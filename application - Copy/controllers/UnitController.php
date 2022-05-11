<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UnitController extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("UnitModel", 'unit');
    }

    public function index() {
        $data = [
            "units" => $this->unit->supplyUnits()
        ];

        $this->load->view("Masters/UnitView", $data);
    }

    public function saveUnit() {
        $this->form_validation->set_rules("Unit", "unit", "trim|required|min_length[1]|max_length[25]|is_unique[units.Unit]");
        $this->form_validation->set_rules("ShortDescription", "description", "trim|min_length[1]");
        $this->form_validation->set_error_delimiters('', '');

        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
            exit();
        } else {
            $unit = html_escape(strip_tags($this->input->post("Unit")));
            $description = html_escape(strip_tags($this->input->post("ShortDescription")));

            $unitData = [
                "Unit" => $unit,
                "Description" => $description,
                "CreatedAt" => date("Y-m-d"),
                "UpdatedAt" => date("Y-m-d")
            ];

            if ($this->unit->isSaved($unitData)) {
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

    public function deleteUnit() {
        $this->form_validation->set_rules('UnitID', 'unit id', 'trim|integer|required|min_length[1]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $where = [
                'ID' => html_escape(strip_tags($this->input->post('UnitID')))
            ];
            $where = $this->security->xss_clean($where);
            if ($this->unit->isDeletedUnit($where)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function editUnit() {
        $this->form_validation->set_rules('UnitID', 'unit id', 'trim|integer|required|min_length[1]');
        $this->form_validation->set_error_delimiters('', '');

        if ($this->form_validation->run() == false) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            //get values
            $unitId = $this->input->post('UnitID');

            $where = [
                'ID' => $unitId,
            ];
            $where = $this->security->xss_clean($where);

            $result = $this->unit->supplyUnit($where);
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

    public function updateUnit() {
        $this->form_validation->set_rules('Unit', 'unit', 'trim|required|min_length[1]|max_length[25]');
        $this->form_validation->set_rules('Description', 'description', 'trim|required|min_length[1]|max_length[50]');
        $this->form_validation->set_rules('UnitID', 'unit id', 'trim|integer|required|min_length[1]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            //get values 
            $unit = html_escape(strip_tags($this->input->post('Unit')));
            $description = html_escape(strip_tags($this->input->post('Description')));
            $unitId = $this->input->post('UnitID');
            $DataUnit = [
                'Unit' => $unit,
                'Description' => $description,
                'UpdatedAt' => date('Y-m-d'),
            ];
            $where = [
                'ID' => $unitId
            ];
            $DataUnit = $this->security->xss_clean($DataUnit);
            $result = $this->unit->isUpdatedUnit($DataUnit, $where);
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
