<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TestController extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library("Aauth");
        $this->load->model('TestModel', 'test');
    }

    public function index() {
        $data = [
            'tests' => $this->test->supplyTests()
        ];
        //print_r($data);
        $this->load->view("Masters/TestView", $data);
    }

    public function saveTest() {
        $this->form_validation->set_rules('Description', 'Description', 'trim|required|min_length[1]|max_length[50]|is_unique[test.Description]');
        $this->form_validation->set_rules('CategoryID', 'CategoryID', 'trim|required|integer|min_length[1]|max_length[25]');
        $this->form_validation->set_rules('ReportHeading', 'ReportHeading', 'trim|required|alpha_numeric_spaces|min_length[1]|max_length[50]');
        $this->form_validation->set_rules('Charge', 'Charge', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('CarryOut', 'CarryOut', 'trim|alpha_numeric_spaces|min_length[1]|max_length[50]');
        $this->form_validation->set_rules('ReportTiming', 'ReportTiming', 'trim|min_length[1]|alpha_numeric_spaces|max_length[50]');
        $this->form_validation->set_rules('TypeID', 'TypeID', 'trim|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('IsActive', 'IsActive', 'trim|integer|min_length[1]|max_length[1]');
        $this->form_validation->set_rules('Remarks', 'Remarks', 'trim|alpha_numeric_spaces|min_length[1]|max_length[50]');
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

            $DataTest = [
                'Description' => html_escape(strip_tags($this->input->post('Description'))),
                'CategoryID' => html_escape(strip_tags($this->input->post('CategoryID'))),
                'ReportHeading' => html_escape(strip_tags($this->input->post('ReportHeading'))),
                'Charge' => html_escape(strip_tags($this->input->post('Charge'))),
                'CarryOut' => html_escape(strip_tags($this->input->post('CarryOut'))),
                'ReportTiming' => html_escape(strip_tags($this->input->post('ReportTiming'))),
                'Remarks' => html_escape(strip_tags($this->input->post('Remarks'))),
                'TypeID' => html_escape(strip_tags($this->input->post('TypeID'))),
                'IsActive' => $isActive,
                'IsDeleted' => 0,
                'AddedBy' => 1,
                'CreatedAt' => date('Y-m-d'),
                'UpdatedAt' => date('Y-m-d')
            ];

            $DataTest = $this->security->xss_clean($DataTest);
            if ($this->test->isSaved($DataTest)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function editTest() {
        $this->form_validation->set_rules('TestID', 'TestID', 'trim|required|integer|min_length[1]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $where = [
                'ID' => html_escape(strip_tags($this->input->post('TestID')))
            ];
            $result = $this->test->supplyTest($where);
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

    public function updateTest() {
        $this->form_validation->set_rules('TestID', 'TestID', 'trim|required|integer|min_length[1]|max_length[25]');
        $this->form_validation->set_rules('CategoryID', 'CategoryID', 'trim|required|integer|min_length[1]|max_length[25]');
        $this->form_validation->set_rules('ReportHeading', 'ReportHeading', 'trim|required|alpha_numeric_spaces|min_length[1]|max_length[50]');
        $this->form_validation->set_rules('Charge', 'Charge', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('CarryOut', 'CarryOut', 'trim|alpha_numeric_spaces|min_length[1]|max_length[50]');
        $this->form_validation->set_rules('ReportTiming', 'ReportTiming', 'trim|min_length[1]|alpha_numeric_spaces|max_length[50]');
        $this->form_validation->set_rules('TypeID', 'TypeID', 'trim|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('IsActive', 'IsActive', 'trim|integer|min_length[1]|max_length[1]');
        $this->form_validation->set_rules('Remarks', 'Remarks', 'trim|alpha_numeric_spaces|min_length[1]|max_length[50]');
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
                'ID' => html_escape(strip_tags($this->input->post('TestID')))
            ];

            $DataTest = [
                'CategoryID' => html_escape(strip_tags($this->input->post('CategoryID'))),
                'ReportHeading' => html_escape(strip_tags($this->input->post('ReportHeading'))),
                'Charge' => html_escape(strip_tags($this->input->post('Charge'))),
                'CarryOut' => html_escape(strip_tags($this->input->post('CarryOut'))),
                'ReportTiming' => html_escape(strip_tags($this->input->post('ReportTiming'))),
                'Remarks' => html_escape(strip_tags($this->input->post('Remarks'))),
                'TypeID' => html_escape(strip_tags($this->input->post('TypeID'))),
                'IsActive' => $isActive,
                'IsDeleted' => 0,
                'AddedBy' => 1,
                'UpdatedAt' => date('Y-m-d')
            ];

            $where = $this->security->xss_clean($where);
            $DataTest = $this->security->xss_clean($DataTest);
            if ($this->test->isUpdated($DataTest, $where)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function deleteTest() {
        $this->form_validation->set_rules('TestID', 'TestID', 'trim|required|min_length[1]|max_length[11]|integer');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $where = [
                'ID' => html_escape(strip_tags($this->input->post('TestID')))
            ];
            if ($this->test->isDeletedTest($where)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function searchTest() {
        $searchTerm = $_GET['term'];
        $result = $this->test->supplySearchTest($searchTerm);
        $data = [];

        if ($result !== FALSE) {
            foreach ($result as $row) {

                $temp['id'] = $row['ID'];
                $temp['value'] = $row['ID'] . ' ' . $row['Description'];
                $temp['Description'] = $row['Description'];
                $temp['Charge'] = $row['Charge'];
                $temp['CategoryID'] = $row['CategoryID'];
                array_push($data, $temp);
            }
            echo json_encode($data);
        } else {
            $data['status'] = 0;
            echo json_encode($data);
        }
    }

}
