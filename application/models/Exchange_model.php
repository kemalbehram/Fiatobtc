<?php
/**
 * Created by PhpStorm.
 * User: Congo Agile
 * Date: 03/04/2021
 * Time: 09:39
 */
class Exchange_model extends CI_Model{


    function saveDataCryptoFiat($data){

        $this->db->insert('fiat_crypto_fiat', $data);
        return true;
    }

    //Fonctions de listage de commande d'exchange Crypto contre Fiat

    function fetchUCancelsCF(){

        $query= $this->db->get_where('fiat_crypto_fiat', array('statut_demande' => 'cancel' ));
        return $query->num_rows();
    }

    //Commandes d'echange de crypto contre fiat
    function fetchCommandesCF(){
        $this->db->order_by('id_exchange', 'DESC');
        $this->db->join('fiat_abonnes', 'fiat_abonnes.id_abonne=fiat_crypto_fiat.id_abonne');
        $query= $this->db->get('fiat_crypto_fiat');
        return $query->result();
    }

    function fetchTraitesCF(){
        $query= $this->db->get_where('fiat_crypto_fiat', array('statut_demande' =>'confirm' ));
        return $query->num_rows();
    }
    function fetchEncoursCF(){
        $query= $this->db->get_where('fiat_crypto_fiat', array('statut_demande' =>'process' ));
        return $query->num_rows();
    }
    function fetchRejeteesCF(){
        $query= $this->db->get_where('fiat_crypto_fiat', array('statut_demande' =>'cancel' ));
        return $query->num_rows();
    }
    function fetchTotalCF(){
        $query= $this->db->get('fiat_crypto_fiat');
        return $query->num_rows();
    }
    function detailsCF($code){
        $this->db->join('fiat_abonnes','fiat_crypto_fiat.id_abonne=fiat_abonnes.id_abonne');
        $query= $this->db->get_where('fiat_crypto_fiat', array('id_exchange' =>$code));
        return $query->row_array();
    }


    //Validation de la commande d'echange de crypto contre du fiat
    function validDemandeCryptoFiat($request){
        $data = array(
            'statut_demande'=>'confirm',
            'date_change_statut'=>date('Y-m-d')
        );
        $this->db->where('id_exchange', $request);
        $this->db->update('fiat_crypto_fiat', $data);
    }

    //Annulation de la commande d'echange de crypto contre iat
    function cancelDemandeCryptoFiat($request){
        $data = array(
            'statut_demande'=>'cancel',
            'date_change_statut'=>date('Y-m-d')
        );
        $this->db->where('id_exchange', $request);
        $this->db->update('fiat_crypto_fiat', $data);
    }

    /*Function de récupération des informations sur
    les ordres d'echange de Crypto contre Fiat pour chaque utilisateur*/
    function fetchUserOrderData($userId){
        $this->db->order_by('id_exchange', 'DESC');
        $this->db->join('fiat_abonnes', 'fiat_abonnes.id_abonne=fiat_crypto_fiat.id_abonne');
        $query= $this->db->get_where('fiat_crypto_fiat', array("fiat_crypto_fiat.id_abonne"=>$userId));

        return $query->result();
    }

    /* fonction d'affichage des soldes pour chaque abonnés */
    function getUserSolde($userId){
        $this->db->group_by('product');
        $this->db->select('product');
        $this->db->select_sum('quantite_depose');
        $query= $this->db->get_where('fiat_soldes', array("fiat_soldes.id_abonne"=>$userId));
        return $query->result();
    }

    //Function de création de solde
      function createUserSolde($data){
        return $this->db->insert('fiat_soldes', $data);
      }

      //Fonction d'affichage des ordres de vente sur la page d'accueil
    function showDataCrypto(){
        $this->db->order_by('id_exchange', 'DESC');
        $this->db->join('fiat_abonnes', 'fiat_abonnes.id_abonne=fiat_crypto_fiat.id_abonne');
        $where="fiat_crypto_fiat.statut_demande='confirm' AND fiat_crypto_fiat.qte > 0";
        $query= $this->db->get_where('fiat_crypto_fiat', $where);

        return $query->result();
    }

