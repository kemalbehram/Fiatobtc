<?php
/**
 * Pour le mot de passe oublié
 */
class Forgot_model extends CI_Model
{
	
	function checkEmail($email)
	{
		$query=$this->db->get_where('fiat_abonnes', array('email_abonne'=>$email, 'statut_abonne'=>'online'));
		return $query->row_array();
	}

	function saveRecuperationCode($data, $email){
		$this->db->where('email_abonne', $email);
		return $this->db->update('fiat_abonnes', $data);
	}

	function getUserdata($code){
		$query= $this->db->get_where('fiat_abonnes', array('recuperationCode'=>$code));
		return $query->row_array();
	}

	function changePassword(){
		$id = $this->input->post('id_abonne');
        $data = array(
            'mot_de_passe_abonne' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
            'recuperationCode'=>''
        );
        $this->db->where('id_abonne', $id);
        return $this->db->update('fiat_abonnes', $data);
    }
}