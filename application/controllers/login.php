<?php
class Login extends CI_Controller{
	
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'Users_model', 'users' );
		
	}

	public function register($token){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('fname', 'First Name', 'required');
		$this->form_validation->set_rules('lname', 'Last Name', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required|matches[confirmpass]|min_length[5]|max_length[12]|alpha_numeric');
		$this->form_validation->set_rules('confirmpass', 'Password Confirmation', 'required');
		
		$data ['token'] = $token;
		$data ['title'] = 'Register';
		$this->load->view('layout/header', $data);
		$this->load->view('login/register');
		$this->load->view('layout/footer');
		return;
		//check if token is valid
		if($this->users->verifyToken($token,Users_model::USER_STATUS_EMAIL_VERIFIED)){
			if ($this->form_validation->run() === FALSE)
			{
				$data ['token'] = $token;
				$data ['title'] = 'Register';
				$this->load->view('layout/header', $data);
				$this->load->view('login/register');
				$this->load->view('layout/footer');
			}else{
				$encryptedPass = md5($this->input->post('password'));
				
				$userData = array('password'=>$encryptedPass,'status' => Users_model::USER_STATUS_ACTIVE,'fname'=>$this->input->post('fname'),'lname'=>$this->input->post('lname'));
				$result = $this->users->updateUserByToken($token,$userData);
				if($result){
					redirect('login/loginUser');
				}else{
					$this->session->set_flashdata('error', 'Please try again.');
					redirect('login/register');
				}
			}
		}else{
			$data['error'] = "Invalid token";
			$data ['title'] = 'Invalid token';
			$this->load->view('layout/header', $data);
			$this->load->view('error/errorMessage');
			$this->load->view('layout/footer');
		}
	}
	
	/**
	 * login action 
	 */
	public function loginAdmin(){
		$this->load->library('form_validation');
		//validate form fields
		$this->form_validation->set_rules('username', 'username', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() === FALSE)
		{
			$data ['title'] = 'Login';
			$this->load->view('layout/header', $data);
			$this->load->view('login/login');
			$this->load->view('layout/footer');
		}else{
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$result = $this->users->login($email,$password);
			
			if($result !== false){
			    $session_data = array('id'=>$result->id,'email'=>$email,'fname'=>$result->first_name,'lname'=>$result->last_name,'user_type' => USER_TYPE_ADMIN);
				$this->session->set_userdata('logged_in', $session_data);
				redirect('admin/index');
			}else{
				$this->session->set_flashdata('error', 'Invalid credentials.');
				redirect('/');
			}
		}
	}
	
	public function logout(){
		$this->session->sess_destroy();
		redirect('home/welcome');
	}
}