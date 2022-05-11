<?php

defined('BASEPATH') or exit('No direct script access allowed');

class SalaryModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->model('SalaryAdvanceModel', 'advance');
    }

    public function isAllowanceSaved($data) {
        $where = [
            'AllowanceType' => $data['AllowanceType'],
            'Name' => $data['Name']
        ];

        $query = $this->db->get_where('employeeallowance', $where);
        if ($query->num_rows() == 1) {
            return FALSE;
        }

        if ($this->db->insert('employeeallowance', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function supplyAllowances() {
        $query = $this->db->get('employeeallowance');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    public function supplyAllowanceNames($where) {
        $query = $this->db->get_where('employeeallowance', $where);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    public function isSavedSalaryScheme($dataSalaryScheme, $schemeItems) {
        $this->db->trans_start();
        $query1 = $this->db->set($dataSalaryScheme)->get_compiled_insert('salaryscheme');
        $this->db->query($query1);
        $salarySchemeId = $this->db->insert_id();

        foreach ($schemeItems as $v) {
            $temp = [
                'SalarySchemeID' => $salarySchemeId,
                'AllowanceID' => $v['AllowanceID'],
                'AllowanceType' => $v['AllowanceType'],
                'AllowanceName' => $v['AllowanceName'],
                'SchemeBasedOn' => $v['SchemeBasedOn'],
                'Amount' => $v['Amount'],
                'Formula' => $v['Formula']
            ];

            $query2 = $this->db->set($temp)->get_compiled_insert('salaryschemeallowances');
            $this->db->query($query2);
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function supplySalaryScheme() {
        $query = $this->db->get_where('salaryscheme');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    public function supplyMonthlySalaryScheme($where) {
        //getting  salary scheme of a month of an employee

        $this->db->select('*,salaryscheme.ID as SalarySchemeID');
        $this->db->from('employeesalaryscheme');
        $this->db->join('salaryscheme', 'salaryscheme.ID = employeesalaryscheme.SalarySchemeID', 'inner');
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return [];
        }
    }

    //providing scheme allowances and the sum of scheme allowances
    public function supplyAssignedSchemeAllowance($where) {
        $query = $this->db->get_where('salaryschemeallowances', $where);
        if ($query->num_rows() > 0) {
            $rs = $query->result_array();

            //empty array to add additional value
            $temp['result'] = [];
            $sumAllowances = 0.00;

            foreach ($rs as $v) {
                if ($v['SchemeBasedOn'] == 2) {
                    $v['Allowance'] = $v['Amount'];
                    $sumAllowances += $v['Amount'];
                }

                array_push($temp['result'], $v);
            }

            $sumAllowances = number_format($sumAllowances, 2, '.', '');
            $temp['SumAllowance'] = $sumAllowances;
            return $temp;
        } else {
            return [];
        }
    }

    public function supplyAssignedSchemeDeduction($where) {
        $query = $this->db->get_where('salaryschemeallowances', $where);
        if ($query->num_rows() > 0) {
            $rs = $query->result_array();

            //empty array to add additional value
            $temp['result'] = [];
            $sumDeduction = 0.00;

            foreach ($rs as $v) {
                if ($v['SchemeBasedOn'] == 2) {
                    $v['Deduction'] = $v['Amount'];
                    $sumDeduction += $v['Amount'];
                }

                array_push($temp['result'], $v);
            }

            $sumDeduction = number_format($sumDeduction, 2, '.', '');
            $temp['SumDeduction'] = $sumDeduction;
            return $temp;
        } else {
            return [];
        }
    }

    public function supplyAssignedSchemeContribution($where) {
        $query = $this->db->get_where('salaryschemeallowances', $where);
        if ($query->num_rows() > 0) {
            $rs = $query->result_array();

            //empty array to add additional value
            $temp['result'] = [];
            $sumContribution = 0.00;

            foreach ($rs as $v) {
                if ($v['SchemeBasedOn'] == 2) {
                    $v['Contribution'] = $v['Amount'];
                    $sumContribution += $v['Amount'];
                }

                array_push($temp['result'], $v);
            }

            $sumContribution = number_format($sumContribution, 2, '.', '');
            $temp['SumContribution'] = $sumContribution;
            return $temp;
        } else {
            return [];
        }
    }

    public function isSalarySaved($insert, $empId, $advAmt, $vNo1, $vNo2,$where) {
        $netSalary = $insert['NetSalary'];    
        
        $q1 = $this->db->get_where('salary', $where);
        if ($q1->num_rows() == 1) {
            return FALSE;
        } else {
            $this->db->trans_start();
            $this->db->insert('salary', $insert);
            $this->advance->recoverAdvance($empId, $advAmt, $vNo2);
            $this->createSalaryGenerationVoucher($vNo1,$netSalary);
            $this->db->trans_complete();
            if ($this->db->trans_status() == false) {
                return false;
            } else {
                return true;
            }
        }
    }

    public function createSalaryGenerationVoucher($vNo, $amount) {
        //get salary ledger id
        $l1 = $this->getSalaryLedgerId();

        //get salary payable ledger id
        $l2 = $this->getSalaryPayableLedgerId();
        $data = [];
        //ledger entry
        $d1 = [
        'LedgerID' => $l1,
        'VNo' => $vNo,
        'Vtype' => 'journal',
        'VDate' => date('Y-m-d'),
        'Narration' => 'TO SALARY PAYABLE A/C '.$amount.' BY SALARY A/C '.$amount,
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
        'Narration' => 'BY SALARY PAYABLE A/C '.$amount.' TO SALARY A/C '.$amount,
        'Debit' => 0.00,
        'Credit' => $amount,
        'IsPosted' => 1,
        'CreatedBy' => 1,
        'CreatedAt' => date('Y-m-d'),
        'UpdatedBy' => 1,
        'UpdatedAt' => date('Y-m-d'),
        'IsAppoved' => 1
        ];
        
        array_push($data,$d1);
        array_push($data,$d2);
        
        $this->db->insert_batch('acc_transaction',$data);
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

    public function getSalaryPayableLedgerId() {
        $wh = [
            'IsSalaryPayable' => 1
        ];

        $q = $this->db->get_where('ledger', $wh);
        if ($q->num_rows() == 1) {
            $row = $q->row_array();
            return $row['ID'];
        } else {
            return 0;
        }
    }

    public function supplyEmployeeSalary($salaryMonth, $empCode) {
        $this->db->select('salary.ID as SalaryID,SlipNo
                        ,EmployeeCode
                        ,Salutation
                        ,FirstName
                        ,LastName
                        ,SalaryGeneratedDate
                        ,SalaryMonth
                        ,NetSalary
                        ,EmployeeID
                        ,IsPaid
                        ');
        $this->db->from('salary');
        $this->db->join('employee', 'employee.ID = salary.EmployeeID', 'inner');
        $this->db->or_where('SalaryMonth', $salaryMonth);
        $this->db->or_where('EmployeeCode', $empCode);
        $this->db->where('IsGenerated', 1);
        $this->db->where('IsCancelled', 0);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $temp = [];
            $rw = $query->result_array();
            foreach ($rw as $r) {
                $r['IsChecked'] = 0;
                $r['PaymentMode'] = "";
                $r['BankName'] = "";
                $r['CHQNo'] = "";
                $r['CHQDate'] = date('Y-m-d');
                array_push($temp, $r);
            }
            return $temp;
        } else {
            return [];
        }
    }
    
    public function supplySalarySlip($salaryMonth){
        $wh = [
            'SalaryMonth'=> $salaryMonth,
            'IsPaid'=> 1
        ];
        $this->db->select('
                    salary.ID as SalaryID,
                    Salutation,
                    EmployeeCode,
                    FirstName,
                    LastName,
                    SlipNo,
                    SalaryMonth,
                    GrossSalary,
                    NetSalary,
                    IsPaid
                    
                ');
        $this->db->from('salary');
        $this->db->join('employee','salary.EmployeeID = employee.ID','inner');
        $this->db->where($wh);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return [];
        }
        
    }

    //make payment of salary and insert payment records
    public function isMadePayment($tmp1, $tmp2) {
        $this->db->trans_start();
        $this->db->update_batch('salary', $tmp1, 'ID');
        $this->db->insert_batch('salarypayment', $tmp2);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    //delete salary scheme
    public function isDeletedScheme($schemeId) {
        $wh1 = [
            'SalarySchemeID' => $schemeId
        ];

        $q1 = $this->db->get_where('employeesalaryscheme', $wh1);
        if ($q1->num_rows() > 0) {
            return false;
        } else {
            $wh2 = [
                'ID' => $schemeId
            ];
            if ($this->db->delete('salaryscheme', $wh2)) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function supplySingleScheme($wh) {
        $q = $this->db->get_where('salaryscheme', $wh);
        if ($q->num_rows() == 1) {
            return $q->row_array();
        } else {
            return [];
        }
    }

    public function supplySchemeItems($wh) {
        $q = $this->db->get_where('salaryschemeallowances', $wh);
        if ($q->num_rows() > 0) {
            return $q->result_array();
        } else {
            return [];
        }
    }

    public function isUpdatedSalaryScheme($update, $items, $schemeId) {
        $temp = [];
        $wh1 = ['ID' => $schemeId];
        $wh2 = ['SalarySchemeID' => $schemeId];
        foreach ($items as $v) {

            $t['SalarySchemeID'] = $schemeId;
            $t['AllowanceID'] = $v['AllowanceID'];
            $t['AllowanceType'] = $v['AllowanceType'];
            $t['AllowanceName'] = $v['AllowanceName'];
            $t['SchemeBasedOn'] = $v['SchemeBasedOn'];
            if ($v['SchemeBasedOn'] == 1) {
                $t['Amount'] = 0.00;
                $t['Formula'] = $v['Formula'];
                $t['BS'] = $v['BS'];
                $t['Symbol'] = $v['Symbol'];
                $t['value'] = $v['Value'];
            } else {
                $t['Amount'] = $v['Amount'];
                $t['Formula'] = 'NA';
                $t['BS'] = 'BS';
                $t['Symbol'] = 'NA';
                $t['value'] = '0.00';
            }

            array_push($temp, $t);
        }

        $this->db->trans_start();
        $this->db->update('salaryscheme', $update, $wh1);
        $this->db->delete('salaryschemeallowances', $wh2);
        $this->db->insert_batch('salaryschemeallowances', $temp);
        $this->db->trans_complete();
        if ($this->db->trans_status() == false) {
            return false;
        } else {
            return true;
        }
    }
    
    public function supplySlipDetail($salaryId){
        $wh = [
            'salary.ID' => $salaryId 
        ];
        
        $this->db->select('*');
        $this->db->from('salary');
        $this->db->join('employee','salary.EmployeeID = employee.ID','inner');
        $this->db->join('department','employee.DepartmentID = department.ID','inner');
        $this->db->join('designation','employee.DesignationID = designation.ID','inner');
        $this->db->where($wh);
        $query = $this->db->get();
        if($query->num_rows() == 1){
            return $query->row_array();
        }else{
            return [];
        }
    }
    
    public function provideSchemeId($empId, $salaryMonth){
        $wh = [
            'EmployeeID'=> $empId,
            'SalaryMonth'=> $salaryMonth
        ];
        
        $q = $this->db->get_where('employeesalaryscheme',$wh);
        if($q->num_rows() == 1){
            $row = $q->row_array();
            return $row['SalarySchemeID'];
        }else{
            return 0;
        }
    }
    
    
    public function isDeletedSalary($salaryId){
        $wh1 = [
            'ID'=> $salaryId
        ];
        
        $wh2 = [
            'SalaryID'=> $salaryId
        ];
        
        $this->db->trans_start();
        $this->db->delete('salary',$wh1);
        $this->db->delete('salarypayment',$wh2);
        $this->db->trans_complete();
        
        if($this->db->trans_status() == false){
            return false;
        }else{
            return true;
        }
    }

}
