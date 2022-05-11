<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DownloadController extends MY_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper('download');
    }
    
    public function downloadSampleExcel(){
        force_download('./download/sample.xlsx', NULL);
    }
}