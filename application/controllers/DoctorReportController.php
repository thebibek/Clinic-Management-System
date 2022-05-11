<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class DoctorReportController extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ReportManagerModel', 'report');
    }

    public function monthWiseCommission() {
        $this->form_validation->set_rules('Month', 'Month', 'trim|required|integer|min_length[1]|max_length[3]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $monthNo = html_escape(strip_tags($this->input->post('Month')));
            $result = $this->report->supplyMonthWiseCommission($monthNo);

            $dateObj = DateTime::createFromFormat('!m', $monthNo);
            $monthName = $dateObj->format('F');


            if (!empty($result)) {
                $data = [
                    'result' => $result,
                    'month' => $monthNo,
                    'monthName' => $monthName
                ];

                echo $html = $this->load->view("ReportManager/MonthWiseCommissionHtml", $data, TRUE);
            } else {
                echo $html = '<span class="text-red">No Records Found</span>';
            }
        }
    }

    public function monthlyDoctorCommission() {
        $this->form_validation->set_rules('Month', 'Month', 'trim|required|integer|min_length[1]|max_length[3]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        }else{
            $monthNo = html_escape(strip_tags($this->input->post('Month')));
            $dateObj = DateTime::createFromFormat('!m', $monthNo);
            $monthName = $dateObj->format('F');
            
            $wh = [
                'MONTH(PaymentDate)' => $monthNo
            ];
            $result = $this->report->supplyMonthlyDoctorCommission($wh);
            
            if(!empty($result)){
                $data = [
                    'result'=> $result,
                    'month'=> $monthName,
                    'monthName'=> $monthName
                ];
                echo $html = $this->load->view("ReportManager/MonthlyDoctorCommissionHtml",$data,TRUE);
            }else{
                echo $html = '<span class="text-red">No Records Found</span>';
            }
        }
    }

    public function dateWiseDoctorCommission(){
        $this->form_validation->set_rules('Date', 'Date', 'trim|required|min_length[1]|max_length[10]');
        
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        }else{
            $date = html_escape(strip_tags($this->input->post('Date')));
           
            $wh = [
                'PaymentDate' => $date
            ];
            $result = $this->report->supplyDayWiseDoctorCommission($wh);
            
            if(!empty($result)){
                $data = [
                    'result'=> $result,
                    'date'=> $date,
                    
                ];
                echo $html = $this->load->view("ReportManager/DayWiseDoctorCommissionHtml",$data,TRUE);
            }else{
                echo $html = '<span class="text-red">No Records Found</span>';
            }
        }
    }

}
