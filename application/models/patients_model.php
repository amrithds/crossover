<?php
class Patients_model extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
	
	// constants for new and existing patients identification
	const NEW_PATIENT = 1;
	
	const EXISTING_PATIENT = 2;
	
	/**
	 * get patients from DB
	 * 
	 * @param string $slug
	 *        	return resultset
	 */
	public function getPatients($criteria = array(),$columns = '*') {
	    
	    $query = $this->db->order_by ( "first_name asc,last_name asc" );
	    $query->select($columns);
	    
	    if (!empty($criteria)) {
	        $query = $query->get_where ( 'patients', $criteria );
	    }else{
	        $query = $query->get( 'patients');
	    }
	    
	    return $query->result_array ();
	}
	
	/**
	 * 
	 * @param unknown $slug
	 */
	public function get_new_detail($slug){
		$query = $this->db->query("SELECT n.id,n.slug,n.title,n.content,n.photo,u.fname,u.lname,n.created_at  FROM news  n LEFT JOIN users u ON (n.user_id = u.id) WHERE n.slug='$slug'");
		return $query->row_array();
	}
	
	/**
	 *
	 * @param unknown $limit        	
	 * @param unknown $start        	
	 * @param array $criteria        	
	 */
	public function getAllNews($limit, $start= 0, $criteria = NULL) {
		$this->db->order_by ( "created_at", "desc" );
		$this->db->limit ( $limit, $start );
		if ($criteria !== NULL) {
			$query = $this->db->get_where ( 'news', $criteria );
		} else {
			$query = $this->db->get ( 'news' );
		}
		return $query->result_array ();
	}
	
	/**
	 * create news
	 * return boolean
	 */
	public function set_news($data) {
		$this->load->helper ( 'url' );
		
		return $this->db->insert ( 'news', $data );
	}
	
	/**
	 * get total record count
	 */
	public function record_count($userId) {
		$this->db->where ( 'user_id', $userId );
		return $this->db->count_all ( "news" );
	}
	
	public function deleteRecord($id){
		$this->db->where('id', $id);
		return $this->db->delete('news');
	}
        
        /**
	 * function to validate login credentials
	 * @param string $email
	 * @param string $password
	 * @return resultset|boolean
	 */
	public function login($email, $password) {
		$this->db->select ( 'id, email, first_name, last_name' );
		$criteria = array (
				'email' => $email,
				'password' => md5 ( $password ) 
		);
		$this->db->from ( 'users' );
		$this->db->where ( $criteria );
		$this->db->limit ( 1 );
		
		$query = $this->db->get ();
		
		if ($query->num_rows () == 1) {
			$res = $query->result ();
			return $res [0];
		} else {
			return false;
		}
	}
}