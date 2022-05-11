<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    /**
     * Class constructor
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('UtilityModel', 'utility');
        $data['notifications'] = $this->getNotification();
        $data['pendingTasks'] = $this->getPendingTask();
        $this->load->view("Partials/TopHeader",$data,true);
        
        
        if (!$this->aauth->is_loggedin()) {
            redirect(base_url());
            exit();
        }
        
    }
    
    public function getNotification(){
        return $this->utility->supplyNotification();
    }
    
    public function getPendingTask(){
        return $this->utility->supplyPendingTask();
    }

    public function isLoggedIn() {
        if ($this->session->has_userdata('LoggedIn')) {
            if ($this->session->userdata('LoggedIn') == TRUE) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }

    //pass table name to get max code

    public function getMaxCode($tableName) {
        //check code is available
        if ($this->utility->supplyMaxCode($tableName) == FALSE) {
            $nextCode = '001';
        } else {
            $maxCodeArray = $this->utility->supplyMaxCode($tableName);
            $maxCode = $maxCodeArray['MaxCode'];
            if (strlen($maxCode) < 3) {
                $nextCode = $maxCode + 1;
                $nextCode = str_pad($nextCode, 3, "0", STR_PAD_LEFT);
            } else {
                $nextCode = $maxCode + 1;
            }
        }
        return $nextCode;
    }

    public function getVoucherNo($tableName) {
        //check code is available
        if ($this->utility->supplyMaxCode($tableName) == FALSE) {
            $nextCode = '1'.rand(99,1000);
        } else {
            $maxCodeArray = $this->utility->supplyMaxCode($tableName);
            $maxCode = $maxCodeArray['MaxCode'];
            $nextCode = $maxCode+1;
            $nextCode = $nextCode.rand(99,1000);
        }
        return $nextCode;
    }

    public function getOPDNo($tableName) {
        //check code is available
        if ($this->utility->supplyMaxCode($tableName) == FALSE) {
            $opdCode = 'OP/' . date('y') . '/00001';
        } else {
            $maxCodeArray = $this->utility->supplyMaxCode($tableName);
            $maxCode = $maxCodeArray['MaxCode'];
            if (strlen($maxCode) < 5) {
                $opdCode = $maxCode + 1;
                $opdCode = str_pad($opdCode, 5, "0", STR_PAD_LEFT);
                $opdCode = 'OP/' . date('y') . '/' . $opdCode;
            } else {
                $opdCode = $maxCode + 1;
                $opdCode = 'OP/' . date('y') . '/' . $opdCode;
            }
        }
        return $opdCode;
    }

    public function getMRNo($tableName) {
        if ($this->utility->supplyMaxCode($tableName) == FALSE) {
            $mrNo = 'MR' . '00001';
        } else {
            $maxCodeArray = $this->utility->supplyMaxCode($tableName);
            $maxCode = $maxCodeArray['MaxCode'];
            if (strlen($maxCode) < 5) {
                $mrNo = $maxCode + 1;
                $mrNo = str_pad($mrNo, 5, "0", STR_PAD_LEFT);
                $mrNo = 'MR' . $mrNo;
            } else {
                $mrNo = $maxCode + 1;
                $mrNo = 'MR' . $mrNo;
            }
        }
        return $mrNo;
    }

    public function getSalarySlipSerialNo($tableName){
        if(!empty($this->utility->supplySalarySlipSerialNo($tableName))){
            return $rw = $this->utility->supplySalarySlipSerialNo($tableName);

            
        }else{
            return [];
        }   
    }

    public function getAttendanceId($tableName) {
        if ($this->utility->supplyMaxCode($tableName) == FALSE) {
            $id = 'A' . '00001';
        } else {
            $maxCodeArray = $this->utility->supplyMaxCode($tableName);
            $maxCode = $maxCodeArray['MaxCode'];
            if (strlen($maxCode) < 5) {
                $id = $maxCode + 1;
                $id = str_pad($id, 5, "0", STR_PAD_LEFT);
                $id = 'A' . $id;
            } else {
                $id = $maxCode + 1;
                $id = 'A' . $id;
            }
        }
        return $id;
    }

    public function getEmergencyNo($tablename) {
        if ($this->utility->supplyMaxCode($tablename) == FALSE) {
            $emergencyNo = 'MR' . '00000001';
        } else {
            $maxCodeArray = $this->utility->supplyMaxCode($tablename);
            $maxCode = $maxCodeArray['MaxCode'];
            if (strlen($maxCode) < 8) {
                $emergencyNo = $maxCode + 1;
                $emergencyNo = str_pad($emergencyNo, 8, "0", STR_PAD_LEFT);
                $emergencyNo = 'MR' . $emergencyNo;
            } else {
                $emergencyNo = $maxCode + 1;
                $emergencyNo = 'MR' . $emergencyNo;
            }
        }
        return $emergencyNo;
    }

    public function getSheetNo($tablename) {
        if ($this->utility->supplyMaxCode($tablename) == FALSE) {
            $sheetNo = 'SH' . '00000001';
        } else {
            $maxCodeArray = $this->utility->supplyMaxCode($tablename);
            $maxCode = $maxCodeArray['MaxCode'];
            if (strlen($maxCode) < 8) {
                $sheetNo = $maxCode + 1;
                $sheetNo = str_pad($sheetNo, 8, "0", STR_PAD_LEFT);
                $sheetNo = 'SH' . $sheetNo;
            } else {
                $sheetNo = $maxCode + 1;
                $sheetNo = 'MR' . $sheetNo;
            }
        }
        return $sheetNo;
    }

    public function getOPDBillNo($tableName) {
        if ($this->utility->supplyMaxCode($tableName) === FALSE) {
            $opdBillNo = 'OPD' . '00001';
        } else {
            $maxCodeArray = $this->utility->supplyMaxCode($tableName);
            $maxCode = $maxCodeArray['MaxCode'];
            if (strlen($maxCode) < 5) {
                $opdBillNo = $maxCode + 1;
                $opdBillNo = str_pad($opdBillNo, 5, "0", STR_PAD_LEFT);
                $opdBillNo = 'OPD' . $opdBillNo;
            } else {
                $opdBillNo = $maxCode + 1;
                $opdBillNo = 'OPD' . $opdBillNo;
            }
        }
        return $opdBillNo;
    }

    public function getBillNo($tableName) {
        if ($this->utility->supplyMaxCode($tableName) === FALSE) {
            $opdBillNo = time() . '001';
        } else {
            $maxCodeArray = $this->utility->supplyMaxCode($tableName);
            $maxCode = $maxCodeArray['MaxCode'];
            if (strlen($maxCode) < 3) {
                $opdBillNo = $maxCode + 1;
                $opdBillNo = str_pad($opdBillNo, 3, "0", STR_PAD_LEFT);
                $opdBillNo = time() . $opdBillNo;
            } else {
                $opdBillNo = $maxCode + 1;
                $opdBillNo = time() . $opdBillNo;
            }
        }
        return $opdBillNo;
    }

    public function getOPDReceiptNo($tableName) {
        if ($this->utility->supplyMaxCode($tableName) === FALSE) {
            $opdReceiptNo = 'OPDR' . '00001';
        } else {
            $maxCodeArray = $this->utility->supplyMaxCode($tableName);
            $maxCode = $maxCodeArray['MaxCode'];
            if (strlen($maxCode) < 5) {
                $opdReceiptNo = $maxCode + 1;
                $opdReceiptNo = str_pad($opdReceiptNo, 5, "0", STR_PAD_LEFT);
                $opdReceiptNo = 'OPDR' . $opdReceiptNo;
            } else {
                $opdReceiptNo = $maxCode + 1;
                $opdReceiptNo = 'OPDR' . $opdReceiptNo;
            }
        }
        return $opdReceiptNo;
    }

    public function getReceiptNo($tableName) {
        if ($this->utility->supplyMaxCode($tableName) === FALSE) {
            $receiptNo = mt_rand(10, 100) . '001';
        } else {
            $maxCodeArray = $this->utility->supplyMaxCode($tableName);
            $maxCode = $maxCodeArray['MaxCode'];
            if (strlen($maxCode) < 3) {
                $receiptNo = $maxCode + 1;
                $receiptNo = str_pad($receiptNo, 3, "0", STR_PAD_LEFT);
                $receiptNo = mt_rand(10, 100) . $receiptNo;
            } else {
                $receiptNo = $maxCode + 1;
                $receiptNo = mt_rand(10, 100) . $receiptNo;
            }
        }
        return $receiptNo;
    }

    public function getConcessionNo($tableName) {
        if ($this->utility->supplyMaxCode($tableName) === FALSE) {
            $opdConcessionNo = 'OPDC' . '00001';
        } else {
            $maxCodeArray = $this->utility->supplyMaxCode($tableName);
            $maxCode = $maxCodeArray['MaxCode'];
            if (strlen($maxCode) < 5) {
                $opdConcessionNo = $maxCode + 1;
                $opdConcessionNo = str_pad($opdConcessionNo, 5, "0", STR_PAD_LEFT);
                $opdConcessionNo = 'OPDC' . $opdConcessionNo;
            } else {
                $opdConcessionNo = $maxCode + 1;
                $opdConcessionNo = 'OPDC' . $opdConcessionNo;
            }
        }
        return $opdConcessionNo;
    }

    public function alpha_space($str) {
        if (!preg_match('/^[\pL\s]+$/u', $str)) {
            $this->form_validation->set_message('alpha_space', 'The {field} field contain only characters and spaces');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    //pass the field name of input, if true errorr exist or no errorr
    //$fieldname is string value
    public function isInputError($fieldName) {
        $error = form_error($fieldName);
        if (!empty($error)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function errorMessage($fieldName) {
        $error = form_error($fieldName);
        if (!empty($error)) {
            $error = str_ireplace('<p>', '', $error);
            $error = str_ireplace('</p>', '', $error);
            return $error;
        } else {
            return 0;
        }
    }

    public function number_check($val) {
        if (is_numeric($val) || $val == 0) {
            return TRUE;
        } else {

            $this->form_validation->set_message('number_check', 'The {field} field can accept only 0 or decimal or integer');
            return FALSE;
        }
    }

    public function appDateFormat($date, $flag) {
        /*
         * 1- DD-MM-YYYY
         * 2- MM-DD-YYYY
         * 3- YYYY-MM-DD
         * 
         */

        if ($flag == 1) {
            $dateFormat = date('d-m-Y', strtotime($date));
        }

        if ($flag == 2) {
            $dateFormat = date('m-d-Y', strtotime($date));
        }

        if ($flag == 3) {
            $dateFormat = date('Y-m-d', strtotime($date));
        }

        return $dateFormat;
    }

}

/* End of file MY_Controller.php */
