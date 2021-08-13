<?php
/**
 * Created by PhpStorm.
 * User: Congo Agile
 * Date: 31/03/2021
 * Time: 19:41
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require APPPATH . 'PHPMailer/src/Exception.php';
require APPPATH . 'PHPMailer/src/PHPMailer.php';
require APPPATH . 'PHPMailer/src/SMTP.php';

class Exchange extends CI_Controller
{

    function index()
    {
        $this->load->view('templates/header');
        $this->load->view('exchanges/index');
        $this->load->view('templates/footer');
    }

    function dataHeader($str)
    {
        $data['title'] = $str;
        $data['types'] = "website";
        $data['description'] = "FIATOBTC permet d’acheter, de vendre  et d'echanger les crypto monnaies contre du Fiat et aussi permet d’échanger les crypto monnaies entre elles";
        $data['meta_title'] = "FiaToBTC";
        $data['title_page'] = " FiaToBTC ";
        $data['keywords'] = "FiaToBTC, Acheter, vendre, BitCoin, USDT, RDC, Échanger";
        return $data;
    }

    /*________________________________START FIAT VS CRYPTO FUNCTION________________________________________*/

    //Fonction d'echange de crypto contre les fiats
    function cryptoTofiat()
    {
        $session_data = $this->session->userdata('fiato_logged_in');

        $data['id_abonne'] = $session_data['id_abonne'];


        //RECUPERATION DE L'EMAIL DE L'ABONNE PAR SESSION
        $data['mailabonne'] = $this->sales_model->get_email_abonne($session_data['id_abonne']);
        $email_abonne = $data['mailabonne']['email_abonne'];
        //
        $data['role_utilisateur'] = $session_data['role_utilisateur'];
        if (!$data['id_abonne']) {
            redirect(base_url('pages/connexion'));
        } else {

            $title = "Echange des Cryptos contre le Fiat";
        }
        if (isset($_POST['btnUpdate'])) {
            $newdata = array(
                'product' => htmlentities($this->input->post('product')),
                'cryptoAdresse' => htmlentities($this->input->post('cryptoAdresse')),
                'qte' => htmlentities($this->input->post('qte')),
                'taux' => htmlentities($this->input->post('taux')),
                'moyen_paiement' => htmlentities($this->input->post('moyen_paiement')),
                'telephone' => htmlentities($this->input->post('telephone')),
                'hash' => htmlentities($this->input->post('hash'))
                //'logged_in' => TRUE
            );
            $viewdata['data'] = $newdata;

        } elseif (isset($_POST['btnConfirm'])) {
            return $this->sendConfirmationEmail($email_abonne);
        } else {
            $viewdata['data'] = null;
        }
        $viewdata['userorderdata'] = $this->exchange_model->fetchUserOrderData($session_data['id_abonne']);
        $viewdata['soldes'] = $this->exchange_model->getUserSolde($session_data['id_abonne']);

        $this->load->view('templates/header', $this->dataHeader($title));
        $this->load->view('exchanges/cryptofiat/crypto_fiat', $viewdata);
        $this->load->view('templates/footer');
    }

    //Function de visualisation avant confirmation
    function postView()
    {
        $newdata = array(
            'product' => htmlentities($this->input->post('product')),
            'cryptoAdresse' => htmlentities($this->input->post('cryptoAdresse')),
            'qte' => htmlentities($this->input->post('qte')),
            'taux' => htmlentities($this->input->post('taux')),
            'moyen_paiement' => htmlentities($this->input->post('moyen_paiement')),
            'telephone' => htmlentities($this->input->post('telephone')),
            'hash' => htmlentities($this->input->post('hash'))
        );
        $viewdata['data'] = $newdata;//$this->session->set_userdata($newdata);//

        $title = "Echange des Cryptos contre le Fiat";

        $this->load->view('templates/header', $this->dataHeader($title));
        $this->load->view('exchanges/cryptofiat/postview', $viewdata);
        $this->load->view('templates/footer');
    }

    //Fonction de confirmation de l'ordre vente
    function confirm()
    {
        $session_data = $this->session->userdata('fiato_logged_in');
        $data['id_abonne'] = $session_data['id_abonne'];

        $data['mailabonne'] = $this->sales_model->get_email_abonne($session_data['id_abonne']);
        $email_abonne = $data['mailabonne']['email_abonne'];

        var_dump($email_abonne);
    }

    function sendConfirmationEmail($email_abonne)
    {
        $annee_footer = date('Y');
        $from = 'kembtc4@gmail.com';
        $mail = new PHPMailer(TRUE);

        try {
            $mail->setFrom('commercial@fiatobtc.com', 'FiaToBTC');
            $mail->addAddress($from, 'FiaToBTC');
            $mail->Subject = "Nouvel ordre d'exchange";
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
                              <td align="center" style="padding:0;Margin:0"> <h1 style="Margin:0;line-height:34px;font-family:helvetica,arial,verdana,sans-serif;font-size:28px;font-style:normal;font-weight:bold;color:#0a1e42">Vous venez de récevoir une nouvelle demande d\'echange.</h1> </td> 
                             </tr> 
                             <tr style="border-collapse:collapse"> 
                              <td align="center" height="15" style="padding:0;Margin:0"> </td> 
                             </tr> 
                             <tr style="border-collapse:collapse"> 
                              <td align="center" style="padding:0;Margin:0"> <h2 style="Margin:0;line-height:22px;font-family:helvetica,arial,verdana,sans-serif;font-size:18px;font-style:normal;font-weight:normal;color:#0a1e42">De la part de ' . $email_abonne . '  !</h2> </td> 
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
                          <td align="center" style="padding:0;Margin:0;padding-bottom:10px"> <p style="Margin:0;font-size:11px;font-family:helvetica,arial,verdana,sans-serif;line-height:17px;color:#999999"><a style="font-family:helvetica,arial,verdana,sans-serif;font-size:11px;text-decoration:underline;color:#999999" href="' . base_url('buying') . '" target="">Acheter</a>&nbsp; |&nbsp;&nbsp;<a style="font-family:helvetica,arial,verdana,sans-serif;font-size:11px;text-decoration:underline;color:#999999" href="' . base_url('sales') . '" target="_blank" data-saferedirecturl="#">Vendre</a>&nbsp; |&nbsp; <a style="font-family:helvetica,arial,verdana,sans-serif;font-size:11px;text-decoration:underline;color:#999999" href="#" target="_blank" data-saferedirecturl="#">Echanger</a>&nbsp; |&nbsp; <a style="font-family:helvetica,arial,verdana,sans-serif;font-size:11px;text-decoration:underline;color:#999999" href="#" target="_blank" data-saferedirecturl="#">Contact</a></p></td> 
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
                          <td align="center" style="padding:0;Margin:0;padding-top:15px"> <p style="Margin:0;font-size:10px;font-family:helvetica,arial,verdana,sans-serif;line-height:15px;color:#999999">© ' . $annee_footer . ' FiaToBTC. Tous droits réservés.</p></td> 
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
                $this->saveData();
            }

        } catch (Exception $e) {
            //return $redirect;
            $this->saveData();
            echo '<h1 class="alert alert-danger text-center">Impossible d\'envoyer le message</h1>';
            echo $e->errorMessage();
        }
    }

    /*Envoi de mail à l'abonné pour la confirmation ou le rejet de sa demande*/
    function sendValidCancelEmail($email_abonne, $motif, $message)
    {
        $annee_footer = date('Y');
        $from = $email_abonne;
        $mail = new PHPMailer(TRUE);

        try {
            $mail->setFrom('commercial@fiatobtc.com', 'FiaToBTC');
            $mail->addAddress($from, 'FiaToBTC');
            $mail->Subject = $motif;
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
                              <td align="center" style="padding:0;Margin:0"> <h1 style="Margin:0;line-height:34px;font-family:helvetica,arial,verdana,sans-serif;font-size:28px;font-style:normal;font-weight:bold;color:#0a1e42">' . $motif . '</h1> </td> 
                             </tr> 
                             <tr style="border-collapse:collapse"> 
                              <td align="center" height="15" style="padding:0;Margin:0"> </td> 
                             </tr> 
                             <tr style="border-collapse:collapse"> 
                              <td align="center" style="padding:0;Margin:0"> <h2 style="Margin:0;line-height:22px;font-family:helvetica,arial,verdana,sans-serif;font-size:18px;font-style:normal;font-weight:normal;color:#0a1e42"> ' . $message . '  !</h2> </td> 
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
                      <td align="left" class="m_2067806560839729598es-m-txt-l" style="padding:0;Margin:0"> <h3 style="Margin:0;line-height:22px;font-family:helvetica, arial,verdana,sans-serif;font-size:18px;font-style:normal;font-weight:bold;color:#0a1e42; text-align:center"><a  href="https://www.fiatobtc.com" rel="noopener noreferrer" target="_blank" data-saferedirecturl="https://www.fiatobtc.com">Cliquer sur ce lien pour accéder à notre page d\'accueil</a>.</h3></td> 
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
                          <td align="center" style="padding:0;Margin:0;padding-bottom:10px"> <p style="Margin:0;font-size:11px;font-family:helvetica,arial,verdana,sans-serif;line-height:17px;color:#999999"><a style="font-family:helvetica,arial,verdana,sans-serif;font-size:11px;text-decoration:underline;color:#999999" href="' . base_url('buying') . '" target="">Acheter</a>&nbsp; |&nbsp;&nbsp;<a style="font-family:helvetica,arial,verdana,sans-serif;font-size:11px;text-decoration:underline;color:#999999" href="' . base_url('sales') . '" target="_blank" data-saferedirecturl="#">Vendre</a>&nbsp; |&nbsp; <a style="font-family:helvetica,arial,verdana,sans-serif;font-size:11px;text-decoration:underline;color:#999999" href="#" target="_blank" data-saferedirecturl="#">Echanger</a>&nbsp; |&nbsp; <a style="font-family:helvetica,arial,verdana,sans-serif;font-size:11px;text-decoration:underline;color:#999999" href="#" target="_blank" data-saferedirecturl="#">Contact</a></p></td> 
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
                          <td align="center" style="padding:0;Margin:0;padding-top:15px"> <p style="Margin:0;font-size:10px;font-family:helvetica,arial,verdana,sans-serif;line-height:15px;color:#999999">© ' . $annee_footer . ' FiaToBTC. Tous droits réservés.</p></td> 
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
            }

        } catch (Exception $e) {
            echo '<h1 class="alert alert-danger text-center">Impossible d\'envoyer le message</h1>';
            echo $e->errorMessage();
        }
    }

    //Enregistrement de données d'echange CRYPTO-FIAT
    function saveData()
    {
        $session_data = $this->session->userdata('fiato_logged_in');
        $data['id_abonne'] = $session_data['id_abonne'];

        $data['mailabonne'] = $this->sales_model->get_email_abonne($session_data['id_abonne']);
        $email_abonne = $data['mailabonne']['email_abonne'];

        $newdata = array(
            'product' => htmlentities($this->input->post('product')),
            'cryptoAdresse' => htmlentities($this->input->post('cryptoAdresse')),
            'qte' => htmlentities($this->input->post('qte')),
            'taux' => htmlentities($this->input->post('taux')),
            'moyen_paiement' => htmlentities($this->input->post('moyen_paiement')),
            'telephone' => htmlentities($this->input->post('telephone')),
            'hash' => htmlentities($this->input->post('hash')),
            'id_abonne' => $data['id_abonne'],
            'email_abonne' => $email_abonne,
            'date_envoi' => date('Y-m-d')
        );
        $this->exchange_model->saveDataCryptoFiat($newdata);

        $this->session->set_flashdata('demande_sent',
            "Votre ordre d'echange a été envoyé, Vous serez notifié par mail une fois 
            qu'il sera traité, Merci de patienter !");
        redirect(base_url('exchange/cryptoTofiat'));
    }

    //Liste d'ordre d'echange de  CRYPTO CONTRE FIAT
    function fetchCryptoFiat()
    {
        $session_data = $this->session->userdata('fiato_logged_in');

        $data['id_abonne'] = $session_data['id_abonne'];

        $data['role_utilisateur'] = $session_data['role_utilisateur'];
        if (!$data['id_abonne'] || $data['role_utilisateur'] == 'abonne') {
            redirect(base_url('pages/connexion'));

        } else {

            $title = "Liste de demandes d'Echange de Cryptos contre les Fiat ";

            $data['commandes'] = $this->exchange_model->fetchCommandesCF();
            $data['cancel'] = $this->exchange_model->fetchUCancelsCF();
            $data['traitees'] = $this->exchange_model->fetchTraitesCF();
            $data['encours'] = $this->exchange_model->fetchEncoursCF();
            $data['rejetees'] = $this->exchange_model->fetchRejeteesCF();
            $data['total'] = $this->exchange_model->fetchTotalCF();


            $this->load->view('templates/header', $this->dataHeader($title));
            $this->load->view('exchanges/cryptofiat/listeCryptoFiat', $data);
            $this->load->view('templates/footer');
        }
    }

    function detailCryptoFiat($id)
    {
        $session_data = $this->session->userdata('fiato_logged_in');

        $data['id_abonne'] = $session_data['id_abonne'];

        $data['role_utilisateur'] = $session_data['role_utilisateur'];
        if (!$data['id_abonne']) {
            redirect(base_url('pages/connexion'));
        } else {

            $title = 'Détails de la demande d\'echange Crypto contre Fiat';

            $data['commands'] = $this->exchange_model->detailsCF($id);

            $this->load->view('templates/header', $this->dataHeader($title));
            $this->load->view('exchanges/cryptofiat/detailCryptoFiat', $data);
            $this->load->view('templates/footer');
        }
    }


    /* Fonction de validation de la demande d'echange */
    function validDemandeCryptoFiat()
    {
        $query = $this->input->post('request');
        $email_abonne = $this->input->post('email');
        $prenom = $this->input->post('prenom');
        $motif = "Ordre d'echange de crypto contre du fiat accepté ";
        $this->exchange_model->validDemandeCryptoFiat($query);

        $message = " Bonjour $prenom , Nous vous informons que votre ordre d'echange de Crypto-Monnaie contre du Fiat a été Acceptée, Vous pouvez désormais le voir affiché sur la page d'accueil en attente d'un acheteur. Merci pour la confiance! ";

        $this->sendValidCancelEmail($email_abonne, $motif, $message);
        echo '<div class="alert alert-success">La demande a été traitée et validée avec succès</div>';
    }

    function cancelDemandeCryptoFiat()
    {
        $query = $this->input->post('request');
        $email_abonne = $this->input->post('email');
        $prenom = $this->input->post('prenom');
        $motif = "Rejet de l'Ordre de vente de crypto contre du fiat";
        $message = " Bonjour $prenom , Nous vous informons que votre ordre d'echange de Crypto-Monnaie contre du Fiat a été réjeté suite au non respect de clause de votre part. Merci d'avoir compris !";

        $this->exchange_model->cancelDemandeCryptoFiat($query);
        $this->sendValidCancelEmail($email_abonne, $motif, $message);
        echo '<div class="alert alert-success">La commande a été rejetée !</div>';
    }

    /*Création du  solde*/
    function createsoldeCryptoFiat()
    {
        $session_data = $this->session->userdata('fiato_logged_in');
        $data['id_abonne'] = $session_data['id_abonne'];

        //RECUPERATION DE L'EMAIL DE L'ABONNE PAR SESSION
        $data['mailabonne'] = $this->sales_model->get_email_abonne($session_data['id_abonne']);
        $email_abonne = $data['mailabonne']['email_abonne'];
        $motif = "Recharge du solde";
        $message = "Vous venez de recevoir une demande de recharge de solde de la part de $email_abonne";


        $datasolde = array(
            'quantite_depose' => htmlentities($this->input->post('quantite_depose')),
            'product' => htmlentities($this->input->post('product')),
            'cryptoAdresse' => htmlentities($this->input->post('cryptoAdresse')),
            'hash' => htmlentities($this->input->post('hash')),
            'id_abonne' => $session_data['id_abonne'],
        );
        $this->exchange_model->createUserSolde($datasolde);

        $this->sendNotificationSolde($motif, $message);

        $this->session->set_flashdata('solde_sent',
            "Votre demande de recharge de solde a été envoyée et est en cours de vérification, Vous serez notifié par mail une fois 
            qu'elle sera traité, Merci de patienter !");

        redirect(base_url('exchange/cryptoTofiat'));

    }

    //Envoi de notification de la notification sur la recharge du solde

    function sendNotificationSolde($motif, $message)
    {
        $annee_footer = date('Y');
        $from = 'kembtc4@gmail.com'; //$email
        $mail = new PHPMailer(TRUE);

        try {
            $mail->setFrom('commercial@fiatobtc.com', 'FiaToBTC');
            $mail->addAddress($from, 'FiaToBTC');
            $mail->Subject = $motif;
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
                              <td align="center" style="padding:0;Margin:0"> <h1 style="Margin:0;line-height:34px;font-family:helvetica,arial,verdana,sans-serif;font-size:28px;font-style:normal;font-weight:bold;color:#0a1e42">' . $motif . '</h1> </td> 
                             </tr> 
                             <tr style="border-collapse:collapse"> 
                              <td align="center" height="15" style="padding:0;Margin:0"> </td> 
                             </tr> 
                             <tr style="border-collapse:collapse"> 
                              <td align="center" style="padding:0;Margin:0"> <h2 style="Margin:0;line-height:22px;font-family:helvetica,arial,verdana,sans-serif;font-size:18px;font-style:normal;font-weight:normal;color:#0a1e42"> ' . $message . '  !</h2> </td> 
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
                      <td align="left" class="m_2067806560839729598es-m-txt-l" style="padding:0;Margin:0"> <h3 style="Margin:0;line-height:22px;font-family:helvetica, arial,verdana,sans-serif;font-size:18px;font-style:normal;font-weight:bold;color:#0a1e42; text-align:center"><a  href="https://www.fiatobtc.com" rel="noopener noreferrer" target="_blank" data-saferedirecturl="https://www.fiatobtc.com">Cliquer sur ce lien pour voir votre ordre sur la page d\'accueil</a>.</h3></td> 
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
                          <td align="center" style="padding:0;Margin:0;padding-bottom:10px"> <p style="Margin:0;font-size:11px;font-family:helvetica,arial,verdana,sans-serif;line-height:17px;color:#999999"><a style="font-family:helvetica,arial,verdana,sans-serif;font-size:11px;text-decoration:underline;color:#999999" href="' . base_url('buying') . '" target="">Acheter</a>&nbsp; |&nbsp;&nbsp;<a style="font-family:helvetica,arial,verdana,sans-serif;font-size:11px;text-decoration:underline;color:#999999" href="' . base_url('sales') . '" target="_blank" data-saferedirecturl="#">Vendre</a>&nbsp; |&nbsp; <a style="font-family:helvetica,arial,verdana,sans-serif;font-size:11px;text-decoration:underline;color:#999999" href="#" target="_blank" data-saferedirecturl="#">Echanger</a>&nbsp; |&nbsp; <a style="font-family:helvetica,arial,verdana,sans-serif;font-size:11px;text-decoration:underline;color:#999999" href="#" target="_blank" data-saferedirecturl="#">Contact</a></p></td> 
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
                          <td align="center" style="padding:0;Margin:0;padding-top:15px"> <p style="Margin:0;font-size:10px;font-family:helvetica,arial,verdana,sans-serif;line-height:15px;color:#999999">© ' . $annee_footer . ' FiaToBTC. Tous droits réservés.</p></td> 
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
            }

        } catch (Exception $e) {
            echo '<h1 class="alert alert-danger text-center">Impossible d\'envoyer le message</h1>';
            echo $e->errorMessage();
        }
    }


    //Function d'affichage de la page de paie de crypto
    function buycrypto($id){
        $data['commands']=$this->exchange_model->buycrypto($id);

        $title = "Echanger des Cryptos contre le Fiat";

        $this->load->view('templates/header', $this->dataHeader($title));
        $this->load->view('exchanges/cryptofiat/buycrypto', $data);
        $this->load->view('templates/footer');
    }

    function savebuycrypto(){


        $session_data = $this->session->userdata('fiato_logged_in');
        $data['id_abonne'] = $session_data['id_abonne'];

        //RECUPERATION DE L'EMAIL DE L'ABONNE PAR SESSION
        $data['mailabonne'] = $this->sales_model->get_email_abonne($session_data['id_abonne']);
        $email_abonne = $data['mailabonne']['email_abonne'];

        $data= array(
            'product'=>htmlentities($this->input->post('product')),
            'qte_commande'=>htmlentities($this->input->post('qte_usd')),
            'qte_totale'=>htmlentities($this->input->post('qte_totale')),
            'id_transaction'=>htmlentities($this->input->post('id_transaction')),
            'cryptoAdresseAch'=>htmlentities($this->input->post('cryptoAdresseAch')),
            'moyen_paiement'=>$this->input->post('moyen_paiement'),
            'id_exchange'=>$this->input->post('id_exchange'),
            'id_abonne'=>$data['id_abonne']
        );

        $this->exchange_model->savebuycrypto($data);

        $motif = "Nouvel echange de chrypto";
        $message = "Vous venez de recevoir un nouvel échange (Achat) de crypto monnaie de la part de $email_abonne";
        $this->sendNotificationSolde($motif, $message);

        $this->session->set_flashdata('achat_order_sent',
            "Votre ordre d'achat a été envoyée et est en cours de vérification, Vous serez notifié par mail une fois 
            qu'elle sera traité, Merci de patienter !");

        redirect(base_url('exchange/myCryptorders'));
    }

    //AFFICHER LES ORDRES DE VENTES ET D'ACHAT DES CRYPTOS POUR CHAQUE L'UTILISATEUR
    function myCryptorders(){
        $session_data = $this->session->userdata('fiato_logged_in');

        $data['id_abonne'] = $session_data['id_abonne'];
        //
        $data['role_utilisateur'] = $session_data['role_utilisateur'];
        if (!$data['id_abonne']) {
            redirect(base_url('pages/connexion'));
        } else {

            $title = "Mes ordres de ventes et d'achat des cryptos";
        }
        //CRYPTO CONTRE FIAT ORDERS (VENTE ET ACHAT)
        $data['userorderdata'] = $this->exchange_model->fetchUserOrderData($session_data['id_abonne']);
        $data['cryptobuyorders'] = $this->exchange_model->fetchUserCryptorderData($session_data['id_abonne']);

        // FIAT CONTRE CRYPTO ORDERS (VENTE ET ACHAT)
        $data['fiatorders'] = $this->exchange_model->fetchUserFiatOrderData($session_data['id_abonne']);
        $data['fiatcommandes'] = $this->exchange_model->fetchUserFiatCommndeData($session_data['id_abonne']);


        $this->load->view('templates/header', $this->dataHeader($title));
        $this->load->view('exchanges/mycrypto_orders',$data);
        $this->load->view('templates/footer');
    }

    /*Liste d'Ordres d'achat Crypto contre Fiat*/
    function fetchOrdersAchatCryptoFiat(){
      $session_data = $this->session->userdata('fiato_logged_in');

        $data['id_abonne'] = $session_data['id_abonne'];

        $data['role_utilisateur'] = $session_data['role_utilisateur'];
        if (!$data['id_abonne'] || $data['role_utilisateur'] == 'abonne') {
            redirect(base_url('pages/connexion'));

        } else {

            $title = "Liste d'odres d'achats de Cryptos contre Fiat";

            $data['commandes'] = $this->exchange_model->fetchCommandesACF();
            //$data['cancel'] = $this->exchange_model->fetchUCancelsCF();
            $data['traitees'] = $this->exchange_model->fetchTraitesACF();
            $data['encours'] = $this->exchange_model->fetchEncoursACF();
            $data['cancel'] = $this->exchange_model->fetchRejeteesACF();
            $data['total'] = $this->exchange_model->fetchTotalACF();


            $this->load->view('templates/header', $this->dataHeader($title));
            $this->load->view('exchanges/cryptofiat/orders/list', $data);
            $this->load->view('templates/footer');
        }

    }

    /*Affichage des Détails de l'ordre d'achat des cryptos contre les fiat */

    function detailOrdersAchatCryptoFiat($id){
      $session_data = $this->session->userdata('fiato_logged_in');

        $data['id_abonne'] = $session_data['id_abonne'];

        $data['role_utilisateur'] = $session_data['role_utilisateur'];
        if (!isset($data['id_abonne']) || $data['role_utilisateur'] == 'abonne') {
            redirect(base_url('pages/connexion'));

        } else {

            $title = 'Détails de la commande d\'achat de Cryptos vs. Fiat';

            $data['commands'] = $this->exchange_model->detailsACF($id);

            $this->load->view('templates/header', $this->dataHeader($title));
            $this->load->view('exchanges/cryptofiat/orders/details', $data);
            $this->load->view('templates/footer');
        }
    }

    /*Validation de la commande d'achat de cryptos vs fiat */
    function validOrdersAchatCryptoFiat(){

        //Adresse mail du vendeur ou initiateur de la commande
        $id_exchange = $this->input->post('id_exchange');
        $data['vendeur'] = $this->exchange_model->getEmailVendeur($id_exchange);
       
        $emailVendeur = $data['vendeur']['email_abonne'];
        $prenomVendeur = $data['vendeur']['prenom_abonne'];

        /*---------------------Mail à Acheteur----------------------------------*/
        $request = $this->input->post('request');
        $email_abonne = $this->input->post('email');
        $prenom = $this->input->post('prenom');
        $motif = "Commande d'achat de crypto contre du fiat  traitée et validée";

        $this->exchange_model->validOrdersAchatCryptoFiat($request);
        $this->exchange_model->updateOrdersAchatCryptoFiat($id_exchange);
       
        $message = "Bonjour $prenom !, Nous vous informons que votre commande d'achat de Crypto-Monnaie contre du Fiat a été traitée et Acceptée, Vous pouvez consulter votre compte sur notre site et trouver votre HashCode que nous vous avons envoyé. Merci pour la confiance! ";
          $this->sendValidCancelEmail($email_abonne, $motif, $message);

        /*----------------------Mail au Vendeur----------------------------*/

        $motif2 = " Ordre d'echange acheté ";
        $message2 = "Félicitations $prenomVendeur !, Votre ordre d'échange que vous avez posé sur notre plateforme a trouvé un acheteur, nous avons crédité votre compte mobile money au numéro indiqué sur l'ordre. Pour plus de détails sur la quantité, veuillez vous connecter sur le site et vous pourez voir vos ordres de ventes."; 

         $this->sendValidCancelEmail($emailVendeur, $motif2, $message2);

        echo '<div class="alert alert-success">La demande a été traitée et validée avec succès</div>';
    }

    /*______________END CRYPTO VS FIAT FUNCTIONS_______________________*/
    

    /*_________________START FIAT VS CRYPTO FUNCTIONS_____________________*/

    //Fonction d'echange de crypto contre du fiat
    function fiatTocrypto()
    {
        $session_data = $this->session->userdata('fiato_logged_in');

        $data['id_abonne'] = $session_data['id_abonne'];

        //RECUPERATION DE L'EMAIL DE L'ABONNE PAR SESSION
        $data['mailabonne'] = $this->sales_model->get_email_abonne($session_data['id_abonne']);
        $email_abonne = $data['mailabonne']['email_abonne'];
        //
        $data['role_utilisateur'] = $session_data['role_utilisateur'];
        if (!$data['id_abonne']) {
            redirect(base_url('pages/connexion'));
        } else {

            $title = "Echange de Fiat contre les Cryptos";
        }
        if (isset($_POST['btnUpdate'])) {
            $newdata = array(
                'product' => htmlentities($this->input->post('product')),
                'id_transaction' => htmlentities($this->input->post('id_transaction')),
                'qte' => htmlentities($this->input->post('qte')),
                'taux' => htmlentities($this->input->post('taux')),
                'moyen_paiement' => htmlentities($this->input->post('moyen_paiement'))
            );
            $viewdata['data'] = $newdata;

        } elseif (isset($_POST['btnConfirm'])) {

            return $this->saveOrderDataFiatCrypto($email_abonne);
        } else {
            $viewdata['data'] = null;
        }
        $viewdata['userorderdata'] = $this->exchange_model->fetchUserOrderData($session_data['id_abonne']);
        $viewdata['soldes'] = $this->exchange_model->getUserSolde($session_data['id_abonne']);

        $this->load->view('templates/header', $this->dataHeader($title));
        $this->load->view('exchanges/fiatcrypto/fiat_crypto', $viewdata);
        $this->load->view('templates/footer');

    }
    /*Vue de détails avant confirmation de l'ordre d'echange de crypto contre le fiat*/
    function postViewFiatCrypto()
    {
        $newdata = array(
            'qte' => htmlentities($this->input->post('qte')),
            'taux' => htmlentities($this->input->post('taux')),
            'moyen_paiement' => htmlentities($this->input->post('moyen_paiement')),
            'id_transaction' => htmlentities($this->input->post('id_transaction')),
            'product' => htmlentities($this->input->post('product'))
        );
        $viewdata['data'] = $newdata;

        $title = "Echange des Fiat contre les Crypto";

        $this->load->view('templates/header', $this->dataHeader($title));
        $this->load->view('exchanges/fiatcrypto/postview', $viewdata);
        $this->load->view('templates/footer');
    }

    /*Save Data to Database*/
    function saveOrderDataFiatCrypto($email_abonne)
    {
        $motif = "Ordre d'echange Crypto contre Fiat";
        $message = "Vous venez de recevoir un ordre d'echange de Fiat contre le Crypto de la part de $email_abonne";
        $session_data = $this->session->userdata('fiato_logged_in');

        $data['id_abonne'] = $session_data['id_abonne'];
        $newdata = array(
            'qte' => htmlentities($this->input->post('qte')),
            'qte_max' => htmlentities($this->input->post('qte')),
            'taux' => htmlentities($this->input->post('taux')),
            'moyen_paiement' => htmlentities($this->input->post('moyen_paiement')),
            'id_transaction' => htmlentities($this->input->post('id_transaction')),
            'product' => htmlentities($this->input->post('product')),
        
            'id_abonne' => $data['id_abonne'],
            'email_abonne' => $email_abonne,
            'date_envoi' => date('Y-m-d')
        );
        $this->exchange_model->saveOrderDataFiatCrypto($newdata);
        $this->sendNotificationSolde($motif, $message);
        $this->session->set_flashdata('demande_sent',
            "Votre ordre d'echange a été envoyé, Vous serez notifié par mail une fois 
            qu'il sera traité, Merci de patienter !");
        redirect(base_url('exchange/fiatTocrypto'));
    }

    function fetchFiatCrypto(){
        $session_data = $this->session->userdata('fiato_logged_in');

        $data['id_abonne'] = $session_data['id_abonne'];

        $data['role_utilisateur'] = $session_data['role_utilisateur'];
        if (!$data['id_abonne'] || $data['role_utilisateur'] == 'abonne') {
            redirect(base_url('pages/connexion'));

        } else {

            $title = "Liste de demandes d'Echange de Fiat contre les Cryptos";

            $data['commandes'] = $this->exchange_model->fetchCommandesFC();
            $data['cancel'] = $this->exchange_model->fetchUCancelsFC();
            $data['traitees'] = $this->exchange_model->fetchTraitesFC();
            $data['encours'] = $this->exchange_model->fetchEncoursFC();
            $data['rejetees'] = $this->exchange_model->fetchRejeteesFC();
            $data['total'] = $this->exchange_model->fetchTotalFC();


            $this->load->view('templates/header', $this->dataHeader($title));
            $this->load->view('exchanges/fiatcrypto/listeFiatCrypto', $data);
            $this->load->view('templates/footer');
        }

    }
    //Details commande Crypto Contre Fiat
    function detailFiatCrypto($id)
    {
        $session_data = $this->session->userdata('fiato_logged_in');

        $data['id_abonne'] = $session_data['id_abonne'];

        $data['role_utilisateur'] = $session_data['role_utilisateur'];
        if (!$data['id_abonne']) {
            redirect(base_url('pages/connexion'));
        }else {

            $title = 'Détails de la demande d\'echange Fiat contre Crypto';

            $data['commands'] = $this->exchange_model->detailsFC($id);

            $this->load->view('templates/header', $this->dataHeader($title));
            $this->load->view('exchanges/fiatcrypto/detailFiatCrypto', $data);
            $this->load->view('templates/footer');
        }
    }

    /*Annulation de la commande*/
    function cancelDemandeFiatCrypto()
    {
        $query = $this->input->post('request');
        $email_abonne = $this->input->post('email');
        $prenom = $this->input->post('prenom');
        $motif = "Rejet de l'Ordre d'Echange de fiat contre Crypto";
        $message = " Bonjour $prenom , Nous vous informons que votre ordre d'echange de Fiat contre la Crypto-Monnaie a été réjeté suite au non respect de clause de votre part. Merci d'avoir compris !";

        $this->exchange_model->cancelDemandeFiatCrypto($query);
        $this->sendValidCancelEmail($email_abonne, $motif, $message);
        echo '<div class="alert alert-success">La commande a été rejetée !</div>';
    }

     /*Fonction de validation de la demande d'echange fiat contre crypto */
    function validDemandeFiatCrypto()
    {
        $query = $this->input->post('request');
        $email_abonne = $this->input->post('email');
        $prenom = $this->input->post('prenom');
        $motif = "Ordre d'echange de fiat contre crypto accepté ";
        $this->exchange_model->validDemandeFiatCrypto($query);

        $message = " Bonjour $prenom , Nous vous informons que votre ordre d'echange du Fiat contre la Crypto-Monnaie a été Acceptée, Vous pouvez désormais le voir affiché sur la page d'accueil en attente d'un preneur. Merci pour la confiance! ";

        $this->sendValidCancelEmail($email_abonne, $motif, $message);
        echo '<div class="alert alert-success">La demande a été traitée et validée avec succès</div>';
    }

    /*Création du  solde*/
    function createsoldeFiatCrypto()
    {
        $session_data = $this->session->userdata('fiato_logged_in');
        $data['id_abonne'] = $session_data['id_abonne'];

        //RECUPERATION DE L'EMAIL DE L'ABONNE PAR SESSION
        $data['mailabonne'] = $this->sales_model->get_email_abonne($session_data['id_abonne']);
        $email_abonne = $data['mailabonne']['email_abonne'];
        $motif = "Recharge du solde";
        $message = "Vous venez de recevoir une demande de recharge de solde de la part de $email_abonne";


        $datasolde = array(
            'quantite_depose' => htmlentities($this->input->post('quantite_depose')),
            'product' => htmlentities($this->input->post('product')),
            'cryptoAdresse' => null,
            'hash' => null,
            'id_transaction'=>htmlentities($this->input->post('id_transaction')),
            'id_abonne' => $session_data['id_abonne']
        );
        $this->exchange_model->createUserSolde($datasolde);

        $this->sendNotificationSolde($motif, $message);

        $this->session->set_flashdata('solde_sent',
            "Votre demande de recharge de solde a été envoyée et est en cours de vérification, Vous serez notifié par mail une fois 
            qu'elle sera traité, Merci de patienter !");

        redirect(base_url('exchange/fiatTocrypto'));

    }

    //Function d'affichage de la page de paie de crypto
    function buyfiat($id){
        $data['commands']=$this->exchange_model->buyfiat($id);

        $title = "Echanger de fiat contre la Crypto-monnaie";

        $this->load->view('templates/header', $this->dataHeader($title));
        $this->load->view('exchanges/fiatcrypto/buyfiat', $data);
        $this->load->view('templates/footer');
    }

    function savebuyfiat(){

        $session_data = $this->session->userdata('fiato_logged_in');
        $data['id_abonne'] = $session_data['id_abonne'];

        //RECUPERATION DE L'EMAIL DE L'ABONNE PAR SESSION
        $data['mailabonne'] = $this->sales_model->get_email_abonne($session_data['id_abonne']);
        $email_abonne = $data['mailabonne']['email_abonne'];

        $data= array(
            'product'=>htmlentities($this->input->post('product')),
            'qte_commande'=>htmlentities($this->input->post('qte_usd')),
            'qte_totale'=>htmlentities($this->input->post('qte_totale')),
            'hashAcheteur'=>htmlentities($this->input->post('hash_code')),
            'telephone'=>htmlentities($this->input->post('telephone')),
            'id_exchange'=>$this->input->post('id_exchange'),
            'id_abonne'=>$data['id_abonne']
        );

        $this->exchange_model->savebuyfiat($data);

        $motif = "Nouvel echange de Fiat";
        $message = "Vous venez de recevoir un nouvel échange (Achat) de Fiat de la part de $email_abonne";
        $this->sendNotificationSolde($motif, $message);

        $this->session->set_flashdata('achat_order_sent',
            "Votre ordre d'achat a été envoyée et est en cours de vérification, Vous serez notifié par mail une fois 
            qu'elle sera traité, Merci de patienter !");

        redirect(base_url('exchange/myCryptorders'));
    }

    /*Liste d'Ordres d'achat Fiat contre Crypto*/
    function fetchOrdersAchatFiatCrypto(){
      $session_data = $this->session->userdata('fiato_logged_in');

        $data['id_abonne'] = $session_data['id_abonne'];

        $data['role_utilisateur'] = $session_data['role_utilisateur'];
        if (!$data['id_abonne'] || $data['role_utilisateur'] == 'abonne') {
            redirect(base_url('pages/connexion'));

        } else {

            $title = "Liste d'odres d'achats de Fiat Cryptos contre ";

            $data['commandes'] = $this->exchange_model->fetchCommandesAFC();
            $data['traitees'] = $this->exchange_model->fetchTraitesAFC();
            $data['encours'] = $this->exchange_model->fetchEncoursAFC();
            $data['cancel'] = $this->exchange_model->fetchRejeteesAFC();
            $data['total'] = $this->exchange_model->fetchTotalAFC();


            $this->load->view('templates/header', $this->dataHeader($title));
            $this->load->view('exchanges/fiatcrypto/orders/list', $data);
            $this->load->view('templates/footer');
        }

    }

    /*Affichage des Détails de l'ordre d'achat de fiat contre les crypto */

    function detailOrdersAchatFiatCrypto($id){
        $session_data = $this->session->userdata('fiato_logged_in');

        $data['id_abonne'] = $session_data['id_abonne'];

        $data['role_utilisateur'] = $session_data['role_utilisateur'];
        if (!isset($data['id_abonne']) || $data['role_utilisateur'] == 'abonne') {
            redirect(base_url('pages/connexion'));

        } else {

            $title = 'Détails de la commande d\'achat des Fiat contre Cryptos';

            $data['commands'] = $this->exchange_model->detailsAFC($id);

            $this->load->view('templates/header', $this->dataHeader($title));
            $this->load->view('exchanges/fiatcrypto/orders/details', $data);
            $this->load->view('templates/footer');
        }
    }

    /*Validation de la commande d'achat de fiat vs crypto */
    function validOrdersAchatFiatCrypto(){

        //Adresse mail du vendeur ou initiateur de la commande
        $id_exchange = $this->input->post('id_exchange');
        $data['vendeur'] = $this->exchange_model->getEmailVendeurFiat($id_exchange);
       
        $emailVendeur = $data['vendeur']['email_abonne'];
        $prenomVendeur = $data['vendeur']['prenom_abonne'];

        /*---------------------Mail à Acheteur----------------------------------*/
        $request = $this->input->post('request');

        $email_abonne = $this->input->post('email');
        $prenom = $this->input->post('prenom');
        $motif = "Commande d'echange de fiat contre la crypto-monnaie  traitée et validée";

        $this->exchange_model->validOrdersAchatFiatCrypto($request);

        $this->exchange_model->updateOrdersAchatFiatCrypto($id_exchange);

        
       
        $message = "Bonjour $prenom !, Nous vous informons que votre commande d'achat du Fiat contre Crypto-Monnaie a été traitée et Acceptée, nous avons crédité votre compte mobile money au numéro indiqué sur la commande.  veuillez vous connecter sur le site et vous pourez voir les détails sur ce lien: https://www.fiatobtc.com/exchanges/myCryptorders.";
          $this->sendValidCancelEmail($email_abonne, $motif, $message);

        /*----------------------Mail au Vendeur----------------------------*/

        $motif2 = " Ordre d'echange acheté ";
        $message2 = "Félicitations $prenomVendeur !, Votre ordre d'échange de Fiat contre la crypto-monnaie que vous avez posé sur notre plateforme a trouvé un acheteur, nous vous avons envoyé un code Hah, veuillez vous connecter sur le site et vous pourez voir les détails sur ce lien: https://www.fiatobtc.com/exchanges/myCryptorders"; 

         $this->sendValidCancelEmail($emailVendeur, $motif2, $message2);

        echo '<div class="alert alert-success">La demande a été traitée et validée avec succès</div>';
    }

    function cancelOrdersAchatFiatCrypto(){
        $query = $this->input->post('request');
        $email_abonne = $this->input->post('email');
        $prenom = $this->input->post('prenom');
        $motif = "Rejet de l'Ordre d'Echange de fiat contre Crypto";
        $message = " Bonjour $prenom , Nous vous informons que votre ordre d'echange de Fiat contre la Crypto-Monnaie a été réjeté suite au non respect de clause de votre part. Merci d'avoir compris !";

        $this->exchange_model->cancelOrdersAchatFiatCrypto($query);
        $this->sendValidCancelEmail($email_abonne, $motif, $message);
        echo '<div class="alert alert-success">La commande a été rejetée !</div>';
    }
}



