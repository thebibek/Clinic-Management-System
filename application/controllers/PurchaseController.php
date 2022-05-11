<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PurchaseController extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("PurchaseModel", 'purchase');
        $this->load->model('SettingsModel', 'settings');
    }

    public function inwardItem() {
        $this->load->view("Purchase/ItemInwardView");
    }

    public function getItemName() {
        $this->form_validation->set_rules('ItemTypeID', 'Item type id', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');

        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['status'] = validation_errors();
            echo json_encode($data);
        } else {
            $itemTypeId = strip_tags($this->input->post('ItemTypeID'));

            $dataId = [
                'ItemTypeID' => $itemTypeId
            ];

            $result = $this->purchase->supplyItemNames($dataId);

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

    public function validatePurchaseItem() {
        $this->form_validation->set_rules('InwardDate', 'Inward date', 'trim|required');
        $this->form_validation->set_rules('BillNo', 'Bill No', 'trim|required|min_length[1]|max_length[31]');
        $this->form_validation->set_rules('Vendor', 'Vendor', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('ItemTypeID', 'Item type', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('ItemNameID', '', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('Desc', 'Description', 'trim|min_length[1]|max_length[51]');
        $this->form_validation->set_rules('Rate', 'Rate', 'trim|required|numeric|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('Quantity', 'Quantity', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('Total', 'Total', 'trim|required|numeric|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $data['status'] = 1;
            echo json_encode($data);
        }
    }

    public function updatePurchaseItems() {
        $this->form_validation->set_rules('InwardDate', 'InwardDate', 'trim|required|min_length[1]');
        $this->form_validation->set_rules('BillNo', 'Bill No', 'trim|required|min_length[1]|max_length[31]');
        $this->form_validation->set_rules('Vendor', 'Vendor', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('BillAmount', 'BillAmount', 'trim|required|numeric|min_length[1]');
        $this->form_validation->set_rules('BillID', 'Purchase Bill id', 'trim|required|integer|min_length[1]|max_length[11]');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $purchaseDate = $this->input->post('InwardDate');
            $billNo = strip_tags($this->input->post('BillNo'));
            $vendorId = $this->input->post('Vendor');
            $billAmount = strip_tags($this->input->post('BillAmount'));
            $billAmount = number_format($billAmount, 2, '.', '');
            $billId = $this->input->post('BillID');

            $purchaseItems = $this->input->post('PurchaseItems');


            //data  to be updated 
            $d1 = [
                'VendorID' => $vendorId,
                'PurchaseDate' => $purchaseDate,
                'BillAmount' => $billAmount,
                'UpdatedAt' => date('Y-m-d')
            ];
            $d1 = $this->security->xss_clean($d1);

            if (!empty($purchaseItems)) {
                if ($this->purchase->isUpdatedPurchaseItems($d1, $billNo, $purchaseItems, $billId)) {
                    $data['status'] = 1;
                    echo json_encode($data);
                }
            } else {
                $data['status'] = 0;
                $data['error'] = 'Add atleast one item.';
                echo json_encode($data);
            }
        }
    }

    public function savePurchaseItems() {
        $this->form_validation->set_rules('InwardDate', 'InwardDate', 'trim|required|min_length[1]');
        $this->form_validation->set_rules('BillNo', 'Bill No', 'trim|required|min_length[1]|max_length[31]|is_unique[purchase.BillNo]');
        $this->form_validation->set_rules('Vendor', 'Vendor', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('BillAmount', 'BillAmount', 'trim|required|numeric|min_length[1]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $purchaseDate = $this->input->post('InwardDate');
            $billNo = strip_tags($this->input->post('BillNo'));
            $vendorId = $this->input->post('Vendor');
            $billAmount = strip_tags($this->input->post('BillAmount'));
            $billAmount = number_format($billAmount, 2, '.', '');

            $purchaseItems = $this->input->post('PurchaseItems');


            $purchaseInput = [
                'VendorID' => $vendorId,
                'BillNo' => $billNo,
                'PurchaseDate' => $purchaseDate,
                'BillAmount' => $billAmount,
                'CreatedAt' => date('Y-m-d'),
                'UpdatedAt' => date('Y-m-d')
            ];
            $purchaseInput = $this->security->xss_clean($purchaseInput);

            if (!empty($purchaseItems)) {
                if ($this->purchase->isSavedPurchaseItems($purchaseInput, $purchaseItems)) {
                    $data['status'] = 1;
                    echo json_encode($data);
                }
            } else {
                $data['status'] = 0;
                $data['error'] = 'Add atleast one item.';
                echo json_encode($data);
            }
        }
    }

    public function providePurchaseBills() {
        $result = $this->purchase->supplyPurchaseBills();
        if (!empty($result)) {
            $data['status'] = 1;
            $data['result'] = $result;
            echo json_encode($data);
        } else {
            $data['status'] = -1;
            echo json_encode($data);
        }
    }

    public function managePurchase() {
        $this->load->view("Purchase/PurchaseManagerView");
    }

    public function filterPurchaseBills() {
        $this->form_validation->set_rules('PurchaseDate', 'Purchase date', 'trim|min_length[1]');
        $this->form_validation->set_rules('BillNo', 'Bill no', 'trim|min_length[1]|max_length[31]');
        $this->form_validation->set_rules('VendorID', 'Vendor Id', 'trim|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');

        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $purchaseDate = strip_tags($this->input->post('PurchaseDate'));
            $billNo = strip_tags($this->input->post('BillNo'));
            $vendorId = $this->input->post('VendorID');


            $param = [
                'PurchaseDate' => $purchaseDate,
                'BillNo' => $billNo,
                'VendorID' => $vendorId
            ];

            $param = $this->security->xss_clean($param);

            $result = $this->purchase->supplyFilterPurchaseBills($param);
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

    public function findBill() {
        $this->form_validation->set_rules('PurchaseBill', 'Purchase bill', 'trim|required|min_length[1]|max_length[31]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == false) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $billNo = $this->input->post('PurchaseBill');
            $wh = [
                'BillNo' => $billNo
            ];

            $wh = $this->security->xss_clean($wh);
            $result = $this->purchase->filterBill($wh);
            if (!empty($result)) {
                $data['result'] = $result;
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function viewPurchaseBill($id) {
        if (!is_numeric($id)) {
            redirect(base_url('app/manage/purchase'));
            exit();
        }

        //getting details for bill

        $data = [
            'bill' => $this->purchase->supplyPurchaseBill($id),
            'items' => $this->purchase->supplyItemPurchased($id),
            'rs' => $this->settings->supplySettings(),
            'billId' => $id
        ];

        $this->load->view("Purchase/PurchaseBillView", $data);
    }

    public function purchaseReport() {
        $this->load->view("Purchase/PurchaseReportView");
    }

    //filter purchase items between date 

    public function generateReport() {
        $this->form_validation->set_rules('FromDate', 'From date', 'trim|required|min_length[10]|max_length[10]');
        $this->form_validation->set_rules('ToDate', 'To date', 'trim|required|min_length[10]|max_length[10]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $fromDate = $this->input->post('FromDate');
            $toDate = $this->input->post('ToDate');

            $param = [
                'FromDate' => $fromDate,
                'ToDate' => $toDate
            ];

            $param = $this->security->xss_clean($param);
            $result = $this->purchase->provideReport($param);

            if (!empty($result)) {
                $data = [
                    'result' => $result,
                    'fromDate' => $fromDate,
                    'toDate' => $toDate
                ];
                echo $html = $this->load->view("Purchase/PurchaseReportHtml", $data, TRUE);
            } else {
                echo $html = '<span class="text-red">No Records Found</span>';
            }
        }
    }

    public function deletePurchaseBill() {
        $this->form_validation->set_rules('BillID', 'Bill id', 'trim|integer|required|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == false) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $billId = $this->input->post('BillID');

            $wh = [
                'ID' => $billId
            ];
            $wh = $this->security->xss_clean($wh);
            if ($this->purchase->isDeletedPurchaseBill($wh)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function editPurchaseBill() {
        $this->form_validation->set_rules('PurchaseBillID', 'Purchase bill id', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == false) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $billId = $this->input->post('PurchaseBillID');

            //getting purchase bill info
            $rs1 = $this->purchase->supplyPurchaseBill($billId);
            $rs2 = $this->purchase->supplyItemPurchased($billId);
            $totalBillAmt = 0.00;
            foreach ($rs2 as $v) {
                $totalBillAmt += $v['Total'];
            }

            $totalBillAmt = number_format($totalBillAmt, 2, '.', '');

            if (!empty($rs1)) {
                $data['rs1'] = $rs1;
                $data['rs2'] = $rs2;
                $data['TotalAmt'] = $totalBillAmt;
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

}