    function buycrypto($id){
        $this->db->join('fiat_abonnes', 'fiat_abonnes.id_abonne=fiat_crypto_fiat.id_abonne');
        $query= $this->db->get_where('fiat_crypto_fiat', array('id_exchange'=>$id, 'statut_demande'=>'confirm'));
        return $query->row_array();
    }

    //FONCTION D'ENREGISTREMENT DE L'ORDRE D'ECHANGE DE CRYPTO

    function savebuycrypto($data){
        return $this->db->insert('fiat_buyings_crypto_exchange', $data);
    }

    //AFFICHAGE DES ORDRES D'ACHAT POUR CHAQUE UTILISATEUR
    function fetchUserCryptorderData($user_id){
        $this->db->order_by('id_buying', 'DESC');
        $this->db->join('fiat_abonnes', 'fiat_abonnes.id_abonne=fiat_buyings_crypto_exchange.id_abonne');
        $query= $this->db->get_where('fiat_buyings_crypto_exchange', array('fiat_buyings_crypto_exchange.id_abonne'=>$user_id));
        return $query->result();
    }


    /* START COMMANDE D'ACHAT DE CRYPTO CONTRE DU FIAT */
    function fetchCommandesACF(){
        $this->db->order_by('id_buying', 'DESC');

        $this->db->join('fiat_abonnes', 'fiat_abonnes.id_abonne = fiat_buyings_crypto_exchange.id_abonne');
        //$this->db->join('fiat_crypto_fiat', 'fiat_crypto_fiat.id_exchange = fiat_buyings_crypto_exchange.id_exchange');

        $query= $this->db->get('fiat_buyings_crypto_exchange');
        return $query->result();
    }

    function fetchTraitesACF(){
        $query= $this->db->get_where('fiat_buyings_crypto_exchange', array('statut_buy_exchange' =>'confirm' ));
        return $query->num_rows();
    }
    function fetchEncoursACF(){
        $query= $this->db->get_where('fiat_buyings_crypto_exchange', array('statut_buy_exchange' =>'process' ));
        return $query->num_rows();
    }
    function fetchRejeteesACF(){
        $query= $this->db->get_where('fiat_buyings_crypto_exchange', array('statut_buy_exchange' =>'cancel' ));
        return $query->num_rows();
    }
    function fetchTotalACF(){
        $query= $this->db->get('fiat_buyings_crypto_exchange');
        return $query->num_rows();
    }
     /* END COMMANDE D'ACHAT DE CRYPTO CONTRE DU FIAT */

    /*Details de la commande d'achat des crypto contre du fiat*/
      function detailsACF($code){
        $this->db->join('fiat_abonnes','fiat_buyings_crypto_exchange.id_abonne = fiat_abonnes.id_abonne');
        $query= $this->db->get_where('fiat_buyings_crypto_exchange', array('id_buying' =>$code));
        return $query->row_array();
    }

    /*Validation de la commande d'achat des cryptos contre du fiat*/
    function validOrdersAchatCryptoFiat($request){
        $data = array(
            'statut_buy_exchange'=>'confirm',
            'hashAcheteur'=>$this->input->post('code_hash'),
            'update_at_orders'=>date('Y-m-d')
        );
        $this->db->where('id_buying', $request);
        $this->db->update('fiat_buyings_crypto_exchange', $data);

        /*$id_abonne = $this->input->post('id_abonne');
        $key_parain= $this->input->post('key_parain');
        $databonus= array(
            'numero_commande'=>$request,
            'id_abonne'=>$id_abonne,
            'key_parain'=>$key_parain,
            'statut_bonus'=>'non réglé',
            'motif_bonus'=>'achat'
        );
        $this->db->insert('fiat_bonus', $databonus);*/
        return true;
    }
    //Adresse mail de l'initiateur de la commande d'achat de crypto contre du fiat
    function getEmailVendeur($request){
        $this->db->join('fiat_abonnes', 'fiat_abonnes.id_abonne=fiat_crypto_fiat.id_abonne');
        $query= $this->db->get_where('fiat_crypto_fiat', array('id_exchange'=>$request));
        return $query->row_array();
    }

