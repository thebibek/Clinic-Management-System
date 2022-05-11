<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PatientModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function supplyPatients() {
        $query = $this->db->get('patient');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    public function supplyPatient($where) {
        $this->db->select('*');
        $this->db->from('patient');
        $this->db->join('bloodgroup', 'patient.BloodGroupID = bloodgroup.ID', 'left');
        $this->db->where($where);
        $q = $this->db->get();
        if ($q->num_rows() == 1) {
            return $q->row_array();
        } else {
            return [];
        }
    }

    public function isSavedPatient($data) {
        if ($this->db->insert('patient', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function isUpdatedPatient($data, $where) {
        if (!is_array($data)) {
            return FALSE;
        }

        if (!is_array($where)) {
            return FALSE;
        }

        if ($this->db->update('patient', $data, $where)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function isDeletedDoctor($where) {
        if ($this->db->delete('doctor', $where)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function supplyDoctorCommisions() {
        $this->db->select('*,doctorcommision.ID as CommisionID');
        $this->db->from('doctorcommision');
        $this->db->join('doctor', 'doctor.ID = doctorcommision.DoctorID');
        $this->db->where('doctorcommision.IsDeleted', 0);
        $this->db->order_by('doctorcommision.ID', 'DESC');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    public function isDeletedCommission($update, $where) {
        if ($this->db->update('doctorcommision', $update, $where)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function supplyCommission($where) {
        $query = $this->db->get_where('doctorcommision', $where);
        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return [];
        }
    }

    public function isUpdatedCommission($update, $where) {
        if ($this->db->update('doctorcommision', $update, $where)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function isUpdatedPayment($update, $where) {
        if ($this->db->update('doctorcommision', $update, $where)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //get patient details against MRNo
    public function getPatientAgainstMRNo($where) {
        $query = $this->db->get_where('patient', $where);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return [];
        }
    }

    //get patient visits
    public function supplyPatientVisits($where) {
        $this->db->select('*');
        $this->db->from('patient');
        $this->db->join('receipt', 'receipt.PatientID = patient.ID');
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    //get patient tests
    public function supplyPatientTests($where) {
        $this->db->select('*');
        $this->db->from('receipt');
        $this->db->join('receipttests', 'receipttests.ReceiptID=receipt.ID', 'inner');
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

}
