<?php

class Report_components_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * get reports from DB
     *
     * @param string $slug
     *            return resultset
     */
    public function getReportComponents($columns = '*', $criteria = array())
    {
        $query = $this->db->order_by("name", "asc");
        $query->select($columns);
        
        if (! empty($criteria)) {
            $query = $query->get_where('report_components', $criteria);
        } else {
            $query = $query->get('report_components');
        }
        
        return $query->result_array();
    }
}