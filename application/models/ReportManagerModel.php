<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ReportManagerModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function supplyMonthWisePatientVisits($monthNo) {
        $where = [
            'MONTH(ReceiptDate)' => $monthNo
        ];
        $this->db->select('*');
        $this->db->from('receipt');
        $this->db->join('patient', 'patient.ID=receipt.PatientID');
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    public function supplyMonthWiseCommission($monthNo) {
        $wh = [
            'MONTH(PaymentDate)' => $monthNo
        ];
        $this->db->select('*');
        $this->db->from('doctorcommision');
        $this->db->join('doctor', 'doctor.ID = doctorcommision.DoctorID', 'inner');
        $this->db->where($wh);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    public function supplyMonthlyCollection($monthNo) {
        $wh = [
            'MONTH(ReceiptDate)' => $monthNo
        ];
        $this->db->select('FirstName,LastName,MobileNo,ReceiptNo,NetAmount,PaidAmount,DueAmount');
        $this->db->select_sum('NetAmount');
        $this->db->select_sum('PaidAmount');
        $this->db->select_sum('DueAmount');
        $this->db->from('receipt');
        $this->db->join('patient', 'patient.ID = receipt.PatientID', 'inner');
        $this->db->group_by('PatientID');
        $this->db->where($wh);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    public function supplyDateVisits($wh) {
        $this->db->select('*');
        $this->db->from('receipt');
        $this->db->join('patient', 'patient.ID = receipt.PatientID', 'inner');
        $this->db->where($wh);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    public function supplyMonthlyDoctorCommission($wh) {
        $this->db->select('Salutation,FirstName,LastName,MobileNo');
        $this->db->select_sum('CommisionAmount');
        $this->db->select_sum('PayAmount');
        $this->db->from('doctorcommision');
        $this->db->join('doctor', 'doctor.ID = doctorcommision.DoctorID', 'inner');
        $this->db->group_by('DoctorID');
        $this->db->where($wh);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    public function supplyDayWiseDoctorCommission($wh) {
        $this->db->select('Salutation,FirstName,LastName,MobileNo');
        $this->db->select_sum('CommisionAmount');
        $this->db->select_sum('PayAmount');
        $this->db->from('doctorcommision');
        $this->db->join('doctor', 'doctor.ID = doctorcommision.DoctorID', 'inner');
        $this->db->group_by('DoctorID');
        $this->db->where($wh);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    public function supplyBillCollection($monthNo) {
        $wh = [
            'MONTH(ReceiptDate)' => $monthNo
        ];
        $query = $this->db->get_where('receipt', $wh);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    public function supplyDateWiseCollection($wh) {
        $query = $this->db->get_where('receipt', $wh);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    public function supplyMonthlyCompletedReport($month) {
        $wh = [
            'MONTH(ReceiptDate)' => $month,
            'IsReportGenerated' => 1
        ];
        $q = $this->db->get_where('receipt', $wh);
        if ($q->num_rows() > 0) {
            return $q->result_array();
        } else {
            return [];
        }
    }

    public function supplyMonthlyPendingReport($month) {
        $wh = [
            'MONTH(ReceiptDate)' => $month,
            'IsReportGenerated' => 0
        ];
        $q = $this->db->get_where('receipt', $wh);
        if ($q->num_rows() > 0) {
            return $q->result_array();
        } else {
            return [];
        }
    }
    
    public function supplyCurrentCompletedReport($wh){
        $query = $this->db->get_where('receipt',$wh);
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return [];
        }
    }
    
    public function supplyCurrentPendingReport($wh){
        $query = $this->db->get_where('receipt',$wh);
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return [];
        }
    }

}
