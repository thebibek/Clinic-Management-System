<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TestParticularsController extends MY_Controller {

    public function __construct() {
        parent::__construct();
        //tp as test particulras
        $this->load->model('TestParticularsModel', 'tp');
        $this->load->model("TestModel", 'test');

        if (!$this->aauth->is_loggedin()) {
            redirect(base_url());
            exit();
        }
    }

    public function index() {
        $data = [
            'tests' => $this->test->supplyTests()
        ];
        //print_r($data);
        $this->load->view("Masters/TestParticularsView", $data);
    }

    public function saveTestParticulars() {
        $this->form_validation->set_rules('TestID', 'TestID', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('TestParticulars', 'TestParticulars', 'trim|required|min_length[1]|max_length[50]');
        $this->form_validation->set_rules('Units', 'Units', 'trim|required|min_length[1]|max_length[25]');
        $this->form_validation->set_rules('MaleValue', 'MaleValue', 'trim|required|min_length[1]|max_length[50]');
        $this->form_validation->set_rules('FemaleValue', 'FemaleValue', 'trim|required|min_length[1]|max_length[21]');
        $this->form_validation->set_rules('PartHeading', 'PartHeading', 'trim|alpha_numeric_spaces|min_length[1]|max_length[50]');
        $this->form_validation->set_rules('IsActive', 'IsActive', 'trim|integer|min_length[1]|max_length[1]');
        $this->form_validation->set_error_delimiters('', '');

        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            if ($this->input->post('IsActive') == 1) {
                $isActive = 1;
            } else {
                $isActive = 0;
            }

            $DataTestParticulars = [
                'TestID' => html_escape(strip_tags($this->input->post('TestID'))),
                'TestParticulars' => html_escape(strip_tags($this->input->post('TestParticulars'))),
                'Units' => html_escape(strip_tags($this->input->post('Units'))),
                'MaleValue' => html_escape(strip_tags($this->input->post('MaleValue'))),
                'FemaleValue' => html_escape(strip_tags($this->input->post('FemaleValue'))),
                'PartHeading' => html_escape(strip_tags($this->input->post('PartHeading'))),
                'IsActive' => $isActive,
                'CreatedAt' => date('Y-m-d'),
                'UpdatedAt' => date('Y-m-d')
            ];

            $DataTestParticulars = $this->security->xss_clean($DataTestParticulars);
            if ($this->tp->isSaved($DataTestParticulars)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function editTestParticulars() {
        $this->form_validation->set_rules('ID', 'ID', 'trim|required|integer|min_length[1]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $where = [
                'ID' => html_escape(strip_tags($this->input->post('ID')))
            ];
            $result = $this->tp->supplyParticular($where);
            if ($result != FALSE) {
                $data['status'] = 1;
                $data['result'] = $result;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function updateTestParticulars() {
        $this->form_validation->set_rules('TestParticularsID', 'TestParticularsID', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('TestParticulars', 'TestParticulars', 'trim|required|min_length[1]|max_length[50]');
        $this->form_validation->set_rules('Units', 'Units', 'trim|required|min_length[1]|max_length[25]');
        $this->form_validation->set_rules('MaleValue', 'MaleValue', 'trim|required|min_length[1]|max_length[50]');
        $this->form_validation->set_rules('FemaleValue', 'FemaleValue', 'trim|required|min_length[1]|max_length[21]');
        $this->form_validation->set_rules('PartHeading', 'PartHeading', 'trim|alpha_numeric_spaces|min_length[1]|max_length[50]');
        $this->form_validation->set_rules('IsActive', 'IsActive', 'trim|integer|min_length[1]|max_length[1]');
        $this->form_validation->set_error_delimiters('', '');

        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            if ($this->input->post('IsActive') == 1) {
                $isActive = 1;
            } else {
                $isActive = 0;
            }

            $where = [
                'ID' => html_escape(strip_tags($this->input->post('TestParticularsID')))
            ];

            $DataTestParticulars = [
                'TestParticulars' => html_escape(strip_tags($this->input->post('TestParticulars'))),
                'Units' => html_escape(strip_tags($this->input->post('Units'))),
                'MaleValue' => html_escape(strip_tags($this->input->post('MaleValue'))),
                'FemaleValue' => html_escape(strip_tags($this->input->post('FemaleValue'))),
                'PartHeading' => html_escape(strip_tags($this->input->post('PartHeading'))),
                'IsActive' => $isActive,
                'UpdatedAt' => date('Y-m-d')
            ];

            $where = $this->security->xss_clean($where);
            $DataTestParticulars = $this->security->xss_clean($DataTestParticulars);
            if ($this->tp->isUpdated($DataTestParticulars, $where)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function deleteParticulars() {
        $this->form_validation->set_rules('ParticularsID', 'ParticularsID', 'trim|required|min_length[1]|max_length[11]|integer');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $where = [
                'ID' => html_escape(strip_tags($this->input->post('ParticularsID')))
            ];
            if ($this->tp->isDeletedParticulars($where)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function fetchTestParticulars() {
        $this->form_validation->set_rules('TestID', 'TestID', 'trim|required|min_length[1]|max_length[11]|integer');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $where = [
                'TestID' => html_escape(strip_tags($this->input->post('TestID')))
            ];
            $result = $this->tp->supplyTestParticulars($where);
            if ($result != FALSE) {
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
