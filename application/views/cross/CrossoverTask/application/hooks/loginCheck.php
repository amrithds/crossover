<?php
class SessionData extends CI_Controller {
	var $CI;
	function __construct() {
		parent::__construct();
		$this->load->library('session');
	}
	function initializeData() {
		if (! $this->session->userdata ( 'logged_in' )) { // this is line 13
			
		}else{
			
		}
	}
}