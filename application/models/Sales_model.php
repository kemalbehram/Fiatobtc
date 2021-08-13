<?php
/**
 * VENTES
 */
class Sales_model extends CI_Model
{
	
	function fetchUnseenNotifications(){
        $query= $this->db->get_where('payments', array('statut_view' => 0 ));
        return $query->num_rows();
    }

    function fetchAllnotifications(){
        $limit=2; $offset=0;
        $this->db->limit($limit, $offset);
    	$this->db->order_by('id_paiement', 'DESC');
    	$this->db->join('fiat_abonnes', 'fiat_abonnes.email_abonne=payments.email');
        $query= $this->db->get('payments');
        return $query->result();
    }
    function updateNotification($data){
        $this->db->where('statut_view', 0);
        return $this->db->update('payments', $data);
    }

    function get_email_abonne($id){
        $this->db->where('id_abonne', $id);
        $query= $this->db->get('fiat_abonnes');
        return $query->row_array();
    }

    function getClientVentes($email){
        $this->db->order_by('id_paiement', 'DESC');
        $query= $this->db->get_where('payments', array('email'=>$email));
        return $query->result();
    }

    //Fonctions liées aux commandes de ventes

    function fetchCommandes(){
        $this->db->order_by('id_paiement', 'DESC');
        $this->db->join('fiat_abonnes', 'fiat_abonnes.email_abonne=payments.email');
        $query= $this->db->get('payments');
        return $query->result();
    }
    
    function fetchTraites(){
        $query= $this->db->get_where('payments', array('status' =>'success'));
        return $query->num_rows();
    }
    function fetchEncours(){
        $query= $this->db->get_where('payments', array('status' =>'initialized'));
        return $query->num_rows();
    }
    function fetchRejetees(){
         $query= $this->db->get_where('payments', array('status' =>'error' ));
        return $query->num_rows();
    }
    function fetchTotal(){
        $query= $this->db->get('payments');
        return $query->num_rows();
    }

    function details($id){
        $this->db->join('fiat_abonnes', 'fiat_abonnes.email_abonne=payments.email');
        $query= $this->db->get_where('payments', array('id_paiement' =>$id));
        return $query->row_array();
    }

    function get_total_sales($email){
        $this->db->where(array('status'=> 'success', 'email'=>$email));
        $this->db->select_sum('entered_amount', 'somme');
        $query=$this->db->get('payments');
        return $query->row_array();
    }

    function cancelCommand($request){
        $data = array(
            'status'=>'error',
            'updated_at'=>date('Y-m-d h:i:s')
        );
        $this->db->where('id_paiement', $request);
        return $this->db->update('payments', $data);
    }

    function validCommand($request){
        $data = array(
            'status'=>'success',
            'updated_at'=>date('Y-m-d h:i:s')
        );
        $this->db->where('id_paiement', $request);
        return $this->db->update('payments', $data);
    }
}