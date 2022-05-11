<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class LedgerGroupModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function isSavedLedgerGroup(array $data) {
        if ($this->db->insert('ledgergroup', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /*
     * retrive all groups for listing
     * 
     */

    public function supplyLedgerGroups() {
        $this->db->select('*,ledgergroup.ID as LedgerGroupID');
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

    public function supplySearchResult($data) {
        $this->db->select('*');
        $this->db->from('ledgergroup');
        $this->db->join('undergroup', 'undergroup.ID = ledgergroup.UnderGroupID', 'inner');
        $this->db->like('LedgerGroup', $data['LedgerGroup']);
        $this->db->or_where('UnderGroupID = ', $data['UnderGroupID']);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    public function supplyGroupLedgers($wh) {
        $query = $this->db->get_where('ledger', $wh);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    public function isDeletedLedgerGroup($wh) {
        if ($this->db->delete('ledgergroup', $wh)) {
            return true;
        } else {
            return false;
        }
    }

    public function supplyLedgerGroup($wh) {
        $query = $this->db->get_where('ledgergroup', $wh);
        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return [];
        }
    }
    
    /*
     * update ledger group 
     * 
     */

    public function isUpdatedLedgerGroup($d1, $d2,$where) {
        $q1 = $this->db->get_where('ledgergroup', ['ID' => $where['ID'], 'LedgerGroup' => $d1['LedgerGroup']]);
        if ($q1->num_rows() == 1) {
            if ($this->db->update('ledgergroup', $d2, $where)) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            $q2 = $this->db->get_where('ledgergroup', ['LedgerGroup' => $d1['LedgerGroup']]);
            if ($q2->num_rows() == 1) {
                return -2;
            } else {
                if ($this->db->update('ledgergroup', $d1, $where)) {
                    return TRUE;
                } else {
                    return FALSE;
                }
            }
        }
    }

}
