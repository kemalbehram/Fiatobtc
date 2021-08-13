<?php
/**
 * CLASSE DE VENTE DU BITCOIN
 */
require APPPATH . 'CoinPayment/Coin.php';

require APPPATH . 'CoinPayment/vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

//require APPPATH . 'CoinPayment/init.php';

class Sales extends CI_Controller
{
	

	function index()
	{
        $capsule = new Capsule;

        $capsule->addConnection([
            'driver' => "mysql",
            'host' => "localhost",
            'database' => "fiatobtc_db",
            'username' => "root",
            'password' => ""
        ]);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        require APPPATH . 'CoinPayment/Payment.php';
        //require "Payment.php";

        $coin = new CoinPaymentsAPI();
        $coin->Setup("14ad4b60f205E0bc9F3E819fbbd65f86EE8e26f491bF3e3188cc816f7bd7aAdd","08f947c36b587a435ff55bb65e9a27b52c0b819c825dbe380cdb7b83c83af789");

        $basicInfo = $coin->GetBasicProfile();
        $username = $basicInfo['result']['public_name'];

        $data['marchantname'] = $username;

        //End CoinPaiment Basic Confiuguration
        



		$session_data= $this->session->userdata('fiato_logged_in');

		$data['id_abonne'] = $session_data['id_abonne'];
	
		$data['role_utilisateur'] = $session_data['role_utilisateur'];
		if (!$data['id_abonne']) {
			redirect(base_url('pages/connexion'));
		}else{


		$data['title'] = 'Ventes';
        $data['types'] = "website";
        $data['description'] = "FIATOBTC permet d’acheter, de vendre les crypto monnaies contre du Fiat et aussi permet d’échanger les crypto monnaies entre elles";
        $data['meta_title'] = "FiaToBTC";
        $data['title_page'] = " FiaToBTC ";
        $data['keywords'] = "FiaToBTC, Acheter, vendre, BitCoin, USDT, RDC, Échanger";

        $data['mailabonne']=$this->sales_model->get_email_abonne($session_data['id_abonne']);//Recupération de l'email de l'abonné pour s'en servir comme identifiant lors de l'affichage de ses ventes effectuées.
        $email = $data['mailabonne']['email_abonne'];
        $data['email']= $email;

        //Recupération du taux d'achat
        $data['product']= $this->product_model->getTauxAchat();

		$this->load->view('templates/header_ach_vente', $data);
		$this->load->view('ventes/index', $data, $username);
		$this->load->view('templates/footer_ach_vente');
		}
	}


    function cmd_convert(){
        $query = $this->input->post('request');
        echo file_get_contents("https://blockchain.info/tobtc?currency=USD&value=$query");
    }


	function fetchAll(){
		$session_data = $this->session->userdata('fiato_logged_in');

        $data['id_abonne'] = $session_data['id_abonne'];

        $data['role_utilisateur'] = $session_data['role_utilisateur'];
        if (!$data['id_abonne'] || $data['role_utilisateur'] == 'abonne') {

            redirect(base_url('pages/connexion'));

        } else {

            $data['title'] = 'Commandes|Ventes';
            $data['types'] = "website";
            $data['description'] = "FIATOBTC permet d’acheter, de vendre les crypto monnaies contre du Fiat et aussi permet d’échanger les crypto monnaies entre elles";
            $data['meta_title'] = "FiaToBTC";
            $data['title_page'] = " FiaToBTC ";
            $data['keywords'] = "FiaToBTC, Acheter, vendre, BitCoin, USDT, RDC, Échanger";

            $data['commandes'] = $this->sales_model->fetchCommandes();
            $data['news'] = $this->sales_model->fetchUnseenNotifications();
            $data['traitees'] = $this->sales_model->fetchTraites();
            $data['encours'] = $this->sales_model->fetchEncours();
            $data['rejetees'] = $this->sales_model->fetchRejetees();
            $data['total'] = $this->sales_model->fetchTotal();
            

            $this->load->view('templates/header', $data);
            $this->load->view('ventes/liste', $data);
            $this->load->view('templates/footer');
        }
	}


