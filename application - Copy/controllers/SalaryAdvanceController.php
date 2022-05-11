<?php

defined('BASEPATH') or exit('No direct script access allowed');

class SalaryAdvanceController extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("SalaryAdvanceModel", 'advance');
    }

    public function index() {
        $this->load->view("Employee/SalaryAdvanceView");
    }

    public function saveAdvanceSalary() {
        $this->form_validation->set_rules('EmployeeID', 'EmployeeID', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('AdvanceDate', 'Advance Date', 'trim|required|min_length[10]|max_length[10]');
        $this->form_validation->set_rules('AdvanceAmount', 'Advance Payment', 'trim|required|decimal|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('Remark', 'Remark', 'trim|min_length[1]|max_length[30]');
        $this->form_validation->set_rules('PayType', 'Pay Type', 'trim|required|integer|min_length[1]|max_length[1]');
        $this->form_validation->set_rules('PaymentMode', 'Payment Mode', 'trim|integer');
        $this->form_validation->set_rules('Bank', 'Bank', 'trim|integer');
        $this->form_validation->set_rules('RefNo', 'RefNo', 'trim|min_length[1]|max_length[31]');

        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $empId = $this->input->post('EmployeeID');
            $advDate = $this->input->post('AdvanceDate');
            $advAmt = $this->input->post('AdvanceAmount');
            $remark = html_escape(strip_tags($this->input->post('Remark')));
            $payType = $this->input->post('PayType');
            $vNo = $this->getVoucherNo('acc_transaction');

            if ($payType == 1) {
                $paymentMode = 0;
                $bank = 0;
                $refNo = 0;
            }

            if ($payType == 2) {
                $paymentMode = $this->input->post('PaymentMode');
                $bank = $this->input->post('Bank');
                $refNo = $this->input->post('RefNo');
            }

            //saving data of advance salary
            $insert = [
                'EmployeeID' => $empId,
                'AdvanceDate' => $advDate,
                'AdvanceAmount' => $advAmt,
                'Remark' => $remark,
                'PayType' => $payType,
                'PaymentMode' => $paymentMode,
                'Bank' => $bank,
                'RefNo' => $refNo,
                'CreatedAt' => date('Y-m-d'),
                'UpdatedAt' => date('Y-m-d')
            ];

            $insert = $this->security->xss_clean($insert);
            if ($this->advance->isSavedSalaryAdavance($insert, $vNo, $advAmt)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function provideSalaryAdvance() {
        $this->form_validation->set_rules('EmployeeID', 'EmployeeID', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $totalAdvance = 0.00;
            $empId = $this->input->post('EmployeeID');
            $wh = [
                'EmployeeID' => $empId
            ];

            $result = $this->advance->supplySalaryAdvance($wh);
            foreach ($result as $v) {
                $totalAdvance += $v['AdvanceAmount'];
            }

            if (!empty($result)) {
                $data['status'] = 1;
                $data['result'] = $result;
                $data['TotalAdvance'] = number_format($totalAdvance, 2, '.', '');
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function deleteAdvanceSalary() {
        $this->form_validation->set_rules('AdvanceID', 'Advance id', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('EmployeeID', 'Employee id', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == false) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $advId = $this->input->post('AdvanceID');
            $empId = $this->input->post('EmployeeID');

            if ($this->advance->isDeletedAdvance($advId, $empId)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function provideAdvanceTaken() {
        $this->form_validation->set_rules('EmployeeID', 'Employee id', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == false) {
            $data['status'] = 1;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $empId = $this->input->post('EmployeeID');
            $result = $this->advance->supplyAdvanceTaken($empId);
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

}
