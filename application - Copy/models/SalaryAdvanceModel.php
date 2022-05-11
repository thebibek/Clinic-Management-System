<?php

defined('BASEPATH') or exit('No direct script access allowed');

class SalaryAdvanceModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function isSavedSalaryAdavance($insert, $vNo, $advAmt) {
        $this->db->trans_start();
        $this->updateEmpAdvance($insert);
        $this->db->insert('advancesalary', $insert);
        $this->createSalaryAdvanceVoucher($vNo, $advAmt);
        $this->db->trans_complete();
        if ($this->db->trans_status() == false) {
            return false;
        } else {
            return true;
        }
    }
    
    public function createSalaryAdvanceVoucher($vNo,$advAmt){
         //salary advance ledger id
        $l1 = $this->provideSalaryAdvanceLedgerId();

        //security cash ledger id
        $l2 = $this->provideCashLedgerId();

        $data = [];
        //ledger entry
        $d1 = [
            'LedgerID' => $l1,
            'VNo' => $vNo,
            'Vtype' => 'payment',
            'VDate' => date('Y-m-d'),
            'Narration' => 'TO CASH A/C ' . $advAmt . ' BY SALARY ADVANCE A/C ' . $advAmt,
            'Debit' => $advAmt,
            'Credit' => 0.00,
            'IsPosted' => 1,
            'CreatedBy' => 1,
            'CreatedAt' => date('Y-m-d'),
            'UpdatedBy' => 1,
            'UpdatedAt' => date('Y-m-d'),
            'IsAppoved' => 1
        ];

        $d2 = [
            'LedgerID' => $l2,
            'VNo' => $vNo,
            'Vtype' => 'payment',
            'VDate' => date('Y-m-d'),
            'Narration' => 'BY SALARY ADVANCE A/C ' . $advAmt . ' TO CASH A/C ' . $advAmt,
            'Debit' => 0.00,
            'Credit' => $advAmt,
            'IsPosted' => 1,
            'CreatedBy' => 1,
            'CreatedAt' => date('Y-m-d'),
            'UpdatedBy' => 1,
            'UpdatedAt' => date('Y-m-d'),
            'IsAppoved' => 1
        ];
        array_push($data, $d1);
        array_push($data, $d2);

        $this->db->insert_batch('acc_transaction', $data);
    }
    
    public function provideSalaryAdvanceLedgerId(){
        $wh = [
            'IsSalaryAdvance'=> 1
        ];
        $q = $this->db->get_where('ledger',$wh);
        if($q->num_rows() == 1){
            $row = $q->row_array();
            return $row['ID'];
        }else{
            return 0;
        }
        
    }
    
    public function provideCashLedgerId(){
        $wh = [
            'IsCash'=> 1
        ];
        $q = $this->db->get_where('ledger',$wh);
        if($q->num_rows() == 1){
            $row = $q->row_array();
            return $row['ID'];
        }else{
            return 0;
        }
    }
    

    public function supplySalaryAdvance($wh) {
        
        $this->db->select('*,advancesalary.ID as AdvanceID');
        $this->db->from('advancesalary');
        $this->db->join('paymentmode', 'advancesalary.PaymentMode = paymentmode.ID', 'left');
        $this->db->join('ledger', 'advancesalary.Bank = ledger.ID', 'left');
        $this->db->where($wh);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    public function isDeletedAdvance($advId, $empId) {
        $wh = [
            'ID' => $advId
        ];
        $this->db->trans_start();
        $advAmt = $this->provideAdvAmt($advId);
        $this->modifyEmpAdvance($empId, $advAmt);
        $this->db->delete('advancesalary', $wh);
        $this->db->trans_complete();
        if ($this->db->trans_status() == false) {
            return false;
        } else {
            return true;
        }
    }

    public function provideAdvAmt($advId) {
        $wh = [
            'ID' => $advId
        ];

        $q = $this->db->get_where('advancesalary', $wh);
        if ($q->num_rows() == 1) {
            $row = $q->row_array();
            return $row['AdvanceAmount'];
        } else {
            return 0.00;
        }
    }

    public function modifyEmpAdvance($empId, $advAmt) {

        $wh = [
            'EmployeeID' => $empId
        ];
        $q = $this->db->get_where('employeeadvance', $wh);
        if ($q->num_rows() == 1) {
            $row = $q->row_array();
            $advReceived = $row['AdvanceReceived'];
            $advPaid = $row['AdvancePaid'];
            $advBal = $row['AdvanceBalance'];
            $advReceived = $advReceived - $advAmt;
            $advBalance = $advReceived - $advPaid;

            $update = [
                'AdvanceReceived' => $advReceived,
                'AdvanceBalance' => $advBalance,
                'UpdatedAt' => date('Y-m-d')
            ];

            $this->db->update('employeeadvance', $update, $wh);
        }
    }

    public function updateEmpAdvance($data) {

        $empId = $data['EmployeeID'];
        $advAmt = $data['AdvanceAmount'];

        $wh = [
            'EmployeeID' => $empId
        ];
        $q = $this->db->get_where('employeeadvance', $wh);
        if ($q->num_rows() == 1) {
            $row = $q->row_array();
            $advReceived = $row['AdvanceReceived'];
            $advPaid = $row['AdvancePaid'];
            $advBal = $row['AdvanceBalance'];
            $advReceived = $advReceived + $advAmt;
            $advBalance = $advReceived - $advPaid;

            $update = [
                'AdvanceReceived' => $advReceived,
                'AdvanceBalance' => $advBalance,
                'UpdatedAt' => date('Y-m-d')
            ];

            $this->db->update('employeeadvance', $update, $wh);
        } else {
            $insertNew = [
                'EmployeeID' => $empId,
                'AdvanceReceived' => $advAmt,
                'AdvancePaid' => 0.00,
                'AdvanceBalance' => $advAmt,
                'CreatedAt' => date('Y-m-d'),
                'UpdatedAt' => date('Y-m-d')
            ];
            $this->db->insert('employeeadvance', $insertNew);
        }
    }

    public function supplyAdvanceTaken($empId) {
        $wh = [
            'EmployeeID' => $empId
        ];

        $q = $this->db->get_where('employeeadvance', $wh);
        if ($q->num_rows() == 1) {
            return $q->row_array();
        } else {
            return [];
        }
    }

    public function recoverAdvance($empId, $advAmt, $vNo) {
        $wh = [
            'EmployeeID' => $empId
        ];

        $q = $this->db->get_where('employeeadvance', $wh);
        if ($q->num_rows() == 1) {
            $row = $q->row_array();
            $advTaken = $row['AdvanceReceived'];
            $prevPaid = $row['AdvancePaid'];
            $advBalance = $row['AdvanceBalance'];

            if ($advAmt > $advBalance) {
                //nothing to do
            } else {
                $newAdvPaid = $prevPaid + $advAmt;
                $advBalance = $advTaken - $newAdvPaid;
                $update = [
                    'AdvancePaid' => $newAdvPaid,
                    'AdvanceBalance' => $advBalance,
                    'UpdatedAt' => date('Y-m-d')
                ];
                $this->db->update('employeeadvance', $update, $wh);
                $this->createRecoveryAdvanceSalaryVoucher($vNo, $advAmt);
            }
        } else {
            //nothing to do
        }
    }

    public function createRecoveryAdvanceSalaryVoucher($vNo, $amount) {
        //get salary ledger id
        $l1 = $this->getSalaryLedgerId();
        //get salary advance ledger
        $l2 = $this->getSalaryAdvanceLedgerId();

        $data = [];
        //ledger entry
        $d1 = [
            'LedgerID' => $l1,
            'VNo' => $vNo,
            'Vtype' => 'journal',
            'VDate' => date('Y-m-d'),
            'Narration' => 'TO SALARY ADVANCE A/C ' . $amount . ' BY SALARY A/C ' . $amount,
            'Debit' => $amount,
            'Credit' => 0.00,
            'IsPosted' => 1,
            'CreatedBy' => 1,
            'CreatedAt' => date('Y-m-d'),
            'UpdatedBy' => 1,
            'UpdatedAt' => date('Y-m-d'),
            'IsAppoved' => 1
        ];

        $d2 = [
            'LedgerID' => $l2,
            'VNo' => $vNo,
            'Vtype' => 'journal',
            'VDate' => date('Y-m-d'),
            'Narration' => 'BY SALARY A/C ' . $amount . ' TO SALARY ADVANCE A/C ' . $amount,
            'Debit' => 0.00,
            'Credit' => $amount,
            'IsPosted' => 1,
            'CreatedBy' => 1,
            'CreatedAt' => date('Y-m-d'),
            'UpdatedBy' => 1,
            'UpdatedAt' => date('Y-m-d'),
            'IsAppoved' => 1
        ];

        array_push($data, $d1);
        array_push($data, $d2);

        $this->db->insert_batch('acc_transaction', $data);
    }

    public function getSalaryLedgerId() {
        $wh = [
            'IsSalary' => 1
        ];

        $q = $this->db->get_where('ledger', $wh);
        if ($q->num_rows() == 1) {
            $row = $q->row_array();
            return $row['ID'];
        } else {
            return 0;
        }
    }

    public function getSalaryAdvanceLedgerId() {
        $wh = [
            'IsSalaryAdvance' => 1
        ];

        $q = $this->db->get_where('ledger', $wh);
        if ($q->num_rows() == 1) {
            $row = $q->row_array();
            return $row['ID'];
        } else {
            return 0;
        }
    }

}
