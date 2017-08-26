<?php
class Reports_model extends CI_Model{
    public function __construct(){
        parent::__construct ();
    }
    
    /**
     * get reports from DB
     *
     * @param string $slug
     *        	return resultset
     */
    public function getReports($columns = '*') {
        
        $query = $this->db->order_by ( "name", "asc" );
        $query->select($columns);
        
        if (!empty($criteria)) {
            $query = $query->get_where ( 'reports', $criteria );
        }else{
            $query = $query->get( 'reports');
        }
        
        return $query->result_array ();
    }
}