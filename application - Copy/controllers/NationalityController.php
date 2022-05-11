<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class NationalityController extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('NationalityModel', 'nationality');
    }

    public function index() {
        $data['nationalities'] = $this->nationality->supplyNationalities();
        $this->load->view("Masters/NationalityView", $data);
    }

    public function saveNationality() {
        $this->form_validation->set_rules('Nationality', 'Nationality', 'trim|required|min_length[1]|max_length[35]|alpha_numeric_spaces|is_unique[nationality.Nationality]');
        $this->form_validation->set_rules('ShortName', 'shortname', 'trim|min_length[1]|max_length[15]|alpha_numeric_spaces');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            //get values 
            $nationality = strtoupper(html_escape(strip_tags($this->input->post('Nationality'))));
            $shortName = strtoupper(html_escape(strip_tags($this->input->post('ShortName'))));

            $insert = [
                'Nationality' => $nationality,
                'ShortName' => $shortName,
                'IsActive' => 1,
                'CreatedAt' => date('Y-m-d'),
                'UpdatedAt' => date('Y-m-d'),
            ];
            $insert = $this->security->xss_clean($insert);
            if ($this->nationality->isSavedNationality($insert)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function deleteNationality() {
        $this->form_validation->set_rules('NationalityID', 'Nationality id', 'trim|integer|required|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $where = [
                'ID' => html_escape(strip_tags($this->input->post('NationalityID')))
            ];
            $where = $this->security->xss_clean($where);
            if ($this->nationality->isDeletedNationality($where)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function editNationality() {
        $this->form_validation->set_rules('NationalityID', 'Nationality id', 'trim|integer|required|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');

        if ($this->form_validation->run() == false) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            //get values
            $nationalityId = $this->input->post('NationalityID');

            $where = [
                'ID' => $nationalityId,
            ];
            $where = $this->security->xss_clean($where);

            $result = $this->nationality->supplyNationality($where);
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

    public function updateNationality() {
        $this->form_validation->set_rules('Nationality', 'Nationality', 'trim|required|min_length[1]|max_length[35]|alpha_numeric_spaces');
        $this->form_validation->set_rules('ShortName', 'shortname', 'trim|min_length[1]|max_length[15]|alpha_numeric_spaces');
        $this->form_validation->set_rules('NationalityID', 'Nationality id', 'trim|integer|required|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            //get values 
            $nationality = strtoupper(html_escape(strip_tags($this->input->post('Nationality'))));
            $shortName = strtoupper(html_escape(strip_tags($this->input->post('ShortName'))));
            $nationalityId = $this->input->post('NationalityID');
            $d1 = [
                'ShortName' => $shortName,
                'UpdatedAt' => date('Y-m-d'),
            ];

            $d1 = $this->security->xss_clean($d1);
            $result = $this->nationality->isUpdatedNationality($d1, $nationality, $nationalityId);
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
