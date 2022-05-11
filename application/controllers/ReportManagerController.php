<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ReportManagerController extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ReportManagerModel', 'report');
    }

    public function patientReport() {
        $this->load->view("Patient/PatientReportView");
    }

    public function getMonthlyPatientVisits() {
        $this->form_validation->set_rules('Month', 'Month', 'trim|required|integer|min_length[1]|max_length[3]');
        $this->form_validation->set_error_delimiters('', '');

        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $monthNo = html_escape(strip_tags($this->input->post('Month')));
            $result = $this->report->supplyMonthWisePatientVisits($monthNo);
            $dateObj = DateTime::createFromFormat('!m', $monthNo);
            $monthName = $dateObj->format('F');

            if (!empty($result)) {
                $data = [
                    'result' => $result,
                    'monthName' => $monthName
                ];
                echo $html = $this->load->view('ReportManager/MonthWiseVisitHtml', $data, TRUE);
            } else {
                echo $html = '<span class="text-red">No Records Found</span>';
            }
        }
    }

    public function getMonthlyCollection() {
        $this->form_validation->set_rules('Month', 'Month', 'trim|required|integer|min_length[1]|max_length[3]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == false) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $monthNo = html_escape(strip_tags($this->input->post('Month')));
            $result = $this->report->supplyMonthlyCollection($monthNo);

            $dateObj = DateTime::createFromFormat('!m', $monthNo);
            $monthName = $dateObj->format('F');
            if (!empty($result)) {
                $data = [
                    'result' => $result,
                    'monthName' => $monthName
                ];
                echo $html = $this->load->view('ReportManager/MonthWiseCollectionHtml', $data, TRUE);
            } else {
                echo $html = '<span class="text-red">No Records Found</span>';
            }
        }
    }

    public function getDateVisits() {
        $this->form_validation->set_rules('Date', 'Date', 'trim|required|min_length[1]|max_length[10]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == false) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $date = $this->input->post('Date');

            $wh = [
                'ReceiptDate' => $date
            ];

            $wh = $this->security->xss_clean($wh);

            $result = $this->report->supplyDateVisits($wh);
            $time = strtotime($date);
            $month = date("F", $time);
            if (!empty($result)) {
                $data = [
                    'result' => $result,
                    'monthName' => $month
                ];
                echo $html = $this->load->view('ReportManager/DateWiseVisitHtml', $data, TRUE);
            } else {
                echo $html = '<span class="text-red">No Records Found</span>';
            }
        }
    }

    public function billReport() {
        $this->load->view("Bill/BillReportView");
    }

    public function monthBillCollection() {
        $this->form_validation->set_rules('Month', 'Month', 'trim|required|integer|min_length[1]|max_length[2]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == false) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $monthNo = $this->input->post('Month');
            $result = $this->report->supplyBillCollection($monthNo);


            $dateObj = DateTime::createFromFormat('!m', $monthNo);
            $monthName = $dateObj->format('F');

            if (!empty($result)) {
                $data = [
                    'result' => $result,
                    'monthName' => $monthName
                ];
                echo $html = $this->load->view("ReportManager/MonthWiseCollectionView", $data, true);
            } else {
                echo $html = '<span class="text-red">No Records Found</span>';
            }
        }
    }

    public function dateWiseCollection() {
        $this->form_validation->set_rules('Date', 'Date', 'trim|required|min_length[1]|max_length[10]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == false) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $date = $this->input->post('Date');
            $wh = [
                'ReceiptDate' => $date
            ];
            $rs = $this->report->supplyDateWiseCollection($wh);
            $time = strtotime($date);
            $month = date("F", $time);
            if (!empty($rs)) {
                $data = [
                    'result' => $rs,
                    'monthName' => $month
                ];

                echo $html = $this->load->view("ReportManager/DateWiseCollectionView", $data, true);
            } else {
                echo $html = '<span class="text-red">No Records Found</span>';
            }
        }
    }

    public function pathoReport() {
        $this->load->view("Report/PathoReportView");
    }

    public function monthlyCompletedReport() {
        $this->form_validation->set_rules('Month', 'Month', 'trim|required|integer|min_length[1]|max_length[2]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == false) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $month = $this->input->post('Month');
            $result = $this->report->supplyMonthlyCompletedReport($month);

            $obj = DateTime::createFromFormat('!m', $month);
            $monthName = $obj->format('F');

            if (!empty($result)) {
                $data = [
                    'result' => $result,
                    'monthName' => $monthName
                ];

                echo $html = $this->load->view("ReportManager/MonthlyCompletedReportHtml", $data, true);
            } else {
                echo $html = '<span class="text-red">No Records Found</span>';
            }
        }
    }

    public function monthlyPendingReport() {
        $this->form_validation->set_rules('Month', 'Month', 'trim|required|integer|min_length[1]|max_length[2]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == false) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $month = $this->input->post('Month');
            $result = $this->report->supplyMonthlyPendingReport($month);

            $obj = DateTime::createFromFormat('!m', $month);
            $monthName = $obj->format('F');

            if (!empty($result)) {
                $data = [
                    'result' => $result,
                    'monthName' => $monthName
                ];

                echo $html = $this->load->view("ReportManager/MonthlyPendingReportHtml", $data, true);
            } else {
                echo $html = '<span class="text-red">No Records Found</span>';
            }
        }
    }

    public function currentCompletedReport() {
        $this->form_validation->set_rules('Date', 'Date', 'trim|required|min_length[1]|max_length[10]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == false) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $date = $this->input->post('Date');
            $wh = [
                'ReceiptDate' => $date
            ];
            $rs = $this->report->supplyCurrentCompletedReport($wh);

            $time = strtotime($date);
            $monthName = date('F', $time);

            if (!empty($rs)) {
                $data = [
                    'result' => $rs,
                    'monthName' => $monthName
                ];
                echo $html = $this->load->view("ReportManager/CurrentCompletedReportHtml", $data, true);
            } else {
                echo $html = '<span class="text-red">No Records Found</span>';
            }
        }
    }

    public function currentPendingReport() {
        $this->form_validation->set_rules('Date', 'Date', 'trim|required|min_length[1]|max_length[10]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == false) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $date = $this->input->post('Date');
            $wh = [
                'ReceiptDate' => $date
            ];
            $rs = $this->report->supplyCurrentPendingReport($wh);

            $time = strtotime($date);
            $monthName = date('F', $time);

            if (!empty($rs)) {
                $data = [
                    'result' => $rs,
                    'monthName' => $monthName
                ];
                echo $html = $this->load->view("ReportManager/CurrentPendingReportHtml", $data, true);
            } else {
                echo $html = '<span class="text-red">No Records Found</span>';
            }
        }
    }

}
