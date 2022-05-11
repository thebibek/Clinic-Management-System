<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class BloodGroupModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function isSavedBG(array $data) {
        if ($this->db->insert('bloodgroup', $data)) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * retrive all blood groups for listing
     * 
     */

    public function supplyBloodGroups() {

        $query = $this->db->get('bloodgroup');
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

    public function supplySingleBG($bgId) {
        $wh = [
            'ID'=> $bgId
        ];
        $query = $this->db->get_where('bloodgroup', $wh);
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return [];
        }
    }

    /*
     * update category 
     * 
     */

    public function isUpdatedBG($bgId, $bloodGroup, $d1) {
        $wh = [
            'ID'=> $bgId
        ];
        $q1 = $this->db->get_where('bloodgroup', ['ID' => $bgId, 'BloodGroup' => $bloodGroup]);
        if ($q1->num_rows() == 1) {
            if ($this->db->update('bloodgroup', $d1, $wh)) {
                return true;
            } else {
                return false;
            }
        } else {
            $q2 = $this->db->get_where('bloodgroup', ['BloodGroup' => $bloodGroup]);
            if ($q2->num_rows() == 1) {
                return -2;
            } else {
                $d1['BloodGroup'] = $bloodGroup;
                
                if ($this->db->update('bloodgroup', $d1, $wh)) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }

    public function isDeletedBG($bgId) {
        $wh = [
            'ID' => $bgId
        ];
        if ($this->db->delete('bloodgroup', $wh)) {
            return true;
        } else {
            return false;
        }
    }

}
