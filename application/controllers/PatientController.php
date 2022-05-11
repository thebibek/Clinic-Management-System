<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PatientController extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library("Aauth");
        $this->load->model('PatientModel', 'patient');
    }

    public function index() {
        $data = [
            'mrNo' => $this->getMRNo('patient')
        ];

        $this->load->view("Patient/RegistrationView", $data);
    }

    public function showProfile($id) {

        if (!is_numeric($id)) {
            redirect(base_url("app/patient/registration"));
            exit();
        }
        $wh1 = [
            'patient.ID' => $id
        ];

        $wh2 = [
            'PatientID' => $id
        ];


        $data = [
            'profile' => $this->patient->supplyPatient($wh1),
            'test' => $this->patient->supplyPatientTests($wh2),
            'visit' => $this->patient->supplyPatientVisits($wh1)
        ];

        $this->load->view("Patient/ProfileView", $data);
    }

    public function visit() {
        $this->load->view("Patient/VisitView");
    }

    public function getVisits() {
        $this->form_validation->set_rules('MRNo', 'MRNo', 'trim|required|alpha_numeric|min_length[1]|max_length[91]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $mrNo = html_escape(strip_tags($this->input->post("MRNo")));

            $where = [
                "MRNo" => $mrNo
            ];

            $result = $this->patient->supplyPatientVisits($where);
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

    public function savePatient() {
        $this->form_validation->set_rules('FirstName', 'First name', 'trim|required|alpha_numeric_spaces|min_length[1]|max_length[31]');
        $this->form_validation->set_rules('LastName', 'Last name', 'trim|required|alpha_numeric_spaces|min_length[1]|max_length[31]');
        $this->form_validation->set_rules('MobileNo', 'Mobile no', 'trim|required|integer|min_length[1]|max_length[15]');
        $this->form_validation->set_rules('Email', 'Email', 'trim|valid_email|min_length[1]|max_length[51]');
        $this->form_validation->set_rules('BloodGroup', 'Blood group', 'trim|required|integer|min_length[1]|max_length[5]');
        $this->form_validation->set_rules('Gender', 'Gender', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('DateOfBirth', 'Date of birth', 'trim|required|min_length[1]|max_length[31]');
        $this->form_validation->set_rules('Age', 'Age', 'trim|required|integer|min_length[1]|max_length[31]');
        $this->form_validation->set_rules('Address', 'Address', 'trim|required|min_length[1]|max_length[91]');
        $this->form_validation->set_rules('IsActive', 'IsActive', 'trim|integer|min_length[1]|max_length[1]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            if ($this->input->post('IsActive') == 1) {
                $isActive = 1;
            } else {
                $isActive = 0;
            }

            if (isset($_FILES['file']['name'])) {
                $uploadPath = './assets/uploads/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = 100;
                $config['max_width'] = 400;
                $config['max_height'] = 400;
                $config['file_name'] = time() . random_int(99, 1000) . '_user';
                $config['file_ext_tolower'] = true;
                $config['overwrite'] = false;

                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('file')) {
                    $data['status'] = 0;
                    $data['error'] = $this->upload->display_errors();
                    echo json_encode($data);
                    exit();
                } else {
                    $fileName = $this->upload->data('file_name');
                }
            } else {
                $fileName = 'default.png';
            }

            $DataPatient = [
                'MRNo' => $this->getMRNo('patient'),
                'FirstName' => html_escape(strip_tags($this->input->post('FirstName'))),
                'LastName' => html_escape(strip_tags($this->input->post('LastName'))),
                'MobileNo' => html_escape(strip_tags($this->input->post('MobileNo'))),
                'Email' => html_escape(strip_tags($this->input->post('Email'))),
                'BloodGroupID' => html_escape(strip_tags($this->input->post('BloodGroup'))),
                'Gender' => html_escape(strip_tags($this->input->post('Gender'))),
                'DateOfBirth' => html_escape(strip_tags($this->input->post('DateOfBirth'))),
                'Age' => html_escape(strip_tags($this->input->post('Age'))),
                'Address' => html_escape(strip_tags($this->input->post('Address'))),
                'IsActive' => $isActive,
                'Image' => $fileName,
                'CreatedAt' => date('Y-m-d'),
                'UpdatedAt' => date('Y-m-d')
            ];
            $DataPatient = $this->security->xss_clean($DataPatient);
            if ($this->patient->isSavedPatient($DataPatient)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function deleteDoctor() {
        $this->form_validation->set_rules('DoctorID', 'DoctorID', 'trim|integer|required|min_length[1]');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            echo json_encode($data);
        } else {
            $where = [
                'ID' => html_escape(strip_tags($this->input->post('DoctorID')))
            ];
            $where = $this->security->xss_clean($where);
            if ($this->doctor->isDeletedDoctor($where)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function editDoctor() {
        $this->form_validation->set_rules('DoctorID', 'doctor id', 'trim|integer|required|min_length[1]');
        $this->form_validation->set_error_delimiters('', '');

        if ($this->form_validation->run() == false) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            //get values
            $doctorId = $this->input->post('DoctorID');

            $where = [
                'ID' => $doctorId,
            ];
            $where = $this->security->xss_clean($where);

            $result = $this->doctor->supplyDoctor($where);
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

    public function updateDoctor() {
        $this->form_validation->set_rules('DoctorID', '', 'trim|required|integer|min_length[1]|max_length[31]');
        $this->form_validation->set_rules('Salutation', '', 'trim|required|alpha|min_length[1]|max_length[31]');
        $this->form_validation->set_rules('FirstName', 'First name', 'trim|required|alpha_numeric_spaces|min_length[1]|max_length[31]');
        $this->form_validation->set_rules('LastName', 'Last name', 'trim|required|alpha_numeric_spaces|min_length[1]|max_length[31]');
        $this->form_validation->set_rules('MobileNo', 'Mobile no', 'trim|required|integer|min_length[1]|max_length[15]');
        $this->form_validation->set_rules('Email', 'Email', 'trim|required|valid_email|min_length[1]|max_length[51]');
        $this->form_validation->set_rules('Designation', 'Designation', 'trim|required|alpha_numeric_spaces|min_length[1]|max_length[31]');
        $this->form_validation->set_rules('Department', 'Department', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('Specialist', 'Specialist', 'trim|alpha_numeric_spaces|min_length[1]|max_length[31]');
        $this->form_validation->set_rules('Qualification', 'Qualification', 'trim|min_length[1]|max_length[31]');
        $this->form_validation->set_rules('Address', 'Address', 'trim|required|min_length[1]|max_length[91]');
        $this->form_validation->set_rules('Hospital', 'Hospital', 'trim|required|min_length[1]|alpha_numeric_spaces|max_length[91]');
        $this->form_validation->set_rules("Commision", "Commision", 'trim|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('IsActive', 'IsActive', 'trim|integer|min_length[1]|max_length[1]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {

            if ($this->input->post('IsActive') == 1) {
                $isActive = 1;
            } else {
                $isActive = 0;
            }

            $DataDoctor = [
                'Salutation' => html_escape(strip_tags($this->input->post('Salutation'))),
                'FirstName' => html_escape(strip_tags($this->input->post('FirstName'))),
                'LastName' => html_escape(strip_tags($this->input->post('LastName'))),
                'MobileNo' => html_escape(strip_tags($this->input->post('MobileNo'))),
                'Email' => html_escape(strip_tags($this->input->post('Email'))),
                'Designation' => html_escape(strip_tags($this->input->post('Designation'))),
                'DepartmentID' => html_escape(strip_tags($this->input->post('Department'))),
                'Specialist' => html_escape(strip_tags($this->input->post('Specialist'))),
                'Qualification' => html_escape(strip_tags($this->input->post('Qualification'))),
                'Address' => html_escape(strip_tags($this->input->post('Address'))),
                'Hospital' => html_escape(strip_tags($this->input->post('Hospital'))),
                'Commision' => html_escape(strip_tags($this->input->post('Commision'))),
                'IsActive' => $isActive,
                'CreatedAt' => date('Y-m-d'),
                'UpdatedAt' => date('Y-m-d')
            ];

            $where = [
                'ID' => $this->input->post('DoctorID')
            ];
            $DataDoctor = $this->security->xss_clean($DataDoctor);
            $where = $this->security->xss_clean($where);
            $result = $this->doctor->isUpdatedDoctor($DataDoctor, $where);
            if ($result) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                json_encode($data);
            }
        }
    }

    public function showCommision() {
        $data = [
            'doctorCommisions' => $this->doctor->supplyDoctorCommisions()
        ];

        $this->load->view("Expenses/DoctorCommisionView", $data);
    }

    public function deleteCommision() {
        $this->form_validation->set_rules('CommissionID', 'CommissionID', 'trim|required|integer|min_length[1]');
        $this->form_validation->set_error_delimiters('', '');

        if ($this->form_validation->run() == FALSE) {
            $data['error'] = validation_errors();
            $data['status'] = 0;
            echo json_encode($data);
        } else {
            $commissionId = html_escape(strip_tags($this->input->post('CommissionID')));
            $update = [
                'IsDeleted' => 1
            ];

            $where = [
                'ID' => $commissionId
            ];

            if ($this->doctor->isDeletedCommission($update, $where)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function editCommission() {
        $this->form_validation->set_rules('CommissionID', 'CommissionID', 'trim|required|integer|min_length[1]');
        $this->form_validation->set_error_delimiters('', '');

        if ($this->form_validation->run() == FALSE) {
            $data['error'] = validation_errors();
            $data['status'] = 0;
            echo json_encode($data);
        } else {
            $commissionId = html_escape(strip_tags($this->input->post('CommissionID')));

            $where = [
                'ID' => $commissionId
            ];

            $result = $this->doctor->supplyCommission($where);
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

    public function updateCommission() {
        $this->form_validation->set_rules('PayAmount', 'PayAmount', 'trim|required|min_length[1]');
        $this->form_validation->set_rules('CommissionID', 'CommissionID', 'trim|required|integer|min_length[1]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['error'] = validation_errors();
            $data['status'] = 0;
            echo json_encode($data);
        } else {
            $commissionId = html_escape(strip_tags($this->input->post('CommissionID')));
            $payAmount = html_escape(strip_tags($this->input->post('PayAmount')));

            if (!is_numeric($payAmount)) {

                $data['status'] = 0;
                $data['error'] = 'pay amount should be integer or decimal value.';
                echo json_encode($data);
                exit();
            } else {
                if (is_float((float) $payAmount)) {

                    $payAmount = number_format($payAmount, 2, '.', '');
                } else {
                    $data['status'] = 0;
                    $data['error'] = 'pay amount should be integer or decimal value.';
                    echo json_encode($data);
                    exit();
                }
            }

            $where = [
                'ID' => $commissionId
            ];
            $update = [
                'PayAmount' => $payAmount,
                'UpdatedAt' => date('Y-m-d')
            ];

            if ($this->doctor->isUpdatedCommission($update, $where)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function payCommission() {
        $this->form_validation->set_rules('CommissionID', 'CommissionID', 'trim|required|integer|min_length[1]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $commissionId = $this->input->post('CommissionID');

            $update = [
                'IsPaid' => 1,
                'PaymentDate' => date('Y-m-d')
            ];

            $where = [
                'ID' => $commissionId
            ];

            if ($this->doctor->isUpdatedPayment($update, $where)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function getPatient() {
        $this->form_validation->set_rules("MRNo", "MRNo", "trim|required|alpha_numeric|min_length[1]|max_length[31]");
        $this->form_validation->set_error_delimiters("", "");

        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $mrNo = html_escape(strip_tags($this->input->post('MRNo')));
            $where = [
                "MRNo" => $mrNo
            ];
            $where = $this->security->xss_clean($where);

            $result = $this->patient->getPatientAgainstMRNo($where);
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

    public function editPatient() {
        $this->form_validation->set_rules('PatientID', 'PatientID', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == false) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $where = [
                'patient.ID' => $this->input->post('PatientID')
            ];
            $where = $this->security->xss_clean($where);
            $result = $this->patient->supplyPatient($where);
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

    public function updatePatient() {
        $this->form_validation->set_rules('PatientID', 'PatientID', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('FirstName', 'First name', 'trim|required|alpha_numeric_spaces|min_length[1]|max_length[31]');
        $this->form_validation->set_rules('LastName', 'Last name', 'trim|required|alpha_numeric_spaces|min_length[1]|max_length[31]');
        $this->form_validation->set_rules('MobileNo', 'Mobile no', 'trim|required|integer|min_length[1]|max_length[15]');
        $this->form_validation->set_rules('Email', 'Email', 'trim|valid_email|min_length[1]|max_length[51]');
        $this->form_validation->set_rules('BloodGroup', 'Blood group', 'trim|required|integer|min_length[1]|max_length[5]');
        $this->form_validation->set_rules('Gender', 'Gender', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('DateOfBirth', 'Date of birth', 'trim|required|min_length[1]|max_length[31]');
        $this->form_validation->set_rules('Age', 'Age', 'trim|required|integer|min_length[1]|max_length[31]');
        $this->form_validation->set_rules('Address', 'Address', 'trim|required|min_length[1]|max_length[91]');
        $this->form_validation->set_rules('IsActive', 'IsActive', 'trim|integer|min_length[1]|max_length[1]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            if ($this->input->post('IsActive') == 1) {
                $isActive = 1;
            } else {
                $isActive = 0;
            }

            if (isset($_FILES['file']['name'])) {
                $uploadPath = './assets/uploads/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = 100;
                $config['max_width'] = 400;
                $config['max_height'] = 400;
                $config['file_name'] = time() . random_int(99, 1000) . '_user';
                $config['file_ext_tolower'] = true;
                $config['overwrite'] = false;

                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('file')) {
                    $data['status'] = 0;
                    $data['error'] = $this->upload->display_errors();
                    echo json_encode($data);
                    exit();
                } else {
                    $fileName = $this->upload->data('file_name');
                }
            } else {
                $fileName = 'default.png';
            }

            $where = [
                'ID' => $this->input->post('PatientID')
            ];

            $update = [
                'FirstName' => html_escape(strip_tags($this->input->post('FirstName'))),
                'LastName' => html_escape(strip_tags($this->input->post('LastName'))),
                'MobileNo' => html_escape(strip_tags($this->input->post('MobileNo'))),
                'Email' => html_escape(strip_tags($this->input->post('Email'))),
                'BloodGroupID' => html_escape(strip_tags($this->input->post('BloodGroup'))),
                'Gender' => html_escape(strip_tags($this->input->post('Gender'))),
                'DateOfBirth' => html_escape(strip_tags($this->input->post('DateOfBirth'))),
                'Age' => html_escape(strip_tags($this->input->post('Age'))),
                'Address' => html_escape(strip_tags($this->input->post('Address'))),
                'Image' => $fileName,
                'IsActive' => $isActive,
                'UpdatedAt' => date('Y-m-d')
            ];
            $update = $this->security->xss_clean($update);
            if ($this->patient->isUpdatedPatient($update, $where)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

}
