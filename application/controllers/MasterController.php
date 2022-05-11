<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MasterController extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('MasterModel', 'master');
    }

    public function getMaster() {
        $this->form_validation->set_rules('TableName', 'TableName', 'trim|required|alpha_dash|min_length[1]');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            echo json_encode($data);
        } else {
            $tableName = $this->input->post('TableName');
            $result = $this->master->supplyMaster($tableName);

            if ($result !== FALSE) {
                $data['status'] = 1;
                $data['result'] = $result;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function provideBank() {
        $result = $this->master->supplyBankLedger();
        if (!empty($result)) {
            $data['status'] = 1;
            $data['result'] = $result;
            echo json_encode($data);
        } else {
            $data['status'] = -1;
            echo json_encode($data);
        }
    }

    public function getCode() {
        $this->form_validation->set_rules('TableName', 'TableName', 'trim|required|min_length[1]|alpha');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            echo json_encode($data);
        } else {
            $tableName = $this->input->post('TableName');
            $data['Code'] = $this->getMaxCode($tableName);
            echo json_encode($data);
        }
    }

    public function getMasterUnder() {
        $this->form_validation->set_rules('ID', 'ID', 'trim|required|integer|min_length[1]');
        $this->form_validation->set_rules('Column', 'Column', 'trim|required|alpha|min_length[1]');
        $this->form_validation->set_rules('TableName', 'TableName', 'trim|required|alpha|min_length[1]');
        if ($this->form_validation->run() == FALSE) {

            $data['status'] = 0;
            echo json_encode($data);
        } else {
            $ID = $this->input->post('ID');
            $column = $this->input->post('Column');
            $tableName = $this->input->post('TableName');

            $where[$column] = $ID;
            $result = $this->master->supplyMasterUnder($tableName, $where);
            if ($result !== FALSE) {
                echo json_encode($result);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

}