	function details($id){
        $session_data= $this->session->userdata('fiato_logged_in');

        $data['id_abonne'] = $session_data['id_abonne'];
    
        $data['role_utilisateur'] = $session_data['role_utilisateur'];
        if (!$data['id_abonne']) {
            redirect(base_url('pages/connexion'));
        }else{

        $data['title'] = 'Détails Vente';
        $data['types'] = "website";
        $data['description'] = "FIATOBTC permet d’acheter, de vendre les crypto monnaies contre du Fiat et aussi permet d’échanger les crypto monnaies entre elles";
        $data['meta_title'] = "FiaToBTC";
        $data['title_page'] = " FiaToBTC ";
        $data['keywords'] = "FiaToBTC, Acheter, vendre, BitCoin, USDT, RDC, Échanger";

        //Recupération du taux d'achat
        $data['commands']= $this->sales_model->details($id);

        $this->load->view('templates/header', $data);
        $this->load->view('ventes/details', $data);
        $this->load->view('templates/footer');
        }
    }


    public function process(){
        
        $session_data= $this->session->userdata('fiato_logged_in');

        $data['id_abonne'] = $session_data['id_abonne'];
    
        $data['role_utilisateur'] = $session_data['role_utilisateur'];
        if (!$data['id_abonne']) {
            redirect(base_url('pages/connexion'));
        }else{

        $capsule = new Capsule;

        $capsule->addConnection([
            'driver' => "mysql",
            'host' => "localhost",
            'database' => "fiatobtc_db",
            'username' => "root",
            'password' => ""
        ]);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        require APPPATH . 'CoinPayment/Payment.php';
        //require "Payment.php";

        $coin = new CoinPaymentsAPI();
        $coin->Setup("14ad4b60f205E0bc9F3E819fbbd65f86EE8e26f491bF3e3188cc816f7bd7aAdd","08f947c36b587a435ff55bb65e9a27b52c0b819c825dbe380cdb7b83c83af789");

        $basicInfo = $coin->GetBasicProfile();
        $username = $basicInfo['result']['public_name'];

        $data['marchantname'] = $username;


        $basicInfo = $coin->GetBasicProfile();
        $username = $basicInfo['result']['public_name'];

        $amount = $this->input->post('amount');
        $email = $this->input->post('email');
        $transaction_moyen=$this->input->post('customRadio');
        $phone_transaction=$this->input->post('phone');
        $quantite = $this->input->post('sales_qte_usd');


        $product= $this->input->post('product');
        $scurrency = "USD";
        if ($product=="BTC") {
            $rcurrency = "BTC";

        }elseif($product=="USDT.ERC20"){
            $rcurrency = "USDT.ERC20";
        }

        if ($quantite > 1000) {
           echo "La quantité maximale à acheter est fixée à 10000 USD";
        }elseif ($quantite < 20) {
            echo "La quantité minimale à acheter est fixée à 20 USD";
        }else{
            $request = [
            'amount' => $amount,
            'currency1' => $scurrency,
            'currency2' => $rcurrency,
            'buyer_email' => $email,
            'item' => "Vendre à FiaToBTC",
            'address' => "",
            'ipn_url' => base_url('sales/webhook')
        ];

        $result = $coin->CreateTransaction($request);
        $data['results'] = $result['result'];

        if ($result['error'] == "ok") {
            $payment = new Payment;
            $payment->email = $email;
            $payment->entered_amount = $amount;
            $payment->amount = $result['result']['amount'];
            $payment->from_currency = $scurrency;
            $payment->to_currency = $rcurrency;
            $payment->status = "initialized";
            $payment->gateway_id = $result['result']['txn_id'];
            $payment->gateway_url = $result['result']['status_url'];
            $payment->transaction_moyen=$transaction_moyen;
            $payment->phone_transaction= $phone_transaction;
            $payment->save();
        } else {
            print 'Error: ' . $result['error'] . "\n";
            die();
        }

        $data['title'] = 'Ventes';
        $data['types'] = "website";
        $data['description'] = "FIATOBTC permet d’acheter, de vendre les crypto monnaies contre du Fiat et aussi permet d’échanger les crypto monnaies entre elles";
        $data['meta_title'] = "FiaToBTC";
        $data['title_page'] = " FiaToBTC ";
        $data['keywords'] = "FiaToBTC, Acheter, vendre, BitCoin, USDT, RDC, Échanger";

        $data['rcurrency'] = $rcurrency;
        
        $this->load->view('templates/header', $data);
        $this->load->view('ventes/view', $data);
        $this->load->view('templates/footer');
            }
        }  
    }

