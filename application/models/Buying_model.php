<?php

/**
 * Classe pour les commandes d'achats
 */
class Buying_model extends CI_Model
{
	
	function saveCommand($data)
	{
		return $this->db->insert('fiat_buyings', $data);
	}

	function getEmailAbonne($id){
		$this->db->where('id_abonne', $id);
		$query= $this->db->get('fiat_abonnes');
		return $query->row_array();
	}

	//Affichage des commandes par utilisateur
	function showUserBuyingCommands($id){
		$this->db->order_by('id_achat', 'DESC');
		$this->db->where('id_abonne', $id);
		$query= $this->db->get('fiat_buyings');
		return $query->result();
	}


	//Fonctions liées aux notifications

    function fetchUnseenNotifications(){

        $query= $this->db->get_where('fiat_buyings', array('statut_view' => 0 ));
        return $query->num_rows();
    }

    function fetchAllnotifications(){
        $limit=2; $offset=0;
        $this->db->limit($limit, $offset);
    	$this->db->order_by('id_achat', 'DESC');
    	$this->db->join('fiat_abonnes', 'fiat_abonnes.id_abonne=fiat_buyings.id_abonne');
        $query= $this->db->get('fiat_buyings');
        return $query->result();
    }
    function updateNotification($data){
        $this->db->where('statut_view', 0);
        return $this->db->update('fiat_buyings', $data);
    }

    function datailsAbonne($referal_key){
        $query= $this->db->get_where('fiat_abonnes', array('referal_key_abonne' =>$referal_key));
        return $query->row_array();
    }

    function details($code){
    	$this->db->join('fiat_abonnes','fiat_buyings.id_abonne=fiat_abonnes.id_abonne');
    	$query= $this->db->get_where('fiat_buyings', array('numero_commande' =>$code));
        return $query->row_array();
    }
    function cancelCommand($request){
    	$data = array(
    		'etat_commande'=>'rejetée',
    		'updated_at'=>date('Y-m-d')
    	);
    	$this->db->where('numero_commande', $request);
    	return $this->db->update('fiat_buyings', $data);
    }

    function validCommand($request){
    	$data = array(
    		'etat_commande'=>'traitée',
            'hash_code'=>$this->input->post('code_hash'),
    		'updated_at'=>date('Y-m-d')
    	);
    	$this->db->where('numero_commande', $request);
    	$this->db->update('fiat_buyings', $data);

        $id_abonne = $this->input->post('id_abonne');
        $key_parain= $this->input->post('key_parain');
    	$databonus= array(
    		'numero_commande'=>$request,
            'id_abonne'=>$id_abonne,
            'key_parain'=>$key_parain,
    		'statut_bonus'=>'non réglé',
    		'motif_bonus'=>'achat'
    	);
    	$this->db->insert('fiat_bonus', $databonus);
    	return true;
    }

    function fetchCommandes(){
        $this->db->order_by('id_achat', 'DESC');
        $this->db->join('fiat_abonnes', 'fiat_abonnes.id_abonne=fiat_buyings.id_abonne');
        $query= $this->db->get('fiat_buyings');
        return $query->result();
    }
    
    function fetchTraites(){
        $query= $this->db->get_where('fiat_buyings', array('etat_commande' =>'traitée' ));
        return $query->num_rows();
    }
    function fetchEncours(){
        $query= $this->db->get_where('fiat_buyings', array('etat_commande' =>'en cours' ));
        return $query->num_rows();
    }
    function fetchRejetees(){
    	 $query= $this->db->get_where('fiat_buyings', array('etat_commande' =>'rejetée' ));
        return $query->num_rows();
    }
    function fetchTotal(){
        $query= $this->db->get('fiat_buyings');
        return $query->num_rows();
    }

//Fonctions liées aux bonus
    function fetchBonus(){
    	$query= $this->db->query("SELECT fiat_bonus.id_bonus, fiat_bonus.numero_commande, fiat_bonus.motif_bonus, fiat_bonus.statut_bonus, fiat_bonus.statut_reclamation, fiat_buyings.qte_achete_usd, fiat_buyings.id_abonne, fiat_abonnes.prenom_abonne, fiat_abonnes.nom_abonne, fiat_abonnes.referal_key_parain, fiat_abonnes.referal_key_abonne, fiat_abonnes.email_abonne, (fiat_buyings.qte_achete_usd*0.7/100) AS bonus FROM fiat_bonus INNER JOIN fiat_buyings ON fiat_bonus.numero_commande=fiat_buyings.numero_commande INNER JOIN fiat_abonnes ON fiat_buyings.id_abonne=fiat_abonnes.id_abonne ORDER BY fiat_bonus.id_bonus DESC");
    	return $query->result();
    }

    function getClienBonus($key_abonne){
    	$query = $this->db->query("SELECT fiat_bonus.id_bonus, fiat_bonus.numero_commande, fiat_bonus.motif_bonus, fiat_bonus.statut_bonus, fiat_bonus.statut_reclamation, fiat_buyings.qte_achete_usd, fiat_buyings.id_abonne, fiat_abonnes.prenom_abonne, fiat_abonnes.nom_abonne, fiat_abonnes.referal_key_parain, fiat_abonnes.referal_key_abonne, fiat_abonnes.email_abonne, (fiat_buyings.qte_achete_usd*0.7/100) AS bonus FROM fiat_bonus INNER JOIN fiat_buyings ON fiat_bonus.numero_commande=fiat_buyings.numero_commande INNER JOIN fiat_abonnes ON fiat_buyings.id_abonne=fiat_abonnes.id_abonne WHERE fiat_bonus.key_parain='$key_abonne' ORDER BY fiat_bonus.id_bonus DESC");
    	return $query->result();
    }

    function fetchBonusTotal(){
    	$query= $this->db->get('fiat_bonus');
        return $query->num_rows();
    }

    function fetchBonusNonRegles(){
    	$query= $this->db->get_where('fiat_bonus', array('statut_bonus' =>'non réglé'));
        return $query->num_rows();
    }
    function fetchBonusRegles(){
    	$query= $this->db->get_where('fiat_bonus', array('statut_bonus' =>'réglé'));
        return $query->num_rows();
    }

   	function reglerBonus($data, $id){
   		$this->db->where('id_bonus', $id);
   		return $this->db->update('fiat_bonus', $data);
   	}

   	function reclamerBonus($data, $id){
   		$this->db->where('id_bonus', $id);
   		return $this->db->update('fiat_bonus', $data);
   	}

    function get_total_buying($id){
        $this->db->where(array('etat_commande'=> 'traitée', 'id_abonne'=>$id));
        $this->db->select_sum('qte_achete_usd', 'somme');
        $query=$this->db->get('fiat_buyings');
        return $query->row_array();
    }

    //Fonctions liées au prime de fidélité
    function fetchFidelity(){
        $this->db->order_by('id_prime', 'DESC');
        $this->db->join('fiat_abonnes', 'fiat_abonnes.email_abonne=fiat_primes.email_abonne');
        $query= $this->db->get('fiat_primes');
        return $query->result();
    }
    function savePrime($data){
        $this->db->insert('fiat_primes', $data);
        return true;
    }

    function fetchValid(){//Pour les emails des abonnés dans les primes
        $query= $this->db->get_where('fiat_abonnes', array('statut_abonne' =>'online' ));
        return $query->result();
    }

    //Primes de fidélidé gagné.
    function getClientFidelity($email){
        $query=$this->db->get_where('fiat_primes', array('email_abonne'=>$email));
        return $query->result();
    }
}