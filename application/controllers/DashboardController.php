<?php

defined('BASEPATH') or exit('No direct script access allowed');

class DashboardController extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("DashboardModel", 'dashboard');
        $this->load->model("UserModel", 'user');
        $this->load->model('AccountModel', 'account');
    }

    /*
     * data for dashboard 
     * 
     */

    public function index() {

        $todayBills = $this->dashboard->supplyTodayBills();
        $pendingReports = $this->dashboard->supplyPendingReports();
        $completedReports = $this->dashboard->supplyCompletedReports();
        $patientVisits = $this->dashboard->supplyTodayPatientVisits();
        $monthlyIncome = $this->dashboard->supplyMonthlyIncome();
        $monthlyExpenses = $this->dashboard->supplyMonthlyExpenses();
        $testsCount = $this->dashboard->testsCount();
        $userId = $this->session->userdata('id');
        $profile = $this->user->provideProfileImage(1);
        $profit = $monthlyIncome - $monthlyExpenses;
        $profit = number_format($profit, 2, '.', '');

        $data['testsCount'] = $testsCount;
        $data['profile'] = $profile;
        $data['expenses'] = $this->account->getChartExpenses();
        $data['sales'] = $this->account->getChartSales();

        $this->load->view("Application/DashboardView", $data);
    }

    public function provideTodayPatientVisits() {
        $result = $this->dashboard->supplyTodayPatientVisits();

        $count = $this->dashboard->countDayPatients();
        if (!empty($result)) {
            $data['status'] = 1;
            $data['result'] = $result;
            $data['count'] = $count;
            echo json_encode($data);
        } else {
            $data['status'] = -1;
            echo json_encode($data);
        }
    }

    public function provideNextVisits() {
        $this->form_validation->set_rules('CurrentDate', 'CurrentDate', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = -1;
            echo json_encode($data);
        } else {
            $date = $this->input->post('CurrentDate');
            $nextDate = date('Y-m-d', strtotime($date . '+1 day'));
            $wh = [
                'patient.CreatedAt' => $nextDate
            ];

            $result = $this->dashboard->supplyNextVisits($wh);
            $count = $this->dashboard->countNextDayPatients($wh);
            if (!empty($result)) {
                $data['status'] = 1;
                $data['result'] = $result;
                $data['count'] = $count;
                $data['CurrentDate'] = date('dS M Y', strtotime($nextDate));
                echo json_encode($data);
            } else {
                $data['CurrentDate'] = date('dS M Y', strtotime($nextDate));
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function providePreviousVisits() {
        $this->form_validation->set_rules('CurrentDate', 'CurrentDate', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = -1;
            echo json_encode($data);
        } else {
            $date = $this->input->post('CurrentDate');
            $previousDate = date('Y-m-d', strtotime($date . '-1 day'));
            $wh = [
                'patient.CreatedAt' => $previousDate
            ];

            $result = $this->dashboard->supplyPreviousVisits($wh);
            $count = $this->dashboard->countPreviousDayPatients($wh);
            if (!empty($result)) {
                $data['status'] = 1;
                $data['result'] = $result;
                $data['count'] = $count;
                $data['CurrentDate'] = date('dS M Y', strtotime($previousDate));
                echo json_encode($data);
            } else {
                $data['CurrentDate'] = date('dS M Y', strtotime($previousDate));
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function provideTodayCompletedReport() {
        $this->form_validation->set_rules('Submit', 'Submit', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = -1;
            echo json_encode($data);
        } else {
            $wh = [
                'IsReportGenerated' => 1,
                'ReportDate' => date('Y-m-d')
            ];
            $result = $this->dashboard->supplyTodayCompletedReport($wh);


            $count = $this->dashboard->countCompletedReports($wh);
            if (!empty($result)) {
                $data['status'] = 1;
                $data['result'] = $result;
                $data['count'] = $count;
                echo json_encode($data);
            } else {



                $data['status'] = -1;

                echo json_encode($data);
            }
        }
    }

    public function provideTodaysTestInvoice() {
        $this->form_validation->set_rules('Submit', 'Submit', 'trim|required|alpha|min_length[1]|max_length[4]');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = -1;
            echo json_encode($data);
        } else {
            $result = $this->dashboard->supplyTodaysTestInvoice();
            $result = [];

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

    public function provideTodaysEmployeeStatus() {
        $this->form_validation->set_rules('Submit', 'Submit', 'trim|required|alpha|min_length[1]|max_length[4]');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = -1;
            echo json_encode($data);
        } else {
            $result = $this->dashboard->supplyEmployeeAttendance();
            $temp = [];
            foreach ($result as $v) {
                $t['FirstName'] = $v['FirstName'];
                $t['LastName'] = $v['LastName'];
                $t['Department'] = $v['Department'];

                if ($v['Status'] = 'A') {
                    $t['Status'] = 'Absent';
                }
                if ($v['Status'] = 'P') {
                    $t['Status'] = 'Present';
                }
                if ($v['Status'] = 'L') {
                    $t['Status'] = 'Leave';
                }
                if ($v['Status'] = 'S') {
                    $t['Status'] = 'Sunday';
                }
                array_push($temp, $t);
            }

            if (!empty($temp)) {
                $data['status'] = 1;
                $data['result'] = $temp;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

}
