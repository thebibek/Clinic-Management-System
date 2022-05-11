<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class DoctorModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function supplyDoctors() {
        $this->db->select('*,doctor.ID as DoctorID,doctor.IsActive as IsDrActive');
        $this->db->from('doctor');
        $this->db->join('department', 'department.ID = doctor.DepartmentID', 'left');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    public function supplyDoctor($where) {
        $query = $this->db->get_where('doctor', $where);
        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return [];
        }
    }

    public function isSavedDoctor($data) {
        if ($this->db->insert('doctor', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function isUpdatedDoctor($data, $where) {
        if (!is_array($data)) {
            return false;
        }

        if (!is_array($where)) {
            return false;
        }

        if ($this->db->update('doctor', $data, $where)) {
            return true;
        } else {
            return true;
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

    public function isUpdatedPayment($update, $where, $vNo, $payAmt) {

        //Doctor commision ledger id
        $l1 = $this->provideDoctorCommLedgerId();
        //Cash ledger id
        $l2 = $this->provideCashLedgerId();
        $data = [];
        //ledger entry
        $d1 = [
            'LedgerID' => $l1,
            'VNo' => $vNo,
            'Vtype' => 'payment',
            'VDate' => date('Y-m-d'),
            'Narration' => 'TO CASH A/C Rs' . $payAmt . ' BY DOCTOR COMMISSION A/C ' . $payAmt,
            'Debit' => $payAmt,
            'Credit' => 0.00,
            'IsPosted' => 1,
            'CreatedBy' => 1,
            'CreatedAt' => date('Y-m-d'),
            'UpdatedBy' => 1,
            'UpdatedAt' => date('Y-m-d'),
            'IsAppoved' => 1
        ];

        $d2 = [
            'LedgerID' => $l2,
            'VNo' => $vNo,
            'Vtype' => 'payment',
            'VDate' => date('Y-m-d'),
            'Narration' => 'TO DOCTOR COMMISSION A/C ' . $payAmt . ' BY CASH A/C ' . $payAmt,
            'Debit' => 0.00,
            'Credit' => $payAmt,
            'IsPosted' => 1,
            'CreatedBy' => 1,
            'CreatedAt' => date('Y-m-d'),
            'UpdatedBy' => 1,
            'UpdatedAt' => date('Y-m-d'),
            'IsAppoved' => 1
        ];
        array_push($data, $d1);
        array_push($data, $d2);

        $this->db->trans_start();
        $this->db->insert_batch('acc_transaction', $data);
        $this->db->update('doctorcommision', $update, $where);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function provideDoctorCommLedgerId() {
        $wh = [
            'IsDoctorCommission' => 1
        ];
        $query = $this->db->get_where('ledger', $wh);
        if ($query->num_rows() == 1) {
            $row = $query->row_array();
            return $row['ID'];
        } else {
            return 0;
        }
    }

    public function provideCashLedgerId() {
        $wh = [
            'IsCash' => 1
        ];

        $query = $this->db->get_where('ledger', $wh);
        if ($query->num_rows() == 1) {
            $row = $query->row_array();
            return $row['ID'];
        } else {
            return 0;
        }
    }

}
