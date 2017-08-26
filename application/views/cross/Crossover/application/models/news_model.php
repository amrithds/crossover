<?php
class News_model extends CI_Model {
	public $id;
	public $user_id;
	public $title;
	public $photo;
	public $slug;
	public $content;
	public $created_at;
	
	public function __construct() {
		parent::__construct ();
	}
	
	/**
	 * get news from DB
	 * 
	 * @param string $slug
	 *        	return resultset
	 */
	public function get_news($slug = FALSE) {
		if ($slug === FALSE) {
			$query = $this->db->get ( 'news' );
			return $query->result_array ();
		}
		
		$query = $this->db->get_where ( 'news', array (
				'slug' => $slug 
		) );
		return $query->row_array ();
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
}