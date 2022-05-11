<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UtilityController extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function getYear() {
        $this->form_validation->set_rules('BirthDate', 'BirthDate', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            echo json_encode($data);
        } else {
            $dateOfBirth = $this->input->post('BirthDate');


            $date1 = new DateTime($dateOfBirth);
            $date2 = $date1->diff(new DateTime(date('Y-m-d')));

            $data['Year'] = $date2->y;
            $data['Month'] = $date2->m;
            $data['Day'] = $date2->d;

            echo json_encode($data);
        }
    }

}
