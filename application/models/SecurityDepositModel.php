<?php

defined('BASEPATH') or exit('No direct script access allowed');

class SecurityDepositModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function isSavedSecurityDeposit($insert, $update, $wh, $vNo) {
        $amtDeposited = $update['AmountDeposited'];
        $paidAmt = $update['AmountPaid'];
        if ($this->db->insert('securitydeposit', $insert)) {
            $this->db->select('AmountDeposited,AmountPaid,DueAmount');
            $this->db->from('securityamountdue');
            $this->db->where($wh);
            $query = $this->db->get();
            if ($query->num_rows() == 1) {
                $rw = $query->row_array();
                $amtDeposited = $amtDeposited + $rw['AmountDeposited'];
                $amtPaid = $paidAmt + $rw['AmountPaid'];
                $amtDue = $amtDeposited - $amtPaid;
                $amtDue = number_format($amtDue, 2, '.', '');
                $d1 = [
                    'AmountDeposited' => $amtDeposited,
                    'AmountPaid' => $amtPaid,
                    'DueAmount' => $amtDue,
                    'UpdatedAt' => date('Y-m-d')
                ];

                $this->db->trans_start();
                $this->db->update('securityamountdue', $d1, $wh);
                $this->createSecurityDepositVoucher($vNo, $paidAmt);
                $this->db->trans_complete();
                if ($this->db->trans_status() == false) {
                    return false;
                } else {
                    return true;
                }
            } else {
                
                $this->db->trans_start();
                $this->db->insert('securityamountdue', $update);
                $this->createSecurityDepositVoucher($vNo, $paidAmt);
                $this->db->trans_complete();
                if ($this->db->trans_status() == false) {
                    return false;
                } else {
                    return true;
                }
            }
        } else {
            return false;
        }
    }

    public function createSecurityDepositVoucher($vNo, $payAmt) {
        //salary ledger id
        $l1 = $this->provideSalaryLedgerId();

        //security ledger id
        $l2 = $this->provideSecurityDepositLedgerId();

        $data = [];
        //ledger entry
        $d1 = [
            'LedgerID' => $l1,
            'VNo' => $vNo,
            'Vtype' => 'journal',
            'VDate' => date('Y-m-d'),
            'Narration' => 'TO SECURITY DEPOSIT A/C ' . $payAmt . ' BY SALARY A/C ' . $payAmt,
            'Debit' => $payAmt,
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
            'Narration' => 'BY SALARY A/C ' . $payAmt . ' TO SECURITY DEPOSIT A/C ' . $payAmt,
            'Debit' => 0.00,
            'Credit' => $payAmt,
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

    public function provideSecurityDepositLedgerId() {
        $wh = [
            'IsSecurityDeposit' => 1
        ];
        $q = $this->db->get_where('ledger', $wh);
        if ($q->num_rows() == 1) {
            $row = $q->row_array();
            return $row['ID'];
        } else {
            return 0;
        }
    }

    public function provideSalaryLedgerId() {
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

    public function supplySecurityDeposits($wh) {

        $this->db->select('*,securitydeposit.ID as SecurityDepositID');
        $this->db->from('securitydeposit');
        $this->db->join('paymentmode', 'securitydeposit.PaymentMode = paymentmode.ID', 'left');
        $this->db->join('ledger', 'securitydeposit.Bank = ledger.ID', 'left');
        $this->db->where($wh);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    public function isDeletedSecurityDeposited($securityDepositedId, $empId) {
        $wh = [
            'ID' => $securityDepositedId
        ];

        $q = $this->db->get_where('securitydeposit', $wh);
        if ($q->num_rows() == 1) {
            $row = $q->row_array();
            $amtDeposited = $row['TotalAmount'];
            $amtPaid = $row['AmountPaid'];

            $this->db->trans_start();
            $this->db->delete('securitydeposit', $wh);
            $this->modifySecurityAmtDue($empId, $amtDeposited, $amtPaid);
            $this->db->trans_complete();
            if ($this->db->trans_status() == false) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    public function modifySecurityAmtDue($empId, $amtDeposited, $amtPaid) {
        $wh = [
            'EmployeeID' => $empId
        ];

        $q = $this->db->get_where('securityamountdue', $wh);
        if ($q->num_rows() == 1) {
            $row = $q->row_array();
            $amtDeposited = $row['AmountDeposited'] - $amtDeposited;
            $amtPaid = $row['AmountPaid'] - $amtPaid;
            $amtDue = $amtDeposited - $amtPaid;
            $update = [
                'EmployeeID' => $empId,
                'AmountDeposited' => $amtDeposited,
                'AmountPaid' => $amtPaid,
                'DueAmount' => $amtDue,
                'UpdatedAt' => date('Y-m-d')
            ];
            $this->db->update('securityamountdue', $update, $wh);
        }
    }

}