    function updateOrdersAchatCryptoFiat($id_exchange){
        $query= $this->db->get_where('fiat_crypto_fiat', array('id_exchange'=>$id_exchange));
        $data['order'] = $query->row_array();
        $qte_ancienne = $data['order']['qte'];
        $qte_commande = $this->input->post('qte_commande');

        $qte_ajour = $qte_ancienne - $qte_commande;
        $dataupdated= array('qte'=>$qte_ajour);

        $this->db->where('id_exchange', $id_exchange);
        return $this->db->update('fiat_crypto_fiat', $dataupdated);
    }













    //=======================START FIAT VS CRYPTO FUNCTION ================================

    /*Enregistrement de l'Ordre d'echange de Fiat Contre le Crypto*/
    function saveOrderDataFiatCrypto($data){
        return $this->db->insert('fiat_fiat_crypto',$data);
    }

    function fetchUCancelsFC(){

        $query= $this->db->get_where('fiat_fiat_crypto', array('statut_demande' => 'cancel' ));
        return $query->num_rows();
    }

    //Commandes d'echange de crypto contre fiat
    function fetchCommandesFC(){
        $this->db->order_by('id_exchange', 'DESC');
        $this->db->join('fiat_abonnes', 'fiat_abonnes.id_abonne=fiat_fiat_crypto.id_abonne');
        $query= $this->db->get('fiat_fiat_crypto');
        return $query->result();
    }

    function fetchTraitesFC(){
        $query= $this->db->get_where('fiat_fiat_crypto', array('statut_demande' =>'confirm' ));
        return $query->num_rows();
    }
    function fetchEncoursFC(){
        $query= $this->db->get_where('fiat_fiat_crypto', array('statut_demande' =>'process' ));
        return $query->num_rows();
    }
    function fetchRejeteesFC(){
        $query= $this->db->get_where('fiat_fiat_crypto', array('statut_demande' =>'cancel' ));
        return $query->num_rows();
    }
    function fetchTotalFC(){
        $query= $this->db->get('fiat_fiat_crypto');
        return $query->num_rows();
    }
    function detailsFC($code){
        $this->db->join('fiat_abonnes','fiat_fiat_crypto.id_abonne=fiat_abonnes.id_abonne');
        $query= $this->db->get_where('fiat_fiat_crypto', array('id_exchange' =>$code));
        return $query->row_array();
    }



    /*++++++++++++++ ANNULATION COMMANDE+++++++++++++++++++*/
    function cancelDemandeFiatCrypto($request){
        $data = array(
            'statut_demande'=>'cancel',
            'date_change_statut'=>date('Y-m-d')
        );
        $this->db->where('id_exchange', $request);
        $this->db->update('fiat_fiat_crypto', $data);
    }

    //Validation de la commande d'echange de crypto contre du fiat
    function validDemandeFiatCrypto($request){

        $data = array(
            'statut_demande'=>'confirm',
            'date_change_statut'=>date('Y-m-d')
        );
        $this->db->where('id_exchange', $request);
        $this->db->update('fiat_fiat_crypto', $data);
    }

     //Fonction d'affichage des ordres de vente sur la page d'accueil
    function showDataFiat(){
        $this->db->order_by('id_exchange', 'DESC');
        $this->db->join('fiat_abonnes', 'fiat_abonnes.id_abonne=fiat_fiat_crypto.id_abonne');
        $where="fiat_fiat_crypto.statut_demande='confirm' AND fiat_fiat_crypto.qte > 0";
        $query= $this->db->get_where('fiat_fiat_crypto', $where);

        return $query->result();
    }

    //Affichage des informations de l'ordre sur la commande d'achat
    function buyfiat($id){
        $this->db->join('fiat_abonnes', 'fiat_abonnes.id_abonne=fiat_fiat_crypto.id_abonne');
        $query= $this->db->get_where('fiat_fiat_crypto', array('id_exchange'=>$id, 'statut_demande'=>'confirm'));
        return $query->row_array();
    }
    function savebuyfiat($data){
        return $this->db->insert('fiat_buyings_fiat_exchange', $data);
    }

    function fetchCommandesAFC(){
        $this->db->order_by('id_buying', 'DESC');

        $this->db->join('fiat_abonnes', 'fiat_abonnes.id_abonne = fiat_buyings_fiat_exchange.id_abonne');
        $query= $this->db->get('fiat_buyings_fiat_exchange');
        return $query->result();
    }

