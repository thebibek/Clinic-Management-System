<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ApplicationController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library("Aauth");
        $this->load->model("DashboardModel", 'dashboard');

        if ($this->aauth->is_loggedin()) {
            redirect(base_url('app/dashboard'));
            exit();
        }
    }

    public function index() {
        $this->load->view("Application/StartView");
    }

}
