<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CategoryController extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('CategoryModel', 'category');

        if (!$this->aauth->is_loggedin()) {
            redirect(base_url());
            exit();
        }
    }

    public function index() {
        $data = [
            'categories' => $this->category->supplyCategories()
        ];
        $this->load->view("Masters/CategoryView", $data);
    }

    public function saveCategory() {
        $this->form_validation->set_rules('Category', 'category', 'trim|required|min_length[1]|max_length[35]|alpha_numeric_spaces|is_unique[category.Category]');
        $this->form_validation->set_rules('ShortName', 'shortname', 'trim|min_length[1]|max_length[15]|alpha_numeric_spaces');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            //get values 
            $category = strtoupper(html_escape(strip_tags($this->input->post('Category'))));
            $shortName = strtoupper(html_escape(strip_tags($this->input->post('ShortName'))));

            $DataCategory = [
                'Category' => $category,
                'ShortName' => $shortName,
                'IsActive' => 1,
                'IsDeleted' => 0,
                'CreatedBy' => 1,
                'CreatedAt' => date('Y-m-d'),
                'UpdatedAt' => date('Y-m-d'),
            ];
            $DataCategory = $this->security->xss_clean($DataCategory);
            if ($this->category->isSavedCategory($DataCategory)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function deleteCategory() {
        $this->form_validation->set_rules('CategoryID', 'category', 'trim|integer|required|min_length[1]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $where = [
                'ID' => html_escape(strip_tags($this->input->post('CategoryID')))
            ];
            $where = $this->security->xss_clean($where);
            if ($this->category->isDeletedCategory($where)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function editCategory() {
        $this->form_validation->set_rules('CategoryID', 'category', 'trim|integer|required|min_length[1]');
        $this->form_validation->set_error_delimiters('', '');

        if ($this->form_validation->run() == false) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            //get values
            $categoryId = $this->input->post('CategoryID');

            $where = [
                'ID' => $categoryId,
                'IsActive' => 1,
                'IsDeleted' => 0
            ];
            $where = $this->security->xss_clean($where);

            $result = $this->category->supplyCategory($where);
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

    public function updateCategory() {
        $this->form_validation->set_rules('Category', 'category', 'trim|required|min_length[1]|max_length[35]|alpha_numeric_spaces');
        $this->form_validation->set_rules('ShortName', 'shortname', 'trim|min_length[1]|max_length[15]|alpha_numeric_spaces');
        $this->form_validation->set_rules('CategoryID', 'category', 'trim|integer|required|min_length[1]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            //get values 
            $category = strtoupper(html_escape(strip_tags($this->input->post('Category'))));
            $shortName = strtoupper(html_escape(strip_tags($this->input->post('ShortName'))));
            $categoryId = $this->input->post('CategoryID');
            $DataCategory = [
                'Category' => $category,
                'ShortName' => $shortName,
                'UpdatedAt' => date('Y-m-d'),
            ];
            $where = [
                'ID' => $categoryId
            ];
            $DataCategory = $this->security->xss_clean($DataCategory);
            $result = $this->category->isUpdatedCategory($DataCategory, $where);
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
