<?php

defined('BASEPATH') or exit('No direct script access allowed');

class LedgerController extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('LedgerGroupModel', 'ledgergroup');
        $this->load->model('LedgerModel', 'ledger');
    }

    public function index() {

        $this->load->view("Account/LedgerView");
    }

    public function getLedgerGroups() {
        $result = $this->ledgergroup->supplyLedgerGroups();

        if (!empty($result)) {
            $data['result'] = $result;
            $data['status'] = 1;
            echo json_encode($data);
            exit();
        } else {
            $data['status'] = -1;
            echo json_encode($data);
        }
    }

    public function saveLedger() {
        $this->form_validation->set_rules('Ledger', 'Ledger', 'trim|required|min_length[1]|max_length[35]|is_unique[ledger.Ledger]');
        $this->form_validation->set_rules('LedgerAlias', 'LedgerAlias', 'trim|min_length[1]|max_length[51]');
        $this->form_validation->set_rules('CompanyID', 'Company Id', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('LedgerGroupID', 'LedgerGroup Id', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('Remarks', 'Remarks', 'trim|min_length[1]|max_length[45]');
        $this->form_validation->set_rules('TB', 'TB', 'trim|required|integer|min_length[1]|max_length[1]');
        $this->form_validation->set_rules('PL', 'PL', 'trim|required|integer|min_length[1]|max_length[1]');
        $this->form_validation->set_rules('BS', 'BS', 'trim|required|integer|min_length[1]|max_length[1]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            //get values 
            $ledger = strtoupper(html_escape(strip_tags($this->input->post('Ledger'))));
            $ledgerAlias = html_escape(strip_tags($this->input->post('LedgerAlias')));
            $companyId = html_escape(strip_tags($this->input->post('CompanyID')));
            $ledgerGroupId = html_escape(strip_tags($this->input->post('LedgerGroupID')));
            $remarks = html_escape(strip_tags($this->input->post('Remarks')));
            $tb = html_escape(strip_tags($this->input->post('TB')));
            $pl = html_escape(strip_tags($this->input->post('PL')));
            $bs = html_escape(strip_tags($this->input->post('BS')));

            $dataLedger = [
                'Ledger' => $ledger,
                'LedgerAlias' => $ledgerAlias,
                'CompanyID' => $companyId,
                'LedgerGroupID' => $ledgerGroupId,
                'TB' => $tb,
                'PL' => $pl,
                'BS' => $bs,
                'Remarks' => $remarks,
                'CreatedAt' => date('Y-m-d'),
                'UpdatedAt' => date('Y-m-d'),
            ];
            $dataLedger = $this->security->xss_clean($dataLedger);
            if ($this->ledger->isSavedLedger($dataLedger)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function filterLedger() {
        $this->form_validation->set_rules('Ledger', 'Ledger', 'trim|min_length[1]|max_length[31]');
        $this->form_validation->set_rules('LedgerGroup', 'Ledger group Id', 'trim|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
            exit();
        } else {
            if ($this->input->post('LedgerGroup')) {
                $ledger = html_escape(strip_tags($this->input->post('Ledger')));
            } else {
                $ledger = "";
            }

            if ($this->input->post('LedgerGroup')) {
                $ledgerGroup = html_escape(strip_tags($this->input->post('LedgerGroup')));
            } else {
                $ledgerGroup = "";
            }


            $result = $this->ledger->supplySearchResult($ledger, $ledgerGroup);


            if (!empty($result)) {
                $data['status'] = 1;
                $data['result'] = $result;
                echo json_encode($data);
                exit();
            } else {
                $data['status'] = -1;
            }
        }
    }

    public function provideLedger() {
        $result = $this->ledger->supplyLedgers();
        if (!empty($result)) {
            $data['status'] = 1;
            $data['result'] = $result;
            echo json_encode($data);
        } else {
            $data['status'] = -1;
            echo json_encode($data);
        }
    }

    public function deleteLedger() {
        $this->form_validation->set_rules('LedgerID', 'Ledger id', 'trim|integer|required|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $where = [
                'ID' => html_escape(strip_tags($this->input->post('LedgerID')))
            ];
            $where = $this->security->xss_clean($where);
            if ($this->ledger->isDeletedLedger($where)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function editLedger() {
        $this->form_validation->set_rules('LedgerID', 'Ledger id', 'trim|integer|required|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');

        if ($this->form_validation->run() == false) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {

            $ledgerId = $this->input->post('LedgerID');

            $where = [
                'ID' => $ledgerId,
            ];
            $where = $this->security->xss_clean($where);

            $result = $this->ledger->supplyLedger($where);
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

    public function updateLedger() {
        $this->form_validation->set_rules('LedgerID', 'Ledger id', 'trim|integer|required|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('Ledger', 'Ledger', 'trim|required|min_length[1]|max_length[35]');
        $this->form_validation->set_rules('LedgerAlias', 'LedgerAlias', 'trim|min_length[1]|max_length[51]');
        $this->form_validation->set_rules('CompanyID', 'Company Id', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('LedgerGroupID', 'LedgerGroup Id', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('Remarks', 'Remarks', 'trim|min_length[1]|max_length[45]');
        $this->form_validation->set_rules('TB', 'TB', 'trim|required|integer|min_length[1]|max_length[1]');
        $this->form_validation->set_rules('PL', 'PL', 'trim|required|integer|min_length[1]|max_length[1]');
        $this->form_validation->set_rules('BS', 'BS', 'trim|required|integer|min_length[1]|max_length[1]');

        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {

            //get values 
            $ledgerId = $this->input->post('LedgerID');
            $ledger = strtoupper(html_escape(strip_tags($this->input->post('Ledger'))));
            $ledgerAlias = html_escape(strip_tags($this->input->post('LedgerAlias')));
            $companyId = html_escape(strip_tags($this->input->post('CompanyID')));
            $ledgerGroupId = html_escape(strip_tags($this->input->post('LedgerGroupID')));
            $remarks = html_escape(strip_tags($this->input->post('Remarks')));
            $tb = html_escape(strip_tags($this->input->post('TB')));
            $pl = html_escape(strip_tags($this->input->post('PL')));
            $bs = html_escape(strip_tags($this->input->post('BS')));

            $where = [
                'ID' => $ledgerId
            ];

            $d1 = [
                'Ledger' => $ledger,
                'LedgerAlias' => $ledgerAlias,
                'CompanyID' => $companyId,
                'LedgerGroupID' => $ledgerGroupId,
                'TB' => $tb,
                'PL' => $pl,
                'BS' => $bs,
                'Remarks' => $remarks,
                'UpdatedAt' => date('Y-m-d'),
            ];
            $d2 = [
                'LedgerAlias' => $ledgerAlias,
                'CompanyID' => $companyId,
                'LedgerGroupID' => $ledgerGroupId,
                'TB' => $tb,
                'PL' => $pl,
                'BS' => $bs,
                'Remarks' => $remarks,
                'UpdatedAt' => date('Y-m-d'),
            ];

            $d1 = $this->security->xss_clean($d1);
            $result = $this->ledger->isUpdatedLedger($d1, $d2, $where);
            if ($result !== -2) {
                $data['status'] = 1;
                echo json_encode($data);
            } else if ($result == -2) {
                $data['status'] = -2;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                json_encode($data);
            }
        }
    }

}
