<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PurchaseModel extends CI_Model {

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

    public function supplyItemNames($data) {
        $query = $this->db->get_where('item', $data);
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
     * update purchase items
     * 
     */

    public function isUpdatedPurchaseItems($d1, $billNo, $purchaseItems, $billId) {
        $wh1 = [
            'ID' => $billId
        ];

        $wh2 = [
            'PurchaseID' => $billId
        ];
        $items = [];
        foreach ($purchaseItems as $v) {
            $t['PurchaseID'] = $billId;
            $t['ItemType'] = $v['ItemType'];
            $t['ItemName'] = $v['ItemName'];
            $t['ItemTypeID'] = $v['ItemTypeID'];
            $t['ItemNameID'] = $v['ItemNameID'];
            $t['Rate'] = $v['Rate'];
            $t['Quantity'] = $v['Quantity'];
            $t['Total'] = $v['Total'];
            $t['CreatedAt'] = date('Y-m-d');
            $t['UpdatedAt'] = date('Y-m-d');
            array_push($items, $t);
        }



        $q1 = $this->db->get_where('purchase', ['ID' => $billId, 'BillNo' => $billNo]);
        if ($q1->num_rows() == 1) {
            $this->db->trans_start();
            $this->db->update('purchase', $d1, $wh1);
            $this->db->delete('purchaseitems', $wh2);
            $this->db->insert_batch('purchaseitems', $items);
            $this->db->trans_complete();
            if ($this->db->trans_status() == false) {
                return false;
            } else {
                return true;
            }
        } else {
            $q2 = $this->db->get_where('purchase', ['BillNo' => $billNo]);
            if ($q2->num_rows() == 1) {
                return -2;
            } else {
                $d1['BillNo'] = $billNo;
                $this->db->trans_start();
                $this->db->update('purchase', $d1, $wh1);
                $this->db->delete('purchaseitems', $wh2);
                $this->db->insert_batch('purchaseitems', $items);
                $this->db->trans_complete();
                if ($this->db->trans_status() == false) {
                    return false;
                } else {
                    return true;
                }
            }
        }
    }

    public function isDeletedPurchaseBill($where) {

        if ($this->db->delete('purchase', $where)) {
            return TRUE;
        } else {
            return FALSE;
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

    public function isSavedPurchaseItems($purchaseInput, $purchaseItems) {
        $this->db->trans_start();

        $query1 = $this->db->set($purchaseInput)->get_compiled_insert('purchase');
        $this->db->query($query1);
        $purchaseId = $this->db->insert_id();

        //saving purchase details
        foreach ($purchaseItems as $v) {
            $data = [
                'PurchaseID' => $purchaseId,
                'ItemType' => $v['ItemType'],
                'ItemName' => $v['ItemName'],
                'ItemTypeID' => $v['ItemTypeID'],
                'ItemNameID' => $v['ItemNameID'],
                'Description' => $v['Desc'],
                'Rate' => $v['Rate'],
                'Quantity' => $v['Quantity'],
                'Total' => $v['Total'],
                'CreatedAt' => date('Y-m-d'),
                'UpdatedAt' => date('Y-m-d')
            ];

            $query2 = $this->db->set($data)->get_compiled_insert('purchaseitems');
            $this->db->query($query2);
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    //providing all purchase bills

    public function supplyPurchaseBills() {
        $this->db->select('*,purchase.ID as PurchaseID');
        $this->db->from('purchase');
        $this->db->join('vendor', 'vendor.ID=purchase.VendorID', 'inner');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    //provide single purchase bill against purchase id

    public function supplyPurchaseBill($id) {
        $this->db->select('*,purchase.ID as PurchaseID');
        $this->db->from('purchase');
        $this->db->join('vendor', 'vendor.ID = purchase.VendorID', 'inner');
        $this->db->where('purchase.ID', $id);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return [];
        }
    }

    public function supplyItemPurchased($id) {
        $query = $this->db->get_where('purchaseitems', ['PurchaseID' => $id]);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    public function supplyFilterPurchaseBills($param) {
        $this->db->select('*,purchase.ID as PurchaseID');
        $this->db->from('purchase');
        $this->db->join('vendor', 'vendor.ID=purchase.VendorID', 'inner');
        $this->db->or_where('PurchaseDate = ', $param['PurchaseDate']);
        $this->db->or_where('BillNo = ', $param['BillNo']);
        $this->db->or_where('VendorID = ', $param['VendorID']);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    public function filterBill($wh) {
        $this->db->select('*,purchase.ID as PurchaseID');
        $this->db->from('purchase');
        $this->db->join('vendor', 'vendor.ID=purchase.VendorID', 'inner');
        $this->db->where($wh);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    //filter records between two date
    public function provideReport($param) {
        $this->db->select('*');
        $this->db->from('purchaseitems');
        $this->db->where('CreatedAt >=', $param['FromDate']);
        $this->db->where('CreatedAt <=', $param['ToDate']);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

}
