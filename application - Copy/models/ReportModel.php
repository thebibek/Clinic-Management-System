<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ReportModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function supplyPendingReports() {
        $this->db->select('receipt.ID as ReceiptID,ReceiptNo,ReceiptDate,IsPrinted,patient.PatientName');
        $this->db->from('receipt');
        $this->db->join('patient', 'patient.ID=receipt.PatientID');
        $where = [
            'receipt.IsReportGenerated'=>0,
            'receipt.IsDeleted'=>0
        ];
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    public function isExistReceiptNo($data, $tableName) {
        $query = $this->db->get_where($tableName, $data);
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function supplyReportReceipt($data) {
        $query = $this->db->get_where('receipt', $data);
        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function supplyReportTests($data) {
        $row = $this->supplyReportReceipt($data);
        if ($row != false) {
            //array containg receipt ID
            $where = [
                'ReceiptID' => $row['ID']
            ];

            //get all test against receipt id
            $query = $this->db->get_where('receipttests', $where);
            if ($query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return [];
            }
        } else {
            return [];
        }
    }

    public function supplyTestParticulars($dataTest, $dataReceipt) {
        $this->db->select("*,testresult.Result as Result,testresult.IsAbnormal as IsAbnormal");
        $this->db->from("testresult");
        $this->db->join("testparticulars", 'testparticulars.ID=testresult.ParticularsID');
        $this->db->join('patient', 'patient.ID=testresult.PatientID');
        $this->db->where(['testresult.TestID' => $dataTest['TestID'], 'testresult.ReceiptNo' => $dataReceipt['ReceiptNo']]);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {


            return $query->result_array();
        } else {

            $row = $this->supplyReportReceipt($dataReceipt);
            if ($row != false) {
                //getting receipt id
                $receiptId = $row['ID'];

                $this->db->select("*,testparticulars.ID as ParticularsID");
                $this->db->from("testparticulars");
                $this->db->join("receipttests", 'receipttests.TestNo = testparticulars.TestID');
                $this->db->join("receipt", "receipt.ID = receipttests.ReceiptID");
                $this->db->join("patient", "patient.ID = receipt.PatientID");
                $this->db->where(['receipttests.TestNo' => $dataTest['TestID'], 'receipttests.ReceiptID' => $receiptId]);
                $query = $this->db->get();
                if ($query->num_rows() > 0) {
                    return $query->result_array();
                } else {
                    return [];
                }
            } else {
                return [];
            }
        }
    }

    public function supplyPatientInfo($where) {
        $this->db->select('*');
        $this->db->from('receipt');
        $this->db->join('patient', 'patient.ID=receipt.PatientID');
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    public function isSavedTestResult($data, $where) {
        $this->db->trans_start();
        $this->db->delete('testresult', $where);
        foreach ($data as $d) {
            $query1 = $this->db->set($d)->get_compiled_insert('testresult');
            $this->db->query($query1);
        }

        $receiptNo = $where['ReceiptNo'];
        $testId = $where['TestID'];


        //update the IsReportGenerated field 1 of receipt table 
        $set = [
            'IsReportGenerated' => 1,
            'ReportDate'=> date('Y-m-d')
        ];


        $wh = [
            'ReceiptNo' => $receiptNo
        ];

        $query2 = $this->db->set($set)->where($wh)->get_compiled_update('receipt');
        $this->db->query($query2);
        
        //update  receipt tests for report made for particular test
        $set1 = [
            'IsReportMade'=>1
        ];
        $wh1 = [
            'TestNo'=> $testId,
            'ReceiptNo'=> $receiptNo
        ];
        $query3 = $this->db->set($set1)->where($wh1)->get_compiled_update('receipttests');
        $this->db->query($query3);
        
        $this->db->trans_complete();
        if ($this->db->trans_status() === false) {
            return false;
        } else {
            return true;
        }
    }

    public function supplyPrintReport($data) {
        $this->db->select('*,test.Description as TestName');
        $this->db->from('testresult');
        $this->db->join('category', 'category.ID=testresult.CategoryID');
        $this->db->join('test', 'test.ID=testresult.TestID');
        $this->db->where($data);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }
    
    //get search reports
    public function supplySearchReports($where){
        $this->db->select('*');
        $this->db->from('patient');
        $this->db->join('receipt','receipt.PatientID = patient.ID');
        $this->db->where($where);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return [];
        }
    }

}
