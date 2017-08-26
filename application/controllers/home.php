<?php
class Home extends Base_controller {
	public function __construct() {
		parent::__construct ();
	}
	
	public function index(){
	    $data ['title'] = 'Homepage';
	    $this->templateResponse('home/index',$data);
	}
	
	/**
	 * Home page
	 */
	public function welcome() {
		$this->load->library ( 'form_validation' );
		$this->form_validation->set_rules ( 'email', 'email', 'required|valid_email|is_unique[users.email]' );
		
		$this->load->model ( 'news_model' );
		$data ['news'] = $this->news_model->getAllNews ( 10, 0 );
		$data ['title'] = 'Homepage';
		// check if email is valid
		if ($this->form_validation->run () === FALSE) {
			$this->load->view ( 'layout/header', $data );
			$this->load->view ( 'home/welcome' );
			$this->load->view ( 'layout/footer' );
		} else {
			$email = $this->input->post ( 'email' );
			$token = $this->generateToken ( $email );
			// create a unique token
			$userData = array (
					'email' => $email,
					'token' => $token 
			);
			
			// send email
			$this->load->library ( 'Mailer' );
			$subject = 'Verify your email Id';
			$body = "<html> <body> <div> Click <a href='" . $this->config->base_url () . "index.php/home/verifyEmailId/$token'>here</a> to create a new account</div></body></html>";
			$status = $this->mailer->sendMail ( $email, $subject, $body );
			
			if ($status === true) {
				$this->users->insertUser ( $userData );
				$data ['title'] = 'Email registration';
				$this->load->view ( 'layout/header', $data );
				$this->load->view ( 'home/success' );
				$this->load->view ( 'layout/footer' );
			} else {
				$this->session->set_flashdata ( 'error', 'Please try again.' );
				redirect ( 'home/welcome' );
			}
		}
	}
	public function verifyEmailId($token) {
		$result = $this->users->verifyToken ( $token );
		if ($result) {
			$userData = array (
					'status' => users::USER_STATUS_EMAIL_VERIFIED 
			);
			$result = $this->users->updateUserByToken ( $token, $userData );
			redirect ( 'login/registerUser/' . $token );
		} else {
			$data ['error'] = "Invalid token";
			$data ['title'] = 'Invalid token';
			$this->load->view ( 'layout/header', $data );
			$this->load->view ( 'error/errorMessage' );
			$this->load->view ( 'layout/footer' );
		}
	}
	public function downloadPdf($slug) {
		$this->load->model ( 'news_model' );
		$data = [ ];
		
		$data ['news_item'] = $this->news_model->get_new_detail ( $slug );
		
		if (empty ( $data ['news_item'] )) {
			show_404 ();
		}
		
		$data ['isPdfDownload'] = true;
		;
		// load the view and saved it into $html variable
		$html = $this->load->view ( 'news/view', $data, true );
		
		// this the the PDF filename that user will get to download
		$pdfFilePath = "news.pdf";
		
		// load mPDF library
		$this->load->library ( 'm_pdf' );
		
		// generate the PDF from the given html
		$this->m_pdf->pdf->WriteHTML ( $html );
		
		// download it.
		$this->m_pdf->pdf->Output ( $pdfFilePath, "D" );
	}
	public function view($slug) {
		$this->load->model ( 'news_model' );
		$data ['news_item'] = $this->news_model->get_new_detail ( $slug );
		
		if (empty ( $data ['news_item'] )) {
			show_404 ();
		}
		
		$data ['title'] = $data ['news_item'] ['title'];
		
		$this->load->view ( 'layout/header', $data );
		$this->load->view ( 'news/view', $data );
		$this->load->view ( 'layout/footer' );
	}
	
	// generate token for login link
	private function generateToken($string) {
		return md5 ( $string . microtime () );
	}
}