    public function webhook(){
        $capsule = new Capsule;

        $capsule->addConnection([
            'driver' => "mysql",
            'host' => "localhost",
            'database' => "fiatobtc_db",
            'username' => "root",
            'password' => ""
        ]);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        require APPPATH . 'CoinPayment/Payment.php';
        //require "Payment.php";

        $coin = new CoinPaymentsAPI();
        $coin->Setup("14ad4b60f205E0bc9F3E819fbbd65f86EE8e26f491bF3e3188cc816f7bd7aAdd","08f947c36b587a435ff55bb65e9a27b52c0b819c825dbe380cdb7b83c83af789");

        $basicInfo = $coin->GetBasicProfile();
        $username = $basicInfo['result']['public_name'];


        $merchant_id = "0d1106bdc85828b093033dab89a85c49";
        $ipn_secret = "hdhriruhuhrppxzmcbuiteqwertijsnmxzxaysofjgrhbhdslskjf6453234";
        $debug_email = "eldadkanawa1009@gmail.com";

        $txn_id = $_POST['txn_id'];
        $payment = Payment::where("gateway_id", $txn_id)->first();
        $order_currency = $payment->to_currency; //BTC
        $order_total = $payment->amount; //BTC


        if (!isset($_POST['ipn_mode']) || $_POST['ipn_mode'] != 'hmac') {
            edie("IPN Mode is not HMAC");
        }

        if (!isset($_SERVER['HTTP_HMAC']) || empty($_SERVER['HTTP_HMAC'])) {
            edie("No HMAC Signature Sent.");
        }

        $request = file_get_contents('php://input');
        if ($request === false || empty($request)) {
            edie("Error in reading Post Data");
        }

        if (!isset($_POST['merchant']) || $_POST['merchant'] != trim($merchant_id)) {
            edie("No or incorrect merchant id.");
        }

        $hmac =  hash_hmac("sha512", $request, trim($ipn_secret));
        if (!hash_equals($hmac, $_SERVER['HTTP_HMAC'])) {
            edie("HMAC signature does not match.");
        }

        $amount1 = floatval($_POST['amount1']); //IN USD
        $amount2 = floatval($_POST['amount2']); //IN BTC
        $currency1 = $_POST['currency1']; //USD
        $currency2 = $_POST['currency2']; //BTC
        $status = intval($_POST['status']);

        if ($currency2 != $order_currency) {
            edie("Currency Mismatch");
        }

        if ($amount2 < $order_total) {
            edie("Amount is lesser than order total");
        }

        if ($status >= 100 || $status == 2) {
            // Payment is complete
            $payment->status = "success";
            $payment->save();
        } else if ($status < 0) {
            // Payment Error
            $payment->status = "error";
            $payment->save();
        } else {
            // Payment Pending
            $payment->status = "pending";
            $payment->save();
        }
        die("IPN OK");
    }

    function edie($error_msg)
    {
        global $debug_email;
        $report =  "ERROR : " . $error_msg . "\n\n";
        $report.= "POST DATA\n\n";
        foreach ($_POST as $key => $value) {
            $report .= "|$k| = |$v| \n";
        }
        mail($debug_email, "Payment Error", $report);
        //die($error_msg);
        $this->session->flashdata('erreur', $error_msg);
        redirect(base_url('sales'));
    }

    function cancelCommand(){
        $query = $this->input->post('request');
        $this->sales_model->cancelCommand($query);
        echo '<div class="alert alert-success">Commande la commande a été rejetée avec succès</div>';
    }
    function validCommand(){
        $query = $this->input->post('request');
        $this->sales_model->validCommand($query);
        echo '<div class="alert alert-success">Commande la commande a été traitée et validée avec succès</div>';
    }
}