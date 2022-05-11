<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class NationalityModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function isSavedNationality(array $data) {
        if ($this->db->insert('nationality', $data)) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * retrive all categories for listing
     * 
     */

    public function supplyNationalities() {

        $query = $this->db->get_where('nationality');
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

    public function supplyNationality($where) {
        $query = $this->db->get_where('nationality', $where);
        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return [];
        }
    }

    /*
     * update nationality
     * 
     */

    public function isUpdatedNationality($d1, $nationality, $nationalityId) {
        $wh = [
            'ID'=> $nationalityId
        ];
        
        $q1 = $this->db->get_where('nationality', ['ID' => $nationalityId, 'Nationality' => $nationality]);
        if ($q1->num_rows() == 1) {
            if ($this->db->update('nationality', $d1, $wh)) {
                return true;
            } else {
                return false;
            }
        } else {
            $q2 = $this->db->get_where('nationality', ['Nationality' => $nationality]);
            if ($q2->num_rows() == 1) {
                return -2;
            } else {
                $d1['Nationality'] =  $nationality;
                
                if ($this->db->update('nationality', $d1, $wh)) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }

    public function isDeletedNationality($where) {

        if ($this->db->delete('nationality', $where)) {
            return true;
        } else {
            return false;
        }
    }

}
