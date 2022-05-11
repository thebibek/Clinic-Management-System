<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class UnitModel extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	
	//supply all units
	public function supplyUnits(){
		$this->db->select();
		$this->db->from('units');
		$this->db->order_by("ID",'DESC');
		
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return [];
		}
	}
	
	//supply single row
	public function supplyUnit($where){
		$query = $this->db->get_where('units',$where);
		if($query->num_rows() ==  1){
			return $query->row_array();
		}else{
			return [];
		}
	}
	
	//insert new record
	public function isSaved($data){
		if($this->db->insert('units',$data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	/*
     * update unit 
     * 
     */

    public function isUpdatedUnit($data, $where) {
        $q1 = $this->db->get_where('units', ['ID' => $where['ID'], 'Unit' => $data['Unit']]);
        if ($q1->num_rows() == 1) {
            if ($this->db->update('units', ['Description' => $data['Description'], 'UpdatedAt' => $data['UpdatedAt']], $where)) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            $q2 = $this->db->get_where('units', ['Unit' => $data['Unit']]);
            if ($q2->num_rows() == 1) {
                return -2;
            } else {
                if ($this->db->update('units', $data, $where)) {
                    return TRUE;
                } else {
                    return FALSE;
                }
            }
        }
    }

    public function isDeletedUnit($where) {
        
        if ($this->db->delete('units',$where)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}