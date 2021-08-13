<?php
/**
 * Created by PhpStorm.
 * User: Congo Agile
 * Date: 09/12/2020
 * Time: 09:45
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model
{
    function login($email, $password)
    {
        $query = $this->db->get_where('fiat_abonnes', array('email_abonne' => $email, 'statut_abonne' => 'online'));
        if ($query->num_rows() == 1) {
            $result = $query->result();
            foreach ($result as $item) {
                if (password_verify($password, $item->mot_de_passe_abonne)) {
                    return $query->result();
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    }
}