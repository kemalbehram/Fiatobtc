<?php
/**
 * 
 */
class Product_model extends CI_Model
{
	///Affichage de produits
	function fetch()
	{
		$this->db->order_by('id_product', 'DESC');
		$this->db->where('product_status', '1');
		$query= $this->db->get('fiat_products');
		return $query->result();
	}

	///Création des produits
	function create($data){
		return $this->db->insert('fiat_products', $data);
		 
	}
	function edit($id){
		$this->db->where('id_product', $id);
		$query= $this->db->get('fiat_products');
		return $query->row_array();
	}
	function update($data){
		$this->db->where('id_product', $this->input->post('id'));
		return $this->db->update('fiat_products', $data);
	}
	function delete($id, $data){
		$this->db->where('id_product', $id);
		return $this->db->delete('fiat_products');
	}
	function getTauxAchat(){
		$this->db->where('designation', 'BITCOIN');
		$query= $this->db->get('fiat_products');
		return $query->row_array();
	}
	
}