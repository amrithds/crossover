<?php
class Users_model extends CI_Model {
	
    const USER_TYPE_ADMIN = 1;
    
	const USER_STATUS_PENDING = 0;
	const USER_STATUS_ACTIVE = 1;
	const USER_STATUS_INACTIVE = 2;
	
	/**
	 *  users_model
	 */
	function __construct() {
		parent::__construct ();
	}
	
	/**
	 * insert into user table
	 * @param array $data
	 * @return boolean
	 */
	function insertUser($data) {
		return $this->db->insert ( 'users', $data );
	}
	
	/**
	 * 
	 * @param unknown $token
	 * @param unknown $data
	 * @return unknown
	 */
	function updateUserByToken($token, $data) {
		//$this->db->where ( 'token', $token );
		//return $this->db->update ( 'users', $data );
		return true;
	}
	
	// activate user account
	function verifyToken($token, $status = self::USER_STATUS_PENDING) {
		$criteria = array (
				//'token' => $token,
				'status' => $status 
		);
		$this->db->where ( $criteria );
		$this->db->from ( 'users' );
		return $this->db->count_all_results ();
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
				'status' => self::USER_STATUS_ACTIVE,
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
?>