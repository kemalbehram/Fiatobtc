<?php

class Pages extends CI_Controller
{
    public function index($page = 'accueil')
    {
        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            $this->notfound();
        }
        $data['url'] = base_url() . '' . $page;
        $data['title'] = ucfirst($page);//Ceci recupere le nom de la page et l'affiche dans title en majusle sur la première lettre
        $data['types'] = "website";
        $data['description'] = "FIATOBTC permet d’acheter, de vendre les crypto monnaies contre du Fiat et aussi permet d’échanger les crypto monnaies entre elles";
        $data['meta_title'] = "FiaToBTC";
        $data['title_page'] = " FiaToBTC ";
        $data['keywords'] = "FiaToBTC, Acheter, vendre, BitCoin, USDT, RDC, Échanger";

        switch ($page) {
            case "accueil":
                $data['meta_title'] = "FiaToBTC";
                $data['title_page'] = " FiaToBTC ";
                $data['keywords'] = "FiaToBTC, Acheter, vendre, BitCoin, USDT, RDC, Échanger";
                break;
            case "acheter":
                $data['meta_title'] = "FiaToBTC ";
                $data['title_page'] = "FiaToBTC";
                $data['keywords'] = "FiaToBTC, Acheter, vendre, BitCoin, USDT, RDC, Échanger";
                break;
            case "vendre":
                $data['meta_title'] = "FiaToBTC ";
                $data['title_page'] = "FiaToBTC";
                $data['keywords'] = "FiaToBTC, Acheter, vendre, BitCoin, USDT, RDC, Échanger";
                break;
            case "tutoriels":
                $data['meta_title'] = "FiaToBTC ";
                $data['title_page'] = "FiaToBTC";
                $data['keywords'] = "FiaToBTC, Acheter, vendre, BitCoin, USDT, RDC, Échanger";

            default:
                $data['meta_title'] = "FiaToBTC ";
                $data['title_page'] = "FiaToBTC";
                $data['keywords'] = "FiaToBTC, Acheter, vendre, BitCoin, USDT, RDC, Échanger";
        }
        $data['orderscrypto'] = $this->dataOrderCrypto();
        $data['ordersfiat']= $this->dataOrderFiat();

        $this->load->view('templates/header_home', $data);
        $this->load->view('pages/' . $page, $data);
        $this->load->view('templates/footer_home');
    }

    public function notfound()
    {
        $data['title'] = ucfirst($page = '404');//Ceci recupere le nom de la page et l'affiche dans title en majusle sur la première lettre
        $data['types'] = "website";
        $data['description'] = "FIATOBTC permet d’acheter, de vendre les crypto monnaies contre du Fiat et aussi permet d’échanger les crypto monnaies entre elles";
        $data['meta_title'] = "FiaToBTC";
        $data['title_page'] = " FiaToBTC ";
        $data['keywords'] = "FiaToBTC, Acheter, vendre, BitCoin, USDT, RDC, Échanger";
        $data['url'] = base_url() . '' . $page;
        $this->load->view('templates/header', $data);
        $this->load->view('pages/404', $data);
        $this->load->view('templates/footer');
    }

    public function connexion()
    {
        $data['title'] = 'Login';
        $data['types'] = "website";
        $data['description'] = "FIATOBTC permet d’acheter, de vendre les crypto monnaies contre du Fiat et aussi permet d’échanger les crypto monnaies entre elles";
        $data['meta_title'] = "FiaToBTC";
        $data['title_page'] = " FiaToBTC ";
        $data['keywords'] = "FiaToBTC, Acheter, vendre, BitCoin, USDT, RDC, Échanger";

        //$this->load->view('templates/header', $data);
        $this->load->view('pages/login', $data);
        //$this->load->view('templates/footer');
    }

    public function logout()
    {
        $this->session->unset_userdata('logged_in');
        $this->session->sess_destroy();
        redirect(base_url());
    }
    //Donnes des ordres de la page d'accueil
    function dataOrderCrypto(){
        $data = $this->exchange_model->showDataCrypto();
        return $data;
    }
    function dataOrderFiat(){
        $data = $this->exchange_model->showDataFiat();
        return $data;
    }
}
