<?php

defined('BASEPATH') or exit('No direct script access allowed');

class LeaveController extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('LeaveModel', 'leave');
    }

    public function index() {
        $this->load->view("Employee/AssignLeaveView");
    }

    public function saveAssignLeave() {
        $this->form_validation->set_rules('Designation', 'Designation', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('LeaveType', 'LeaveType', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('LeaveNo', 'LeaveNo', 'trim|required|integer|min_length[1]|max_length[3]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $desgnId = $this->input->post('Designation');
            $leaveTypeId = $this->input->post('LeaveType');
            $leaveNo = html_escape(strip_tags($this->input->post('LeaveNo')));

            //data to insert to leave
            $insert = [
                'DesignationID' => $desgnId,
                'LeaveTypeID' => $leaveTypeId,
                'LeaveNo' => $leaveNo,
                'CreatedAt' => date('Y-m-d'),
                'UpdatedAt' => date('Y-m-d')
            ];

            //data for where clause
            $wh = [
                'DesignationID' => $desgnId,
                'LeaveTypeID' => $leaveTypeId
            ];

            if ($this->leave->isSavedAssignedLeave($insert, $wh)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function provideAssignedLeave() {
        $this->form_validation->set_rules('TableName', 'TableName', 'trim|required|alpha|min_length[13]|max_length[13]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $table = $this->input->post('TableName');
            $result = $this->leave->supplyAssignedLeave($table);
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

    public function filterAssignedLeave() {
        $this->form_validation->set_rules('Designation', 'Designation', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('LeaveType', 'LeaveType', 'trim|integer|min_length[1]|max_length[11]');

        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $designationId = $this->input->post('Designation');
            $leaveTypeId = $this->input->post('LeaveType');

            $result = $this->leave->supplyFilteredAssignedLeave($designationId, $leaveTypeId);
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

    public function deleteAssignedLeave() {
        $this->form_validation->set_rules('ID', 'ID', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $where = [
                'ID' => $this->input->post('ID')
            ];

            if ($this->leave->isDeletedAssignedLeave($where)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function assignEmployeeLeave() {
        $this->load->view("Employee/AssignEmployeeView");
    }

    public function provideEmployeeLeaves() {
        $this->form_validation->set_rules('EmployeeID', 'EmployeeID', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 1;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $totalLeave = 0;
            $empId = $this->input->post('EmployeeID');
            $wh = [
                'EmployeeID' => $empId
            ];

            $result = $this->leave->supplyemployeeassignleaves($wh, $empId);
            foreach ($result as $v) {
                $totalLeave += $v['NoOfLeave'];
            }
            if (!empty($result)) {
                $data['status'] = 1;
                $data['result'] = $result;
                $data['TotalLeave'] = $totalLeave;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function saveEmployeeLeaves() {
        $this->form_validation->set_rules('EmployeeID', 'Employee ID', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');

        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $temp = [];

            $empId = $this->input->post('EmployeeID');
            $items = $this->input->post('items');

            //for where clause
            $wh = [
                'EmployeeID' => $empId
            ];


            if (!empty($items)) {

                foreach ($items as $v) {
                    $t['EmployeeID'] = $v['EmployeeID'];
                    $t['LeaveTypeID'] = $v['ID'];
                    $t['NoOfLeave'] = $v['NoOfLeave'];
                    $t['CreatedAt'] = date('Y-m-d');
                    $t['UpdatedAt'] = date('Y-m-d');

                    array_push($temp, $t);
                }

                if ($this->leave->isSavedEmployeeAssignedLeave($temp, $wh)) {
                    $data['status'] = 1;
                    echo json_encode($data);
                }
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function leaveApplication() {
        $this->load->view("Employee/LeaveApplicationView");
    }

    public function provideSingleLeaveType() {
        $this->form_validation->set_rules('LeaveTypeID', 'Leave Type', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $id = $this->input->post('LeaveTypeID');
            $wh = [
                'ID' => $id
            ];

            $result = $this->leave->supplySingleLeaveType($wh);
            if (!empty($result)) {
                $data['result'] = $result;
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function countLeave() {
        $this->form_validation->set_rules('LeaveFrom', 'LeaveFrom', 'trim|required');
        $this->form_validation->set_rules('LeaveTo', 'LeaveTo', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $leaveFrom = $this->input->post('LeaveFrom');
            $leaveTo = $this->input->post('LeaveTo');

            if ($leaveTo < $leaveFrom || $leaveTo == $leaveFrom) {
                $data['status'] = 0;
                $data['error'] = "Please check LeaveTo > LeaveFrom and LeaveFrom Not Equal To LeaveTo ";
                echo json_encode($data);
                exit();
            }

            $date1 = date_create($leaveFrom);
            $date2 = date_create($leaveTo);
            $diff = date_diff($date1, $date2);
            $dayCount = $diff->format('%a');
            $leaveCount = $dayCount + 1;

            $data['status'] = 1;
            $data['result'] = $leaveCount;

            echo json_encode($data);
        }
    }

    public function saveLeaveTaken() {
        $this->form_validation->set_rules('EmployeeID', 'EmployeeID', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('DepartmentID', 'DepartmentID', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $empId = $this->input->post('EmployeeID');
            $deptId = $this->input->post('DepartmentID');
            $items = $this->input->post('Items');

            if (!empty($items)) {
                foreach ($items as $v) {
                    $temp = [];
                    $whtemp = [];
                    if ($v['LeaveFor'] == 1) {

                        $timestamp = strtotime($v['LeaveFrom']);
                        $day = date('w', $timestamp);
                        if ($day == 0) {
                            if ($v['IsSunday'] == 1) {
                                $totalLeave = 1;
                            } else {
                                $totalLeave = 0;
                            }
                            $d['Status'] = 'S';
                        } else {
                            $d['Status'] = 'L';
                            $totalLeave = 1;
                        }

                        $d['EmployeeID'] = $empId;
                        $d['DepartmentID'] = $deptId;
                        $d['AttendanceDate'] = $v['LeaveFrom'];

                        $wh = [
                            'EmployeeID' => $empId,
                            'AttendanceDate' => $v['LeaveFrom']
                        ];

                        array_push($temp, $d);
                        $this->leave->updateEmployeeAttendance($temp, $wh, $totalLeave, $empId);
                    }

                    if ($v['LeaveFor'] == 2) {
                        $totalLeave = 0;
                        $begin = $v['LeaveFrom'];
                        $end = date('Y-m-d', strtotime('+1 day', strtotime($v['LeaveTo'])));


                        $period = new DatePeriod(
                                new DateTime($begin),
                                new DateInterval('P1D'),
                                new DateTime($end)
                        );

                        foreach ($period as $value) {
                            $datePeriod[] = $value->format('Y-m-d');
                        }

                        foreach ($datePeriod as $v1) {
                            $day = date('w', strtotime($v1));
                            //if day is sunday
                            if ($day == 0) {
                                if ($v['IsSunday'] == 1) {
                                    $totalLeave += 1;
                                } else {
                                    //nothing to do
                                }
                                $d['Status'] = 'S';
                            } else {
                                $d['Status'] = 'L';
                                $totalLeave += 1;
                            }

                            $d['EmployeeID'] = $empId;
                            $d['DepartmentID'] = $deptId;
                            $d['AttendanceDate'] = $v1;


                            $w['EmployeeID'] = $empId;
                            $w['DepartmentID'] = $deptId;
                            $w['AttendanceDate'] = $v1;

                            //for delete multiple row
                            array_push($whtemp, $w);

                            //for insert batch
                            array_push($temp, $d);
                        }

                        $this->leave->updateMultipleEmployeeAttendance($temp, $whtemp, $totalLeave, $empId);
                    }

                    if ($v['LeaveFor'] == 3) {

                        $timestamp = strtotime($v['LeaveFrom']);
                        $day = date('w', $timestamp);
                        if ($day == 0) {
                            if ($v['IsSunday'] == 1) {
                                $totalLeave = 0.5;
                            } else {
                                $totalLeave = 0;
                            }
                            $d['Status'] = 'S';
                        } else {
                            $d['Status'] = 'HL';
                            $totalLeave = 0.5;
                        }

                        $d['EmployeeID'] = $empId;
                        $d['DepartmentID'] = $deptId;
                        $d['AttendanceDate'] = $v['LeaveFrom'];

                        $wh = [
                            'EmployeeID' => $empId,
                            'AttendanceDate' => $v['LeaveFrom']
                        ];

                        array_push($temp, $d);
                        $this->leave->updateEmployeeAttendance($temp, $wh, $totalLeave, $empId);
                    }
                }

                if ($this->leave->isSavedLeaveTaken($items, $empId)) {
                    $data['status'] = 1;
                    echo json_encode($data);
                } else {
                    $data['status'] = -1;
                    echo json_encode($data);
                }
            } else {
                $data['status'] = 0;
                $data['error'] = 'Add atleast one leave and save !!';
                echo json_encode($data);
            }
        }
    }

    public function provideEmpAssignedLeave() {
        $this->form_validation->set_rules('EmployeeID', 'Employee id', 'trim|required|min_length[1]|integer|max_length[11]');
        
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == false) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $empId = $this->input->post('EmployeeID');
            $result = $this->leave->supplyEmpAssignedLeave($empId);
            if (!empty($result)) {
                $data['result'] = $result;
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

}
