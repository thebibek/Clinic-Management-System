<?php

defined('BASEPATH') or exit('No direct script access allowed');

class LeaveModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function isSavedAssignedLeave($insert, $wh) {
        $query = $this->db->get_where('assignedleave', $wh);
        if ($query->num_rows() == 1) {
            return FALSE;
        }

        if ($this->db->insert('assignedleave', $insert)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function supplyAssignedLeave() {
        $this->db->select('*,assignedleave.ID as AssignedLeaveID');
        $this->db->from('assignedleave');
        $this->db->join('leavetype', 'leavetype.ID = assignedleave.LeaveTypeID', 'inner');
        $this->db->join('designation', 'designation.ID = assignedleave.DesignationID', 'inner');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    public function supplyFilteredAssignedLeave($designationId, $leaveTypeId) {
        $this->db->select('*,assignedleave.ID as AssignedLeaveID');
        $this->db->from('assignedleave');
        $this->db->join('leavetype', 'leavetype.ID = assignedleave.LeaveTypeID', 'inner');
        $this->db->join('designation', 'designation.ID = assignedleave.DesignationID', 'inner');
        $this->db->where('DesignationID =', $designationId);
        $this->db->or_where('LeaveTypeID =', $leaveTypeId);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    public function isDeletedAssignedLeave($where) {
        if ($this->db->delete('assignedleave', $where)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //supply all leave assigned to employee
    public function supplyemployeeassignleaves($wh, $empId) {
        $this->db->select('*');
        $this->db->from('employeeassignleave');
        $this->db->join('leavetype', 'leavetype.ID = employeeassignleave.LeaveTypeID', 'inner');
        $this->db->where($wh);
        $query1 = $this->db->get();
        $query2 = $this->db->get('leavetype');

        if ($query1->num_rows() > 0) {
            //leave type
            $rs2 = $query2->result_array();
            //employee leave
            $rs1 = $query1->result_array();


            foreach ($rs2 as $k2 => $v2) {
                if (array_key_exists($k2, $rs1)) {
                    //nothing to do
                } else {
                    $rs1[$k2]['EmployeeID'] = $empId;
                    $rs1[$k2]['LeaveTypeID'] = $v2['ID'];
                    $rs1[$k2]['NoOfLeave'] = 0;
                    $rs1[$k2]['CreatedAt'] = date('Y-m-d');
                    $rs1[$k2]['UpdatedAt'] = date('Y-m-d');
                    $rs1[$k2]['ID'] = 0;
                    $rs1[$k2]['LeaveType'] = $v2['LeaveType'];
                }
            }
            return $rs1;
        } else {

            if ($query2->num_rows() > 0) {
                $temp = [];
                $rs = $query2->result_array();

                foreach ($rs as $r) {
                    $r['EmployeeID'] = $empId;
                    $r['NoOfLeave'] = 0;
                    array_push($temp, $r);
                }

                return $temp;
            } else {
                return [];
            }
        }
    }

    public function isSavedEmployeeAssignedLeave($insert, $wh) {
        $this->db->trans_start();
        $this->db->delete('employeeassignleave', $wh);
        $this->db->insert_batch('employeeassignleave', $insert);
        $this->db->trans_complete();

        if ($this->db->trans_status() == FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function supplySingleLeaveType($wh) {
        $query = $this->db->get_where('leavetype', $wh);
        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return [];
        }
    }

    public function updateEmployeeAttendance($insert, $wh, $totalLeave, $empId) {
        $this->db->trans_start();
        $this->db->delete('employeeattendance', $wh);
        $this->db->insert_batch('employeeattendance', $insert);
        $this->calculateLeaveBalance($totalLeave, $empId);
        $this->db->trans_complete();

        if ($this->db->trans_status() == FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function updateMultipleEmployeeAttendance($insert, $wh, $totalLeave, $empId) {
        $this->db->trans_start();
        foreach ($wh as $w) {
            $this->db->delete('employeeattendance', $w);
        }
        $this->db->insert_batch('employeeattendance', $insert);
        $this->calculateLeaveBalance($totalLeave, $empId);
        $this->db->trans_complete();

        if ($this->db->trans_status() == FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function calculateLeaveBalance($totalLeave, $empId) {
        $wh = ['EmployeeID' => $empId];
        $this->db->select('LeaveBalance');
        $this->db->from('employeeleave');
        $this->db->where($wh);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            $rw = $query->row_array();

            $leaveBalance = $rw['LeaveBalance'] - $totalLeave;
            $update = [
                'LeaveBalance' => $leaveBalance
            ];

            $this->db->update('employeeleave', $update, $wh);
        } else {
            return [];
        }
    }

    public function isSavedLeaveTaken($items, $empId) {
        $wh = ['EmployeeID' => $empId];
        $insert = [];
        foreach ($items as $v) {
            $d['EmployeeID'] = $empId;
            $d['ApplicationDate'] = $v['ApplicationDate'];
            $d['ApplicationFor'] = $v['ApplicationFor'];
            $d['LeaveFor'] = $v['LeaveFor'];
            $d['LeaveFrom'] = $v['LeaveFrom'];
            $d['LeaveTo'] = $v['LeaveTo'];
            $d['LeaveTypeID'] = $v['LeaveTypeID'];
            $d['Status'] = $v['Status'];
            $d['DayCount'] = $v['DayCount'];
            $d['Remarks'] = $v['Remarks'];
            $d['IsSunday'] = $v['IsSunday'];
            $d['CreatedAt'] = date('Y-m-d');
            $d['UpdatedAt'] = date('Y-m-d');

            array_push($insert, $d);
        }

        $this->db->trans_start();
        $this->db->delete('employeeleavemanager', $wh);
        $this->db->insert_batch('employeeleavemanager', $insert);
        $this->db->trans_complete();

        if ($this->db->trans_status() == FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    public function supplyEmpAssignedLeave($empId){
        $wh = [
            'EmployeeID'=> $empId
        ];
        $this->db->select('*');
        $this->db->from('employeeleavemanager');
        $this->db->join('leavetype','employeeleavemanager.LeaveTypeID = leavetype.ID','left');
        $this->db->where($wh);
        $q = $this->db->get();
        if($q->num_rows() > 0){
            return $q->result_array();
        }else{
            return [];
        }
    }

}
