<?php

defined('BASEPATH') or exit('No direct script access allowed');

class VoucherController extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("VoucherModel", 'voucher');
    }

    public function index() {
        $this->load->view("Account/VoucherView");
    }

    public function provideContraLedger() {
        $this->form_validation->set_rules('Submit', 'Submit', 'trim|alpha|required|min_length[1]|max_length[4]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['status'] = validation_errors();
            echo json_encode($data);
            exit();
        } else {
            $result = $this->voucher->supplyContraLedger();
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

    public function postVoucher() {
        $this->form_validation->set_rules('VoucherType', 'Voucher Type', 'trim|required|integer|min_length[1]|max_length[1]');
        $this->form_validation->set_rules('Comment', 'Comment', 'trim|required');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $voucherType = $this->input->post('VoucherType');
            $comment = $this->input->post('Comment');
            $items = $this->input->post('Items');
            if (!empty($items)) {
                $items = $this->input->post('Items');
            }

            if ($this->saveVoucher($items, $voucherType, $comment)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
            }
        }
    }

    public function saveVoucher($items, $voucherType, $comment) {
        $temp = [];
        $voucherNo = $this->getVoucherNo('acc_transaction');
        if ($voucherType == 1) {
            $voucherType = 'contra';
        }
        if ($voucherType == 2) {
            $voucherType = 'payment';
        }
        if ($voucherType == 3) {
            $voucherType = 'receipt';
        }
        if ($voucherType == 4) {
            $voucherType = 'journal';
        }

        foreach ($items as $v) {
            $d['LedgerID'] = $v['LedgerID'];
            $d['VNo'] = $voucherNo;
            $d['Vtype'] = $voucherType;
            $d['VDate'] = $v['Date'];
            $d['Narration'] = $comment;
            $d['Debit'] = $v['Debit'];
            $d['Credit'] = $v['Credit'];
            $d['IsPosted'] = 1;
            $d['CreatedBy'] = 1;
            $d['CreatedAt'] = date('Y-m-d');
            $d['UpdatedBy'] = 1;
            $d['UpdatedAt'] = date('Y-m-d');
            $d['IsAppoved'] = 1;

            array_push($temp, $d);
        }

        if ($this->voucher->isSavedVoucher($temp)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function provideDayBook() {
        $this->load->view("Account/DayBookView");
    }

    public function provideFilteredVouchers() {
        $this->form_validation->set_rules('VoucherType', 'Voucher Type', 'trim|required|integer|min_length[1]|max_length[1]');
        $this->form_validation->set_rules('FromDate', 'FromDate', 'trim|required');
        $this->form_validation->set_rules('ToDate', 'ToDate', 'trim|required');
        $this->form_validation->set_rules('LedgerGroup', 'LedgerGroup', 'trim|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('Ledger', 'Ledger', 'trim|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $voucherType = $this->input->post('VoucherType');
            $fromDate = $this->input->post('FromDate');
            $toDate = $this->input->post('ToDate');
            $ledgerGroup = $this->input->post('LedgerGroup');
            $ledger = $this->input->post('Ledger');

            $drSum = 0;
            $crSum = 0;

            $param = [
                'FromDate' => $fromDate,
                'ToDate' => $toDate,
                'LedgerGroup' => $ledgerGroup,
                'Ledger' => $ledger
            ];

            if ($voucherType == 1) {
                $result = $this->voucher->supplyAllVouchers($param);
            } else {
                switch ($voucherType) {
                    case 2:
                        $vType = 'contra';
                        break;

                    case 3:
                        $vType = 'receipt';
                        break;

                    case 4:
                        $vType = 'payment';
                        break;

                    case 5:
                        $vType = 'journal';
                        break;
                }
                $result = $this->voucher->supplyVouchers($param, $vType);
            }


            foreach ($result as $v) {
                $drSum += $v['Debit'];
                $crSum += $v['Credit'];
            }
            $drSum = number_format($drSum, 2, '.', '');
            $crSum = number_format($crSum, 2, '.', '');
            if (!empty($result)) {
                $data['status'] = 1;
                $data['result'] = $result;
                $data['Debit'] = $drSum;
                $data['Credit'] = $crSum;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function provideDebitPaymentLedger() {
        $this->form_validation->set_rules('Submit', 'Submit', 'trim|required|alpha|min_length[1]|max_length[4]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $result = $this->voucher->supplyDebitPaymentLedger();
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

    public function provideCreditPaymentLedger() {
        $this->form_validation->set_rules('Submit', 'Submit', 'trim|required|alpha|min_length[1]|max_length[4]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $result = $this->voucher->supplyCreditPaymentLedger();
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

    public function provideDebitReceiptLedger() {
        $this->form_validation->set_rules('Submit', 'Submit', 'trim|required|alpha|min_length[1]|max_length[4]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $result = $this->voucher->supplyDebitReceiptLedger();
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

    public function provideCreditReceiptLedger() {
        $this->form_validation->set_rules('Submit', 'Submit', 'trim|required|alpha|min_length[1]|max_length[4]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $result = $this->voucher->supplyCreditReceiptLedger();
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

    public function supplyJournalLedger() {
        $this->form_validation->set_rules('Submit', 'Submit', 'trim|required|alpha|min_length[1]|max_length[4]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $result = $this->voucher->supplyJournalLedger();
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
