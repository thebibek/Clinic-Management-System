<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PaymentModel extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
    
    public function isSavedPMode($insert){
        if($this->db->insert('paymentmode',$insert)){
            return true;
        }else{
            return false;
        }
    }
    
    /*
     * retrive all blood groups for listing
     * 
     */

    public function supplyPaymentModes() {

        $query = $this->db->get('paymentmode');
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

    public function supplySinglePM($pmId) {
        $wh = [
            'ID'=> $pmId
        ];
        $query = $this->db->get_where('paymentmode', $wh);
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

    public function isUpdatedPMode($pmId, $paymentMode, $d1) {
        $wh = [
            'ID'=> $pmId
        ];
        $q1 = $this->db->get_where('paymentmode', ['ID' => $pmId, 'PaymentMode' => $paymentMode]);
        if ($q1->num_rows() == 1) {
            if ($this->db->update('paymentmode', $d1, $wh)) {
                return true;
            } else {
                return false;
            }
        } else {
            $q2 = $this->db->get_where('paymentmode', ['PaymentMode' => $paymentMode]);
            if ($q2->num_rows() == 1) {
                return -2;
            } else {
                $d1['PaymentMode'] = $paymentMode;
                
                if ($this->db->update('paymentmode', $d1, $wh)) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }

    public function isDeletedPM($pmId) {
        $wh = [
            'ID' => $pmId
        ];
        if ($this->db->delete('paymentmode', $wh)) {
            return true;
        } else {
            return false;
        }
    }
}