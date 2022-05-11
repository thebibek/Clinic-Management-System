<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AttendanceModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function isSavedAttendance($items, $where) {
        $this->db->trans_start();
        $this->db->delete('employeeattendance', $where);
        $this->db->insert_batch('employeeattendance', $items);
        $this->db->trans_complete();

        if ($this->db->trans_status() == FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function supplyEmployeeAttendance($where) {
        $query = $this->db->get_where('employeeattendance', $where);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    public function IsSavedFillAttendance($items, $where) {
        $this->db->trans_start();
        $this->db->delete('employeeattendance', $where);
        foreach ($items as $t) {
            $this->db->insert_batch('employeeattendance', $t);
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() == FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function supplyEmpAbsent($empId, $year, $month) {
        $wh = [
            'EmployeeID' => $empId,
            'MONTH(AttendanceDate)' => $month,
            'YEAR(AttendanceDate)' => $year,
            'Status' => 'A'
        ];

        $this->db->select('COUNT(Status) as Absent');
        $this->db->from('employeeattendance');
        $this->db->where($wh);
        $q = $this->db->get();
        if ($q->num_rows() == 1) {
            $row = $q->row_array();
            return $row['Absent'];
        } else {
            return 0;
        }
    }
    
    public function supplyEmpPresent($empId, $year, $month){
        $wh = [
            'EmployeeID' => $empId,
            'MONTH(AttendanceDate)'=> $month,
            'YEAR(AttendanceDate)'=> $year,
            'Status'=> 'P'
        ];
        
        $this->db->select('COUNT(Status) as Present');
        $this->db->from('employeeattendance');
        $this->db->where($wh);
        $q = $this->db->get();
        if($q->num_rows() == 1){
            $row = $q->row_array();
            return $row['Present'];
        }else{
            return 0;
        }
    }

}
