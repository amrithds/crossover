<?php

/**
 * 
 * @author damrith
 * Pathology admin related activities
 */
class Admin extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('patients_model', 'patients');
    }

    /**
     * Admin Homepage
     * List all patient records
     */
    public function index()
    {
        $this->load->library('pagination');
        
        $this->data['patients'] = $this->patients->getPatients();
        
        $this->templateResponse('admin/index');
    }

    /**
     * add new patient report
     * create new patient/update existing patient records
     */
    public function addReports()
    {
        // load model classes
        $this->load->model('reports_model', 'reports');
        // get all patients
        $requiredColumns = 'id,first_name,last_name';
        $this->data['patients'] = $this->patients->getPatients(array(), $requiredColumns);
        
        $this->data['reports'] = $this->reports->getReports();
        
        $this->templateResponse('admin/report');
    }

    /**
     *
     * @param integer $reportId
     *            (Reports_model id)
     */
    public function getReportComponents($reportId)
    {
        $this->load->model('report_components_model', 'report_components');
        
        $dd;
        $required_columns = 'id,name';
        $criteria = array(
            'report_id' => $reportId
        );
        //get all components of report
        $this->data['reports'] = $this->report_components->getReportComponents($required_columns, $criteria);
        
        $this->templateResponse($view);
    }
}