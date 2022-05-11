<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /*
     * @return today bills count
     */

    public function supplyTodayBills() {
        $this->db->select();
        $this->db->from('receipt');
        $this->db->where(['ReceiptDate' => date('Y-m-d')]);
        $count = $this->db->count_all_results();
        return $count;
    }

    /*
     * $return today patient visit
     */

    public function supplyTodayPatientVisits() {
        $wh = [
            'patient.CreatedAt'=> date('Y-m-d')
        ];
        $this->db->select('MRNo,FirstName,LastName,ReceiptNo,IsReportGenerated');
        $this->db->from('patient');
        $this->db->join('receipt','receipt.PatientID = patient.ID','left');
        $this->db->where($wh);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return [];
        }
    }

    /*
     * @return patient count for today
     */

    public function countDayPatients() {
        $this->db->select();
        $this->db->from('patient');
        $this->db->where(['CreatedAt' => date('Y-m-d')]);
        $count = $this->db->count_all_results();
        return $count;
    }

    public function supplyNextVisits($wh){
        $this->db->select('MRNo,FirstName,LastName,ReceiptNo,IsReportGenerated');
        $this->db->from('patient');
        $this->db->join('receipt','receipt.PatientID = patient.ID','left');
        $this->db->where($wh);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return [];
        }
    }

    public function countNextDayPatients($wh){
        $this->db->select();
        $this->db->from('patient');
        $this->db->where($wh);
        $count = $this->db->count_all_results();
        return $count;
    }

    public function supplyPreviousVisits($wh){
        $this->db->select('MRNo,FirstName,LastName,ReceiptNo,IsReportGenerated');
        $this->db->from('patient');
        $this->db->join('receipt','receipt.PatientID = patient.ID','left');
        $this->db->where($wh);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return [];
        }
    }

    public function countPreviousDayPatients($wh){
        $this->db->select();
        $this->db->from('patient');
        $this->db->where($wh);
        $count = $this->db->count_all_results();
        return $count;
    }


    public function supplyTodayCompletedReport($wh){
       

        $this->db->select('MRNo,ReceiptNo,IsReportGenerated');
        $this->db->from('receipt');
        $this->db->join('patient','patient.ID = receipt.PatientID','inner');
        $this->db->where($wh);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return [];
        }
    }


    public function countCompletedReports($wh){
        $this->db->select();
        $this->db->from('receipt');
        $this->db->where($wh);
        $count = $this->db->count_all_results();
        return $count;

    }

    /*
     * @return total pending reports
     */

    public function supplyPendingReports() {
        $this->db->select();
        $this->db->from('receipt');
        $this->db->where(['IsReportGenerated' => 0]);
        $count = $this->db->count_all_results();
        return $count;
    }

    /*
     * @return completed reports
     */

    public function supplyCompletedReports() {
        $this->db->select();
        $this->db->from('receipt');
        $this->db->where(['IsReportGenerated' => 1]);
        $count = $this->db->count_all_results();
        return $count;
    }

    public function supplyMonthlyIncome() {
        $this->db->select_sum('PaidAmount');
        $this->db->from('receipt');
        $monthLastDate = date('Y-m-d', strtotime('last day of previous month'));
        $currentDate = date('Y-m-d');


        $where = [
            'ReceiptDate >=' => $monthLastDate,
            'ReceiptDate <=' => $currentDate
        ];


        $this->db->where($where);
        $query = $this->db->get();
        $row = $query->row_array();
        return $row['PaidAmount'];
    }

    //for sales and expenses graph
    public function lastFiveMonthIncome() {

        //for first month
        $monthLastDate = date('Y-m-d', strtotime('last day of previous month'));
        $currentDate = date('Y-m-d');

        $d1 = $this->getSales($monthLastDate, $currentDate);
        $e1 = $this->getExpenses($monthLastDate, $currentDate);

        $data[0] = ['sales' => $d1, 'expenses' => $e1];

        //for second month
        $currentDate = $monthLastDate;
        $t1 = new DateTime($monthLastDate);
        $t1->modify('last day of previous month');
        $monthLastDate = $t1->format('Y-m-d');
        $d2 = $this->getSales($monthLastDate, $currentDate);
        $e2 = $this->getExpenses($monthLastDate, $currentDate);

        $data[1] = ['sales' => $d2, 'expenses' => $e2];

        //for third month
        $currentDate = $monthLastDate;
        $t2 = new DateTime($monthLastDate);
        $t2->modify('last day of previous month');
        $monthLastDate = $t2->format('Y-m-d');
        $d3 = $this->getSales($monthLastDate, $currentDate);
        $e3 = $this->getExpenses($monthLastDate, $currentDate);

        $data[2] = ['sales' => $d3, 'expenses' => $e3];

        //for fourth month
        $currentDate = $monthLastDate;
        $t3 = new DateTime($monthLastDate);
        $t3->modify('last day of previous month');
        $monthLastDate = $t3->format('Y-m-d');
        $d4 = $this->getSales($monthLastDate, $currentDate);
        $e4 = $this->getExpenses($monthLastDate, $currentDate);

        $data[3] = ['sales' => $d4, 'expenses' => $e4];

        //for fifth month
        $currentDate = $monthLastDate;
        $t4 = new DateTime($monthLastDate);
        $t4->modify('last day of previous month');
        $monthLastDate = $t4->format('Y-m-d');
        $d5 = $this->getSales($monthLastDate, $currentDate);
        $e5 = $this->getExpenses($monthLastDate, $currentDate);

        $data[4] = ['sales' => $d5, 'expenses' => $e5];


        return $data;
    }

    public function getSales($monthLastDate, $currentDate) {

        $where = [
            'ReceiptDate >=' => $monthLastDate,
            'ReceiptDate <=' => $currentDate
        ];
        $this->db->select_sum('PaidAmount');
        $this->db->from('receipt');
        $this->db->where($where);
        $query = $this->db->get();
        $row = $query->row_array();

        if (!empty($row)) {
            return $row['PaidAmount'];
        } else {
            return 0;
        }
    }
    
    public function getExpenses($monthLastDate, $currentDate) {
        $where = [
            'PaymentDate >=' => $monthLastDate,
            'PaymentDate <=' => $currentDate,
            'IsPaid'=> 1
        ];
        $this->db->select_sum('PayAmount');
        $this->db->from('doctorcommision');
        $this->db->where($where);
        $query = $this->db->get();
        $row = $query->row_array();

        if (!empty($row)) {
            return $row['PayAmount'];
        } else {
            return 0;
        }
    }

    public function supplyMonthlyExpenses() {
        $this->db->select_sum('PayAmount');
        $this->db->from('doctorcommision');

        $monthLastDate = date('Y-m-d', strtotime('last day of previous month'));
        $currentDate = date('Y-m-d');


        $where = [
            'PaymentDate >=' => $monthLastDate,
            'PaymentDate <=' => $currentDate
        ];


        $this->db->where($where);
        $query = $this->db->get();
        $row = $query->row_array();
        return $row['PayAmount'];
    }

    /*
     * @select tests count with group by
     */

    public function testsCount() {
        $this->db->select('TestDescription,COUNT(TestDescription) as total');
        $this->db->from('receipttests');

        $this->db->group_by("TestDescription");
        $this->db->order_by('total', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }
    
    public function supplyTodaysTestInvoice(){
        $wh = [
            'ReceiptDate'=> date('Y-m-d')
        ];
        
        $query = $this->db->get_where('receipt',$wh);
        if($query->num_rows() > 0){
             return $query->result_array();
        }else{
            return [];
        }
    }
    
    public function supplyEmployeeAttendance(){
        $wh = [
            'AttendanceDate'=> date('Y-m-d')
        ];
        
        
        $this->db->select('*');
        $this->db->from('employee');
        $this->db->join('employeeattendance','employee.ID = employeeattendance.EmployeeID','left');
        $this->db->join('department','employee.DepartmentID = department.ID','left');
        $this->db->where($wh);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return [];
        }
        
    }
    
    

}
