<?php
/**
 * Created by PhpStorm.
 * User: Congo Agile
 * Date: 01/12/2020
 * Time: 09:04
 */
class Recover extends CI_Controller{
    function index($code){
        $data['user']= $this->forgot_model->getUserdata($code);
        if (!$data['user']) {
            $this->session->set_flashdata('code_expired', 'Le code que vous de réinitialisation pour cet email a déjà expiré!');
            redirect(base_url('forgot'));
        }else{
        $data['noms'] =$data['user']['prenom_abonne'].' '.$data['user']['nom_abonne'];
        $photo['photo'] = $data['user']['photo_abonne'];

        $data['title'] = 'Recover-password';
        $data['types'] = "website";
        $data['description'] = "FIATOBTC permet d’acheter, de vendre les crypto monnaies contre du Fiat et aussi permet d’échanger les crypto monnaies entre elles";
        $data['meta_title'] = "FiaToBTC";
        $data['title_page'] = " FiaToBTC ";
        $data['keywords'] = "FiaToBTC, Acheter, vendre, BitCoin, USDT, RDC, Échanger";

        //$this->load->view('templates/header', $data);
        $this->load->view('pages/recover-password', $data);
        //$this->load->view('templates/footer');
        }
        
    }

    function changePassword(){

        $this->load->library('form_validation');

        $this->form_validation->set_rules('password', 'Nouveau mot de passe', 'required|min_length[8]|max_length[50]');
        $this->form_validation->set_rules('passwordConfirm', 'Confirmer mot de passe', 'required|matches[password]');

        if ($this->form_validation->run()) {
            
           $this->forgot_model->changePassword();

            $array= array(
                'success'=>'<div class="alert-success p-3 text-lg-center"> Votre mot de passe a été changé avec succès! </div>
                    <div class="text-lg-center mt-3">
                        <a href="'.base_url('pages/connexion').'" class="btn btn-primary btn-block">Connectez-vous maintenant</a>
                    </div>
            '
            );

          }else {
            $array = array(
                'error' => true,
                'password_error' => form_error('password'),
                'confirmPassword_error' => form_error('passwordConfirm')
            );
        }
        echo json_encode($array);
    }
}