    function fetchTraitesAFC(){
        $query= $this->db->get_where('fiat_buyings_fiat_exchange', array('statut_buy_exchange' =>'confirm' ));
        return $query->num_rows();
    }
    function fetchEncoursAFC(){
        $query= $this->db->get_where('fiat_buyings_fiat_exchange', array('statut_buy_exchange' =>'process' ));
        return $query->num_rows();
    }
    function fetchRejeteesAFC(){
        $query= $this->db->get_where('fiat_buyings_fiat_exchange', array('statut_buy_exchange' =>'cancel' ));
        return $query->num_rows();
    }
    function fetchTotalAFC(){
        $query= $this->db->get('fiat_buyings_fiat_exchange');
        return $query->num_rows();
    }
     /* END COMMANDE D'ACHAT DE CRYPTO CONTRE DU FIAT */

    /*Details de la commande d'achat des crypto contre du fiat*/
      function detailsAFC($code){
        $this->db->join('fiat_abonnes','fiat_buyings_fiat_exchange.id_abonne = fiat_abonnes.id_abonne');
        $query= $this->db->get_where('fiat_buyings_fiat_exchange', array('id_buying' =>$code));
        return $query->row_array();
    }

 
    //Adresse mail de l'initiateur de la commande d'achat de fiat contre crypto
    function getEmailVendeurFiat($request){
        $this->db->join('fiat_abonnes', 'fiat_abonnes.id_abonne=fiat_fiat_crypto.id_abonne');
        $query= $this->db->get_where('fiat_fiat_crypto', array('id_exchange'=>$request));
        return $query->row_array();
    }

    /*Validation de la commande d'achat du fiat contre la crypto*/
    function validOrdersAchatFiatCrypto($request){
        $query= $this->db->get_where('fiat_buyings_fiat_exchange', array('id_buying'=>$request));
        $data['order'] = $query->row_array();
        $hascode = $data['order']['hashAcheteur'];
        $data = array(
            'statut_buy_exchange'=>'confirm',
            'update_at_orders'=>date('Y-m-d')
        );
        $this->db->where('id_buying', $request);
        $this->db->update('fiat_buyings_fiat_exchange', $data);

        //Add Hash code To Fiat Crypto Table
        $data1 = array(
            'hash'=>$hascode
        );

        $this->db->where('id_exchange', $this->input->post('id_exchange'));
        $this->db->update('fiat_fiat_crypto', $data1);

        return true;
    }

    function updateOrdersAchatFiatCrypto($id_exchange){
        $query= $this->db->get_where('fiat_fiat_crypto', array('id_exchange'=>$id_exchange));
        $data['order'] = $query->row_array();
        $qte_ancienne = $data['order']['qte'];
        $qte_commande = $this->input->post('qte_commande');

        $qte_ajour = $qte_ancienne - $qte_commande;
        $dataupdated= array('qte'=>$qte_ajour);

        $this->db->where('id_exchange', $id_exchange);
        return $this->db->update('fiat_fiat_crypto', $dataupdated);
    }

    //Annulation de la commande du fiat contre crypto
    function cancelOrdersAchatFiatCrypto($request){
        $data = array(
            'statut_buy_exchange'=>'cancel',
            'update_at_orders'=>date('Y-m-d')
        );
        $this->db->where('id_buying', $request);
        $this->db->update('fiat_buyings_fiat_exchange', $data);
        return true;
    }

    //AFFICHAGE DES ORDRES D'ACHAT POUR CHAQUE UTILISATEUR FIAT CONTRE CONTRE
    function fetchUserFiatCommndeData($user_id){
        $this->db->order_by('id_buying', 'DESC');
        $this->db->join('fiat_abonnes', 'fiat_abonnes.id_abonne=fiat_buyings_fiat_exchange.id_abonne');
        $query= $this->db->get_where('fiat_buyings_fiat_exchange', array('fiat_buyings_fiat_exchange.id_abonne'=>$user_id));
        return $query->result();
    }

    function fetchUserFiatOrderData($userId){
        $this->db->order_by('id_exchange', 'DESC');
        $this->db->join('fiat_abonnes', 'fiat_abonnes.id_abonne=fiat_fiat_crypto.id_abonne');
        $query= $this->db->get_where('fiat_fiat_crypto', array("fiat_fiat_crypto.id_abonne"=>$userId));

        return $query->result();
    }
}