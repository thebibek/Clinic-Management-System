<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ItemTypeModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function isSavedItemType(array $data) {
        if ($this->db->insert('itemtype', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /*
     * retrive all categories for listing
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
     * retrive single item type for edit
     * 
     */

    public function supplyItemType($where) {
        $query = $this->db->get_where('itemtype', $where);
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

    public function isUpdatedItemType($d1,$d2, $where) {
        $q1 = $this->db->get_where('itemtype',['ID' => $where['ID'], 'ItemType' => $d1['ItemType']]);
        if ($q1->num_rows() == 1) {
            if ($this->db->update('itemtype', $d2, $where)) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            $q2 = $this->db->get_where('itemtype', ['ItemType' => $d1['ItemType']]);
            if ($q2->num_rows() == 1) {
                return -2;
            } else {
                if ($this->db->update('itemtype', $d1, $where)) {
                    return TRUE;
                } else {
                    return FALSE;
                }
            }
        }
    }

    public function isDeletedItemType($where) {
        if ($this->db->delete('itemtype', $where)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
