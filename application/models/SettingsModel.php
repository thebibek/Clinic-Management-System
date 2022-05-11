<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class SettingsModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function isSaved($data) {
        $query = $this->db->get_where('settings', ['ID' => 1]);
        if ($query->num_rows() == 1) {
            if ($this->db->update('settings', $data, ['ID' => 1])) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            //insert once
            if ($this->db->insert('settings', $data)) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }

    public function isSavedGlobalSetting($data) {
        $query = $this->db->get_where('globalsettings', ['ID' => 1]);
        if ($query->num_rows() == 1) {
            if ($this->db->update('globalsettings', $data, ['ID' => 1])) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            //insert once
            if ($this->db->insert('globalsettings', $data)) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }
    
    public function supplySettings(){
        $query =  $this->db->get('settings');
        if($query->num_rows() == 1){
            return $query->row_array();
        }else{
            return [];
        }
    }

    //supply global settings

    public function supplyGlobalSettings(){
        $query = $this->db->get('globalsettings');
        if($query->num_rows() == 1){
            return $query->row_array();
        }else{
            return [];
        }
    }

}
