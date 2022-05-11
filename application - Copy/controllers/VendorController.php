<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class VendorController extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('VendorModel', 'vendor');
    }

    public function index() {
        $this->load->view("Supplier/VendorView");
    }

    // Creating vendor and L

    public function saveVendor() {
        $this->form_validation->set_rules('Vendor', 'Vendor', 'trim|required|min_length[1]|max_length[91]|is_unique[vendor.Vendor]');
        $this->form_validation->set_rules('Address', 'Address', 'trim|required|min_length[1]|max_length[151]');
        $this->form_validation->set_rules('ContactNo', 'Contact No', 'trim|required|integer|min_length[1]|max_length[15]');
        $this->form_validation->set_rules('CompanyID', 'Company Id', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('LedgerGroupID', 'Ledger Group Id', 'trim|required|integer|min_length[1]|max_length[91]');
        $this->form_validation->set_rules('IsActive', 'IsActive', 'trim|required|min_length[1]|max_length[1]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            //get values 
            $vendor = strtoupper(strip_tags($this->input->post('Vendor')));
            $address = strip_tags($this->input->post('Address'));
            $contactNo = strip_tags($this->input->post('ContactNo'));
            $companyId = strip_tags($this->input->post('CompanyID'));
            $ledgerGroupId = strip_tags($this->input->post('LedgerGroupID'));

            if ($this->input->post('IsActive') == 1) {
                $isActive = 1;
            } else {
                $isActive = 0;
            }


            $dataVendor = [
                'Vendor' => $vendor,
                'CompanyID' => $companyId,
                'LedgerGroupID' => $ledgerGroupId,
                'Address' => $address,
                'ContactNo' => $contactNo,
                'IsActive' => $isActive,
                'CreatedAt' => date('Y-m-d'),
                'UpdatedAt' => date('Y-m-d'),
            ];


            $dataVendor = $this->security->xss_clean($dataVendor);
            if ($this->vendor->isSavedVendor($dataVendor, $companyId, $ledgerGroupId)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function deleteVendor() {
        $this->form_validation->set_rules('VendorID', 'Vendor id', 'trim|integer|required|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == false) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $where = [
                'ID' => html_escape(strip_tags($this->input->post('VendorID')))
            ];
            $where = $this->security->xss_clean($where);
            if ($this->vendor->isDeletedVendor($where)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function editVendor() {
        $this->form_validation->set_rules('VendorID', 'Vendor id', 'trim|integer|required|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');

        if ($this->form_validation->run() == false) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            //get values
            $vendorId = $this->input->post('VendorID');

            $where = [
                'ID' => $vendorId,
            ];
            $where = $this->security->xss_clean($where);

            $result = $this->vendor->supplyVendor($where);
            if (!empty($result)) {
                $data['status'] = 1;
                $data['result'] = $result;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function updateVendor() {
        $this->form_validation->set_rules('Vendor', 'Vendor', 'trim|required|min_length[1]|max_length[91]');
        $this->form_validation->set_rules('Address', 'Address', 'trim|required|min_length[1]|max_length[151]');
        $this->form_validation->set_rules('ContactNo', 'Contact No', 'trim|required|integer|min_length[1]|max_length[15]');
        $this->form_validation->set_rules('CompanyID', 'Company Id', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('LedgerGroupID', 'Ledger Group Id', 'trim|required|integer|min_length[1]|max_length[91]');
        $this->form_validation->set_rules('IsActive', 'IsActive', 'trim|required|min_length[1]|max_length[1]');
        $this->form_validation->set_rules('VendorID', 'Vendor id', 'trim|integer|required|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {

            //get values 
            $vendor = strtoupper(strip_tags($this->input->post('Vendor')));
            $address = strip_tags($this->input->post('Address'));
            $contactNo = strip_tags($this->input->post('ContactNo'));
            $companyId = strip_tags($this->input->post('CompanyID'));
            $ledgerGroupId = strip_tags($this->input->post('LedgerGroupID'));
            $vendorId = $this->input->post('VendorID');

            if ($this->input->post('IsActive') == 1) {
                $isActive = 1;
            } else {
                $isActive = 0;
            }

            $d1 = [
                'CompanyID' => $companyId,
                'LedgerGroupID' => $ledgerGroupId,
                'Address' => $address,
                'ContactNo' => $contactNo,
                'IsActive' => $isActive,
                'UpdatedAt' => date('Y-m-d'),
            ];

            $where = [
                'ID' => $vendorId
            ];



            $d1 = $this->security->xss_clean($d1);
            $result = $this->vendor->isUpdatedVendor($d1, $vendor, $where);
            if ($result !== -2) {
                $data['status'] = 1;
                echo json_encode($data);
            } else if ($result == -2) {
                $data['status'] = -2;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                json_encode($data);
            }
        }
    }

}
