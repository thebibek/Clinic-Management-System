<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class BloodGroupController extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('BloodGroupModel', 'bg');
    }

    public function index() {

        $data['bloodgroups'] = $this->bg->supplyBloodGroups();

        $this->load->view("Masters/BloodGroupView", $data);
    }

    public function saveBloodGroup() {
        $this->form_validation->set_rules('BloodGroup', 'Blood group', 'trim|required|min_length[1]|max_length[4]|is_unique[bloodgroup.BloodGroup]');
        $this->form_validation->set_rules('Description', 'Description', 'trim|min_length[1]|max_length[15]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == false) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $bloodGroup = html_escape(strip_tags($this->input->post('BloodGroup')));
            $description = html_escape(strip_tags($this->input->post('Description')));
            $insert = [
                'BloodGroup' => $bloodGroup,
                'Description' => $description,
                'CreatedAt' => date('Y-m-d'),
                'UpdatedAt' => date('Y-m-d')
            ];

            if ($this->bg->isSavedBG($insert)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function deleteBloodGroup() {
        $this->form_validation->set_rules('BloodGroupID', 'Blood group id', 'trim|integer|required|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters();
        if ($this->form_validation->run() == false) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $bgId = $this->input->post('BloodGroupID');

            if ($this->bg->isDeletedBG($bgId)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function editBloodGroup() {
        $this->form_validation->set_rules('BloodGroupID', 'Blood group id', 'trim|integer|required|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == false) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $bgId = $this->input->post('BloodGroupID');
            $result = $this->bg->supplySingleBG($bgId);
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

    public function updateBloodGroup() {
        $this->form_validation->set_rules('BloodGroup', 'Blood group', 'trim|required|min_length[1]|max_length[4]');
        $this->form_validation->set_rules('Description', 'Description', 'trim|min_length[1]|max_length[15]');
        $this->form_validation->set_rules('BloodGroupID', 'Blood group id', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == false) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $bloodGroup = html_escape(strip_tags($this->input->post('BloodGroup')));
            $description = html_escape(strip_tags($this->input->post('Description')));
            $bgId = $this->input->post('BloodGroupID');

            //updatig data
            $d1 = [
                'Description' => $description,
                'UpdatedAt' => date('Y-m-d')
            ];

            $d1 = $this->security->xss_clean($d1);
            $result = $this->bg->isUpdatedBG($bgId, $bloodGroup, $d1);

            if ($result !== -2) {
                $data['status'] = 1;
                echo json_encode($data);
            } elseif ($result == -2) {
                $data['status'] = -2;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

}
