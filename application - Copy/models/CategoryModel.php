<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CategoryModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function isSavedCategory(array $data) {
        if ($this->db->insert('category', $data)) {
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

    public function isUpdatedCategory($data, $where) {
        $q1 = $this->db->get_where('category', ['ID' => $where['ID'], 'Category' => $data['Category']]);
        if ($q1->num_rows() == 1) {
            if ($this->db->update('category', ['ShortName' => $data['ShortName'], 'UpdatedAt' => $data['UpdatedAt']], $where)) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            $q2 = $this->db->get_where('category', ['Category' => $data['Category']]);
            if ($q2->num_rows() == 1) {
                return -2;
            } else {
                if ($this->db->update('category', $data, $where)) {
                    return TRUE;
                } else {
                    return FALSE;
                }
            }
        }
    }

    public function isDeletedCategory($where) {
        $update = [
            'IsDeleted' => 1
        ];
        if ($this->db->update('category', $update, $where)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
