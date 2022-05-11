<?php

class PatientRegistrationModel extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    
    public function isSavedPatientInfo(array $data){
        if($this->db->insert('patient',$data)){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    public function supplyCategories(){
        $query=$this->db->get('Category');
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return FALSE;
        }
    }
}