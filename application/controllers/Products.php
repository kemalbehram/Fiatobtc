<?php
/**
 * CLASSES DE GESTION DE PRODUITS
 */
class Products extends CI_Controller
{
	//Fonction de listage des tous les produits
	function index()
	{
		$session_data= $this->session->userdata('fiato_logged_in');

		$data['id_abonne'] = $session_data['id_abonne'];
	
		$data['role_utilisateur'] = $session_data['role_utilisateur'];
		if (!$data['id_abonne'] || $data['role_utilisateur'] =='abonne') {

			redirect(base_url('pages/connexion'));

		}else{

		$data['title'] = 'Produits';
        $data['types'] = "website";
        $data['description'] = "FIATOBTC permet d’acheter, de vendre les crypto monnaies contre du Fiat et aussi permet d’échanger les crypto monnaies entre elles";
        $data['meta_title'] = "FiaToBTC";
        $data['title_page'] = " FiaToBTC ";
        $data['keywords'] = "FiaToBTC, Acheter, vendre, BitCoin, USDT, RDC, Échanger";

		$data['products']= $this->product_model->fetch();
		$this->load->view('templates/header', $data);
		$this->load->view('products/index', $data);
		$this->load->view('templates/footer');
		}
	}

	function create(){
	
		$this->load->library('form_validation');

        $this->form_validation->set_rules('designation', 'Désignation', 'required|is_unique[fiat_products.designation]');
        $this->form_validation->set_rules('taux_achat', 'Taux d\'achat', 'required|decimal');  
        $this->form_validation->set_rules('taux_vente', 'Taux de vente', 'required|decimal'); 

        if ($this->form_validation->run()) {
		    	$data = array(
				'designation' => htmlentities($this->input->post('designation')), 
				'taux_achat' => htmlentities($this->input->post('taux_achat')), 
				'taux_vente' => htmlentities($this->input->post('taux_vente'))
				);

				$this->product_model->create($data);

				$array = array(
	                'success'=>'<div class="alert-success p-3 text-lg-center"> Le produit a été ajouté avec succès!</div>
	            '
	            );

	        }else{

	            $array = array(
	                'error' => true,
	                'designation_error' => form_error('designation'),
	                'tauxachat_error' => form_error('taux_achat'),
	                'tauxvente_error' => form_error('taux_vente')
	            );
	        }
	        echo json_encode($array);  
	}

	function edit($id){
		$session_data= $this->session->userdata('fiato_logged_in');

		$data['id_abonne'] = $session_data['id_abonne'];
	
		$data['role_utilisateur'] = $session_data['role_utilisateur'];
		if (!$data['id_abonne'] || $data['role_utilisateur'] =='abonne') {

			redirect(base_url('pages/connexion'));

		}else{

		$data['title'] = 'Produits';
        $data['types'] = "website";
        $data['description'] = "FIATOBTC permet d’acheter, de vendre les crypto monnaies contre du Fiat et aussi permet d’échanger les crypto monnaies entre elles";
        $data['meta_title'] = "FiaToBTC";
        $data['title_page'] = " FiaToBTC ";
        $data['keywords'] = "FiaToBTC, Acheter, vendre, BitCoin, USDT, RDC, Échanger";

			$data['product']= $this->product_model->edit($id);
			$this->load->view('templates/header', $data);
			$this->load->view('products/edit', $data);
			$this->load->view('templates/footer');
		}
	}

	function update(){
		$this->load->library('form_validation');

        $this->form_validation->set_rules('designation', 'Désignation', 'required');
        $this->form_validation->set_rules('taux_achat', 'Taux d\'achat', 'required|decimal');  
        $this->form_validation->set_rules('taux_vente', 'Taux de vente', 'required|decimal'); 

        if ($this->form_validation->run()) {

	    	$data = array(
			'designation' => htmlentities($this->input->post('designation')), 
			'taux_achat' => htmlentities($this->input->post('taux_achat')), 
			'taux_vente' => htmlentities($this->input->post('taux_vente'))
			);
			$this->product_model->update($data);
			$this->session->set_flashdata('product_update', 'Le produit a été mis à jour avec succès !');
        	redirect(base_url('products/index'));

        }else{
            $array = array(
                'error' => true,
                'designation_error' => form_error('designation'),
                'tauxachat_error' => form_error('taux_achat'),
                'tauxvente_error' => form_error('taux_vente')
            );
            echo json_encode($array);
        }  
	}

	function delete($id){
		$data = array(
			'product_status' => 0, 
			'product_date_updated'=> date('Y-m-d')
		);
		$this->product_model->delete($id, $data);
			$this->session->set_flashdata('product_delete', 'Le produit a été supprimé avec succès !');
        	redirect(base_url('products'));
	}
}