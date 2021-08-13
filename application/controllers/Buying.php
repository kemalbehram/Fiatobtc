<?php
/**
 * Classe d'achat
 */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require APPPATH . 'PHPMailer/src/Exception.php';
require APPPATH . 'PHPMailer/src/PHPMailer.php';
require APPPATH . 'PHPMailer/src/SMTP.php';


class Buying extends CI_Controller
{
	
	function index(){
		$session_data= $this->session->userdata('fiato_logged_in');

		$data['id_abonne'] = $session_data['id_abonne'];
	
		$data['role_utilisateur'] = $session_data['role_utilisateur'];
		if (!$data['id_abonne']) {
			redirect(base_url('pages/connexion'));
		}else{

		$data['title'] = 'Achats';
        $data['types'] = "website";
        $data['description'] = "FIATOBTC permet d’acheter, de vendre les crypto monnaies contre du Fiat et aussi permet d’échanger les crypto monnaies entre elles";
        $data['meta_title'] = "FiaToBTC";
        $data['title_page'] = " FiaToBTC ";
        $data['keywords'] = "FiaToBTC, Acheter, vendre, BitCoin, USDT, RDC, Échanger";

        //Recupération du taux d'achat
        $data['product']= $this->product_model->getTauxAchat();

		$this->load->view('templates/header_ach_vente', $data);
		$this->load->view('achats/index', $data);
		$this->load->view('templates/footer_ach_vente');
		}
	}

	//Fonctions de conversion USD en BTC
	function usd_btc(){
		$query = $this->input->post('query');
		echo file_get_contents("https://blockchain.info/tobtc?currency=USD&value=$query");
	}
	function cmd_convert(){
		$query = $this->input->post('request');
		echo file_get_contents("https://blockchain.info/tobtc?currency=USD&value=$query");
	}

	//Enregistrement de la commande d'achat
	function createCommand(){
		$session_data = $this->session->userdata('fiato_logged_in');

        $data['id_abonne'] = $session_data['id_abonne'];
        if (!$data['id_abonne']) {
            redirect(base_url('pages/connexion'));
        } else {

		$this->load->library('form_validation');

        $this->form_validation->set_rules('qte_usd', 'Quantité à acheter', 'required');
        $this->form_validation->set_rules('frais_commission', 'Frais de commission', 'required');
        $this->form_validation->set_rules('total_a_payer', 'Total à payer', 'required');
        $this->form_validation->set_rules('adresse_btc', 'Adresse BitCoin', 'required|min_length[5]|max_length[300]');
        $this->form_validation->set_rules('moyen_paiement', 'Moyen de paiement', 'required|in_list[243,244,245]');
        $this->form_validation->set_rules('id_transaction', 'ID de transaction', 'required|min_length[4]|max_length[200]|is_unique[fiat_buyings.id_transaction]', array(
            'is_unique' => 'L\'ID de transaction que vous venez d\'entrer est déjà enregistré pour une autre commande.'
        ));

        //$data['product']=$this->product_model->getTauxAchat(); Affichage du taux d'achat
        $data['abonne']=$this->buying_model->getEmailAbonne($session_data['id_abonne']);
        $email_abonne= $data['abonne']['email_abonne'];

        $quantite= $this->input->post('qte_usd');
        if($quantite<=1000 || $quantite==50){
            $taux_achat=10;
        }elseif($quantit<=1001 && $quantite <=10000){
            $taux_achat=9.5;
        }elseif ($quantite>10000) {
           $taux_achat=9;
        }

        if ($this->form_validation->run()) {
        	$data = array(
        		'numero_commande' => substr(str_shuffle(str_repeat('123456789', mt_rand(5, 20))), 0, 5),
        		'qte_achete_usd' => htmlentities($this->input->post('qte_usd')),
        		'qte_achete_btc'=>htmlentities($this->input->post('qte_btc')),
                'montant_envoye'=>htmlentities($this->input->post('montant_envoye')),
        		'frais_commission'=>htmlentities($this->input->post('frais_commission')),
        		'taux_achat'=>$taux_achat,
        		'total_a_payer'=>htmlentities($this->input->post('total_a_payer')),
        		'moyen_paiement'=>htmlentities($this->input->post('moyen_paiement')),
        		'id_transaction'=>htmlentities($this->input->post('id_transaction')),
        		'id_abonne'=>$session_data['id_abonne'],
        		'email_abonne'=>$email_abonne,
        		'adresse_btc_client'=>htmlentities($this->input->post('adresse_btc')),
                'phone_transaction'=>htmlentities($this->input->post('phone_transaction')),
                'codeProduit'=>htmlentities($this->input->post('product')),

        	);
        	$this->buying_model->saveCommand($data);
            $array = array(
                'success'=>'<div class="alert-success p-3 text-lg-center">Merci de nous avoir envoyé votre commande! Nous la traitons à cet instant, vous verez son état dans votre panneau de contrôle en cliquant sur <strong><a href="'.base_url('register/myaccount').'">Mes achats</a></strong></div>'
            	
            );
            $this->sendConfirmationEmail($email_abonne);
        } else {
            $array = array(
                'error' => true,
                'qte_usd_error' => form_error('qte_usd'),
                'frais_commission_error' => form_error('frais_commission'),
                'total_a_payer_error' => form_error('total_a_payer'),
                'adresse_btc_error' => form_error('adresse_btc'),
                'moyen_paiement_error' => form_error('moyen_paiement'),
                'id_transaction_error' => form_error('id_transaction')
            );
        }
	}
	echo json_encode($array);
  }

