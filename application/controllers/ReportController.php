<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ReportController extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('TestModel', 'test');
        $this->load->model('PatientRegistrationModel', 'pr');
        $this->load->model('ReceiptModel', 'receipt');
        $this->load->model('ReportModel', 'report');
        $this->load->model('SettingsModel', 'settings');
    }

    public function index() {
        $data = [
            'pendingReports' => $this->receipt->supplyPendingReports()
        ];
        //echo '<pre>';
        //print_r($data);
        //exit();
        $this->load->view("Report/ReportView", $data);
    }

    public function generateReport($receiptNo) {
        if (empty($receiptNo)) {
            redirect(base_url('app/report'));
            exit();
        }

        if (!is_numeric($receiptNo)) {
            redirect(base_url('app/report'));
            exit();
        }

        $ReceiptData = [
            'ReceiptNo' => $receiptNo
        ];

        if ($this->receipt->isExistReceiptNo($ReceiptData, 'receipt')) {
            $data = [
                'tests' => $this->test->supplyTests(),
                'receiptNo' => $receiptNo,
                'pendingReports' => $this->receipt->supplyPendingReports()
            ];
            //echo '<pre>';
            //print_r($data);
            //exit();
            $this->load->view("Report/ReportView", $data);
        } else {
            redirect(base_url('app/report'));
            exit();
        }
    }

    public function pendingReports() {
        $data = [
            'pendingReports' => $this->receipt->supplyPendingReports(),
            'rs2' => $this->settings->supplySettings()
        ];


        $this->load->view("Report/PendingReportView", $data);
    }

    public function completeReports() {
        $data = [
            'completedReports' => $this->receipt->supplyCompletedReports(),
            'rs2' => $this->settings->supplySettings()
        ];

        $this->load->view("Report/CompletedReportView", $data);
    }

    public function getReportTests() {
        $this->form_validation->set_rules('ReceiptNo', 'ReceiptNo', 'trim|required|min_length[1]|max_length[11]|integer');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $where = [
                'ReceiptNo' => html_escape(strip_tags($this->input->post('ReceiptNo')))
            ];
            $result = $this->report->supplyReportTests($where);

            if (!empty($result)) {
                $data['result'] = $result;
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function getReportParticulars() {
        $this->form_validation->set_rules("TestID", "TestID", "trim|required|integer|min_length[1]|max_length[11]");
        $this->form_validation->set_rules('ReceiptNo', 'ReceiptNo', 'trim|required|min_length[1]|max_length[11]|integer');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $whereTest = [
                "TestID" => $this->input->post("TestID")
            ];

            $whereReceipt = [
                "ReceiptNo" => $this->input->post("ReceiptNo")
            ];
            $result = $this->report->supplyTestParticulars($whereTest, $whereReceipt);
            if ($result !== FALSE) {
                $data['status'] = 1;
                $data['result'] = $result;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function saveBill() {

        $this->form_validation->set_rules('ReceiptNo', 'ReceiptNo', 'trim|required|min_length[1]|max_length[50]|is_unique[receipt.ReceiptNo]');
        $this->form_validation->set_rules('PatientName', 'PatientName', 'trim|required|alpha_numeric_spaces|min_length[1]|max_length[50]');
        $this->form_validation->set_rules('Age', 'Age', 'trim|required|integer|min_length[1]|max_length[4]');
        $this->form_validation->set_rules('Gender', 'Gender', 'trim|required|integer|min_length[1]|max_length[4]');
        $this->form_validation->set_rules('MobileNo', 'MobileNo', 'trim|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('Adddress', 'Adddress', 'trim|min_length[1]|max_length[191]');
        $this->form_validation->set_rules('TotalAmount', 'TotalAmount', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('DueAmount', 'DueAmount', 'trim|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('Discount', 'Discount', 'trim|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('NetAmount', 'NetAmount', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('PaidAmount', 'PaidAmount', 'trim|integer|min_length[1]|max_length[11]');

        $this->form_validation->set_error_delimiters('', '');

        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {

            //patient data validation 
            if ($this->input->post('MobileNo')) {
                $mobileNo = $this->input->post('MobileNo');
            } else {
                $mobileNo = 0;
            }

            if ($this->input->post('Adddress')) {
                $address = $this->input->post('Adddress');
            } else {
                $address = 'NA';
            }

            $DataPatient = [
                'PatientName' => html_escape(strip_tags($this->input->post('PatientName'))),
                'Age' => html_escape(strip_tags($this->input->post('Age'))),
                'MobileNo' => $mobileNo,
                'Gender' => html_escape(strip_tags($this->input->post('Gender'))),
                'CreatedAt' => date('Y-m-d'),
                'UpdatedAt' => date('Y-m-d'),
                'Address' => $address
            ];




            if ($this->input->post('tests')) {
                $tests = $this->input->post('tests');
            } else {
                $tests = [];
            }

            if ($this->input->post('DueAmount') == 0) {
                $isPaid = 1;
                $isPartialPaid = 0;
            } else {
                $isPaid = 0;
                $isPartialPaid = 1;
            }

            //tests 
            if (empty($tests)) {
                $data['status'] = 0;
                $data['error'] = "Please add a test !!";
                echo json_encode($data);
                exit();
            }




            $DataBill = [
                'ReceiptNo' => html_escape(strip_tags($this->input->post('ReceiptNo'))),
                'ReceiptDate' => date('Y-m-d'),
                'ReceiptTime' => date('Y-m-d h:i:s'),
                'TotalAmount' => html_escape(strip_tags($this->input->post('TotalAmount'))),
                'Discount' => html_escape(strip_tags($this->input->post('Discount'))),
                'NetAmount' => html_escape(strip_tags($this->input->post('NetAmount'))),
                'PaidAmount' => html_escape(strip_tags($this->input->post('PaidAmount'))),
                'DueAmount' => html_escape(strip_tags($this->input->post('DueAmount'))),
                'IsPaid' => $isPaid,
                'IsPartialPaid' => $isPartialPaid,
                'IsPrinted' => 0,
                'CreatedAt' => date('Y-m-d'),
                'UpdatedAt' => date('Y-m-d')
            ];

            $DataBill = $this->security->xss_clean($DataBill);
            $DataPatient = $this->security->xss_clean($DataPatient);
            if ($this->receipt->isSavedBill($DataBill, $DataPatient, $tests)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function getPatientInfo() {

        $this->form_validation->set_rules('ReceiptNo', 'ReceiptNo', 'trim|required|min_length[1]|max_length[11]|integer');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $where = [
                'ReceiptNo' => $this->input->post('ReceiptNo')
            ];

            $result = $this->report->supplyPatientInfo($where);

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

    public function editTest() {
        $this->form_validation->set_rules('TestID', 'TestID', 'trim|required|integer|min_length[1]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $where = [
                'ID' => html_escape(strip_tags($this->input->post('TestID')))
            ];
            $result = $this->test->supplyTest($where);
            if ($result != FALSE) {
                $data['status'] = 1;
                $data['result'] = $result;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function updateTest() {
        $this->form_validation->set_rules('TestID', 'TestID', 'trim|required|integer|min_length[1]|max_length[25]');
        $this->form_validation->set_rules('CategoryID', 'CategoryID', 'trim|required|integer|min_length[1]|max_length[25]');
        $this->form_validation->set_rules('ReportHeading', 'ReportHeading', 'trim|required|alpha_numeric_spaces|min_length[1]|max_length[50]');
        $this->form_validation->set_rules('Charge', 'Charge', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('CarryOut', 'CarryOut', 'trim|alpha_numeric_spaces|min_length[1]|max_length[50]');
        $this->form_validation->set_rules('ReportTiming', 'ReportTiming', 'trim|min_length[1]|alpha_numeric_spaces|max_length[50]');
        $this->form_validation->set_rules('TypeID', 'TypeID', 'trim|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('IsActive', 'IsActive', 'trim|integer|min_length[1]|max_length[1]');
        $this->form_validation->set_rules('Remarks', 'Remarks', 'trim|alpha_numeric_spaces|min_length[1]|max_length[50]');
        $this->form_validation->set_error_delimiters('', '');

        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            if ($this->input->post('IsActive') == 1) {
                $isActive = 1;
            } else {
                $isActive = 0;
            }

            $where = [
                'ID' => html_escape(strip_tags($this->input->post('TestID')))
            ];

            $DataTest = [
                'CategoryID' => html_escape(strip_tags($this->input->post('CategoryID'))),
                'ReportHeading' => html_escape(strip_tags($this->input->post('ReportHeading'))),
                'Charge' => html_escape(strip_tags($this->input->post('Charge'))),
                'CarryOut' => html_escape(strip_tags($this->input->post('CarryOut'))),
                'ReportTiming' => html_escape(strip_tags($this->input->post('ReportTiming'))),
                'Remarks' => html_escape(strip_tags($this->input->post('Remarks'))),
                'TypeID' => html_escape(strip_tags($this->input->post('TypeID'))),
                'IsActive' => $isActive,
                'IsDeleted' => 0,
                'AddedBy' => 1,
                'UpdatedAt' => date('Y-m-d')
            ];

            $where = $this->security->xss_clean($where);
            $DataTest = $this->security->xss_clean($DataTest);
            if ($this->test->isUpdated($DataTest, $where)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function deleteTest() {
        $this->form_validation->set_rules('TestID', 'TestID', 'trim|required|min_length[1]|max_length[11]|integer');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $where = [
                'ID' => html_escape(strip_tags($this->input->post('TestID')))
            ];
            if ($this->test->isDeletedTest($where)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function saveTestResult() {
        $this->form_validation->set_rules('ReceiptNo', 'ReceiptNo', 'trim|required|min_length[1]|max_length[18]|integer');
        $this->form_validation->set_rules('TestID', 'TestID', 'trim|required|min_length[1]|max_length[11]|integer');
        $this->form_validation->set_rules('PatientID', 'PatientID', 'trim|required|min_length[1]|max_length[11]|integer');
        $this->form_validation->set_rules('CategoryID', 'CategoryID', 'trim|required|min_length[1]|max_length[11]|integer');

        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
            exit();
        } else {
            $where = [
                "ReceiptNo" => $this->input->post("ReceiptNo"),
                "TestID" => $this->input->post("TestID"),
                "PatientID" => $this->input->post("PatientID")
            ];

            //getting category id
            $categoryId = $this->input->post("CategoryID");

            $DataResult = [];
            if ($this->input->post('Results')) {
                $result = $this->input->post('Results');
                $length = count($result);
                foreach ($result as $r) {
                    $temp = [];
                    $temp['ReceiptNo'] = $where['ReceiptNo'];
                    $temp['CategoryID'] = $categoryId;
                    $temp['TestID'] = $r['TestID'];
                    $temp['PatientID'] = $where['PatientID'];
                    $temp['NormalValue'] = $r['NormalValue'];
                    $temp['ParticularsID'] = $r['ParticularsID'];
                    $temp['TestParticulars'] = $r['TestParticulars'];
                    $temp['Result'] = $r["Result"];
                    $temp['Units'] = $r['Units'];
                    $temp['IsAbnormal'] = $r['IsAbnormal'];
                    $temp['AddedBy'] = 1;
                    $temp['Status'] = 1;
                    $temp['CreatedAt'] = date('Y-m-d');
                    $temp['UpdatedAt'] = date('Y-m-d');

                    array_push($DataResult, $temp);
                }
            }

            $result = $this->report->isSavedTestResult($DataResult, $where);
            if ($result) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function searchReport() {
        $this->load->view("Report/SearchReportView");
    }

    public function getSearchReports() {
        $this->form_validation->set_rules('MRNo', 'MRNo', 'trim|required|alpha_numeric|min_length[1]|max_length[91]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $mrNo = html_escape(strip_tags($this->input->post("MRNo")));

            $where = [
                "MRNo" => $mrNo
            ];

            $result = $this->report->supplySearchReports($where);
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

}
