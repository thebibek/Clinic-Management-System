<?php
defined('BASEPATH') or exit('No direct script access allowed');


class MasterModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function supplyMaster($tableName) {
        //$query=$this->db->get($tableName);

        $query = $this->db->get_where($tableName);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }

    public function supplyMasterUnder($table, $data) {
        $query = $this->db->get_where($table, $data);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }

    public function supplyBankLedger() {
        $wh = [
            'IsBank'=> 1
        ];
        $query = $this->db->get_where('ledger',$wh);
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return [];
        }
    }

}
