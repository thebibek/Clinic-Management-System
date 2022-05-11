<?php

defined('BASEPATH') or exit('No direct script access allowed');

class AccountModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function supplyTrialBalance() {
        $this->db->select('Ledger,LedgerGroup');
        $this->db->select_sum('Debit');
        $this->db->select_sum('Credit');
        $this->db->from('acc_transaction');
        $this->db->join('ledger', 'ledger.ID = acc_transaction.LedgerID', 'inner');
        $this->db->join('ledgergroup', 'ledger.LedgerGroupID = ledgergroup.ID', 'inner');
        $this->db->group_by('LedgerID');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    public function supplyCashAndBankBook() {
        $this->db->select('Ledger,LedgerGroup');
        $this->db->select_sum('Debit');
        $this->db->select_sum('Credit');
        $this->db->from('acc_transaction');
        $this->db->join('ledger', 'ledger.ID = acc_transaction.LedgerID', 'inner');
        $this->db->join('ledgergroup', 'ledgergroup.ID = ledger.LedgerGroupID', 'inner');
        $this->db->group_by('LedgerID');
        $this->db->where(['IsCashBankBook' => 1]);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    public function filterLedgerVouchers($wh) {
        $this->db->select('ledger.ID as LedgerID,Ledger,VDate,VNo,Vtype,Narration,Debit,Credit');
        $this->db->from('acc_transaction');
        $this->db->join('ledger', 'ledger.ID = acc_transaction.LedgerID', 'inner');
        $this->db->where($wh);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    public function isDeletedLedgerVoucher($wh) {
        if ($this->db->delete('acc_transaction', $wh)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function supplyExpenseLedgerVouchers() {
        $wh = [
            'IsExpense' => 1
        ];
        $this->db->select('Ledger');
        $this->db->select_sum('Debit');
        $this->db->from('acc_transaction');
        $this->db->join('ledger', 'ledger.ID = acc_transaction.LedgerID', 'inner');
        $this->db->group_by('LedgerID');
        $this->db->where($wh);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    public function supplyIncomeLedgerVouchers() {
        $wh = [
            'IsIncome' => 1
        ];

        $this->db->select('Ledger');
        $this->db->select_sum('Credit');
        $this->db->from('acc_transaction');
        $this->db->join('ledger', 'ledger.ID = acc_transaction.LedgerID', 'inner');
        $this->db->group_by('LedgerID');
        $this->db->where($wh);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    public function provideLiabilities() {

        $wh = [
            'BS' => 2
        ];
        $this->db->select('Ledger');
        $this->db->select_sum('Credit');
        $this->db->from('acc_transaction');
        $this->db->join('ledger', 'ledger.ID = acc_transaction.LedgerID', 'inner');
        $this->db->group_by('LedgerID');
        $this->db->where($wh);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    public function provideAssets() {
        $wh = [
            'BS' => 1
        ];
        $this->db->select('Ledger');
        $this->db->select_sum('Debit');
        $this->db->from('acc_transaction');
        $this->db->join('ledger', 'ledger.ID = acc_transaction.LedgerID', 'inner');
        $this->db->group_by('LedgerID');
        $this->db->where($wh);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    public function supplyCashInHand($wh) {
        $this->db->select_sum('Debit');
        $this->db->select_sum('Credit');
        $this->db->from('acc_transaction');
        $this->db->join('ledger', 'ledger.ID = acc_transaction.LedgerID', 'inner');
        $this->db->group_by('LedgerID');
        $this->db->where($wh);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return [];
        }
    }

    //for graph data
    public function getChartExpenses() {
        for ($i = 1; $i <= 12; $i++) {
            $data[$i] = $this->getMonthlyExpense($i, date('Y'));
        }
        return $data;
    }
    
    public function getChartSales(){
        for($i=1;$i<=12;$i++){
            $data[$i] = $this->getMonthlySales($i,date('Y'));
        }
        return $data;
    }

    //get monthly expenses

    public function getMonthlyExpense($month, $year) {
        $wh = [
            'MONTH(VDate)' => $month,
            'YEAR(VDate)' => $year,
            'IsExpense' => 1
        ];

        $this->db->select_sum('Debit');
        $this->db->from('acc_transaction');
        $this->db->join('ledger', 'acc_transaction.LedgerID = ledger.ID', 'inner');
        $this->db->group_by('LedgerID');
        $this->db->where($wh);
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            $row = $q->row_array();
            return $row['Debit'];
        } else {
            return 0.00;
        }
    }

    //get monthly sales

    public function getMonthlySales($month, $year) {
        $wh = [
            'MONTH(VDate)' => $month,
            'YEAR(VDate)' => $year,
            'IsIncome' => 1
        ];

        $this->db->select_sum('Credit');
        $this->db->from('acc_transaction');
        $this->db->join('ledger', 'acc_transaction.LedgerID = ledger.ID', 'inner');
        $this->db->group_by('LedgerID');
        $this->db->where($wh);
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            $row = $q->row_array();
            return $row['Credit'];
        } else {
            return 0.00;
        }
    }

}
