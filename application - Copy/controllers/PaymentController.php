<?php

defined('BASEPATH') or exit('No direct script access allowed');

class PaymentController extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("PaymentModel", "pmode");
    }

    public function showModeView() {
        $data['modes'] = $this->pmode->supplyPaymentModes();
        $this->load->view("Masters/PaymentModeView", $data);
    }

    public function savePaymentMode() {
        $this->form_validation->set_rules('PaymentMode', 'Payment mode', 'trim|required|min_length[1]|max_length[31]|alpha_numeric_spaces|is_unique[paymentmode.PaymentMode]');
        $this->form_validation->set_rules('Description', 'Description', 'trim|alpha_numeric_spaces|min_length[1]|max_length[31]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == false) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $paymentMode = strtoupper(html_escape(strip_tags($this->input->post('PaymentMode'))));
            $desc = html_escape(strip_tags($this->input->post('Description')));

            $insert = [
                'PaymentMode' => $paymentMode,
                'Description' => $desc,
                'CreatedAt' => date('Y-m-d'),
                'UpdatedAt' => date('Y-m-d')
            ];

            if ($this->pmode->isSavedPMode($insert)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function deletePaymentMode() {
        $this->form_validation->set_rules('PaymentModeID', 'Payment mode id', 'trim|integer|required|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == false) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $pmId = $this->input->post('PaymentModeID');
            if ($this->pmode->isDeletedPM($pmId)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function editPaymentMode() {
        $this->form_validation->set_rules('PaymentModeID', 'Payment mode id', 'trim|integer|required|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == false) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $pmId = $this->input->post('PaymentModeID');
            $result = $this->pmode->supplySinglePM($pmId);
            if (!empty($result)) {
                $data['status'] = 1;
                $data['result'] = $result;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
            }
        }
    }

    public function updatePaymentMode() {
        $this->form_validation->set_rules('PaymentMode', 'Payment mode', 'trim|required|min_length[1]|max_length[31]|alpha_numeric_spaces');
        $this->form_validation->set_rules('Description', 'Description', 'trim|alpha_numeric_spaces|min_length[1]|max_length[31]');
        $this->form_validation->set_rules('PaymentModeID', 'Payment mode id', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == false) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $pmId = $this->input->post('PaymentModeID');
            $paymentMode = strtoupper(html_escape(strip_tags($this->input->post('PaymentMode'))));
            $desc = html_escape(strip_tags($this->input->post('Description')));

            //data to be updated
            $d1 = [
                'Description' => $desc,
                'UpdatedAt' => date('Y-m-d')
            ];
            $result = $this->pmode->isUpdatedPMode($pmId, $paymentMode, $d1);

            if ($result !== -2) {
                $data['status'] = 1;
                echo json_encode($data);
            } elseif ($result == -2) {
                $data['status'] = -2;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

}
