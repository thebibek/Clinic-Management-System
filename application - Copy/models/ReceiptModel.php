<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ReceiptModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function isSavedBill($DataBill, $tests, $DataCommision, $vNo, $paidAmount) {
        $this->db->trans_start();

        $receiptNo = $DataBill['ReceiptNo'];
        $query1 = $this->db->set($DataBill)->get_compiled_insert('receipt');
        $this->db->query($query1);
        $receiptId = $this->db->insert_id();

        //save doctor commision

        $query2 = $this->db->set($DataCommision)->get_compiled_insert('doctorcommision');
        $this->db->query($query2);

        //saving tests
        foreach ($tests as $val) {
            $dataTests = [
                'ReceiptID' => $receiptId,
                'CategoryID' => $val['CategoryID'],
                'TestNo' => $val['TestNo'],
                'TestDescription' => $val['TestDescription'],
                'Charges' => $val['Charges'],
                'ReceiptNo' => $receiptNo
            ];
            $query3 = $this->db->set($dataTests)->get_compiled_insert('receipttests');
            $this->db->query($query3);
        }
        $this->createBillVoucher($vNo, $paidAmount);
        
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function createBillVoucher($vNo, $paidAmt) {
        //salary advance ledger id
        $l1 = $this->provideCashLedgerId();

        //security cash ledger id
        $l2 = $this->provideTestFeeLedgerId();

        $data = [];
        //ledger entry
        $d1 = [
            'LedgerID' => $l1,
            'VNo' => $vNo,
            'Vtype' => 'payment',
            'VDate' => date('Y-m-d'),
            'Narration' => 'TO TEST FEE A/C ' . $paidAmt . ' BY CASH A/C ' . $paidAmt,
            'Debit' => $paidAmt,
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
            'Narration' => 'BY CASH A/C ' . $paidAmt . ' TO TEST FEE A/C ' . $paidAmt,
            'Debit' => 0.00,
            'Credit' => $paidAmt,
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

    public function provideCashLedgerId() {
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
    
    public function provideTestFeeLedgerId(){
        $wh = [
            'IsTestFee'=> 1
        ];
        
        $q = $this->db->get_where('ledger',$wh);
        if($q->num_rows() == 1){
            $row = $q->row_array();
            return $row['ID'];
        }else{
            return 0;
        }
    }

    public function isUpdatedBill($DataBill, $tests, $receiptId, $receiptNo) {
        $this->db->trans_start();

        $wh1 = [
            'ID' => $receiptId
        ];

        $wh2 = [
            'ReceiptID' => $receiptId
        ];

        $query1 = $this->db->set($DataBill)->where($wh1)->get_compiled_update('receipt');
        $this->db->query($query1);

        $set = [
            'IsReportGenerated' => 0,
            'IsPrinted' => 0
        ];

        $query2 = $this->db->set($set)->where($wh1)->get_compiled_update('receipt');
        $this->db->query($query2);

        $this->db->delete('receipttests', $wh2);
        //saving tests
        foreach ($tests as $val) {
            $dataTests = [
                'ReceiptID' => $receiptId,
                'CategoryID' => $val['CategoryID'],
                'TestNo' => $val['TestNo'],
                'TestDescription' => $val['TestDescription'],
                'Charges' => $val['Charges'],
                'ReceiptNo' => $receiptNo
            ];
            $query3 = $this->db->set($dataTests)->get_compiled_insert('receipttests');
            $this->db->query($query3);
        }



        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function isDeleted($where) {
        $this->db->trans_start();
        $this->db->delete('receipttests', $where);

        $set = [
            'IsDeleted' => 1
        ];
        $wh = [
            'ID' => $where['ReceiptID']
        ];
        $query2 = $this->db->set($set)->where($wh)->get_compiled_update('receipt');
        $this->db->query($query2);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function supplyPendingReports() {
        $this->db->select('*,receipt.ID as ReceiptID');
        $this->db->from('receipt');
        $this->db->join('patient', 'patient.ID=receipt.PatientID');
        $where = [
            'receipt.IsReportGenerated' => 0,
            'receipt.IsDeleted' => 0
        ];
        $this->db->where($where);
        $this->db->order_by('receipt.ID', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    public function supplyBills() {
        $this->db->select('*,receipt.ID as ReceiptID');
        $this->db->from('receipt');
        $this->db->join('patient', 'patient.ID = receipt.patientID');
        $where = [
            'receipt.IsDeleted' => 0
        ];
        $this->db->where($where);
        $this->db->order_by('receipt.ID', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    public function supplyCompletedReports() {
        $this->db->select('*,receipt.ID as ReceiptID');
        $this->db->from('receipt');
        $this->db->join('patient', 'patient.ID=receipt.PatientID');
        $this->db->where('receipt.IsReportGenerated', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    public function isExistReceiptNo($data) {
        $query = $this->db->get_where('receipt', $data);
        if ($query->num_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function supplyPrintReceipt($data) {
        $query = $this->db->get_where('receipt', $data);
        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return FALSE;
        }
    }

    public function supplyItems($data) {
        $query = $this->db->get_where('receipttests', $data);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    public function ReceiptDetail($data) {
        $this->db->select('*,doctor.Salutation,doctor.FirstName as DrFirstName,doctor.LastName as DrLastName,doctor.MobileNo as DotorMobile,patient.MobileNo as PatientMobile');
        $this->db->from('receipt');
        $this->db->join('doctor', 'doctor.ID = receipt.DoctorID', 'INNER');
        $this->db->join('patient', 'patient.ID = receipt.PatientID', 'INNER');
        $this->db->where($data);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return [];
        }
    }

    public function isSavedDueFee($set, $where) {
        if ($this->db->update('receipt', $set, $where)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
