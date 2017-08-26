<?php
class Cart_Model extends CI_Model {
	function retrieve_products() {
		$query = $this->db->get ( 'products' ); // Select the table products
		return $query->result_array (); // Return the results in a array.
	}
	
	function validate_add_cart_item() {
		$id = $this->input->post ( 'product_id' ); // Assign posted product_id to $id
		$cty = $this->input->post ( 'quantity' ); // Assign posted quantity to $cty
		
		$this->db->where ( 'id', $id ); // Select where id matches the posted id
		$query = $this->db->get ( 'products', 1 ); // Select the products where a match is found and limit the query by 1
		
		if ($query->num_rows > 0) {
			foreach ( $query->result () as $row ) {
				// Create an array with product information
				$data = array (
						'id' => $id,
						'qty' => $cty,
						'price' => $row->price,
						'name' => $row->name 
				);
				
				// Add the data to the cart using the insert function that is available because we loaded the cart library
				$this->cart->insert ( $data );
				
				return TRUE; // Finally return TRUE
			}
		} else {
			// Nothing found! Return FALSE!
			return FALSE;
		}
	}
}