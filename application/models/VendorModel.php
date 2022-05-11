<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class VendorModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function isSavedVendor($dataVendor, $companyId, $ledgerGroupId) {
        $this->db->trans_start();


        $query1 = $this->db->set($dataVendor)->get_compiled_insert('vendor');
        $this->db->query($query1);

        //getting result of ledger group
        $rs = $this->getLedgerGroupData($ledgerGroupId);



        //setting the data of ledger
        $data = [
            'Ledger' => $dataVendor['Vendor'],
            'LedgerAlias' => $dataVendor['Vendor'],
            'CompanyID' => $companyId,
            'LedgerGroupID' => $ledgerGroupId,
            'Remarks' => 'NA',
            'TB' => $rs['TrialBalance'],
            'PL' => $rs['ProfitLoss'],
            'BS' => $rs['BalanceSheet'],
            'CreatedAt' => date('Y-m-d'),
            'UpdatedAt' => date('Y-m-d')
        ];

        $query2 = $this->db->set($data)->get_compiled_insert('ledger');
        $this->db->query($query2);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function getLedgerGroupData($ledgerGroupId) {
        $query = $this->db->get_where('ledgergroup', ['ID' => $ledgerGroupId]);
        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return [];
        }
    }

    public function isDeletedVendor($where) {
        if ($this->db->delete('vendor', $where)) {
            return true;
        } else {
            return false;
        }
    }

    public function supplyVendor($where) {
        $query = $this->db->get_where('vendor', $where);
        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    /*
     * update vendor
     * @$d1(array) data to be updated
     * @$vendor , vendor name
     * @$where(array) , row id  
     */

    public function isUpdatedVendor($d1, $vendor, $where) {
        $q1 = $this->db->get_where('vendor', ['ID' => $where['ID'], 'Vendor' => $vendor]);
        if ($q1->num_rows() == 1) {
            if ($this->db->update('vendor', $d1, $where)) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            $q2 = $this->db->get_where('vendor', ['Vendor' => $vendor]);
            if ($q2->num_rows() == 1) {
                return -2;
            } else {
                $d1['Vendor'] = $vendor;
                if ($this->db->update('vendor', $d1, $where)) {
                    return TRUE;
                } else {
                    return FALSE;
                }
            }
        }
    }

}