  //Notifications
  function loadVenteAchatNotification()
    {
        if ($_POST["view"] != '') {

            $data = array('statut_view' => 1);
            $this->buying_model->updateNotification($data);
            $this->sales_model->updateNotification($data);
        }

        //NOTIFICATIONS D'ACHATS
        $result = $this->buying_model->fetchAllnotifications();
        $output = '';


        if ($result) {
            foreach ($result as $row) {
                $output .= '
            		<a href="'.base_url('buying/details/'.$row->numero_commande).'" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                          <img src="'.base_url().'assets/img/users/'.$row->photo_abonne.'" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                          <div class="media-body">
                            <h3 class="dropdown-item-title">
                              '.$row->prenom_abonne.'  '.$row->nom_abonne.'
                              <span class="float-right text-sm text-info"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">Achat...</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> '.substr($row->date_commande, 5, 11).' Heures</p>
                          </div>
                        </div>
                        <!-- Message End -->
               		</a>
               		<div class="dropdown-divider"></div>
            ';
            }
            $output .= '
            <div class="dropdown-divider"></div>
            <a href="'.base_url('buying/fetchAll').'" class="dropdown-item dropdown-footer">Voir toutes les commandes d\'achat</a>
            <div class="dropdown-divider"></div>
        ';
        } else {
            $output .= '
         	<div class="dropdown-divider"></div>      
              <a href="#" class="dropdown-item">
                  <i class="fas fa-envelope mr-2"></i>Aucune notification
                  <span class="float-right text-muted text-sm"> ' . date('Y-m-d') . '</span>
             </a>
         ';
        }


        //NOTIFICATION DE VENTES
        $result_vente = $this->sales_model->fetchAllnotifications();
        if ($result_vente) {
            foreach ($result_vente as $row) {
                $output .= '
            		<a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                          <img src="'.base_url().'assets/img/users/'.$row->photo_abonne.'" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                          <div class="media-body">
                            <h3 class="dropdown-item-title">
                              '.$row->prenom_abonne.'  '.$row->nom_abonne.'
                              <span class="float-right text-sm text-success"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">Vente...</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> '.substr($row->created_at, 5, 11).' Heures</p>
                          </div>
                        </div>
                        <!-- Message End -->
               		</a>
               		<div class="dropdown-divider"></div>
            ';
            }
            $output .= '
            <div class="dropdown-divider"></div>
            <a href="'.base_url('sales/fetchAll').'" class="dropdown-item dropdown-footer">Voir toutes les commandes de ventes</a>
        ';
    	}


        //NOMBRE DE NOTIFICATIONS
        $result_1 = $this->buying_model->fetchUnseenNotifications();
        $result_2 = $this->sales_model->fetchUnseenNotifications();
        $count = $result_1 + $result_2; //mysqli_num_rows($result_1);
        $data = array(
            'notification' => $output,
            'unseen_notification' => $count
        );
        echo json_encode($data);
    }

    function details($code){
        $session_data= $this->session->userdata('fiato_logged_in');

        $data['id_abonne'] = $session_data['id_abonne'];
    
        $data['role_utilisateur'] = $session_data['role_utilisateur'];
        if (!$data['id_abonne']) {
            redirect(base_url('pages/connexion'));
        }else{

        $data['title'] = 'Détails Achat';
        $data['types'] = "website";
        $data['description'] = "FIATOBTC permet d’acheter, de vendre les crypto monnaies contre du Fiat et aussi permet d’échanger les crypto monnaies entre elles";
        $data['meta_title'] = "FiaToBTC";
        $data['title_page'] = " FiaToBTC ";
        $data['keywords'] = "FiaToBTC, Acheter, vendre, BitCoin, USDT, RDC, Échanger";

        //Recupération du taux d'achat
        $data['commands']= $this->buying_model->details($code);

        $this->load->view('templates/header', $data);
        $this->load->view('achats/details', $data);
        $this->load->view('templates/footer');
        }
    }

    function preuvePaiment($code){
        $session_data= $this->session->userdata('fiato_logged_in');

        $data['id_abonne'] = $session_data['id_abonne'];
    
        $data['role_utilisateur'] = $session_data['role_utilisateur'];
        if (!$data['id_abonne']) {
            redirect(base_url('pages/connexion'));
        }else{

        $data['title'] = 'Preuve de paiement';
        $data['types'] = "website";
        $data['description'] = "FIATOBTC permet d’acheter, de vendre les crypto monnaies contre du Fiat et aussi permet d’échanger les crypto monnaies entre elles";
        $data['meta_title'] = "FiaToBTC";
        $data['title_page'] = " FiaToBTC ";
        $data['keywords'] = "FiaToBTC, Acheter, vendre, BitCoin, USDT, RDC, Échanger";

        //Recupération du taux d'achat
        $data['commands']= $this->buying_model->details($code);

        $this->load->view('templates/header', $data);
        $this->load->view('achats/preuve_paiement', $data);
        $this->load->view('templates/footer');
    }
    }

    function cancelCommand(){
        $query = $this->input->post('request');
        $this->buying_model->cancelCommand($query);
        echo '<div class="alert alert-success">Commande la commande a été rejetée avec succès</div>';
    }
    function validCommand(){
        $query = $this->input->post('request');
        $this->buying_model->validCommand($query);
        echo '<div class="alert alert-success">La commande a été traitée et validée avec succès</div>';
    }

    function fetchAll(){
        $session_data = $this->session->userdata('fiato_logged_in');

        $data['id_abonne'] = $session_data['id_abonne'];

        $data['role_utilisateur'] = $session_data['role_utilisateur'];
        if (!$data['id_abonne'] || $data['role_utilisateur'] == 'abonne') {

            redirect(base_url('pages/connexion'));

        } else {

            $data['title'] = 'Commandes|Achats';
            $data['types'] = "website";
            $data['description'] = "FIATOBTC permet d’acheter, de vendre les crypto monnaies contre du Fiat et aussi permet d’échanger les crypto monnaies entre elles";
            $data['meta_title'] = "FiaToBTC";
            $data['title_page'] = " FiaToBTC ";
            $data['keywords'] = "FiaToBTC, Acheter, vendre, BitCoin, USDT, RDC, Échanger";

            $data['commandes'] = $this->buying_model->fetchCommandes();
            $data['news'] = $this->buying_model->fetchUnseenNotifications();
            $data['traitees'] = $this->buying_model->fetchTraites();
            $data['encours'] = $this->buying_model->fetchEncours();
            $data['rejetees'] = $this->buying_model->fetchRejetees();
            $data['total'] = $this->buying_model->fetchTotal();
            

            $this->load->view('templates/header', $data);
            $this->load->view('achats/liste', $data);
            $this->load->view('templates/footer');
        }
    }

