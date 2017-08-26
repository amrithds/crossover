<?php

class Base_controller extends CI_Controller{
    public $data;
    
    function __construct(){
        parent::__construct();
        $this->data['title'] = 'Dr Patho';
    }
    
    public function templateResponse($view){
        $this->load->view ( 'layout/header', $this->data );
        $this->load->view ( $view , $this->data);
        $this->load->view ( 'layout/footer' );
    }
}


class Patient_Controller extends CI_Controller {

	function __construct(){
		parent::__construct();
		
		if (! isset ( $this->session->userdata ['logged_in'] )) {
		    redirect ( 'home/welcome' );
		}
	}
}


class Admin_Controller extends Base_controller {
    
    function __construct(){
        parent::__construct();
        
        if (! isset ( $this->session->userdata ['logged_in'] ) || $this->session->userdata ['logged_in']['user_type'] !== USER_TYPE_ADMIN) {
            redirect ( '/' );
        }
    }
}