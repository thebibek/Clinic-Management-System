<?php

class UtilityModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function supplyMaxCode($tableName) {
        $this->db->select_max('ID', 'MaxCode');
        $query = $this->db->get($tableName);
        //check row exist
        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return FALSE;
        }
    }

    public function supplySalarySlipSerialNo($tableName) {

        $this->db->select_max('SlipSerialNo', 'SerialNo');
        $query = $this->db->get($tableName);

        if ($query->num_rows() == 1) {
            $rw = $query->row_array();
            if (!empty($rw['SerialNo'])) {
                return $rw;
            } else {
                return [];
            }
        } else {
            return [];
        }
    }

    public function supplyNotification() {
        $wh = [
            'IsReportGenerated' => 1
        ];
        $this->db->select('*');
        $this->db->from('receipt');
        $this->db->join('patient', 'receipt.PatientID = patient.ID', 'left');
        $this->db->where($wh);
        $this->db->limit(3);
        $this->db->order_by('receipt.ID', 'DESC');
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            return $q->result_array();
        } else {
            return [];
        }
    }

    public function supplyPendingTask() {
        $wh = [
            'IsReportGenerated' => 0
        ];
        $this->db->select('*');
        $this->db->from('receipt');
        $this->db->join('patient', 'receipt.PatientID = patient.ID', 'left');
        $this->db->where($wh);
        $this->db->limit(4);
        $this->db->order_by('receipt.ID', 'DESC');
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            return $q->result_array();
        } else {
            return [];
        }
    }

}