    function fechAllBonus(){
        $session_data = $this->session->userdata('fiato_logged_in');

        $data['id_abonne'] = $session_data['id_abonne'];

        $data['role_utilisateur'] = $session_data['role_utilisateur'];
        if (!$data['id_abonne'] || $data['role_utilisateur'] == 'abonne') {

            redirect(base_url('pages/connexion'));

        } else {

            $data['title'] = 'Bonus|Achats';
            $data['types'] = "website";
            $data['description'] = "FIATOBTC permet d’acheter, de vendre les crypto monnaies contre du Fiat et aussi permet d’échanger les crypto monnaies entre elles";
            $data['meta_title'] = "FiaToBTC";
            $data['title_page'] = " FiaToBTC ";
            $data['keywords'] = "FiaToBTC, Acheter, vendre, BitCoin, USDT, RDC, Échanger";

            $data['bonus'] = $this->buying_model->fetchBonus();

            $data['regles'] = $this->buying_model->fetchBonusRegles();
            $data['nonregles'] = $this->buying_model->fetchBonusNonRegles();
            $data['total'] = $this->buying_model->fetchBonusTotal();
            
            $this->load->view('templates/header', $data);
            $this->load->view('achats/bonus', $data);
            $this->load->view('templates/footer');
        }
    }

    function reglerBonus(){
        $id_bonus=$_POST['id_bonus'];
        $data= array(
            
            'statut_bonus'=>'réglé',
            'date_reglement'=>date('Y-m-d'),
            'statut_reclamation'=>'fait'
        );
        $this->buying_model->reglerBonus($data, $id_bonus);
        echo '<div class="alert alert-success">Le bonus a été réglé</div>';
        
    }

    function reclamerBonus(){
        $id_bonus=$_POST["bonus_id"];
        $data= array(
            'statut_reclamation'=>'oui'
        );
        $this->buying_model->reclamerBonus($data, $id_bonus);
        echo '<div class="alert alert-success">La reclamation sur ce bonus a été envoyé, une fois traité le <strong>statut</strong> de votre bonus changera en <strong>Réglé</strong>. Merci de patienter !</div>';
    }

