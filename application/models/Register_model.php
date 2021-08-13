<?php
/**
 * Created by PhpStorm.
 * User: Congo Agile
 * Date: 01/12/2020
 * Time: 11:08
 */
class Register_model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function referalkey_check($referal_key){
        $query = $this->db->get_where('fiat_abonnes', array('referal_key_abonne'=> $referal_key));
        //if ($query->num_rows==1){
            return $query->row_array();
        //}else{
            //return false;
        //}
    }

    function email_check($email){
        $this->db->where('email_abonne', $email);
        $query=$this->db->get('fiat_abonnes');
        if ($query->num_rows==1){
            return $query->row_array();
        }else{
            return false;
        }
    }
    function save_data_account($data){
        return $this->db->insert('fiat_abonnes', $data);
    }

    function check_code_validation($code){
        $query=$this->db->get_where('fiat_abonnes', array('validation_code'=>$code));
        //if ($query->num_rows > 0){
            return $query->row_array();
        //}else{
           // return false;
        ///}
    }

    function loginByUsingValidationCode($code){
            $query = $this->db->get_where('fiat_abonnes', array('validation_code'=>$code,'statut_abonne'=>'online'));
            if($query->num_rows()==1){
                return $query->result();
            }else{
                return false;
            }
    }
    function confirm_account($code){
        $data= array(
            'statut_abonne'=>'online'
        );
        $this->db->where('validation_code', $code);
        return $this->db->update('fiat_abonnes', $data);
    }

    //Fonctions liées aux notifications

    function fetchUnseenNotifications(){
        $query= $this->db->get_where('fiat_abonnes', array('statut_view' => 0 ));
        return $query->num_rows();
    }

    function fetchAllnotifications(){
        $query= $this->db->query("SELECT * FROM fiat_abonnes ORDER BY id_abonne DESC LIMIT 5");
        return $query->result();
    }
    function updateNotification($data){
        $this->db->where('statut_view', 0);
        return $this->db->update('fiat_abonnes', $data);
    }

    function datailsAbonne($referal_key){
        $query= $this->db->get_where('fiat_abonnes', array('referal_key_abonne' =>$referal_key));
        return $query->row_array();
    }

    function datailsAllSubscribes($referal_key){
        $query= $this->db->query("SELECT * FROM fiat_abonnes WHERE referal_key_abonne != $referal_key ORDER BY id_abonne  DESC");
        return $query->result();
    }

    //Fonctions liées à la gestion des abonnés

    function fetchAbonnes(){
        $this->db->order_by('id_abonne', 'DESC');
        $query= $this->db->get('fiat_abonnes');
        return $query->result();
    }
    function fetchConfirm(){
        $query= $this->db->get_where('fiat_abonnes', array('statut_abonne' =>'online' ));
        return $query->num_rows();
    }

    

    function fetchNonConfirm(){
        $query= $this->db->get_where('fiat_abonnes', array('statut_abonne' =>'offline' ));
        return $query->num_rows();
    }
    function fetchTotal(){
        $query= $this->db->get('fiat_abonnes');
        return $query->num_rows();
    }

    //GESTION DE COMPTE
    function myaccount($id){
        $query= $this->db->get_where('fiat_abonnes', array('id_abonne' =>$id));
        return $query->row_array();
    }

    function myfiels($referal_key){
        $query= $this->db->get_where('fiat_abonnes', array('referal_key_parain' =>$referal_key, 'statut_abonne'=>'online'));
        return $query->result();
    }
    function countmyfiels($referal_key){
        $query= $this->db->get_where('fiat_abonnes', array('referal_key_parain' =>$referal_key, 'statut_abonne'=>'online'));
        return $query->num_rows();
    }

    function updateinfoaccount($data, $id){
        $this->db->where('id_abonne', $id);
        return $this->db->update('fiat_abonnes', $data);
    }
    function check_ancient_password($id, $newpassword){
        $query = $this->db->get_where('fiat_abonnes', array('id_abonne' => $id, 'statut_abonne' => 'online'));
        if ($query->num_rows() == 1) {
            $result = $query->result();
            foreach ($result as $item) {
                if (password_verify($newpassword, $item->mot_de_passe_abonne)) {
                    return $query->result();
                } else{
                    return false;
                }
            }
        } else {
            return false;
        }
    }
    function changePassword($data, $id){
        $this->db->where('id_abonne', $id);
        return $this->db->update('fiat_abonnes', $data);
    }
}