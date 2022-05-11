<?php

class GroupModel extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
    
    public function supplyGroup($where){
        $query = $this->db->get_where('aauth_groups',$where);
        if($query->num_rows() == 1){
            return $query->row_array();
        }else{
            return [];
        }
    }
    
}