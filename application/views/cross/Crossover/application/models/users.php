<?php
class users extends CI_Model {
	/*
	 * public $id;
	 * public $password;
	 * public $fname;
	 * public $lname;
	 * public $email;
	 * public $status;
	 * public $token;
	 */
	const USER_STATUS_PENDING = 0;
	const USER_STATUS_EMAIL_VERIFIED = 1;
	const USER_STATUS_ACTIVE = 2;
	const USER_STATUS_INACTIVE = 3;
	function __construct() {
		parent::__construct ();
	}
	
	// insert into user table
	function insertUser($data) {
		return $this->db->insert ( 'users', $data );
	}
	function updateUserByToken($token, $data) {
		$this->db->where ( 'token', $token );
		return $this->db->update ( 'users', $data );
	}
	
	// activate user account
	function verifyToken($token, $status = self::USER_STATUS_PENDING) {
		$criteria = array (
				'token' => $token,
				'status' => $status 
		);
		$this->db->where ( $criteria );
		$this->db->from ( 'users' );
		return $this->db->count_all_results ();
	}
	public function login($email, $password) {
		$this->db->select ( 'id, email, fname, lname' );
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