    function sendConfirmationEmail($email_abonne){
        $annee_footer= date('Y');
        $from = 'kembtc4@gmail.com';
        $mail = new PHPMailer(TRUE);

        try {
            $mail->setFrom('commercial@fiatobtc.com', 'FiaToBTC');
            $mail->addAddress($from, 'FiaToBTC');
            $mail->Subject = "Nouvelle commande d'achat BTC";
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Body = '
              
                      <body style="background-color: #F2F6FA;">
               <table cellpadding="0" cellspacing="0" class="m_2067806560839729598es-content" align="center" style="border-collapse:collapse;border-spacing:0px;table-layout:fixed!important;width:100%"> 
                 <tbody><tr style="border-collapse:collapse"> 
                  <td align="center" style="padding:0;Margin:0"> 
                   <table bgcolor="#ffffff" align="center" cellpadding="0" cellspacing="0" width="600" style="border-collapse:collapse;border-spacing:0px;background-color:#ffffff"> 
                     <tbody><tr style="border-collapse:collapse"> 
                      <td align="left" style="padding:0;Margin:0;padding-top:20px;padding-left:30px;padding-right:30px"> 
                       <table cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;border-spacing:0px"> 
                         <tbody><tr style="border-collapse:collapse"> 
                          <td width="540" align="center" valign="top" style="padding:0;Margin:0"> 
                           <table cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;border-spacing:0px"> 
                             <tbody><tr style="border-collapse:collapse"> 
                              <td align="center" height="30" style="padding:0;Margin:0"> </td> 
                             </tr> 
                             <tr style="border-collapse:collapse"> 
                              <td align="center" style="padding:0;Margin:0"> <h1 style="Margin:0;line-height:34px;font-family:helvetica,arial,verdana,sans-serif;font-size:28px;font-style:normal;font-weight:bold;color:#0a1e42">Vous venez de récevoir une nouvelle commande d\'achat du BitCoin</h1> </td> 
                             </tr> 
                             <tr style="border-collapse:collapse"> 
                              <td align="center" height="15" style="padding:0;Margin:0"> </td> 
                             </tr> 
                             <tr style="border-collapse:collapse"> 
                              <td align="center" style="padding:0;Margin:0"> <h2 style="Margin:0;line-height:22px;font-family:helvetica,arial,verdana,sans-serif;font-size:18px;font-style:normal;font-weight:normal;color:#0a1e42">De la part de '.$email_abonne.'  !</h2> </td> 
                             </tr> 
                           </tbody></table> </td> 
                         </tr> 
                       </tbody></table> </td> 
                     </tr> 
                   </tbody></table> </td> 
                 </tr> 
               </tbody>
              </table>

           <table cellpadding="0" cellspacing="0" class="m_2067806560839729598es-content" align="center" style="border-collapse:collapse;border-spacing:0px;table-layout:fixed!important;width:100%"> 
            <tbody><tr style="border-collapse:collapse"> 
            <td align="center" style="padding:0;Margin:0"> 
           <table bgcolor="#ffffff" align="center" cellpadding="0" cellspacing="0" width="600" style="border-collapse:collapse;border-spacing:0px;background-color:#ffffff"> 
             <tbody><tr style="border-collapse:collapse"> 
              <td align="center" style="padding:0;Margin:0;padding-left:30px;padding-right:30px"> 
               <table cellpadding="0" cellspacing="0" width="95%" style="border-collapse:collapse;border-spacing:0px"> 
                 <tbody><tr style="border-collapse:collapse"> 
                  <td width="540" align="center" valign="top" style="padding:0;Margin:0"> 
                   <table cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;border-spacing:0px"> 
                     <tbody><tr style="border-collapse:collapse"> 
                      <td align="center" height="20" style="padding:0;Margin:0"> </td> 
                     </tr> 
                     <tr style="border-collapse:collapse"> 
                      <td align="left" class="m_2067806560839729598es-m-txt-l" style="padding:0;Margin:0"> <h3 style="Margin:0;line-height:22px;font-family:helvetica, arial,verdana,sans-serif;font-size:18px;font-style:normal;font-weight:bold;color:#0a1e42; text-align:center"><a  href="'. base_url('buying/fetchAll') .'" rel="noopener noreferrer" target="_blank" data-saferedirecturl="'. base_url('buying/fetchAll') .'">Cliquer sur ce lien pour les détails</a>.</h3></td> 
                     </tr> 
                     <tr style="border-collapse:collapse"> 
                      <td align="center" height="20" style="padding:0;Margin:0"> </td> 
                     </tr>
                     <tr style="border-collapse:collapse"> 
                      
                     </tr>
                     <tr style="border-collapse:collapse"> 
                      <td align="center" height="20" style="padding:0;Margin:0"> </td> 
                     </tr> 
                   </tbody></table> </td> 
                 </tr> 
               </tbody></table> </td> 
             </tr> 
           </tbody></table> </td> 
            </tr> 
            </tbody>
          </table>


           <table cellpadding="0" cellspacing="0" class="m_2067806560839729598es-footer" align="center" style="border-collapse:collapse;border-spacing:0px;table-layout:fixed!important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top"> 
             <tbody><tr style="border-collapse:collapse"> 
              <td align="center" style="padding:0;Margin:0"> 
               <table bgcolor="#ffffff" class="m_2067806560839729598es-footer-body" align="center" cellpadding="0" cellspacing="0" width="600" style="border-collapse:collapse;border-spacing:0px;background-color:#ffffff;border-top:1px solid #ededed"> 
                 <tbody><tr style="border-collapse:collapse"> 
                  <td align="left" style="Margin:0;padding-left:30px;padding-right:30px;padding-top:40px;padding-bottom:40px"> 
                   <table cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;border-spacing:0px"> 
                     <tbody><tr style="border-collapse:collapse"> 
                      <td width="540" align="center" valign="top" style="padding:0;Margin:0"> 
                       <table cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;border-spacing:0px"> 
                         <tbody>
                          <tr style="border-collapse:collapse"> 
                          <td align="center" class="m_2067806560839729598es-m-txt-c" style="padding:0;Margin:0;padding-bottom:10px"> <a href="#" style="font-family:helvetica,arial,verdana,sans-serif;font-size:12px;text-decoration:underline;color:#999999" target="_blank" data-saferedirecturl="#"> <img src="https://www.fiatobtc.com/assets/img/email/email-footer.png" alt="" style="display:block;border:0;outline:none;text-decoration:none" width="170" class="CToWUd"> </a> </td> 
                         </tr> 
                         <tr style="border-collapse:collapse"> 
                          <td align="center" style="padding:0;Margin:0;padding-bottom:10px"> <p style="Margin:0;font-size:11px;font-family:helvetica,arial,verdana,sans-serif;line-height:17px;color:#999999"><a style="font-family:helvetica,arial,verdana,sans-serif;font-size:11px;text-decoration:underline;color:#999999" href="'.base_url('buying').'" target="">Acheter</a>&nbsp; |&nbsp;&nbsp;<a style="font-family:helvetica,arial,verdana,sans-serif;font-size:11px;text-decoration:underline;color:#999999" href="'.base_url('sales').'" target="_blank" data-saferedirecturl="#">Vendre</a>&nbsp; |&nbsp; <a style="font-family:helvetica,arial,verdana,sans-serif;font-size:11px;text-decoration:underline;color:#999999" href="#" target="_blank" data-saferedirecturl="#">Echanger</a>&nbsp; |&nbsp; <a style="font-family:helvetica,arial,verdana,sans-serif;font-size:11px;text-decoration:underline;color:#999999" href="#" target="_blank" data-saferedirecturl="#">Contact</a></p></td> 
                         </tr> 
                         <tr style="border-collapse:collapse"> 
                          <td align="center" style="padding:0;Margin:0"> 
                           <table cellpadding="0" cellspacing="0" class="m_2067806560839729598es-table-not-adapt m_2067806560839729598es-social" style="border-collapse:collapse;border-spacing:0px"> 
                             <tbody><tr style="border-collapse:collapse"> 
                              <td align="center" valign="top" style="padding:0;Margin:0;padding-right:10px"> 
                                <a href="#" style="font-family:helvetica, arial,verdana,sans-serif;font-size:12px;text-decoration:underline;color:#999999" target="_blank" data-saferedirecturl="#"> <img src="https://ci3.googleusercontent.com/proxy/hU2WzS2PyDWPBFnYX3wH7ML_NrKyiQ2Ea000M3Mi-Zc3mFsMYY8-QZa_eZMQnXb_i_0xgC49zbMvDjjWMYl42n1Asjgxo-w2vEcLHOimyF4nLbtPE1AcvloKLTuTneQToe3IzF1xZby0CGGwAoI56OAPJWMdvzwb43y4dKDf4H1ORLm9RyV8KtQfdS6PmavW2JQhMb9KnL2Zvc_jzvLRxm1fm1QThWcTy45uNSNV4xcWkfPxhoNUJQWPPh3m4kw1f6A-LXjP14SMHLscHkpjaTMI4-0=s0-d-e1-ft#https://marketing-image-production.s3.amazonaws.com/uploads/a536842e94841fd7412b8cf4f4731af10bbd1728c2dea2c0c69f9e96cd0b8f83684373abcadf56c360f1022af9e5c90dacade8c23f97e365a709ac439221ecf3.png" alt="Fb" title="Facebook" width="24" height="24" style="display:block;border:0;outline:none;text-decoration:none" class="CToWUd"> </a>
                                 </td> 
                              <td align="center" valign="top" style="padding:0;Margin:0;padding-right:10px"> 
                                <a href="#" style="font-family:helvetica,arial,verdana,sans-serif;font-size:12px;text-decoration:underline;color:#999999" target="_blank" data-saferedirecturl="#"> <img src="https://ci5.googleusercontent.com/proxy/VYOI-U6ViNREkrtUvidwYPRoLOa_GsrJocGSEp6qHWku-EQ-A46FRLOo5yO3kfT_y2zW6WMJ4YYW1Xe13XqOPt2OQCfXjPE9ZvwSD8mN8o9g0H92b2gWmzmcpt_NdblhQH1VJMtD1T_dS5ecH5fv5AiHhVPHPMU_QL5O43vFjX4wqRvFdbKkAJcqlvLbB2_rtQcVhyq2eJwWbX4s6VcqXhX3qbcXKWg6TKgIXnyppQ7iND6MYC-JyeOasDoZz1Y5Nl4DAyn0utQT12cyMep5KaqrLHo=s0-d-e1-ft#https://marketing-image-production.s3.amazonaws.com/uploads/d1ef1d7022812086f5dcd594d61ad4b2c2f41dc0a3367f5f7e16867a8f20f5fbc4a4bafdce8b758af56dfd72fb7881ce1d8ad35a3e2c1d99287d1274917fec56.png" alt="Tw" title="Twitter" width="24" height="24" style="display:block;border:0;outline:none;text-decoration:none" class="CToWUd"> </a> </td> 
                              <td align="center" valign="top" style="padding:0;Margin:0;padding-right:10px"> 
                                <a href="#" style="font-family:helvetica, arial,verdana,sans-serif;font-size:12px;text-decoration:underline;color:#999999" target="_blank" data-saferedirecturl="#"> <img src="https://ci5.googleusercontent.com/proxy/CfeF3RygsLZ4U4u2UQNe7mmjrAfW2jVzwBUQeweDh9fVr7M9-KCgY5w6mCnFKzKu6ob8AkuK3i7Bh24Ou8R6nV9ZXQfPqyF_5CvQ3OYwj-A2v-u6Omx9qfWQ2RMm4JQ7GQOmFA8ieVSx_ZiWcTO5koW_uCgHBrOdkOQc1YftO9GcTXr_HJPP9ULpFn9DE8Hxt_Y4T1cveQHXpmc2eNU-5YfaG6uCOrXfFODURvcneQcj7UqMC8XnCXVHJlxwAvkEhyLkgRMNTfDZbcz_0RaRcFIslx8=s0-d-e1-ft#https://marketing-image-production.s3.amazonaws.com/uploads/ee1eb3291f900f3928ea59e49405e7f89d56db76b9de001644f9defe70017f79a2190f68ab836e4faaab74b67ca71e01b5dfa3781bfffd6fb9797c3946e7a691.png" alt="In" title="Linkedin" width="24" height="24" style="display:block;border:0;outline:none;text-decoration:none" class="CToWUd"> </a> </td> 
                              <td align="center" valign="top" style="padding:0;Margin:0;padding-right:10px"> <a href="#" style="font-family:helvetica,arial,verdana,sans-serif;font-size:12px;text-decoration:underline;color:#999999" target="_blank" data-saferedirecturl="#"> <img src="https://ci6.googleusercontent.com/proxy/nJvfVVdkDB4Hnwn3K59cZRWKGL3rDwxMEIoCOEUBrNZLGRyOSIgmOiv3pAYj-6uUypDV6irC1SivaIz2sjJia1HCtTKKNzViEzbAIouK4VhUgdxFwCBNr94f2qeGPsNUkIvDTkW874zZHXhMjp9yhv9jp8ISzMcfdsJTvceQRUK-NakFHidRWg3gdvdObfZH6I48NJYlC5apUnYv_bj2nW91ZBhqABsLA3ei2md5CMZfgnrL6g-tcpR9mFYHnK_LOpH1HmTc6WnZQjQrD1l7HQpFAhg=s0-d-e1-ft#https://marketing-image-production.s3.amazonaws.com/uploads/fe425a4fe6a7943b516ac86118be7087e81728d9449930e8e0b1ed8fcd7d0513dc833e4a4d8fc53bfa59d326d94caea884e43f253285b48d9c858c8bb3073e96.png" alt="Telegram" title="Telegram" width="24" height="24" style="display:block;border:0;outline:none;text-decoration:none" class="CToWUd"> </a> </td> 
                              <td align="center" valign="top" style="padding:0;Margin:0"> 
                                <a href="#" style="font-family:helvetica,arial,verdana,sans-serif;font-size:12px;text-decoration:underline;color:#999999" target="_blank" data-saferedirecturl="#"> <img src="https://ci5.googleusercontent.com/proxy/uegN1XsIbnaB9tQujjyxSUFUnRqkhEOX1w7WyLszOFnl1WNPWvMgPLv08-0XcPebZAIqBpSv6iW9ft5i7DwZWP4cnP6cCmlwqGuo3a9Xa9VnHGXoeTahDXcM5AKOnKMpgMuZeHDROFKUPx1kdTg3LX9jKgKfy7jlTrWzMkyi64BdtqBzmbKVFrQY4-egW9T3DORGZyx32EYTxDfBirLswg9hWvCI-ol0THpmznyzuQjZC_hs0RX0MuPixlRHwpxzBO7hZbSpi1kzAJTOjlYwdYIflew=s0-d-e1-ft#https://marketing-image-production.s3.amazonaws.com/uploads/f868f23585d96b50efb6708d1a1ebc80ee5a7c19da2e86054bbf9f9355e9b7bdff683cbf72ee54601151562cdcd75cbf7e72e6e17a2030b7572a6b4a390bc41f.png" alt="Ig" title="Instagram" width="24" height="24" style="display:block;border:0;outline:none;text-decoration:none" class="CToWUd"> </a> </td> 
                             </tr> 
                           </tbody></table> </td> 
                         </tr> 
                         <tr style="border-collapse:collapse"> 
                          <td align="center" style="padding:0;Margin:0;padding-top:15px"> <p style="Margin:0;font-size:10px;font-family:helvetica,arial,verdana,sans-serif;line-height:15px;color:#999999">© '.$annee_footer.' FiaToBTC. Tous droits réservés.</p></td> 
                         </tr> 
                       </tbody></table> </td> 
                     </tr> 
                   </tbody></table> </td> 
                 </tr> 
               </tbody></table> </td> 
             </tr> 
           </tbody>
          </table>
                ';
            $mail->isSMTP();
            $mail->Host = 'mail.fiatobtc.com';
            $mail->SMTPAuth = TRUE;
            $mail->SMTPSecure = 'smtp';
            $mail->Username = 'commercial@fiatobtc.com';
            $mail->Password = 'FIATO@2btc';
            $mail->Port = 587;

            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            if (!$mail->send()) {
                echo '<h1 class="alert alert-danger text-center">Message Error : </h1>' . $mail->ErrorInfo;
            } else {
                //echo '<h1 class="alert alert-success text-center">Message has been sent</h1>';
            }

        } catch (Exception $e) {
            //return $redirect;
            echo '<h1 class="alert alert-danger text-center">Impossible d\'envoyer le message</h1>';
            echo $e->errorMessage();
        }
    }

