<?php
class feed extends CI_Controller{
	
	/* (non-PHPdoc)
	 * @see CI_Controller::__construct()
	 */
	public function __construct() {
		parent::__construct();
		$this->load->helper('xml');
		$this->load->helper('text');
		$this->load->model('news_model', 'news');
	}
	
	public function index(){
		//add data
		$data['feed_name'] = $this->config->base_url(); 
		$data['encoding'] = 'utf-8'; 
		$data['feed_url'] = $this->config->base_url().'/feed'; 
		$data['page_description'] = 'News blog'; 
		$data['page_language'] = 'en-en'; 
		$data['creator_email'] = 'amrith.ds.gowda@gmail.com';
		$data['news'] = $this->news->getAllNews(10);
		header("Content-Type: application/rss+xml"); 
		
		$this->load->view('feed/rss', $data);
	}

}