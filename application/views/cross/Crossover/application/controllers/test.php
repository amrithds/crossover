<?php
class Test extends CI_Controller{
	
	public function __construct() {
		parent::__construct();
		$this->load->library('unit_test');
	}
	
	public function testLogin($param) {
		//$testName = 'Login test';
		$this->load->model ( 'users' );
		$this->unit->run($this->users->verifyToken('invalid'), false, 'Verify token function(Invalid token check)');
		
		
		$this->unit->run($this->users->verifyToken('d20a79026b86ece94edaa9f9315f9ed1'), 1, 'Verify token function(valid token check)');
		$this->load->view ( 'test/loginTest' );
		//$this->unit->run($this->users->verifyToken('e10adc3949ba59abbe56e057f20f883e'), 1, 'Verify token function(valid token check)');
	}
}