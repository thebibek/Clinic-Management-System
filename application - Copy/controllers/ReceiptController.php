<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ReceiptController extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('TestModel', 'test');
        $this->load->model('PatientRegistrationModel', 'pr');
        $this->load->model('ReceiptModel', 'receipt');
        $this->load->model('DoctorModel', 'doctor');
        $this->load->model('ReportModel', 'report');
        $this->load->model('SettingsModel', 'settings');
    }

    public function index() {
        $data = [
            'tests' => $this->test->supplyTests(),
            'receiptNo' => $this->getReceiptNo('receipt'),
            'pendingReports' => $this->receipt->supplyPendingReports(),
            'doctors' => $this->doctor->supplyDoctors()
        ];
        //echo '<pre>';
        //print_r($data);
        //exit();
        $this->load->view("Bill/ReceiptView", $data);
    }

    public function saveBill() {

        $this->form_validation->set_rules('ReceiptNo', 'ReceiptNo', 'trim|required|min_length[1]|max_length[50]|is_unique[receipt.ReceiptNo]');
        $this->form_validation->set_rules('DoctorID', 'DoctorID', 'trim|required|integer|min_length[1]|max_length[50]');
        $this->form_validation->set_rules('DoctorCommision', 'DoctorCommision', 'trim|integer|min_length[1]');
        $this->form_validation->set_rules('PatientName', 'Patient Name', 'trim|required|min_length[1]');
        $this->form_validation->set_rules('PatientID', 'PatientID', 'trim|required|integer|min_length[1]|max_length[50]');
        $this->form_validation->set_rules('TotalAmount', 'TotalAmount', 'trim|required|decimal|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('DueAmount', 'DueAmount', 'trim|decimal|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('Discount', 'Discount', 'trim|decimal|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('NetAmount', 'NetAmount', 'trim|required|decimal|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('PaidAmount', 'PaidAmount', 'trim|required|decimal|min_length[1]|max_length[11]');

        $this->form_validation->set_error_delimiters('', '');

        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {

            $patientName = html_escape(strip_tags($this->input->post('PatientName')));
            $doctorId = html_escape(strip_tags($this->input->post('DoctorID')));
            $patientId = html_escape(strip_tags($this->input->post('PatientID')));
            $vNo = $this->getVoucherNo('acc_transaction');

            if ($this->input->post('tests')) {
                $tests = $this->input->post('tests');
            } else {
                $tests = [];
            }

            if ($this->input->post('DueAmount') == 0.00) {
                $isPaid = 1;
                $isPartialPaid = 0;
            } else {
                $isPaid = 0;
                $isPartialPaid = 1;
            }


            $receiptNo = html_escape(strip_tags($this->input->post('ReceiptNo')));
            $paidAmount = html_escape(strip_tags($this->input->post('PaidAmount')));
            $netAmount = html_escape(strip_tags($this->input->post('NetAmount')));
            $flag = html_escape(strip_tags($this->input->post('flag')));

            if ($paidAmount > $netAmount) {
                $paidAmount = $netAmount;
            }



            //tests 
            if (empty($tests)) {
                $data['status'] = 0;
                $data['error'] = "Please add a test !!";
                echo json_encode($data);
                exit();
            }

            //calculate doctor commision 
            $commision = $this->input->post('DoctorCommision');

            if ($commision > 0) {
                $commisionAmount = ($netAmount / 100) * $commision;
                $commisionAmount = number_format((float) $commisionAmount, 2, '.', '');
            } else {
                $commisionAmount = 0.00;
            }

            //doctor commision data 
            $DataCommision = [
                'ReceiptNo' => $receiptNo,
                'PatientID' => $patientId,
                'PatientName' => $patientName,
                'DoctorID' => $doctorId,
                'NetAmount' => $netAmount,
                'CommisionAmount' => $commisionAmount,
                'PayAmount' => $commisionAmount,
                'IsPaid' => 0,
                'CreatedAt' => date('Y-m-d'),
                'UpdatedAt' => date('Y-m-d')
            ];


            $DataBill = [
                'ReceiptNo' => $receiptNo,
                'PatientID' => $patientId,
                'DoctorID' => $doctorId,
                'ReceiptDate' => date('Y-m-d'),
                'ReceiptTime' => date('Y-m-d h:i:s'),
                'TotalAmount' => html_escape(strip_tags($this->input->post('TotalAmount'))),
                'Discount' => html_escape(strip_tags($this->input->post('Discount'))),
                'NetAmount' => $netAmount,
                'PaidAmount' => $paidAmount,
                'DueAmount' => html_escape(strip_tags($this->input->post('DueAmount'))),
                'IsPaid' => $isPaid,
                'IsPartialPaid' => $isPartialPaid,
                'IsPrinted' => 0,
                'CreatedAt' => date('Y-m-d'),
                'UpdatedAt' => date('Y-m-d')
            ];

            $DataBill = $this->security->xss_clean($DataBill);
            $DataCommision = $this->security->xss_clean($DataCommision);

            if ($this->receipt->isSavedBill($DataBill, $tests, $DataCommision, $vNo, $paidAmount)) {
                $data['status'] = 1;
                $data['print'] = 0;
                //for save and print
                if ($flag == 1) {
                    $data['print'] = 1;
                    $data['receiptno'] = $receiptNo;
                }

                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function editBill() {
        $this->form_validation->set_rules('ReceiptID', 'ReceiptID', 'trim|required|integer|min_length[1]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $receiptId = html_escape(strip_tags($this->input->post('ReceiptID')));

            $wh1 = [
                'ReceiptID' => $receiptId
            ];

            $wh2 = [
                'receipt.ID' => $receiptId
            ];

            //result set of  tests of a bill
            $rs1 = $this->test->supplyReceiptTests($wh1);



            //result set  data related to bill for edit
            $rs2 = $this->test->supplyBillDetail($wh2);

            if (!empty($rs2)) {
                $data['status'] = 1;
                $data['rs1'] = $rs1;
                $data['rs2'] = $rs2;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function updateBill() {
        $this->form_validation->set_rules('ReceiptNo', 'ReceiptNo', 'trim|required|integer|min_length[1]');
        $this->form_validation->set_rules('ReceiptID', 'ReceiptID', 'trim|required|integer|min_length[1]');
        $this->form_validation->set_rules('TotalAmount', 'TotalAmount', 'trim|required|numeric|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('DueAmount', 'DueAmount', 'trim|numeric|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('Discount', 'Discount', 'trim|numeric|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('NetAmount', 'NetAmount', 'trim|required|numeric|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('PaidAmount', 'PaidAmount', 'trim|required|numeric|min_length[1]|max_length[11]');

        $this->form_validation->set_error_delimiters('', '');

        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {

            if ($this->input->post('tests')) {
                $tests = $this->input->post('tests');
            } else {
                $tests = [];
            }

            if ($this->input->post('DueAmount') == 0.00) {
                $isPaid = 1;
                $isPartialPaid = 0;
            } else {
                $isPaid = 0;
                $isPartialPaid = 1;
            }


            $receiptId = html_escape(strip_tags($this->input->post('ReceiptID')));
            $receiptNo = html_escape(strip_tags($this->input->post('ReceiptNo')));
            $paidAmount = html_escape(strip_tags($this->input->post('PaidAmount')));
            $netAmount = html_escape(strip_tags($this->input->post('NetAmount')));

            if ($paidAmount > $netAmount) {
                $paidAmount = $netAmount;
            }


            //tests 
            if (empty($tests)) {
                $data['status'] = 0;
                $data['error'] = "Please add a test !!";
                echo json_encode($data);
                exit();
            }

            $DataBill = [
                'TotalAmount' => html_escape(strip_tags($this->input->post('TotalAmount'))),
                'Discount' => html_escape(strip_tags($this->input->post('Discount'))),
                'NetAmount' => $netAmount,
                'PaidAmount' => $paidAmount,
                'DueAmount' => html_escape(strip_tags($this->input->post('DueAmount'))),
                'IsPaid' => $isPaid,
                'IsPartialPaid' => $isPartialPaid,
                'IsPrinted' => 0,
                'UpdatedAt' => date('Y-m-d')
            ];

            $DataBill = $this->security->xss_clean($DataBill);

            if ($this->receipt->isUpdatedBill($DataBill, $tests, $receiptId, $receiptNo)) {
                $data['status'] = 1;
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

    public function getReceipt() {
        $this->form_validation->set_rules('ReceiptNo', 'receipt no', 'trim|required|integer|min_length[1]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $where = [
                'ReceiptNo' => html_escape(strip_tags($this->input->post('ReceiptNo')))
            ];

            $result = $this->report->supplyReportReceipt($where);
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

    public function saveDueFee() {
        $this->form_validation->set_rules('ReceiptNo', 'Receipt no', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('PaidAmount', 'Paid amount', 'trim|required|decimal|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('DuesAmount', 'Dues amount', 'trim|required|decimal|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('PayAmount', 'Payment due amount', 'trim|required|numeric|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');

        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {

            $paidAmount = html_escape(strip_tags($this->input->post('PaidAmount')));
            $duesAmount = html_escape(strip_tags($this->input->post('DuesAmount')));
            $payAmount = html_escape(strip_tags($this->input->post('PayAmount')));

            if ($payAmount < $duesAmount) {
                $data['status'] = 0;
                $data['error'] = 'Please enter dues amount';
                echo json_encode($data);
                exit();
            }

            $paidAmount = $paidAmount + $payAmount;

            $where = [
                'ReceiptNo' => html_escape(strip_tags($this->input->post('ReceiptNo')))
            ];

            $set = [
                'PaidAmount' => $paidAmount,
                'DueAmount' => 0,
                'IsPaid' => 1,
                'IsPartialPaid' => 0
            ];

            $rs = $this->receipt->isSavedDueFee($set, $where);
            if ($rs) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function getBills() {
        $data = [
            'bills' => $this->receipt->supplyBills(),
            'rs2' => $this->settings->supplySettings(),
            'pendingReports' => $this->receipt->supplyPendingReports(),
        ];

        $this->load->view("Bill/BillView", $data);
    }

    public function deleteReceipt() {
        $this->form_validation->set_rules('ReceiptID', 'receipt id', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $where = [
                'ReceiptID' => html_escape(strip_tags($this->input->post('ReceiptID')))
            ];
            $where = $this->security->xss_clean($where);

            if ($this->receipt->isDeleted($where)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

}
