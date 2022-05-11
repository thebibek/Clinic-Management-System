<?php

defined('BASEPATH') or exit('No direct script access allowed');

class AccountController extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('AccountModel', 'account');
    }

    public function showTrialBalance() {
        $this->load->view("Account/TrialBalanceView");
    }

    public function provideTrialBalance() {
        $this->form_validation->set_rules('Submit', 'Submit', 'trim|required|alpha|min_length[1]|max_length[4]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $drBalance = 0.00;
            $crBalance = 0.00;
            $result = $this->account->supplyTrialBalance();
            foreach ($result as $v) {
                $drBalance += $v['Debit'];
                $crBalance += $v['Credit'];
            }
            $drBalance = number_format($drBalance, 2, '.', '');
            $crBalance = number_format($crBalance, 2, '.', '');

            if (!empty($result)) {
                $data['status'] = 1;
                $data['result'] = $result;
                $data['DrBalance'] = $drBalance;
                $data['CrBalance'] = $crBalance;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function showCashBankBook() {
        $this->load->view("Account/CashBankView");
    }

    public function provideCashAndBankBook() {
        $this->form_validation->set_rules('Submit', 'Submit', 'trim|required|alpha|min_length[1]|max_length[4]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $drBalance = 0.00;
            $crBalance = 0.00;
            $result = $this->account->supplyCashAndBankBook();
            foreach ($result as $v) {
                $drBalance += $v['Debit'];
                $crBalance += $v['Credit'];
            }
            $drBalance = number_format($drBalance, 2, '.', '');
            $crBalance = number_format($crBalance, 2, '.', '');

            if (!empty($result)) {
                $data['status'] = 1;
                $data['result'] = $result;
                $data['DrBalance'] = $drBalance;
                $data['CrBalance'] = $crBalance;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function showLedgerVouchers() {
        $this->load->view("Account/LedgerVouchersView");
    }

    public function provideLedgerVouchers() {
        $this->form_validation->set_rules('FromDate', 'From date', 'trim|required|min_length[1]|max_length[10]');
        $this->form_validation->set_rules('ToDate', 'To date', 'trim|required|min_length[1]|max_length[10]');
        $this->form_validation->set_rules('VoucherNo', 'Voucher No', 'trim|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('LedgerGroup', 'Ledger group', 'trim|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('Ledger', 'Ledger', 'trim|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');

        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $drBalance = 0.00;
            $crBalance = 0.00;
            $fromDate = $this->input->post('FromDate');
            $toDate = $this->input->post('ToDate');
            $vNo = $this->input->post('VoucherNo');
            $ledgerGrId = $this->input->post('LedgerGroup');
            $ledgerId = $this->input->post('Ledger');



            $temp = [
                'VDate >=' => $fromDate,
                'VDate <=' => $toDate,
            ];

            if (!empty($vNo)) {
                $temp['VNo'] = $vNo;
            }

            if (!empty($ledgerGrId)) {
                $temp['LedgerGroupID'] = $ledgerGrId;
            }

            if (!empty($ledgerId)) {
                $temp['Ledger'] = $ledgerId;
            }



            $result = $this->account->filterLedgerVouchers($temp);

            foreach ($result as $v) {
                $drBalance += $v['Debit'];
                $crBalance += $v['Credit'];
            }

            $drBalance = number_format($drBalance, 2, '.', '');
            $crBalance = number_format($crBalance, 2, '.', '');

            if (!empty($result)) {
                $data['status'] = 1;
                $data['result'] = $result;
                $data['CrBalance'] = $crBalance;
                $data['DrBalance'] = $drBalance;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function deleteLedgerVoucher() {
        $this->form_validation->set_rules('VNo', 'VNo', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters();
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $vNo = $this->input->post('VNo');
            $wh = [
                'VNo' => $vNo
            ];
            if ($this->account->isDeletedLedgerVoucher($wh)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function showProfitAndLoss() {
        $this->load->view("Account/ProfitAndLossAccountView");
    }

    public function calculateProfitAndLoss() {
        $this->form_validation->set_rules('Submit', 'Submit', 'trim|required|alpha|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $drBalance = 0.00;
            $crBalance = 0.00;
            //get debit balance and credit balance of each ledger
            $rs1 = $this->account->supplyIncomeLedgerVouchers();
            $rs2 = $this->account->supplyExpenseLedgerVouchers();
            foreach ($rs1 as $v1) {
                $crBalance += $v1['Credit'];
            }
            $crBalance = number_format($crBalance, 2, '.', '');

            foreach ($rs2 as $v2) {
                $drBalance += $v2['Debit'];
            }

            $drBalance = number_format($drBalance, 2, '.', '');

            //income
            if (!empty($rs1)) {
                $data['rs1'] = $rs1;
            }

            //expenses
            if (!empty($rs2)) {
                $data['rs2'] = $rs2;
            }

            if ($crBalance >= $drBalance) {
                $netProfit = $crBalance - $drBalance;
                $netProfit = number_format($netProfit, 2, '.', '');
            } else {
                $netProfit = $drBalance - $crBalance;
                $netProfit = number_format($netProfit, 2, '.', '');
            }

            $data['DrBalance'] = $drBalance;
            $data['CrBalance'] = $crBalance;
            $data['NetProfit'] = $netProfit;
            $data['status'] = 1;
            echo json_encode($data);
        }
    }

    public function showBalanceSheet() {
        $this->load->view("Account/BalanceSheetView");
    }

    public function provideBalanceSheet() {
        $this->form_validation->set_rules('Submit', 'Submit', 'trim|required|alpha|min_length[1]|max_length[4]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 1;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $totalLiabilities = 0.00;
            $totalAssets = 0.00;

            //getting liabilities
            $rs1 = $this->account->provideLiabilities();

            //getting assets
            $rs2 = $this->account->provideAssets();

            foreach ($rs1 as $v) {
                $totalLiabilities += $v['Credit'];
            }
            $totalLiabilities = number_format($totalLiabilities, 2, '.', '');

            foreach ($rs2 as $v) {
                $totalAssets += $v['Debit'];
            }
            $totalAssets = number_format($totalAssets, 2, '.', '');


            $data['status'] = 1;
            $data['rs1'] = $rs1;
            $data['rs2'] = $rs2;
            $data['TotalLiabilities'] = $totalLiabilities;
            $data['TotalAssets'] = $totalAssets;
            echo json_encode($data);
        }
    }

    public function provideCashInHand() {
        $this->form_validation->set_rules('Submit', 'Submit', 'trim|required|alpha|min_length[1]|max_length[4]');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = -1;
            echo json_encode($data);
        } else {
            $wh = [
                'IsCash' => 1
            ];
            $result = $this->account->supplyCashInHand($wh);
            $totalDebit = $result['Debit'];
            $totalCredit = $result['Credit'];
            $cash = $totalDebit - $totalCredit;
            $cash = number_format($cash, 2, '.', '');
            if (!empty($result)) {
                $data['cash'] = $cash;
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

}
