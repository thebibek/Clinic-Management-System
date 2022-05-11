<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class GroupController extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("UnderGroupModel", 'undergroup');
    }

    public function index() {
        $this->load->view("Account/GroupView");
    }

    public function saveGroup() {
        $this->form_validation->set_rules('Group', 'Group', 'trim|required|min_length[1]|max_length[31]|is_unique[undergroup.UnderGroup]');
        $this->form_validation->set_rules('Description', 'Description', 'trim|min_length[1]|max_length[51]');
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

            $dataGroup = [
                'UnderGroup' => strtoupper(html_escape(strip_tags($this->input->post('Group')))),
                'Description' => html_escape(strip_tags($this->input->post('Description'))),
                'IsActive' => $isActive,
                'CreatedAt' => date('Y-m-d'),
                'UpdatedAt' => date('Y-m-d')
            ];

            if ($this->undergroup->isSaved($dataGroup)) {
                $data['status'] = 1;
                echo json_encode($data);
                exit();
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function deleteGroup() {
        $this->form_validation->set_rules('GroupID', 'Group ID', 'trim|integer|required|min_length[1]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $where = [
                'ID' => html_escape(strip_tags($this->input->post('GroupID')))
            ];
            $where = $this->security->xss_clean($where);
            if ($this->undergroup->isDeletedGroup($where)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function editGroup() {
        $this->form_validation->set_rules('GroupID', 'Group ID', 'trim|integer|required|min_length[1]');
        $this->form_validation->set_error_delimiters('', '');

        if ($this->form_validation->run() == false) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            //get values
            $groupId = $this->input->post('GroupID');

            $where = [
                'ID' => $groupId,
            ];
            $where = $this->security->xss_clean($where);

            $result = $this->undergroup->supplyGroup($where);
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

    public function updateGroup() {
        $this->form_validation->set_rules('GroupID', 'GroupID', 'trim|required|integer|min_length[1]');
        $this->form_validation->set_rules('Group', 'Group', 'trim|required|min_length[1]|max_length[31]');
        $this->form_validation->set_rules('Description', 'Description', 'trim|min_length[1]|max_length[51]');
        $this->form_validation->set_rules('IsActive', 'IsActive', 'trim|integer|min_length[1]|max_length[1]');

        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            //get values

            if ($this->input->post("IsActive") == 1) {
                $isActive = 1;
            } else {
                $isActive = 0;
            }

            $group = strtoupper(html_escape(strip_tags($this->input->post('Group'))));
            $description = strtoupper(html_escape(strip_tags($this->input->post('Description'))));
            $groupId = $this->input->post('GroupID');
            $dataGroup = [
                'UnderGroup' => $group,
                'Description' => $description,
                'IsActive' => $isActive,
                'UpdatedAt' => date('Y-m-d'),
            ];
            $where = [
                'ID' => $groupId
            ];
            $dataGroup = $this->security->xss_clean($dataGroup);
            $result = $this->undergroup->isUpdatedGroup($dataGroup, $where);
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
