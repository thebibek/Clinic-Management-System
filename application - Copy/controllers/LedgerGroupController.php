<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class LedgerGroupController extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('LedgerGroupModel', 'ledgergroup');
    }

    public function index() {

        $this->load->view("Account/LedgerGroupView");
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

    public function saveLedgerGroup() {
        $this->form_validation->set_rules('LedgerGroup', 'Ledger Group', 'trim|required|min_length[1]|max_length[35]|is_unique[ledgergroup.LedgerGroup]');
        $this->form_validation->set_rules('UnderGroup', 'UnderGroup', 'trim|required|integer|min_length[1]|max_length[10]');
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
            $ledgerGroup = strtoupper(strip_tags($this->input->post('LedgerGroup')));
            $underGroup = html_escape(strip_tags($this->input->post('UnderGroup')));
            $remarks = html_escape(strip_tags($this->input->post('Remarks')));
            $tb = html_escape(strip_tags($this->input->post('TB')));
            $pl = html_escape(strip_tags($this->input->post('PL')));
            $bs = html_escape(strip_tags($this->input->post('BS')));

            $dataLedgerGroup = [
                'LedgerGroup' => $ledgerGroup,
                'UnderGroupID' => $underGroup,
                'TrialBalance' => $tb,
                'ProfitLoss' => $pl,
                'BalanceSheet' => $bs,
                'Remarks' => $remarks,
                'CreatedAt' => date('Y-m-d'),
                'UpdatedAt' => date('Y-m-d'),
            ];
            $dataLedgerGroup = $this->security->xss_clean($dataLedgerGroup);
            if ($this->ledgergroup->isSavedLedgerGroup($dataLedgerGroup)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function searchLedgerGroups() {
        $this->form_validation->set_rules('LedgerGroup', 'Ledger group', 'trim|min_length[1]|max_length[51]');
        $this->form_validation->set_rules('UnderGroupID', 'Under group Id', 'trim|integer|min_length[1]|max_length[51]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
            exit();
        } else {
            if ($this->input->post('LedgerGroup')) {
                $ledgerGroup = html_escape(strip_tags($this->input->post('LedgerGroup')));
            } else {
                $ledgerGroup = "";
            }

            if ($this->input->post('UnderGroupID')) {
                $underGroupId = html_escape(strip_tags($this->input->post('UnderGroupID')));
            } else {
                $underGroupId = "";
            }

            $dataSearch = [
                'LedgerGroup' => $ledgerGroup,
                'UnderGroupID' => $underGroupId
            ];

            $result = $this->ledgergroup->supplySearchResult($dataSearch);

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

    public function deleteLedgerGroup() {
        $this->form_validation->set_rules('LedgerGroupID', 'LedgerGroupID', 'trim|integer|required|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $where = [
                'ID' => html_escape(strip_tags($this->input->post('LedgerGroupID')))
            ];
            $where = $this->security->xss_clean($where);
            if ($this->ledgergroup->isDeletedLedgerGroup($where)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function editLedgerGroup() {
        $this->form_validation->set_rules('LedgerGroupID', 'LedgerGroupID', 'trim|integer|required|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');

        if ($this->form_validation->run() == false) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {

            $ledgerGroupId = $this->input->post('LedgerGroupID');

            $where = [
                'ID' => $ledgerGroupId,
            ];
            $where = $this->security->xss_clean($where);

            $result = $this->ledgergroup->supplyLedgerGroup($where);
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

    public function updateLedgerGroup() {
        $this->form_validation->set_rules('LedgerGroupID', 'Ledger group id', 'trim|integer|required|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('LedgerGroup', 'Ledger Group', 'trim|required|min_length[1]|max_length[35]|alpha_numeric_spaces');
        $this->form_validation->set_rules('UnderGroup', 'UnderGroup', 'trim|required|integer|min_length[1]|max_length[10]');
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
            $ledgerGroupId = $this->input->post('LedgerGroupID');
            $ledgerGroup = strtoupper(strip_tags($this->input->post('LedgerGroup')));
            $underGroup = html_escape(strip_tags($this->input->post('UnderGroup')));
            $remarks = html_escape(strip_tags($this->input->post('Remarks')));
            $tb = html_escape(strip_tags($this->input->post('TB')));
            $pl = html_escape(strip_tags($this->input->post('PL')));
            $bs = html_escape(strip_tags($this->input->post('BS')));

            $where = [
                'ID' => $ledgerGroupId
            ];

            $update1 = [
                'LedgerGroup' => $ledgerGroup,
                'UnderGroupID' => $underGroup,
                'TrialBalance' => $tb,
                'ProfitLoss' => $pl,
                'BalanceSheet' => $bs,
                'Remarks' => $remarks,
                'UpdatedAt' => date('Y-m-d'),
            ];
            $update2 = [
                'UnderGroupID' => $underGroup,
                'TrialBalance' => $tb,
                'ProfitLoss' => $pl,
                'BalanceSheet' => $bs,
                'Remarks' => $remarks,
                'UpdatedAt' => date('Y-m-d'),
            ];

            $update1 = $this->security->xss_clean($update1);
            $result = $this->ledgergroup->isUpdatedLedgerGroup($update1, $update2, $where);
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

    /*
     * Provide ledger under LedgerGroup
     *
     */

    public function provideGroupLedgers() {
        $this->form_validation->set_rules('LedgerGroupID', 'Ledger Group ID', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $ledgerGroupId = $this->input->post('LedgerGroupID');
            $wh = [
                'LedgerGroupID' => $ledgerGroupId
            ];

            $result = $this->ledgergroup->supplyGroupLedgers($wh);
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
