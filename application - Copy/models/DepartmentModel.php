<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class DepartmentModel extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	
	//supply all units
	public function supplyDepartments(){
		$this->db->select();
		$this->db->from('department');
		$this->db->where(['IsActive => 1']);
		$this->db->order_by("ID",'DESC');
		
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return [];
		}
	}
	
	//supply single row
	public function supplyDepartment($where){
		$query = $this->db->get_where('department',$where);
		if($query->num_rows() ==  1){
			return $query->row_array();
		}else{
			return [];
		}
	}
	
	//insert new record
	public function isSavedDepartment($data){
		if($this->db->insert('department',$data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	/*
     * update unit 
     * 
     */

    public function isUpdatedDepartment($data, $where) {
        $q1 = $this->db->get_where('department', ['ID' => $where['ID'], 'Department' => $data['Department']]);
        if ($q1->num_rows() == 1) {
            if ($this->db->update('department', ['Department' => $data['Department'],'Description'=> $data['Description'],'IsActive'=>$data['IsActive'] ,'UpdatedAt' => $data['UpdatedAt']], $where)) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            $q2 = $this->db->get_where('department', ['Department' => $data['Department']]);
            if ($q2->num_rows() == 1) {
                return -2;
            } else {
                if ($this->db->update('department', $data, $where)) {
                    return TRUE;
                } else {
                    return FALSE;
                }
            }
        }
    }

    public function isDeletedDepartment($where) {
        
        if ($this->db->delete('department',$where)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}