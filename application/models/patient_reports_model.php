<?php
class Patient_reports_model extends CI_Model{
    public function __construct(){
        parent::__construct ();
    }
    
    public function getPatientsReports($patientId) {
        if($patientId) {
            $query = $this->db->query("SELECT p.id, p.patient_id, p.report_id, p.doctor_name, p.reporter_id,"
                    . "p.suggestions, p.created_at, p.updated_at, r.name "
                    . "FROM patient_reports p "
                    . "JOIN reports r ON r.id= p.report_id "
                    . "WHERE p.patient_id =".$patientId);
            return $query->result();
        }
    }
}