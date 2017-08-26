<?php
class Cart extends CI_Controller {
	function Cart() {
		parent::__construct (); // We define the the Controller class is the parent.
		$this->load->model ( 'cart_model' );
	}
	function index() {
		$data ['products'] = $this->cart_model->retrieve_products (); // Retrieve an array with all products
		$data ['content'] = 'cart/products'; // Select our view file that will display our products
		$this->load->view ( 'index', $data ); // Display the page with the above defined content
	}
	function add_cart_item() {
		if ($this->cart_model->validate_add_cart_item () == TRUE) {
			
			// Check if user has javascript enabled
			if ($this->input->post ( 'ajax' ) != '1') {
				redirect ( 'cart' ); // If javascript is not enabled, reload the page with new data
			} else {
				echo 'true'; // If javascript is enabled, return true, so the cart gets updated
			}
		}
	}
}