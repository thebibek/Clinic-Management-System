<?php

class VoucherModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    //supply ledger for only contra entry
    public function supplyContraLedger()
    {
        $where = [
            'IsContraEntry' => 1
        ];
        $query = $this->db->get_where('ledger', $where);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    public function isSavedVoucher($data)
    {
        $this->db->trans_start();
        $this->db->insert_batch('acc_transaction', $data);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function supplyAllVouchers($param)
    {
        $this->db->select('*');
        $this->db->from('acc_transaction');
        $this->db->join('ledger', 'ledger.ID = acc_transaction.LedgerID', 'inner');
        $this->db->where('VDate >=', $param['FromDate']);
        $this->db->where('VDate <=', $param['ToDate']);
        $this->db->or_where('LedgerID =', $param['Ledger']);
        $this->db->or_where('LedgerGroupID =', $param['LedgerGroup']);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    public function supplyVouchers($param,$vType){
        $wh = [
            'Vtype'=> $vType
        ];
        $this->db->select('*');
        $this->db->from('acc_transaction');
        $this->db->join('ledger', 'ledger.ID = acc_transaction.LedgerID', 'inner');
        $this->db->where($wh);
        $this->db->where('VDate >=', $param['FromDate']);
        $this->db->where('VDate <=', $param['ToDate']);
        $this->db->or_where('LedgerID =', $param['Ledger']);
        $this->db->or_where('LedgerGroupID =', $param['LedgerGroup']);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    public function supplyDebitPaymentLedger()
    {
        $where = [
            'IsPaymentEntry !=' => 1
        ];

        $query = $this->db->get_where('ledger', $where);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    public function supplyCreditPaymentLedger()
    {
        $where = [
            'IsPaymentEntry' => 1
        ];
        $query = $this->db->get_where('ledger', $where);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    public function supplyDebitReceiptLedger()
    {
        $where = [
            'IsReceiptEntry' => 1
        ];

        $query = $this->db->get_where('ledger', $where);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    public function supplyCreditReceiptLedger()
    {
        $where = [
            'IsReceiptEntry !=' => 1
        ];

        $query = $this->db->get_where('ledger', $where);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    public function supplyJournalLedger(){
       
        $query = $this->db->get_where('ledger');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }
}
