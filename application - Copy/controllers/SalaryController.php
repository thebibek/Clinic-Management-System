<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class SalaryController extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('SalaryModel', 'salary');
        $this->load->model('SettingsModel', 'settings');
    }

    public function saveAllowance() {
        $this->form_validation->set_rules('Allowance', 'Allowance', 'trim|required|min_length[1]|max_length[11]|alpha');
        $this->form_validation->set_rules('Name', 'Name', 'trim|required|min_length[1]|max_length[21]|alpha_numeric_spaces');
        $this->form_validation->set_rules('Code', 'Code', 'trim|required|min_length[1]|max_length[21]|alpha_numeric_spaces');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $allowance = html_escape(strip_tags($this->input->post('Allowance')));
            $name = html_escape(strip_tags($this->input->post('Name')));
            $code = html_escape(strip_tags($this->input->post('Code')));

            $dataAllowance = [
                'AllowanceType' => $allowance,
                'Name' => $name,
                'Code' => $code,
                'CreatedAt' => date('Y-m-d'),
                'UpdatedAt' => date('Y-m-d')
            ];
            $dataAllowance = $this->security->xss_clean($dataAllowance);

            if ($this->salary->isAllowanceSaved($dataAllowance)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function getAllowances() {
        $result = $this->salary->supplyAllowances();
        if (!empty($result)) {
            $data['status'] = 1;
            $data['result'] = $result;
            echo json_encode($data);
        } else {
            $data['status'] = -1;
            echo json_encode($data);
        }
    }

    public function getAllowanceName() {
        $this->form_validation->set_rules('AllowanceType', 'Allowance Or Deduction', 'trim|required|alpha|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $where = [
                'AllowanceType' => html_escape(strip_tags($this->input->post('AllowanceType')))
            ];

            $result = $this->salary->supplyAllowanceNames($where);
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

    public function saveSalaryScheme() {
        $this->form_validation->set_rules('SchemeCode', 'SchemeCode', 'trim|required|min_length[1]|max_length[31]');
        $this->form_validation->set_rules('SchemeName', 'SchemeName', 'trim|required|min_length[1]|max_length[31]|is_unique[salaryscheme.SchemeName]');
        $this->form_validation->set_rules('AllowanceType', 'AllowanceType', 'trim|required|alpha|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('AllowanceName', 'AllowanceName', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            if ($this->input->post('SchemeItems')) {
                $schemeItems = $this->input->post('SchemeItems');
                if (!empty($schemeItems)) {
                    $schemeItems = $this->security->xss_clean($schemeItems);
                } else {
                    $data['status'] = 2;
                    echo json_encode($data);
                    exit();
                }
            } else {
                $data['status'] = 2;
                echo json_encode($data);
                exit();
            }

            $dataSalaryScheme = [
                'SchemeCode' => $this->input->post('SchemeCode'),
                'SchemeName' => $this->input->post('SchemeName'),
                'AllowanceType' => $this->input->post('AllowanceType'),
                'AllowanceNameID' => $this->input->post('AllowanceName'),
                'CreatedAt' => date('Y-m-d'),
                'UpdatedAt' => date('Y-m-d')
            ];

            if ($this->salary->isSavedSalaryScheme($dataSalaryScheme, $schemeItems)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function provideSalaryScheme() {
        $result = $this->salary->supplySalaryScheme();
        if (!empty($result)) {
            $data['status'] = 1;
            $data['result'] = $result;
            echo json_encode($data);
        } else {
            $data['status'] = -1;
            echo json_encode($data);
        }
    }

    public function addSchemeToEmployee() {
        $this->load->view("Employee/EmployeeSalarySchemeView");
    }

    public function salaryGeneration() {
        $this->load->view("Employee/SalaryGenerationView");
    }

    //generating salary for a particular employee 
    public function generateSalary() {
        
    }

    public function provideMonthlySalaryScheme() {
        $this->form_validation->set_rules('EmployeeID', 'Employee ID', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('SalaryMonth', 'Salary month', 'trim|required|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $employeeId = html_escape(strip_tags($this->input->post('EmployeeID')));
            $salaryMonth = html_escape(strip_tags($this->input->post('SalaryMonth')));

            $where = [
                'EmployeeID' => $employeeId,
                'SalaryMonth' => $salaryMonth
            ];

            $where = $this->security->xss_clean($where);
            $result = $this->salary->supplyMonthlySalaryScheme($where);
            if (!empty($result)) {
                $data['result'] = $result;
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function provideAssignedSchemeAllowance() {
        $this->form_validation->set_rules('SalarySchemeID', 'Salary Scheme Id', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('AllowanceType', 'Allowance Type', 'trim|required|alpha|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $where = [
                'SalarySchemeID' => $this->input->post('SalarySchemeID'),
                'AllowanceType' => $this->input->post('AllowanceType')
            ];

            $where = $this->security->xss_clean($where);
            $result = $this->salary->supplyAssignedSchemeAllowance($where);
            if (!empty($result)) {
                $data['status'] = 1;
                $data['rs'] = $result;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function provideAssignedSchemeDeduction() {
        $this->form_validation->set_rules('SalarySchemeID', 'Salary Scheme Id', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('AllowanceType', 'Allowance Type', 'trim|required|alpha|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $where = [
                'SalarySchemeID' => $this->input->post('SalarySchemeID'),
                'AllowanceType' => $this->input->post('AllowanceType')
            ];

            $where = $this->security->xss_clean($where);
            $result = $this->salary->supplyAssignedSchemeDeduction($where);
            if (!empty($result)) {
                $data['status'] = 1;
                $data['rs'] = $result;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function provideAssignedSchemeContribution() {
        $this->form_validation->set_rules('SalarySchemeID', 'Salary Scheme Id', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('AllowanceType', 'Allowance Type', 'trim|required|alpha|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $where = [
                'SalarySchemeID' => $this->input->post('SalarySchemeID'),
                'AllowanceType' => $this->input->post('AllowanceType')
            ];

            $where = $this->security->xss_clean($where);
            $result = $this->salary->supplyAssignedSchemeContribution($where);
            if (!empty($result)) {
                $data['status'] = 1;
                $data['rs'] = $result;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function provideEmployeeSalarySlip() {
        $this->form_validation->set_rules('EmployeeID', 'Employee ID', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() === FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {

            //getting the global settings
            $rs1 = $this->settings->supplyGlobalSettings();



            if ($rs1['SalarySlipCurrentYear'] == 0) {
                $year = 0;
            } else {
                $year = $rs1['SalarySlipCurrentYear'];
            }

            $text = $rs1['SalarySlipText'];



            if (!empty($rs1)) {
                if (!empty($this->getSalarySlipSerialNo('salary'))) {
                    $rw = $this->getSalarySlipSerialNo('salary');
                    $slipNo = $rw['SerialNo'] + 1;
                    if ($year == 0) {
                        $slip = $text . '/' . $slipNo;
                    } else {
                        $slip = $text . '/' . $year . '/' . $slipNo;
                    }

                    $data['status'] = 1;
                    $data['slip'] = $slip;
                    $data['SlipNo'] = $slipNo;

                    echo json_encode($data);
                } else {
                    $slipNo = $rs1['SalarySlipStartingNum'];
                    if ($year == 0) {
                        $slip = $text . '/' . $slipNo;
                    } else {
                        $slip = $text . '/' . $year . '/' . $slipNo;
                    }
                    $data['status'] = 1;
                    $data['slip'] = $slip;
                    $data['SlipNo'] = $slipNo;

                    echo json_encode($data);
                }
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function saveSalary() {
        $this->form_validation->set_rules('EmployeeID', 'Employee ID', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('SlipSerialNo', 'Slip Serial No', 'trim|required|integer|min_length[1]|max_length[31]');
        $this->form_validation->set_rules('SlipNo', 'Slip No', 'trim|required|min_length[1]|max_length[31]');
        $this->form_validation->set_rules('SalaryGeneratedDate', 'Generation Date', 'trim|min_length[1]|max_length[10]');
        $this->form_validation->set_rules('SalaryMonth', 'Salary Month', 'trim|required|min_length[1]|max_length[10]');
        $this->form_validation->set_rules('Attendance', 'Attendance', 'trim|required|integer|min_length[1]|max_length[2]');
        $this->form_validation->set_rules('BasicSalary', 'Basic Salary', 'trim|required|decimal|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('TotalAllowance', 'Total Allowance', 'trim|required|decimal|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('TotalDeduction', 'Total Deduction', 'trim|required|decimal|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('TotalContribution', 'Total Contribution', 'trim|required|decimal|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('AbsentDays', 'Absent days', 'trim|integer|min_length[1]|max_length[2]');
        $this->form_validation->set_rules('AdvanceAmt', 'AdvanceAmt', 'trim|decimal|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $empId = html_escape(strip_tags($this->input->post('EmployeeID')));
            $serialNo = html_escape(strip_tags($this->input->post('SlipSerialNo')));
            $slipNo = html_escape(strip_tags($this->input->post('SlipNo')));
            $generateDate = html_escape(strip_tags($this->input->post('SalaryGeneratedDate')));
            $salaryMonth = html_escape(strip_tags($this->input->post('SalaryMonth')));
            $attendance = html_escape(strip_tags($this->input->post('Attendance')));
            $basicSalary = html_escape(strip_tags($this->input->post('BasicSalary')));
            $totalAllowance = html_escape(strip_tags($this->input->post('TotalAllowance')));
            $totalDeduction = html_escape(strip_tags($this->input->post('TotalDeduction')));
            $totalContribution = html_escape(strip_tags($this->input->post('TotalContribution')));
            $advAmt = html_escape(strip_tags($this->input->post('AdvanceAmt')));
            $vNo1 = $this->getVoucherNo('acc_transaction');
            $vNo2 = $vNo1 + 1;

            if ($this->input->post('AbsentDays')) {
                $absentDays = $this->input->post('AbsentDays');
            } else {
                $absentDays = 0;
            }

            if ($this->input->post('AdvanceAmt')) {
                $advAmt = $this->input->post('AdvanceAmt');
            } else {
                $advAmt = 0.00;
            }



            $absentDeduction = ($basicSalary / 30) * $absentDays;
            $absentDeduction = number_format($absentDeduction, 2, '.', '');

            $grossSalary = ($basicSalary + $totalAllowance);
            $grossSalary = number_format($grossSalary, 2, '.', '');

            $netSalary = $grossSalary - ($totalDeduction + $totalContribution + $advAmt + $absentDeduction);

            if ($netSalary <= 0) {
                $data['status'] = -2;
                echo json_encode($data);
                exit();
            }

            $isGenerated = 1;
            $isPaid = 0;


            $insert = [
                'EmployeeID' => $empId,
                'SlipSerialNo' => $serialNo,
                'SlipNo' => $slipNo,
                'SalaryGeneratedDate' => $generateDate,
                'SalaryMonth' => $salaryMonth,
                'Attendance' => $attendance,
                'BasicSalary' => $basicSalary,
                'TotalAllowance' => $totalAllowance,
                'TotalDeduction' => $totalDeduction,
                'TotalContribution' => $totalContribution,
                'AdvanceReceived' => $advAmt,
                'SecurityReceived' => 0.00,
                'GrossSalary' => $grossSalary,
                'NetSalary' => $netSalary,
                'IsGenerated' => 1,
                'IsCancelled' => 0,
                'IsPaid' => 0,
                'CreatedAt' => date('Y-m-d'),
                'UpdatedAt' => date('Y-m-d')
            ];

            $insert = $this->security->xss_clean($insert);
            $where = [
                'EmployeeID' => $empId,
                'SalaryMonth' => $salaryMonth,
                'IsGenerated' => 1,
                'IsCancelled' => 0
            ];

            if ($this->salary->isSalarySaved($insert, $empId, $advAmt, $vNo1, $vNo2, $where)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function deleteSalary() {
        $this->form_validation->set_rules('SalaryID', 'Salary id', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == false) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $salaryId = $this->input->post('SalaryID');

            if ($this->salary->isDeletedSalary($salaryId)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function salaryPayment() {
        $this->load->view("Employee/SalaryPaymentView");
    }

    public function filterEmployeeSalary() {
        $this->form_validation->set_rules('SalaryMonth', 'Salary Month', 'trim|required|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $salaryMonth = $this->input->post('SalaryMonth');
            $empCode = $this->input->post('EmpCode');

            $result = $this->salary->supplyEmployeeSalary($salaryMonth, $empCode);


            if (!empty($result)) {
                $data['result'] = $result;
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function makePayment() {
        $this->form_validation->set_rules('PaymentDate', 'PaymentDate', 'trim|required|min_length[1]|max_length[10]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $items = $this->input->post('items');
            if (empty($items)) {
                $data['status'] = 0;
                $data['error'] = 'Please Search for generated salary !';
                echo json_encode($data);
                exit();
            }

            //temprorary array to carry the value of updating salary table
            $tmp1 = [];

            //temprorary array to carry the salary payment table records
            $tmp2 = [];
            foreach ($items as $v) {
                if ($v['IsChecked'] == 1) {

                    //value for tmp1
                    $t1['ID'] = $v['SalaryID'];
                    $t1['IsPaid'] = 1;

                    //value for tmp2
                    $t2['SalaryID'] = $v['SalaryID'];
                    $t2['PaymentDate'] = date('Y-m-d');
                    $t2['PaymentMode'] = $v['PaymentMode'];
                    $t2['LedgerID'] = $v['BankName']; //bank name corresponds to ledger
                    $t2['ChequeNo'] = $v['CHQNo'];
                    $t2['ChequeDate'] = date('Y-m-d', strtotime($v['CHQDate']));
                    $t2['PaymentStatus'] = 1;
                    $t2['CreatedAt'] = date('Y-m-d');
                    $t2['UpdatedAt'] = date('Y-m-d');

                    array_push($tmp1, $t1);
                    array_push($tmp2, $t2);
                }
            }

            if (!empty($tmp1)) {

                $data['status'] = 1;



                foreach ($tmp2 as $r) {
                    if ($r['PaymentMode'] == 2) {
                        if (empty($r['LedgerID']) || empty($r['ChequeNo']) || empty($r['ChequeDate'])) {
                            $data['status'] = 0;
                            $data['error'] = 'Please check Bank Name,CHQ/DD No,CHQ/DD Date';
                            break;
                        }
                    }

                    if ($r['PaymentMode'] == 3) {
                        if (empty($r['BankName'])) {
                            $data['status'] = 0;
                            $data['error'] = 'Please check Bank Name';
                            break;
                        }
                    }
                }

                if ($data['status'] == 1) {
                    if ($this->salary->isMadePayment($tmp1, $tmp2)) {
                        $data['status'] = 1;
                        echo json_encode($data);
                    }
                } else {
                    echo json_encode($data);
                }
            } else {
                $data['status'] = 0;
                $data['error'] = 'Please select at least a checkbox to make payment';
                echo json_encode($data);
            }
        }
    }

    public function deleteSalaryScheme() {
        $this->form_validation->set_rules('SchemeID', 'Salary scheme id', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == false) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $schemeId = $this->input->post('SchemeID');

            if ($this->salary->isDeletedScheme($schemeId)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function editSalaryScheme() {
        $this->form_validation->set_rules('SchemeID', 'Scheme id', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == false) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $schemeId = $this->input->post('SchemeID');

            $wh1 = [
                'ID' => $schemeId
            ];

            $wh2 = [
                'SalarySchemeID' => $schemeId
            ];

            $rs1 = $this->salary->supplySingleScheme($wh1);
            $rs2 = $this->salary->supplySchemeItems($wh2);

            if (!empty($rs1)) {
                $data['rs1'] = $rs1;
                $data['rs2'] = $rs2;
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function updateSalaryScheme() {
        $this->form_validation->set_rules('SchemeID', 'Scheme id', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('SchemeCode', 'SchemeCode', 'trim|required|min_length[1]|max_length[31]');
        //$this->form_validation->set_rules('SchemeName', 'SchemeName', 'trim|required|min_length[1]|max_length[31]|is_unique[salaryscheme.SchemeName]');
        $this->form_validation->set_rules('AllowanceType', 'AllowanceType', 'trim|required|alpha|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('AllowanceName', 'AllowanceName', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            if ($this->input->post('SchemeItems')) {
                $schemeItems = $this->input->post('SchemeItems');
                if (!empty($schemeItems)) {
                    $schemeItems = $this->security->xss_clean($schemeItems);
                } else {
                    $data['status'] = 2;
                    echo json_encode($data);
                    exit();
                }
            } else {
                $data['status'] = 2;
                echo json_encode($data);
                exit();
            }

            $schemeId = $this->input->post('SchemeID');

            $update = [
                'SchemeCode' => $this->input->post('SchemeCode'),
                'AllowanceType' => $this->input->post('AllowanceType'),
                'AllowanceNameID' => $this->input->post('AllowanceName'),
                'UpdatedAt' => date('Y-m-d')
            ];

            if ($this->salary->isUpdatedSalaryScheme($update, $schemeItems, $schemeId)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function printSalarySlip() {
        $this->load->view('Employee/SalarySlipView');
    }

    public function provideSalarySlip() {
        $this->form_validation->set_rules('SalaryMonth', 'Salary month', 'trim|required|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == false) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $salaryMonth = $this->input->post('SalaryMonth');
            $result = $this->salary->supplySalarySlip($salaryMonth);
            if (!empty($result)) {
                $data['result'] = $result;
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

}
