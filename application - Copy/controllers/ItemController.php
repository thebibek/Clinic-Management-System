<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ItemController extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("ItemTypeModel", 'itemtype');
        $this->load->model("ItemModel", 'item');
    }

    public function index() {
        $this->load->view("Supplier/ItemTypeView");
    }

    public function saveItemType() {
        $this->form_validation->set_rules('ItemType', 'Item type', 'trim|required|min_length[1]|max_length[91]');
        $this->form_validation->set_rules('Description', 'Description', 'trim|required|min_length[1]|max_length[91]');
        $this->form_validation->set_rules('IsActive', 'IsActive', 'trim|required|min_length[1]|max_length[1]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            //get values 
            $itemType = strtoupper(strip_tags($this->input->post('ItemType')));
            $description = strtoupper(html_escape(strip_tags($this->input->post('Description'))));

            if ($this->input->post('IsActive') == 1) {
                $isActive = 1;
            } else {
                $isActive = 0;
            }


            $dataItemType = [
                'ItemType' => $itemType,
                'Description' => $description,
                'IsActive' => $isActive,
                'CreatedAt' => date('Y-m-d'),
                'UpdatedAt' => date('Y-m-d'),
            ];
            $dataItemType = $this->security->xss_clean($dataItemType);
            if ($this->itemtype->isSavedItemType($dataItemType)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function createItem() {
        $this->load->view("Supplier/ItemView");
    }

    public function saveItem() {
        $this->form_validation->set_rules('ItemType', 'Item type', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('ItemName', 'Item name', 'trim|required|min_length[1]|max_length[51]|is_unique[item.ItemName]');
        $this->form_validation->set_rules('Description', 'Description', 'trim|alpha_numeric_spaces|max_length[51]');
        $this->form_validation->set_rules('OpeningBalance', 'Opening balance', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('ItemRate', 'Item rate', 'trim|required|decimal|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('IsActive', 'IsActive', 'trim|min_length[1]|max_length[1]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {

            //get values 
            $itemType = strip_tags($this->input->post('ItemType'));
            $itemName = strtoupper(strip_tags($this->input->post('ItemName')));
            $description = html_escape(strip_tags($this->input->post('Description')));
            $openingBal = strip_tags($this->input->post('OpeningBalance'));
            $itemRate = strip_tags($this->input->post('ItemRate'));

            if ($this->input->post('IsActive') == 1) {
                $isActive = 1;
            } else {
                $isActive = 0;
            }


            $item = [
                'ItemTypeID' => $itemType,
                'ItemName' => $itemName,
                'Description' => $description,
                'OpeningBalance' => $openingBal,
                'Rate' => $itemRate,
                'IsActive' => $isActive,
                'CreatedAt' => date('Y-m-d'),
                'UpdatedAt' => date('Y-m-d'),
            ];
            $item = $this->security->xss_clean($item);
            if ($this->item->isSavedItem($item)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function deleteItemType() {
        $this->form_validation->set_rules('ItemTypeID', 'Item type id', 'trim|integer|required|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $where = [
                'ID' => html_escape(strip_tags($this->input->post('ItemTypeID')))
            ];
            $where = $this->security->xss_clean($where);
            if ($this->itemtype->isDeletedItemType($where)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function editItemType() {
        $this->form_validation->set_rules('ItemTypeID', 'Item type id', 'trim|integer|required|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');

        if ($this->form_validation->run() == false) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            //get values
            $itemTypeId = $this->input->post('ItemTypeID');

            $where = [
                'ID' => $itemTypeId,
            ];
            $where = $this->security->xss_clean($where);

            $result = $this->itemtype->supplyItemType($where);
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

    public function updateItemType() {
        $this->form_validation->set_rules('ItemType', 'Item type', 'trim|required|min_length[1]|max_length[91]');
        $this->form_validation->set_rules('Description', 'Description', 'trim|required|min_length[1]|max_length[91]');
        $this->form_validation->set_rules('IsActive', 'IsActive', 'trim|required|min_length[1]|max_length[1]');
        $this->form_validation->set_rules('ItemTypeID', 'Item type id', 'trim|integer|required|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {

            //get values 
            $itemType = strtoupper(strip_tags($this->input->post('ItemType')));
            $description = strtoupper(html_escape(strip_tags($this->input->post('Description'))));
            $itemTypeId = $this->input->post('ItemTypeID');

            if ($this->input->post('IsActive') == 1) {
                $isActive = 1;
            } else {
                $isActive = 0;
            }

            $d1 = [
                'ItemType' => $itemType,
                'Description' => $description,
                'IsActive' => $isActive,
                'UpdatedAt' => date('Y-m-d'),
            ];

            $d2 = [
                'Description' => $description,
                'IsActive' => $isActive,
                'UpdatedAt' => date('Y-m-d'),
            ];

            $where = [
                'ID' => $itemTypeId
            ];
            $d1 = $this->security->xss_clean($d1);
            $d2 = $this->security->xss_clean($d2);
            $result = $this->itemtype->isUpdatedItemType($d1, $d2, $where);
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

    public function deleteItem() {
        $this->form_validation->set_rules('ItemID', 'Item id', 'trim|integer|required|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $where = [
                'ID' => html_escape(strip_tags($this->input->post('ItemID')))
            ];
            $where = $this->security->xss_clean($where);
            if ($this->item->isDeletedItem($where)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function editItem() {
        $this->form_validation->set_rules('ItemID', 'Item id', 'trim|integer|required|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');

        if ($this->form_validation->run() == false) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            //get values
            $itemId = $this->input->post('ItemID');

            $where = [
                'ID' => $itemId,
            ];
            $where = $this->security->xss_clean($where);

            $result = $this->item->supplyItem($where);
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

    public function updateItem() {
        $this->form_validation->set_rules('ItemType', 'Item type', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('ItemName', 'Item name', 'trim|required|min_length[1]|max_length[51]');
        $this->form_validation->set_rules('Description', 'Description', 'trim|alpha_numeric_spaces|max_length[51]');
        $this->form_validation->set_rules('OpeningBalance', 'Opening balance', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('ItemRate', 'Item rate', 'trim|required|decimal|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('IsActive', 'IsActive', 'trim|min_length[1]|max_length[1]');
        $this->form_validation->set_rules('ItemID', 'ItemID', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == false) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            //get values 
            $itemType = strip_tags($this->input->post('ItemType'));
            $itemName = strtoupper(strip_tags($this->input->post('ItemName')));
            $description = html_escape(strip_tags($this->input->post('Description')));
            $openingBal = strip_tags($this->input->post('OpeningBalance'));
            $itemRate = strip_tags($this->input->post('ItemRate'));
            $itemId = $this->input->post("ItemID");

            if ($this->input->post('IsActive') == 1) {
                $isActive = 1;
            } else {
                $isActive = 0;
            }

            $wh = [
                'ID' => $itemId
            ];

            //data to be updated
            $d1 = [
                'ItemTypeID' => $itemType,
                'Description' => $description,
                'OpeningBalance' => $openingBal,
                'Rate' => $itemRate,
                'IsActive' => $isActive,
                'UpdatedAt' => date('Y-m-d'),
            ];
            $d1 = $this->security->xss_clean($d1);
            $result = $this->item->isUpdatedItem($d1, $itemName, $wh);

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
