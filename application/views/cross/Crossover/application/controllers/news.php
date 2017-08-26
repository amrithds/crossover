<?php
class News extends CI_Controller {
	
	/*
	 * (non-PHPdoc)
	 * @see CI_Controller::__construct()
	 */
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'news_model' );
		
		if (! isset ( $this->session->userdata ['logged_in'] )) {
			redirect ( 'home/welcome' );
		}
	}
	
	public function index($offset = 0) {
		$this->load->library('pagination');
		$sessionData = $this->session->userdata("logged_in");
		$config['base_url'] = 'http://localhost/Crossover/index.php/news/index';
		$config["total_rows"] = $this->news_model->record_count($sessionData['id']);
		$config["per_page"] = 10;
		//paginate
		$this->pagination->initialize($config);
		$criteria = array('user_id'=>$sessionData['id']);
		$data ['news'] = $this->news_model->getAllNews ($config["per_page"],$offset,$criteria);
		
		$data ['title'] = 'News archive';
		
		$this->load->view ( 'layout/header', $data );
		$this->load->view ( 'news/index', $data );
		$this->load->view ( 'layout/footer' );
	}
	
	
	public function create() {
		$this->load->library ( 'form_validation' );
		
		$data ['title'] = 'Create a news item';
		
		$this->form_validation->set_rules ( 'title', 'Title', 'required|max_length[255]' );
		$this->form_validation->set_rules ( 'content', 'text', 'required' );
		
		if ($this->form_validation->run () === FALSE) {
			$this->load->view ( 'layout/header', $data );
			$this->load->view ( 'news/create' );
			$this->load->view ( 'layout/footer' );
		} else {
			$config ['upload_path'] = './uploads/newsImages/';
			$config ['allowed_types'] = 'gif|jpg|png';
			
			//get session data
			$path = $_FILES['photo']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);
			$sessionData = $this->session->userdata("logged_in");
			
			$fileName = $sessionData ['id'].time().'.'.$ext;
			$config['file_name'] = $fileName;
			$this->load->library ( 'upload', $config );
			
			if ( ! $this->upload->do_upload ('photo')) {
				$this->session->set_flashdata ( 'error', $this->upload->display_errors () );
				redirect('news/create');
			} else {
				
				$slug = url_title ( $this->input->post ( 'title' ), 'dash', TRUE );
				
				$data = array (
						'title' => $this->input->post ( 'title' ),
						'slug' => $slug,
						'content' => $this->input->post ( 'content' ),
						'user_id' => $sessionData ['id'],
						'photo' => $fileName
				);
				$this->news_model->set_news ($data);
				redirect('news/index');
			}
		}
	}
	
	public function delete($id){
		if (!$this->news_model->deleteRecord($id)) {
			$data['error'] = "Invalid Id/unable to delete.";
			$data ['title'] = 'Error';
			$this->load->view('layout/header', $data);
			$this->load->view('error/errorMessage');
			$this->load->view('layout/footer');
		}else{
			redirect( 'news/index' );
		}
	}
}