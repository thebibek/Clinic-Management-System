<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TestParticularsModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function isSaved(array $data) {
        if ($this->db->insert('testparticulars', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function supplyTestParticulars($where) {

        $query = $this->db->get_where('testparticulars', $where);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            $result = [];
            return $result;
        }
    }

    public function supplyTests() {
        $where = [
            'IsDeleted' => 0,
            'IsActive' => 1
        ];
        $query = $this->db->get_where('test', $where);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            $result = [];
            return $result;
        }
    }

    public function supplyTest(array $where) {
        $query = $this->db->get_where('test', $where);
        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return FALSE;
        }
    }

    public function isUpdated($data, $where) {
        if (!is_array($data)) {
            return FALSE;
        }

        if (!is_array($where)) {
            return FALSE;
        }

        if ($this->db->update('testparticulars', $data, $where)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function isDeletedParticulars($where) {

        if ($this->db->delete('testparticulars', $where)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function supplyParticular($where) {
        $query = $this->db->get_where('testparticulars', $where);
        if ($query->num_rows() == 1) {
            return $query->row_array();
            print_r($query->row_array());
        } else {
            return FALSE;
        }
    }

}
