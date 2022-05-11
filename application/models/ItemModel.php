<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ItemModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function isSavedItem(array $data) {
        if ($this->db->insert('item', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /*
     * retrive all items for listing
     * 
     */

    public function supplyCategories() {
        $where = [
            'IsActive' => 1,
            'IsDeleted' => 0
        ];
        $query = $this->db->get_where('category', $where);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }

    /*
     * retrive single item for edit
     * 
     */

    public function supplyItem($where) {
        $query = $this->db->get_where('item', $where);
        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return [];
        }
    }

    /*
     * update item
     * 
     */

    public function isUpdatedItem($d1, $itemName, $where) {
        $q1 = $this->db->get_where('item', ['ID' => $where['ID'], 'ItemName' => $itemName]);
        if ($q1->num_rows() == 1) {
            if ($this->db->update('item', $d1, $where)) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            $q2 = $this->db->get_where('item', ['ItemName' => $itemName]);
            if ($q2->num_rows() == 1) {
                return -2;
            } else {
                $d1['ItemName'] = $itemName;
                if ($this->db->update('item', $d1, $where)) {
                    return TRUE;
                } else {
                    return FALSE;
                }
            }
        }
    }
    
    //delete item

    public function isDeletedItem($where) {

        if ($this->db->delete('item', $where)) {
            return true;
        } else {
            return false;
        }
    }

}
