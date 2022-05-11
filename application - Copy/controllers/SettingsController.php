<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class SettingsController extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('Aauth');
        $this->load->model('SettingsModel', 'setting');
    }

    public function index() {
        $this->load->view("Application/SettingsView");
    }

    public function saveSettings() {

        $this->form_validation->set_rules('LabName', 'LabName', 'trim|required|min_length[1]|max_length[51]|alpha_numeric_spaces');
        $this->form_validation->set_rules('Address', 'Address', 'trim|required|min_length[1]|max_length[191]');
        $this->form_validation->set_rules('PhoneNo1', 'PhoneNo1', 'trim|required|integer|min_length[1]|max_length[21]');
        $this->form_validation->set_rules('PhoneNo2', 'PhoneNo2', 'trim|integer|min_length[1]|max_length[21]');
        $this->form_validation->set_rules('TagLine', 'TagLine', 'trim|alpha_numeric_spaces|min_length[1]|max_length[51]');
        $this->form_validation->set_rules('Email', 'Email', 'trim|min_length[1]|max_length[50]|valid_email');
        $this->form_validation->set_rules('Website', 'Website', 'trim|min_length[1]|max_length[50]|valid_url');
        $this->form_validation->set_rules('RegdNo', 'RegdNo', 'trim|min_length[1]|max_length[31]');
        $this->form_validation->set_rules('LabNo', 'LabNo', 'trim|min_length[1]|max_length[31]');
        $this->form_validation->set_rules('TechnicianName', 'TechnicianName', 'trim|alpha_numeric_spaces|min_length[1]|max_length[50]');
        $this->form_validation->set_rules('TechnicianQualifiation', 'TechnicianQualifiation', 'trim|alpha_numeric_spaces|min_length[1]|max_length[50]');
        $this->form_validation->set_rules('Currency', 'currency', 'trim|required|min_length[1]|max_length[3]');
        $this->form_validation->set_rules('DateFormat', 'date format', 'trim|required|integer|min_length[1]');
        $this->form_validation->set_rules('FooterNote1', 'FooterNote1', 'trim|alpha_numeric_spaces|min_length[1]|max_length[191]');
        $this->form_validation->set_rules('FooterNote2', 'FooterNote2', 'trim|alpha_numeric_spaces|min_length[1]|max_length[191]');
        $this->form_validation->set_rules('FooterNote3', 'FooterNote3', 'trim|alpha_numeric_spaces|min_length[1]|max_length[191]');

        $this->form_validation->set_error_delimiters('', '');

        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $filePath = './assets/img/';
            $config['upload_path'] = $filePath;
            $config['allowed_types'] = 'png';
            $config['file_name'] = 'logo.png';
            $config['max_size'] = 100;
            $config['max_width'] = 100;
            $config['max_height'] = 100;
            if (file_exists('./assets/img/logo.png')) {
                @unlink('./assets/img/logo.png');
            }
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('file')) {
                $data['status'] = 0;
                $data['error'] = $this->upload->display_errors();
                echo json_encode($data);
                exit();
            } else {
                //Nothing to do
            }


            if ($this->input->post('IsPrintHeader') == 1) {
                //print without header
                $isPrinted = 1;
            } else {
                //print with header;
                $isPrinted = 0;
            }

            $DataSettings = [
                'LabName' => html_escape(strip_tags($this->input->post('LabName'))),
                'Address' => $this->input->post('Address'),
                'PhoneNo1' => html_escape(strip_tags($this->input->post('PhoneNo1'))),
                'PhoneNo2' => html_escape(strip_tags($this->input->post('PhoneNo2'))),
                'TagLine' => html_escape(strip_tags($this->input->post('TagLine'))),
                'Email' => html_escape(strip_tags($this->input->post('Email'))),
                'Website' => html_escape(strip_tags($this->input->post('Website'))),
                'RegdNo' => html_escape(strip_tags($this->input->post('RegdNo'))),
                'LabNo' => html_escape(strip_tags($this->input->post('LabNo'))),
                'LogoUrl' => html_escape(strip_tags($this->input->post(base_url()))),
                'TechnicianName' => html_escape(strip_tags($this->input->post('TechnicianName'))),
                'TechnicianQualification' => html_escape(strip_tags($this->input->post('TechnicianQualifiation'))),
                'Currency' => html_escape(strip_tags($this->input->post('Currency'))),
                'DateFormat' => html_escape(strip_tags($this->input->post('DateFormat'))),
                'FooterNote1' => html_escape(strip_tags($this->input->post('FooterNote1'))),
                'FooterNote2' => html_escape(strip_tags($this->input->post('FooterNote2'))),
                'FooterNote3' => html_escape(strip_tags($this->input->post('FooterNote3'))),
                'IsPrintReportHeader' => $isPrinted,
                'CreatedAt' => date('Y-m-d'),
                'UpdatedAt' => date('Y-m-d'),
            ];

            $DataSettings = $this->security->xss_clean($DataSettings);
            if ($this->setting->isSaved($DataSettings)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function saveGlobalSetting() {
        $this->form_validation->set_rules('SalarySlipType', 'SalarySlipType', 'trim|required|integer|min_length[1]|max_length[1]');
        $this->form_validation->set_rules('SalarySlipText', 'Text', 'trim|required|alpha|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('SalarySlipCurrentYear', 'Current Year', 'trim|min_length[4]|max_length[4]');
        $this->form_validation->set_rules('SalarySlipStartingNum', 'Starting Number', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $insert = [
                'SalarySlipType' => html_escape(strip_tags($this->input->post('SalarySlipType'))),
                'SalarySlipText' => html_escape(strip_tags($this->input->post('SalarySlipText'))),
                'SalarySlipCurrentYear' => $this->input->post('SalarySlipCurrentYear'),
                'SalarySlipStartingNum' => $this->input->post('SalarySlipStartingNum'),
                'CreatedAt' => date('Y-m-d'),
                'UpdatedAt' => date('Y-m-d')
            ];
            $insert = $this->security->xss_clean($insert);
            if ($this->setting->isSavedGlobalSetting($insert)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

}
