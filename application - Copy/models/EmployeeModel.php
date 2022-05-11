<?php

defined('BASEPATH') or exit('No direct script access allowed');

class EmployeeModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function isSavedEmployee($data, $empAttendanceId) {
        $this->db->trans_start();
        $query1 = $this->db->set($data)->get_compiled_insert('employee');
        $this->db->query($query1);

        $employeeId = $this->db->insert_id();

        $insertAttendanceRegistration = [
            'EmployeeID' => $employeeId,
            'AttendanceID' => $empAttendanceId,
            'LeaveTaken' => 0,
            'TotalAbsent' => 0,
            'WorkingDays' => 0,
            'CreatedAt' => date('Y-m-d'),
            'UpdatedAt' => date('Y-m-d'),
        ];

        $query2 = $this->db->set($insertAttendanceRegistration)->get_compiled_insert('empattendanceregistration');
        $this->db->query($query2);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function supplyFilteredEmployee($data) {
        $this->db->select('*');
        $this->db->from('employee');
        $this->db->join('department','department.ID = employee.DepartmentID','left');
        $this->db->join('designation','designation.ID = employee.DesignationID','left');
        $this->db->where('EmployeeCode', $data['EmployeeCode']);
        $this->db->or_where('FirstName', $data['FirstName']);
        $this->db->or_where('FatherName', $data['FatherName']);
        $this->db->or_where('DepartmentID', $data['DepartmentID']);
        $this->db->or_where('DesignationID', $data['DesignationID']);
        $this->db->or_where('JoiningDate', $data['JoiningDate']);
        $this->db->or_where('DateOfBirth', $data['DateOfBirth']);
        $this->db->or_where('CurrentEmployee', $data['CurrentEmployee']);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    //supply all employee
    public function supplyAllEmployee() {
        $this->db->select('*,employee.ID as EmployeeID');
        $this->db->from('employee');
        $this->db->join('department', 'department.ID = employee.DepartmentID', 'left');
        $this->db->join('designation', 'designation.ID = employee.DesignationID', 'left');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    //saving designation

    public function isDesignationSaved($data) {
        if ($this->db->insert('designation', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //deleting designation

    public function isDeletedDesignation($data) {
        if ($this->db->delete('designation', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function supplyEmployee($where) {
        $query = $this->db->get_where('designation', $where);
        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return [];
        }
    }

    /*
     * update category 
     * 
     */

    public function isUpdatedDesignation($data, $where) {
        $q1 = $this->db->get_where('designation', ['ID' => $where['ID'], 'Designation' => $data['Designation']]);
        if ($q1->num_rows() == 1) {
            if ($this->db->update('designation', ['Description' => $data['Description'], 'UpdatedAt' => $data['UpdatedAt']], $where)) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            $q2 = $this->db->get_where('designation', ['Designation' => $data['Designation']]);
            if ($q2->num_rows() == 1) {
                return -2;
            } else {
                if ($this->db->update('designation', $data, $where)) {
                    return TRUE;
                } else {
                    return FALSE;
                }
            }
        }
    }

    //supply employee attendance registration 

    public function supplyAttendanceRegistration() {
        $this->db->select('EmployeeCode,FirstName,LastName,AttendanceID,Designation,Department');
        $this->db->from('empattendanceregistration');
        $this->db->join('employee', 'employee.ID = empattendanceregistration.EmployeeID');
        $this->db->join('department', 'department.ID = employee.DepartmentID');
        $this->db->join('designation', 'designation.ID = employee.DesignationID');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    //supply single employee
    public function supplySingleEmployee($where) {
        $query = $this->db->get_where('employee', $where);
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return [];
        }
    }

    //save employee salary scheme

    public function isSavedEmployeeSalaryScheme($data) {
        if ($this->db->insert('employeesalaryscheme', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //supply employee salary scheme 

    public function supplyEmployeeSalaryScheme($where) {
        $this->db->select('*,employeesalaryscheme.ID as EmployeesalaryschemeID,MONTHNAME(SalaryMonth) as Month,YEAR(SalaryMonth) as Year');
        $this->db->from('employeesalaryscheme');
        $this->db->join('salaryscheme', 'salaryscheme.ID = employeesalaryscheme.SalarySchemeID', 'inner');
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    //deleting employee salary scheme
    public function isDeletedEmployeeSalaryScheme($where) {
        if ($this->db->delete('employeesalaryscheme', $where)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //supply department employee with attendance status
    public function supplyDeptEmployeeStatus($where) {
        $query = $this->db->get_where('employee', $where);
        if ($query->num_rows() > 0) {
            $temp = [];
            $rs = $query->result_array();
            foreach ($rs as $r) {
                $r['Attendance'] = 'P';
                array_push($temp, $r);
            }

            return $temp;
        } else {
            return [];
        }
    }

    //supply departments's employee
    //$where['DepartmentID']

    public function supplyDeptEmployee($where) {
        $query = $this->db->get_where('employee', $where);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    // delete employee
    public function isDeletedEmployee($wh) {
        if ($this->db->delete('employee', $wh)) {
            return true;
        } else {
            return false;
        }
    }

    //update employee
    public function isUpdatedEmployee($data, $wh) {
        if ($this->db->update('employee', $data, $wh)) {
            return true;
        } else {
            return false;
        }
    }

    //upload employee
    public function isUploadedEmployee($data) {
        $this->db->trans_start();
        $this->db->insert_batch('employee', $data);
        $this->db->trans_complete();

        if ($this->db->trans_status() == false) {
            return false;
        } else {
            return true;
        }
    }

}
