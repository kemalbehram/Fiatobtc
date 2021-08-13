<?php

/**
 * Created by PhpStorm.
 * User: Congo Agile
 * Date: 01/12/2020
 * Time: 08:33
 */
class Login extends CI_Controller
{
    function index()
    {
        if (date('Y-m-d')>='2025-01-01'){
            redirect(base_url());
        }elseif (date('Y')!= 2021) {
            
            $this->session->set_flashdata('connexion_failed', 'Connexion impossible, le site necessite quelques mises à jour !');
            redirect(base_url('pages/connexion'));
        }else{
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('password', 'Mot de passe', 'trim|required|callback_authentification');
            if($this->form_validation->run()===FALSE){
                redirect(base_url('pages/connexion'));
                $this->session->set_flashdata('connexion_failed', 'Email ou Mot de passe incorrect !');
            }else{
                $this->session->set_flashdata('connexion_success', 'Vous êtes maintenant connecté!');
                redirect(base_url('pages'));
            }
        }
    }

    function loginBycodeConfirm($codevalidation)
    {
        $result = $this->register_model->loginByUsingValidationCode($codevalidation);
        if ($result) {
            $sess_fiat_array = array();
            foreach ($result as $row) {
                $sess_fiat_array = $arrayName = array(
                    'id_abonne' => $row->id_abonne,
                    'email_abonne ' => $row->email_abonne,
                    'prenom_abonne'=>$row->prenom_abonne,
                    'nom_abonne'=>$row->nom_abonne,
                    'role_utilisateur' => $row->role_utilisateur,
                    'photo_abonne' => $row->photo_abonne
                );
                $this->session->set_userdata('fiato_logged_in', $sess_fiat_array);
                redirect(base_url('pages'));
            }
            return true;
        } else {
            $this->session->set_flashdata('connexion_failed', 'Le code a déjà expiré !');
            redirect(base_url('pages/connexion'));
        }
    }

    function authentification($password)
    {
        $email = $this->input->post('email');
        $result = $this->login_model->login($email, $password);
        if ($result) {
            $subscribe_sess_array = array();
            foreach ($result as $row) {
                $subscribe_sess_array = $arrayName = array(
                    'id_abonne' => $row->id_abonne,
                    'email_abonne ' => $row->email_abonne,
                    'prenom_abonne'=>$row->prenom_abonne,
                    'nom_abonne'=>$row->nom_abonne,
                    'role_utilisateur' => $row->role_utilisateur,
                    'photo_abonne' => $row->photo_abonne
                );
                $this->session->set_userdata('fiato_logged_in', $subscribe_sess_array);
            }
            return true;
        } else {
            $this->session->set_flashdata('connexion_failed', 'Email ou Mot de passe incorrect !');
            redirect(base_url('pages/connexion'));
        }
    }
}