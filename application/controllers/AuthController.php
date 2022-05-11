<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library("Aauth");
    }

    public function login() {
        if ($this->aauth->is_loggedin()) {
            redirect(base_url('app/dashboard'));
            exit();
        }

        $this->form_validation->set_rules('Email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('Password', 'Password', 'trim|required|min_length[6]|max_length[8]');
        $this->form_validation->set_error_delimiters("", "");
        if ($this->form_validation->run() == false) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
            exit();
        }
        $emailId = $this->input->post('Email');
        $password = $this->input->post('Password');
        if ($this->aauth->login($emailId, $password)) {
            $data['status'] = 1;
            echo json_encode($data);
            exit();
        } else {

            $data['status'] = 0;
            $data['error'] = $this->aauth->print_errors();
            echo json_encode($data);
            exit();
        }
    }

    public function logout() {

        $this->aauth->logout();
        redirect(base_url());
        exit();
    }

}
