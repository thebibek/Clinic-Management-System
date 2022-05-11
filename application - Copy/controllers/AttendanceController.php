<?php

defined('BASEPATH') or exit('No direct script access allowed');

class AttendanceController extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('EmployeeModel', 'employee');
        $this->load->model("AttendanceModel", "attend");
    }

    public function index() {
        $this->load->view("Employee/EmployeeAttendanceView");
    }

    public function filterDeptEmployee() {
        $this->form_validation->set_rules('Department', 'Departent', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('AttendanceDate', 'AttendanceDate', 'trim|required|min_length[10]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $where = [
                'DepartmentID' => $this->input->post('Department')
            ];

            $where = $this->security->xss_clean($where);
            $result = $this->employee->supplyDeptEmployeeStatus($where);
            if (!empty($result)) {
                $data['result'] = $result;
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                json_encode($data);
            }
        }
    }

    public function saveEmployeeAttendance() {
        $this->form_validation->set_rules('AttendanceDate', 'AttendanceDate', 'trim|required|min_length[10]');
        $this->form_validation->set_rules('Department', 'Department', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {

            $attendanceDate = $this->input->post('AttendanceDate');
            if ($attendanceDate == '0000-00-00') {
                $data['status'] = -1;
                echo json_encode($data);
                exit();
            }

            $items = $this->input->post('items');
            $deptId = $this->input->post('Department');

            //create where clause for delete
            $where = [
                'DepartmentID' => $deptId,
                'AttendanceDate' => $attendanceDate
            ];

            if (!empty($items)) {
                $temp = [];
                foreach ($items as $v) {
                    $t['EmployeeID'] = $v['ID'];
                    $t['DepartmentID'] = $deptId;
                    $t['AttendanceDate'] = $attendanceDate;
                    $t['Status'] = $v['Attendance'];

                    array_push($temp, $t);
                }

                if ($this->attend->isSavedAttendance($temp, $where)) {
                    $data['status'] = 1;
                    echo json_encode($data);
                }
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function showAttendanceSheet() {
        $this->load->view("Employee/EmployeeAttendanceSheetView");
    }

    public function fillAttendance() {
        $this->form_validation->set_rules('Department', 'Department', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('AttendanceDate', 'AttendanceDate', 'trim|required|min_length[10]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $deptId = $this->input->post('Department');
            $attendanceDate = $this->input->post('AttendanceDate');

            //where clause for supply department employee
            $wh1 = [
                'DepartmentID' => $deptId
            ];

            if ($attendanceDate == '0000-00-00') {
                $data['status'] = -1;
                echo json_encode($data);
                exit();
            }

            for ($i = 1; $i <= 31; $i++) {
                $d[$i] = 'A';
            }

            //store the department employees 
            $rs1 = $this->employee->supplyDeptEmployee($wh1);

            $timestamp = strtotime($attendanceDate);
            $month = date('m', $timestamp);
            $year = date('Y', $timestamp);
            $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);

            if ($days == 28) {
                $d[29] = 'D';
                $d[30] = 'D';
                $d[31] = 'D';
            }

            if ($days == 29) {
                $d[30] = 'D';
                $d[31] = 'D';
            }

            if ($days == 30) {
                $d[31] = 'D';
            }


            for ($i = 1; $i <= $days; $i++) {
                $date = $year . '-' . $month . '-' . $i;

                if (date('w', strtotime($date)) == 0) {
                    $d[$i] = 'S';
                }
            }


            if (!empty($rs1)) {
                $temp = [];

                $t['attendance'] = [];


                //iterate employees and store their attendance details
                foreach ($rs1 as $v) {
                    $temp1 = [];
                    $s1 = 0;    //total absent
                    $s2 = 0;    //total leave
                    $s3 = 0;    //total working days
                    $s4 = 0.0;  //total half leave
                    $wh2 = [
                        'EmployeeID' => $v['ID'],
                        'DepartmentID' => $v['DepartmentID'],
                        'MONTH(attendanceDate)' => $month
                    ];

                    $t['EmployeeID'] = $v['ID'];
                    $t['EmployeeCode'] = $v['EmployeeCode'];
                    $t['Salutation'] = $v['Salutation'];
                    $t['FirstName'] = $v['FirstName'];
                    $t['LastName'] = $v['LastName'];
                    //store each employee month attendance
                    $rs2 = $this->attend->supplyEmployeeAttendance($wh2);
                    foreach ($rs2 as $r2) {
                        $day = (int) date('d', strtotime($r2['AttendanceDate']));
                        $d[$day] = $r2['Status'];
                    }


                    foreach ($d as $x) {
                        //total absent
                        if ($x == 'A') {
                            $s1 += 1;
                        }
                        //total leave
                        if ($x == 'L') {
                            $s2 += 1;
                        }
                        //total working days
                        if ($x == 'P') {
                            $s3 += 1;
                        }

                        //total half day
                        if ($x == 'HL') {
                            $s4 += 0.5;
                        }
                    }

                    foreach ($d as $k) {
                        $r['IsPresent'] = $k;
                        $r['Status'] = $k;
                        array_push($temp1, $r);
                    }

                    $t['TotalAbsent'] = $s1;
                    $t['TotalLeave'] = $s2 + $s4;
                    $t['WorkingDays'] = $s3;
                    $t['attendance'] = $temp1;


                    array_push($temp, $t);
                }


                $data['status'] = 1;
                $data['result'] = $temp;
                echo json_encode($data);
                exit();
            } else {
                $data['status'] = -1;
                echo json_encode($data);
                exit();
            }
        }
    }

    public function saveFillAttendance() {
        $this->form_validation->set_rules('YearMonth', 'YearMonth', 'trim|required|min_length[10]|max_length[10]');
        $this->form_validation->set_rules('Department', 'Department', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {

            $yearMonth = $this->input->post('YearMonth');
            $year = date('Y', strtotime($yearMonth));
            $month = date('m', strtotime($yearMonth));

            $deptId = $this->input->post('Department');
            $items = $this->input->post('items');

            $where = [
                'DepartmentID' => $deptId,
                'MONTH(AttendanceDate)' => $month
            ];

            $temp = [];
            if (!empty($items)) {
                foreach ($items as $v) {
                    $temp1 = [];
                    foreach ($v['attendance'] as $key => $w) {
                        $t['EmployeeID'] = $v['EmployeeID'];
                        $t['DepartmentID'] = $deptId;
                        $t['AttendanceDate'] = $year . '-' . $month . '-' . ($key + 1);
                        $t['Status'] = $w['IsPresent'];
                        array_push($temp1, $t);
                    }
                    array_push($temp, $temp1);
                }

                if ($this->attend->IsSavedFillAttendance($temp, $where)) {
                    $data['status'] = 1;
                    echo json_encode($data);
                }
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function provideAbsent() {
        $this->form_validation->set_rules('EmployeeID', 'Employee id', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('SalaryMonth', 'Salary month', 'trim|required');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == false) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $empId = $this->input->post('EmployeeID');
            $salaryMonth = $this->input->post('SalaryMonth');
            $year = date('Y', strtotime($salaryMonth));
            $month = date('m', strtotime($salaryMonth));

            $result = $this->attend->supplyEmpAbsent($empId, $year, $month);
            if (!empty($result)) {
                $data['status'] = 1;
                $data['result'] = $result;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

}
