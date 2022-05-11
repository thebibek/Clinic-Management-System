<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UnderGroupModel extends CI_Model {
    
    public function __construct(){
        parent::__construct();
    }
    
    public function isSaved($data){
        if($this->db->insert('undergroup',$data)){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    public function isDeletedGroup($where) {
     
        if ($this->db->delete('undergroup', $where)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function supplyGroup($where) {
        $query = $this->db->get_where('undergroup', $where);
        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return [];
        }
    }
    
    /*
     * Update Group 
     * 
     */

    public function isUpdatedGroup($data, $where) {
        $q1 = $this->db->get_where('undergroup', ['ID' => $where['ID'], 'UnderGroup' => $data['UnderGroup']]);
        if ($q1->num_rows() == 1) {
            if ($this->db->update('undergroup', ['Description' => $data['Description'], 'IsActive'=>$data['IsActive'],'UpdatedAt' => $data['UpdatedAt']], $where)) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            $q2 = $this->db->get_where('undergroup', ['UnderGroup' => $data['UnderGroup']]);
            if ($q2->num_rows() == 1) {
                return -2;
            } else {
                if ($this->db->update('undergroup', $data, $where)) {
                    return TRUE;
                } else {
                    return FALSE;
                }
            }
        }
    }
    
}