    function fechAllFidelity(){
        $session_data = $this->session->userdata('fiato_logged_in');

        $data['id_abonne'] = $session_data['id_abonne'];

        $data['role_utilisateur'] = $session_data['role_utilisateur'];
        if (!$data['id_abonne'] || $data['role_utilisateur'] == 'abonne') {

            redirect(base_url('pages/connexion'));

        } else {

            $data['title'] = 'Primes|Fidélité';
            $data['types'] = "website";
            $data['description'] = "FIATOBTC permet d’acheter, de vendre les crypto monnaies contre du Fiat et aussi permet d’échanger les crypto monnaies entre elles";
            $data['meta_title'] = "FiaToBTC";
            $data['title_page'] = " FiaToBTC ";
            $data['keywords'] = "FiaToBTC, Acheter, vendre, BitCoin, USDT, RDC, Échanger";

            $data['primes'] = $this->buying_model->fetchFidelity();

            
            $this->load->view('templates/header', $data);
            $this->load->view('achats/primes', $data);
            $this->load->view('templates/footer');
        }
    }

    function createPrime(){
        $session_data = $this->session->userdata('fiato_logged_in');

        $data['id_abonne'] = $session_data['id_abonne'];

        $data['role_utilisateur'] = $session_data['role_utilisateur'];
        if (!$data['id_abonne'] || $data['role_utilisateur'] == 'abonne') {

            redirect(base_url('pages/connexion'));

        } else {

            $data['title'] = 'Primes|Fidélité';
            $data['types'] = "website";
            $data['description'] = "FIATOBTC permet d’acheter, de vendre les crypto monnaies contre du Fiat et aussi permet d’échanger les crypto monnaies entre elles";
            $data['meta_title'] = "FiaToBTC";
            $data['title_page'] = " FiaToBTC ";
            $data['keywords'] = "FiaToBTC, Acheter, vendre, BitCoin, USDT, RDC, Échanger";
            
            $data['abonnes'] = $this->buying_model->fetchValid();
            $this->load->view('templates/header', $data);
            $this->load->view('achats/create_prime', $data);
            $this->load->view('templates/footer');
        }
    }
    function sendPrime(){
        $email_abonne=$this->input->post('email_abonne');
        $from = $email_abonne;
        $mail = new PHPMailer(TRUE);

        $motif=$this->input->post('motif');
        $montant=$this->input->post('montant');


        try {
            $mail->setFrom('no-reply@fiatobtc.com', 'FiaToBTC');
            $mail->addAddress($from, 'FiaToBTC');
            $mail->Subject = "Félicitations ! Vous avez gagné la prime de Fidélité";
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Body = '
              
                      <body style="background-color: #F2F6FA;">
               <table cellpadding="0" cellspacing="0" class="m_2067806560839729598es-content" align="center" style="border-collapse:collapse;border-spacing:0px;table-layout:fixed!important;width:100%"> 
                 <tbody><tr style="border-collapse:collapse"> 
                  <td align="center" style="padding:0;Margin:0"> 
                   <table bgcolor="#ffffff" align="center" cellpadding="0" cellspacing="0" width="600" style="border-collapse:collapse;border-spacing:0px;background-color:#ffffff"> 
                     <tbody><tr style="border-collapse:collapse"> 
                      <td align="left" style="padding:0;Margin:0;padding-top:20px;padding-left:30px;padding-right:30px"> 
                       <table cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;border-spacing:0px"> 
                         <tbody><tr style="border-collapse:collapse"> 
                          <td width="540" align="center" valign="top" style="padding:0;Margin:0"> 
                           <table cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;border-spacing:0px"> 
                             <tbody><tr style="border-collapse:collapse"> 
                              <td align="center" height="30" style="padding:0;Margin:0"> </td> 
                             </tr> 
                             <tr style="border-collapse:collapse"> 
                              <td align="center" style="padding:0;Margin:0"> <h1 style="Margin:0;line-height:34px;font-family:helvetica,arial,verdana,sans-serif;font-size:28px;font-style:normal;font-weight:bold;color:#0a1e42">FiaToBTC vous récompense pour avoir été un abonné fidèle.</h1> </td> 
                             </tr> 
                             <tr style="border-collapse:collapse"> 
                              <td align="center" height="15" style="padding:0;Margin:0"> </td> 
                             </tr> 
                             <tr style="border-collapse:collapse"> 
                              <td align="center" style="padding:0;Margin:0"> <h3 style="Margin:0;line-height:22px;font-family:helvetica,arial,verdana,sans-serif;font-size:18px;font-style:normal;font-weight:normal;color:#0a1e42">USD '.$montant.' vous ont été offerts!</h3> </td> 
                             </tr> 
                           </tbody></table> </td> 
                         </tr> 
                       </tbody></table> </td> 
                     </tr> 
                   </tbody></table> </td> 
                 </tr> 
               </tbody>
              </table>

           <table cellpadding="0" cellspacing="0" class="m_2067806560839729598es-content" align="center" style="border-collapse:collapse;border-spacing:0px;table-layout:fixed!important;width:100%"> 
            <tbody><tr style="border-collapse:collapse"> 
            <td align="center" style="padding:0;Margin:0"> 
           <table bgcolor="#ffffff" align="center" cellpadding="0" cellspacing="0" width="600" style="border-collapse:collapse;border-spacing:0px;background-color:#ffffff"> 
             <tbody><tr style="border-collapse:collapse"> 
              <td align="center" style="padding:0;Margin:0;padding-left:30px;padding-right:30px"> 
               <table cellpadding="0" cellspacing="0" width="95%" style="border-collapse:collapse;border-spacing:0px"> 
                 <tbody><tr style="border-collapse:collapse"> 
                  <td width="540" align="center" valign="top" style="padding:0;Margin:0"> 
                   <table cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;border-spacing:0px"> 
                     <tbody><tr style="border-collapse:collapse"> 
                      <td align="center" height="20" style="padding:0;Margin:0"> </td> 
                     </tr> 
                     <tr style="border-collapse:collapse"> 
                      <td align="left" class="m_2067806560839729598es-m-txt-l" style="padding:0;Margin:0"> <h4 style="Margin:0;line-height:22px;font-family:helvetica, arial,verdana,sans-serif;font-size:18px;font-style:normal;font-weight:bold;color:#0a1e42; text-align:center">'.$motif.'</h4></td> 
                     </tr> 
                     <tr style="border-collapse:collapse"> 
                      <td align="center" height="20" style="padding:0;Margin:0"> </td> 
                     </tr>
                     <tr style="border-collapse:collapse"> 
                      
                     </tr>
                     <tr style="border-collapse:collapse"> 
                      <td align="center" height="20" style="padding:0;Margin:0"> </td> 
                     </tr> 
                   </tbody></table> </td> 
                 </tr> 
               </tbody></table> </td> 
             </tr> 
           </tbody></table> </td> 
            </tr> 
            </tbody>
          </table>


           <table cellpadding="0" cellspacing="0" class="m_2067806560839729598es-footer" align="center" style="border-collapse:collapse;border-spacing:0px;table-layout:fixed!important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top"> 
             <tbody><tr style="border-collapse:collapse"> 
              <td align="center" style="padding:0;Margin:0"> 
               <table bgcolor="#ffffff" class="m_2067806560839729598es-footer-body" align="center" cellpadding="0" cellspacing="0" width="600" style="border-collapse:collapse;border-spacing:0px;background-color:#ffffff;border-top:1px solid #ededed"> 
                 <tbody><tr style="border-collapse:collapse"> 
                  <td align="left" style="Margin:0;padding-left:30px;padding-right:30px;padding-top:40px;padding-bottom:40px"> 
                   <table cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;border-spacing:0px"> 
                     <tbody><tr style="border-collapse:collapse"> 
                      <td width="540" align="center" valign="top" style="padding:0;Margin:0"> 
                       <table cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;border-spacing:0px"> 
                         <tbody>
                          <tr style="border-collapse:collapse"> 
                          <td align="center" class="m_2067806560839729598es-m-txt-c" style="padding:0;Margin:0;padding-bottom:10px"> <a href="#" style="font-family:helvetica,arial,verdana,sans-serif;font-size:12px;text-decoration:underline;color:#999999" target="_blank" data-saferedirecturl="#"> <img src="https://www.fiatobtc.com/assets/img/email/email-footer.png" alt="" style="display:block;border:0;outline:none;text-decoration:none" width="170" class="CToWUd"> </a> </td> 
                         </tr> 
                         <tr style="border-collapse:collapse"> 
                          <td align="center" style="padding:0;Margin:0;padding-bottom:10px"> <p style="Margin:0;font-size:11px;font-family:helvetica,arial,verdana,sans-serif;line-height:17px;color:#999999"><a style="font-family:helvetica,arial,verdana,sans-serif;font-size:11px;text-decoration:underline;color:#999999" href="'.base_url('buying').'" target="">Acheter</a>&nbsp; |&nbsp;&nbsp;<a style="font-family:helvetica,arial,verdana,sans-serif;font-size:11px;text-decoration:underline;color:#999999" href="'.base_url('sales').'" target="_blank" data-saferedirecturl="#">Vendre</a>&nbsp; |&nbsp; <a style="font-family:helvetica,arial,verdana,sans-serif;font-size:11px;text-decoration:underline;color:#999999" href="#" target="_blank" data-saferedirecturl="#">Echanger</a>&nbsp; |&nbsp; <a style="font-family:helvetica,arial,verdana,sans-serif;font-size:11px;text-decoration:underline;color:#999999" href="#" target="_blank" data-saferedirecturl="#">Contact</a></p></td> 
                         </tr> 
                         <tr style="border-collapse:collapse"> 
                          <td align="center" style="padding:0;Margin:0"> 
                           <table cellpadding="0" cellspacing="0" class="m_2067806560839729598es-table-not-adapt m_2067806560839729598es-social" style="border-collapse:collapse;border-spacing:0px"> 
                             <tbody><tr style="border-collapse:collapse"> 
                              <td align="center" valign="top" style="padding:0;Margin:0;padding-right:10px"> 
                                <a href="#" style="font-family:helvetica, arial,verdana,sans-serif;font-size:12px;text-decoration:underline;color:#999999" target="_blank" data-saferedirecturl="#"> <img src="https://ci3.googleusercontent.com/proxy/hU2WzS2PyDWPBFnYX3wH7ML_NrKyiQ2Ea000M3Mi-Zc3mFsMYY8-QZa_eZMQnXb_i_0xgC49zbMvDjjWMYl42n1Asjgxo-w2vEcLHOimyF4nLbtPE1AcvloKLTuTneQToe3IzF1xZby0CGGwAoI56OAPJWMdvzwb43y4dKDf4H1ORLm9RyV8KtQfdS6PmavW2JQhMb9KnL2Zvc_jzvLRxm1fm1QThWcTy45uNSNV4xcWkfPxhoNUJQWPPh3m4kw1f6A-LXjP14SMHLscHkpjaTMI4-0=s0-d-e1-ft#https://marketing-image-production.s3.amazonaws.com/uploads/a536842e94841fd7412b8cf4f4731af10bbd1728c2dea2c0c69f9e96cd0b8f83684373abcadf56c360f1022af9e5c90dacade8c23f97e365a709ac439221ecf3.png" alt="Fb" title="Facebook" width="24" height="24" style="display:block;border:0;outline:none;text-decoration:none" class="CToWUd"> </a>
                                 </td> 
                              <td align="center" valign="top" style="padding:0;Margin:0;padding-right:10px"> 
                                <a href="#" style="font-family:helvetica,arial,verdana,sans-serif;font-size:12px;text-decoration:underline;color:#999999" target="_blank" data-saferedirecturl="#"> <img src="https://ci5.googleusercontent.com/proxy/VYOI-U6ViNREkrtUvidwYPRoLOa_GsrJocGSEp6qHWku-EQ-A46FRLOo5yO3kfT_y2zW6WMJ4YYW1Xe13XqOPt2OQCfXjPE9ZvwSD8mN8o9g0H92b2gWmzmcpt_NdblhQH1VJMtD1T_dS5ecH5fv5AiHhVPHPMU_QL5O43vFjX4wqRvFdbKkAJcqlvLbB2_rtQcVhyq2eJwWbX4s6VcqXhX3qbcXKWg6TKgIXnyppQ7iND6MYC-JyeOasDoZz1Y5Nl4DAyn0utQT12cyMep5KaqrLHo=s0-d-e1-ft#https://marketing-image-production.s3.amazonaws.com/uploads/d1ef1d7022812086f5dcd594d61ad4b2c2f41dc0a3367f5f7e16867a8f20f5fbc4a4bafdce8b758af56dfd72fb7881ce1d8ad35a3e2c1d99287d1274917fec56.png" alt="Tw" title="Twitter" width="24" height="24" style="display:block;border:0;outline:none;text-decoration:none" class="CToWUd"> </a> </td> 
                              <td align="center" valign="top" style="padding:0;Margin:0;padding-right:10px"> 
                                <a href="#" style="font-family:helvetica, arial,verdana,sans-serif;font-size:12px;text-decoration:underline;color:#999999" target="_blank" data-saferedirecturl="#"> <img src="https://ci5.googleusercontent.com/proxy/CfeF3RygsLZ4U4u2UQNe7mmjrAfW2jVzwBUQeweDh9fVr7M9-KCgY5w6mCnFKzKu6ob8AkuK3i7Bh24Ou8R6nV9ZXQfPqyF_5CvQ3OYwj-A2v-u6Omx9qfWQ2RMm4JQ7GQOmFA8ieVSx_ZiWcTO5koW_uCgHBrOdkOQc1YftO9GcTXr_HJPP9ULpFn9DE8Hxt_Y4T1cveQHXpmc2eNU-5YfaG6uCOrXfFODURvcneQcj7UqMC8XnCXVHJlxwAvkEhyLkgRMNTfDZbcz_0RaRcFIslx8=s0-d-e1-ft#https://marketing-image-production.s3.amazonaws.com/uploads/ee1eb3291f900f3928ea59e49405e7f89d56db76b9de001644f9defe70017f79a2190f68ab836e4faaab74b67ca71e01b5dfa3781bfffd6fb9797c3946e7a691.png" alt="In" title="Linkedin" width="24" height="24" style="display:block;border:0;outline:none;text-decoration:none" class="CToWUd"> </a> </td> 
                              <td align="center" valign="top" style="padding:0;Margin:0;padding-right:10px"> <a href="#" style="font-family:helvetica,arial,verdana,sans-serif;font-size:12px;text-decoration:underline;color:#999999" target="_blank" data-saferedirecturl="#"> <img src="https://ci6.googleusercontent.com/proxy/nJvfVVdkDB4Hnwn3K59cZRWKGL3rDwxMEIoCOEUBrNZLGRyOSIgmOiv3pAYj-6uUypDV6irC1SivaIz2sjJia1HCtTKKNzViEzbAIouK4VhUgdxFwCBNr94f2qeGPsNUkIvDTkW874zZHXhMjp9yhv9jp8ISzMcfdsJTvceQRUK-NakFHidRWg3gdvdObfZH6I48NJYlC5apUnYv_bj2nW91ZBhqABsLA3ei2md5CMZfgnrL6g-tcpR9mFYHnK_LOpH1HmTc6WnZQjQrD1l7HQpFAhg=s0-d-e1-ft#https://marketing-image-production.s3.amazonaws.com/uploads/fe425a4fe6a7943b516ac86118be7087e81728d9449930e8e0b1ed8fcd7d0513dc833e4a4d8fc53bfa59d326d94caea884e43f253285b48d9c858c8bb3073e96.png" alt="Telegram" title="Telegram" width="24" height="24" style="display:block;border:0;outline:none;text-decoration:none" class="CToWUd"> </a> </td> 
                              <td align="center" valign="top" style="padding:0;Margin:0"> 
                                <a href="#" style="font-family:helvetica,arial,verdana,sans-serif;font-size:12px;text-decoration:underline;color:#999999" target="_blank" data-saferedirecturl="#"> <img src="https://ci5.googleusercontent.com/proxy/uegN1XsIbnaB9tQujjyxSUFUnRqkhEOX1w7WyLszOFnl1WNPWvMgPLv08-0XcPebZAIqBpSv6iW9ft5i7DwZWP4cnP6cCmlwqGuo3a9Xa9VnHGXoeTahDXcM5AKOnKMpgMuZeHDROFKUPx1kdTg3LX9jKgKfy7jlTrWzMkyi64BdtqBzmbKVFrQY4-egW9T3DORGZyx32EYTxDfBirLswg9hWvCI-ol0THpmznyzuQjZC_hs0RX0MuPixlRHwpxzBO7hZbSpi1kzAJTOjlYwdYIflew=s0-d-e1-ft#https://marketing-image-production.s3.amazonaws.com/uploads/f868f23585d96b50efb6708d1a1ebc80ee5a7c19da2e86054bbf9f9355e9b7bdff683cbf72ee54601151562cdcd75cbf7e72e6e17a2030b7572a6b4a390bc41f.png" alt="Ig" title="Instagram" width="24" height="24" style="display:block;border:0;outline:none;text-decoration:none" class="CToWUd"> </a> </td> 
                             </tr> 
                           </tbody></table> </td> 
                         </tr> 
                         <tr style="border-collapse:collapse"> 
                          <td align="center" style="padding:0;Margin:0;padding-top:15px"> <p style="Margin:0;font-size:10px;font-family:helvetica,arial,verdana,sans-serif;line-height:15px;color:#999999">© '.$annee_footer.' FiaToBTC. Tous droits réservés.</p></td> 
                         </tr> 
                       </tbody></table> </td> 
                     </tr> 
                   </tbody></table> </td> 
                 </tr> 
               </tbody></table> </td> 
             </tr> 
           </tbody>
          </table>
                ';
            $mail->isSMTP();
            $mail->Host = 'mail.fiatobtc.com';
            $mail->SMTPAuth = TRUE;
            $mail->SMTPSecure = 'smtp';
            $mail->Username = 'no-reply@fiatobtc.com';
            $mail->Password = 'FIATO@2btc';
            $mail->Port = 587;

            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            if (!$mail->send()) {
                echo '<h1 class="alert alert-danger text-center">Message Error : </h1>' . $mail->ErrorInfo;
            } else {
                //echo '<h1 class="alert alert-success text-center">Message has been sent</h1>';
                $this->savePrime();
            }

        } catch (Exception $e) {
            //return $redirect;
            echo '<h1 class="alert alert-danger text-center">Impossible d\'envoyer le mail </h1>';
            echo $e->errorMessage();
        }
    }
    function savePrime(){
        $data=array(
            'email_abonne'=>$this->input->post('email_abonne'),
            'montant'=>$this->input->post('montant'),
            'motif'=>$this->input->post('motif')
        );
        $this->buying_model->savePrime($data);
        $this->session->flashdata('primesent', 'La prime a été enregistrée et l\'email a été envoyé à l\'abonné !');
        redirect(base_url('buying/fechAllFidelity'));
    }

}