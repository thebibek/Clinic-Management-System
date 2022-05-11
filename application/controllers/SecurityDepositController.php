<?php

defined('BASEPATH') or exit('No direct script access allowed');

class SecurityDepositController extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('SecurityDepositModel', 'sdeposit');
    }

    public function index() {
        $this->load->view("Employee/SecurityDepositView");
    }

    public function saveSecurityAmount() {
        $this->form_validation->set_rules('EmployeeID', 'EmployeeID', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('SecurityDepositDate', 'Security Deposit Date', 'trim|required|min_length[10]|max_length[10]');
        $this->form_validation->set_rules('TotalAmount', 'Total Amount', 'trim|required|decimal|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('AmountPaid', 'Amount Paid', 'trim|required|decimal|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('AmountDue', 'Amount Due', 'trim|required|decimal|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('Remark', 'Remark', 'trim|min_length[1]|max_length[51]');
        $this->form_validation->set_rules('PayType', 'PayType', 'trim|required|integer|min_length[1]|max_length[1]');
        $this->form_validation->set_rules('PaymentMode', 'PaymentMode', 'trim|integer');
        $this->form_validation->set_rules('Bank', 'Bank', 'trim|integer');
        $this->form_validation->set_rules('RefNo', 'RefNo', 'trim|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');

        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $empId = $this->input->post('EmployeeID');
            $securityDepositDate = $this->input->post('SecurityDepositDate');
            $totalAmt = $this->input->post('TotalAmount');
            $amtPaid = $this->input->post('AmountPaid');
            $amtDue = $this->input->post('AmountDue');
            $remark = html_escape(strip_tags($this->input->post('Remark')));
            $payType = $this->input->post('PayType');
            $paymentMode = $this->input->post('PaymentMode');
            $bank = $this->input->post('Bank');
            $refNo = $this->input->post('RefNo');
            $vNo = $this->getVoucherNo('acc_transaction');

            if ($payType == 1) {
                $paymentMode = 0;
                $bank = 0;
                $refNo = 0;
            }

            //insert security deposit amount
            $insert = [
                'EmployeeID' => $empId,
                'SecurityDepositDate' => $securityDepositDate,
                'TotalAmount' => $totalAmt,
                'AmountPaid' => $amtPaid,
                'AmountDue' => $amtDue,
                'Remark' => $remark,
                'PayType' => $payType,
                'PaymentMode' => $paymentMode,
                'Bank' => $bank,
                'RefNo' => $refNo,
                'CreatedAt' => date('Y-m-d'),
                'UpdatedAt' => date('Y-m-d')
            ];

            // update due amount    
            $update = [
                'EmployeeID' => $empId,
                'AmountDeposited' => $totalAmt,
                'AmountPaid' => $amtPaid,
                'DueAmount' => $amtDue,
                'CreatedAt' => date('Y-m-d'),
                'UpdatedAt' => date('Y-m-d')
            ];

            //where clause
            $wh = [
                'EmployeeID' => $empId
            ];


            $insert = $this->security->xss_clean($insert);

            if ($this->sdeposit->isSavedSecurityDeposit($insert, $update, $wh, $vNo)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function provideSecurityDeposits() {
        $this->form_validation->set_rules('EmployeeID', 'EmployeeID', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $totalDue = 0.00;
            $empId = $this->input->post('EmployeeID');
            $wh = [
                'EmployeeID' => $empId
            ];

            $result = $this->sdeposit->supplySecurityDeposits($wh);
            foreach ($result as $v) {
                $totalDue += $v['AmountDue'];
            }
            $totalDue = number_format($totalDue, 2, '.', '');
            if (!empty($result)) {
                $data['status'] = 1;
                $data['result'] = $result;
                $data['TotalDue'] = $totalDue;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function deleteSecurityDeposit() {
        $this->form_validation->set_rules('SecurityDepositID', 'Security deposit id', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('EmployeeID', 'Employee id', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == false) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $securityDepositedId = $this->input->post('SecurityDepositID');
            $empId = $this->input->post('EmployeeID');
            if ($this->sdeposit->isDeletedSecurityDeposited($securityDepositedId, $empId)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

}
