<?php

defined('BASEPATH') or exit('No direct script access allowed');

class UploadController extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('EmployeeModel', 'employee');
    }

    public function uploadEmployeeExcel() {
        $this->form_validation->set_rules('EmployeeExcel', 'Uploaded File', 'callback_checkFileValidation');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('msg', validation_errors());
            redirect(base_url('app/employee/import'));
        } else {
            if (!empty($_FILES['EmployeeExcel']['name'])) {
                $extension = pathinfo($_FILES['EmployeeExcel']['name'], PATHINFO_EXTENSION);

                if ($extension == 'csv') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif ($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }

                $spreadsheet = $reader->load($_FILES['EmployeeExcel']['tmp_name']);
                $data = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

                $createArr = [
                    'ResumeNo' => 'A',
                    'EmpCode' => 'B',
                    'Salutation' => 'C',
                    'FirstName' => 'D',
                    'LastName' => 'E',
                    'ShortName' => 'F',
                    'DateOfBirth' => 'G',
                    'FatherName' => 'H',
                    'MotherName' => 'I',
                    'BankACNo' => 'J',
                    'BankName' => 'K',
                    'ESINo' => 'L',
                    'PFNo' => 'M',
                    'PANNo' => 'N',
                    'Address' => 'O',
                    'StateOrProvince' => 'P',
                    'City' => 'Q',
                    'PinOrZip' => 'R',
                    'PhoneNo' => 'S',
                    'Email' => 'T'
                ];

                foreach ($data as $key => $value) {
                    if ($key == 1) {
                        $sheetArr = array_flip($value);
                    }
                    break;
                }

                $diff = array_diff_key($sheetArr, $createArr);
                if (empty($diff)) {
                    $temp = [];
                    foreach ($data as $k => $v) {
                        if ($k == 1) {
                            //nothing to do
                        } else {
                            $t['ResumeNo'] = $v['A'];
                            $t['EmployeeCode'] = $v['B'];
                            $t['Salutation'] = $v['C'];
                            $t['FirstName'] = $v['D'];
                            $t['LastName'] = $v['E'];
                            $t['ShortName'] = $v['F'];
                            $t['DateOfBirth'] = date('Y-m-d', strtotime($v['G']));
                            $t['FatherName'] = $v['H'];
                            $t['MotherName'] = $v['I'];
                            $t['BankAccountNo'] = $v['J'];
                            $t['BankName'] = $v['K'];
                            $t['ESINo'] = $v['L'];
                            $t['PFNo'] = $v['M'];
                            $t['PANNo'] = $v['N'];
                            $t['Address'] = $v['O'];
                            $t['StateOrProvince'] = $v['P'];
                            $t['City'] = $v['Q'];
                            $t['PinOrZip'] = $v['R'];
                            $t['PhoneNumber'] = $v['S'];
                            $t['Email'] = $v['T'];

                            array_push($temp, $t);
                        }
                    }

                    if ($this->employee->isUploadedEmployee($temp)) {
                        $this->session->set_flashdata('msg', 'File uploaded successfully.');
                        redirect(base_url('app/employee/import'));
                    } else {
                        $this->session->set_flashdata('msg', 'File could not uploaded.');
                        redirect(base_url('app/employee/import'));
                    }
                } else {
                    $this->session->set_flashdata('msg', 'Invalid file,Pls ensure correct formart.');
                    redirect(base_url('app/employee/import'));
                }
            }
        }
    }

    //check validation
    public function checkFileValidation() {
        $fileMimes = [
            'text/x-comma-separated-values',
            'text/comma-separated-values',
            'application/octet-stream',
            'application/vnd.ms-excel',
            'application/x-csv',
            'text/x-csv',
            'text/csv',
            'application/csv',
            'application/excel',
            'application/vnd.msexcel',
            'text/plain',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ];

        if (isset($_FILES['EmployeeExcel']['name'])) {
            $file = basename($_FILES['EmployeeExcel']['name']);
            $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            if (($extension == 'xlsx' || $extension == 'xls' || $extension == 'csv') && in_array($_FILES['EmployeeExcel']['type'], $fileMimes)) {
                return true;
            } else {
                $this->form_validation->set_message('checkFileValidation', 'Please upload valid file');
                return false;
            }
        } else {
            $this->form_validation->set_message('checkFileValidation', 'Please upload a file');
            return false;
        }
    }

}
