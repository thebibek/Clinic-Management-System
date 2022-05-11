<?php

class TestModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function isSaved(array $data) {
        if ($this->db->insert('test', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function supplyTests() {
        $where = [
            'IsDeleted' => 0,
           
        ];
        $query = $this->db->get_where('test', $where);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            $result = [];
            return $result;
        }
    }

    public function supplyTest(array $where) {
        $query = $this->db->get_where('test', $where);
        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return FALSE;
        }
    }

    public function isUpdated($data, $where) {
        if (!is_array($data)) {
            return FALSE;
        }

        if (!is_array($where)) {
            return FALSE;
        }

        if ($this->db->update('test', $data, $where)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function isDeletedTest($where) {
        //field to be updated
        $data = [
            'isDeleted' => 1,
        ];
        if ($this->db->update('test', $data, $where)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function supplySearchTest($searchTerm) {
        $this->db->select('ID,Description,Charge,CategoryID');
        $this->db->from('test');
        $this->db->like('Description', $searchTerm);
        $this->db->or_like('ID', $searchTerm);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }

    public function supplyReceiptTests($where) {
        $query = $this->db->get_where('receipttests', $where);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    public function supplyBillDetail($where) {
        $this->db->select('*,receipt.ID as ReceiptID,doctor.Salutation,doctor.FirstName as DrFirstName,doctor.LastName as DrLastName,doctor.MobileNo as DoctorMobileNo,patient.MobileNo as PatientMobileNo,patient.FirstName as PFirstName,patient.LastName as PLastName');
        $this->db->from('receipt');
        $this->db->join('patient', 'patient.ID = receipt.PatientID','inner');
        $this->db->join('doctor', 'doctor.ID = receipt.DoctorID','inner');
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return [];
        }
    }

}
