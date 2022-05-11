<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class LedgerModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function isSavedLedger(array $data) {
        if ($this->db->insert('ledger', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /*
     * retrive all ledger groups for listing
     * 
     */

    public function supplyLedgerGroups() {
        $this->db->select('*');
        $this->db->from('ledgergroup');
        $this->db->join('undergroup', 'undergroup.ID = ledgergroup.UnderGroupID', 'inner');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }

    /*
     *   retrive all ledger
     *
     */

    public function supplyLedgers() {
        $this->db->select('ledger.ID as LedgerID,
        LabName,
        LedgerGroup,
        Ledger,
        LedgerAlias,
        Ledger.Remarks as LedgerRemarks,
        Ledger.TB as LedgerTB,
        Ledger.PL as LedgerPL,
        Ledger.BS as LedgerBS');
        $this->db->from('ledger');
        $this->db->join('ledgergroup', 'ledgergroup.ID = ledger.LedgerGroupID', 'inner');
        $this->db->join('settings', 'settings.ID = ledger.CompanyID', 'inner');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    /*
     * retrive single category for edit
     * 
     */

    public function supplyCategory($where) {
        $query = $this->db->get_where('category', $where);
        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return [];
        }
    }

    /*
     * update category 
     * 
     */

    public function isUpdatedLedger($d1, $d2, $where) {
        $q1 = $this->db->get_where('ledger', ['ID' => $where['ID'], 'Ledger' => $d1['Ledger']]);
        if ($q1->num_rows() == 1) {
            if ($this->db->update('ledger', $d2, $where)) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            $q2 = $this->db->get_where('ledger', ['Ledger' => $d1['Ledger']]);
            if ($q2->num_rows() == 1) {
                return -2;
            } else {
                if ($this->db->update('ledger', $d1, $where)) {
                    return TRUE;
                } else {
                    return FALSE;
                }
            }
        }
    }

    public function isDeletedLedger($where) {
        if ($this->db->delete('ledger', $where)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function supplySearchResult($ledger, $ledgerGroupId) {
        
        $this->db->select('ledger.ID as LedgerID,
        LabName,
        LedgerGroup,
        Ledger,
        LedgerAlias,
        Ledger.Remarks as LedgerRemarks,
        Ledger.TB as LedgerTB,
        Ledger.PL as LedgerPL,
        Ledger.BS as LedgerBS');
        $this->db->from('ledger');
        $this->db->join('ledgergroup', 'ledgergroup.ID = ledger.LedgerGroupID', 'inner');
        $this->db->join('settings', 'settings.ID = ledger.CompanyID', 'inner');
        $this->db->where('Ledger',$ledger);
        $this->db->or_where('LedgerGroupID',$ledgerGroupId);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    public function supplyLedger($wh) {
        $query = $this->db->get_where('ledger', $wh);
        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return [];
        }
    }

}
