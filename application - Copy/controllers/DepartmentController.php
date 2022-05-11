<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class DepartmentController extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("DepartmentModel", 'dept');
    }

    public function index() {
        $data = [
            "departments" => $this->dept->supplyDepartments()
        ];

        $this->load->view("Masters/DepartmentView", $data);
    }

    public function saveDepartment() {
        $this->form_validation->set_rules("Department", "department", "trim|required|alpha_numeric_spaces|min_length[1]|max_length[91]|is_unique[department.Department]");
        $this->form_validation->set_rules("Description", "description", "trim|min_length[1]");
        $this->form_validation->set_rules('IsActive', 'IsActive', 'trim|integer|min_length[1]|max_length[1]');
        $this->form_validation->set_error_delimiters('', '');

        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
            exit();
        } else {
            if ($this->input->post('IsActive') == 1) {
                $isActive = 1;
            } else {
                $isActive = 0;
            }

            $department = strtoupper(html_escape(strip_tags($this->input->post("Department"))));
            $description = html_escape(strip_tags($this->input->post("Description")));

            $departmentData = [
                "Department" => $department,
                "Description" => $description,
                "IsActive" => $isActive,
                "CreatedAt" => date("Y-m-d"),
                "UpdatedAt" => date("Y-m-d")
            ];

            if ($this->dept->isSavedDepartment($departmentData)) {
                $data['status'] = 1;
                echo json_encode($data);
                exit();
            } else {
                $data['status'] = -1;
                echo json_encode($data);
                exit();
            }
        }
    }

    public function deleteDepartment() {
        $this->form_validation->set_rules('DepartmentID', 'department id', 'trim|integer|required|min_length[1]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $where = [
                'ID' => html_escape(strip_tags($this->input->post('DepartmentID')))
            ];
            $where = $this->security->xss_clean($where);
            if ($this->dept->isDeletedDepartment($where)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function editDepartment() {
        $this->form_validation->set_rules('DepartmentID', 'departmentt id', 'trim|integer|required|min_length[1]');
        $this->form_validation->set_error_delimiters('', '');

        if ($this->form_validation->run() == false) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            //get values
            $deptId = $this->input->post('DepartmentID');

            $where = [
                'ID' => $deptId,
            ];
            $where = $this->security->xss_clean($where);

            $result = $this->dept->supplyDepartment($where);
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

    public function updateDepartment() {
        $this->form_validation->set_rules("Department", "department", "trim|required|alpha_numeric_spaces|min_length[1]|max_length[91]");
        $this->form_validation->set_rules("Description", "description", "trim|min_length[1]");
        $this->form_validation->set_rules('IsActive', 'IsActive', 'trim|integer|min_length[1]|max_length[1]');
        $this->form_validation->set_rules("DepartmentID", "dept id", "trim|required|integer|min_length[1]");
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            //get values 
            $department = html_escape(strip_tags($this->input->post('Department')));
            $description = html_escape(strip_tags($this->input->post('Description')));
            $departmentId = $this->input->post('DepartmentID');
            if ($this->input->post('IsActive') == 1) {
                $isActive = 1;
            } else {
                $isActive = 0;
            }


            $DataDept = [
                'Department' => $department,
                'Description' => $description,
                'IsActive' => $isActive,
                'UpdatedAt' => date('Y-m-d')
            ];
            $where = [
                'ID' => $departmentId
            ];
            $DataDept = $this->security->xss_clean($DataDept);
            $result = $this->dept->isUpdatedDepartment($DataDept, $where);
            if ($result !== -2) {
                $data['status'] = 1;
                echo json_encode($data);
            } else if ($result == -2) {
                $data['status'] = -2;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                json_encode($data);
            }
        }
    }

}
