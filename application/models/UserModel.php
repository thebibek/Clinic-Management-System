<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function supplyUser() {
        $this->db->select('id,email,username');
        $this->db->from('aauth_users');
        $query = $this->db->get();
        $rs = $query->result_array();
        $temp = [];
        foreach ($rs as $r) {
            $string = $this->getRoles($r['id']);

            $r['role'] = $string;
            array_push($temp, $r);
        }

        return $temp;
    }

    public function getRoles($userId) {
        $this->db->select('name');
        $this->db->from('aauth_user_to_group');
        $this->db->join('aauth_groups', 'aauth_groups.id=aauth_user_to_group.group_id');
        $this->db->where('user_id', $userId);
        $query = $this->db->get();
        $rs = $query->result_array();

        $string = '';
        foreach ($rs as $r) {
            $string .= $r['name'] . ',';
        }
        return $string;
    }

    public function supplyPermission($where) {
        $query = $this->db->get_where('aauth_perms', $where);
        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return [];
        }
    }

    public function supplyUserPermissions($userId) {
        $where = [
            'user_id' => $userId
        ];
        $this->db->select('perm_id');
        $this->db->from('aauth_perm_to_user');
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $rs = $query->result_array();

            $temp = [];
            foreach ($rs as $r) {
                array_push($temp, $r['perm_id']);
            }

            return $temp;
        } else {
            return [];
        }
    }

    public function provideProfileImage($userId) {
        $wh = [
            'UserID' => $userId
        ];
        $this->db->select('ProfileUrl');
        $this->db->from('employee');
        $this->db->where($wh);
        $q = $this->db->get();
        if ($q->num_rows() == 1) {
            return $q->row_array();
        } else {
            return [];
        }
    }

    public function isUserLinkSaved($empId, $userId) {
        $wh = [
            'ID' => $empId
        ];

        $update = [
            'UserID' => $userId
        ];

        if ($this->db->update('employee', $update, $wh)) {
            return true;
        } else {
            return false;
        }
    }
    
    public function supplyLinkedUser(){
        $this->db->select('employee.ID as EmployeeID,Designation,FirstName,LastName,UserID,username,aauth_users.email as UserEmail');
        $this->db->from('employee');
        $this->db->join('designation','employee.DesignationID = designation.ID','left');
        $this->db->join('aauth_users','employee.UserID = aauth_users.ID','left');
        $q = $this->db->get();
        if($q->num_rows() > 0){
            return $q->result_array();
        }else{
            return [];
        }
    }
    
    public function isUpdatedUserLink($empId,$userId){
        $wh = [
            'ID'=> $empId
        ];
        $update = [
            'UserID'=> 0
        ];
        
        if($this->db->update('employee',$update,$wh)){
            return true;
        }else{
            return false;
        }
    }

}
