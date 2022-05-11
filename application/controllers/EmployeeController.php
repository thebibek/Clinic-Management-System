<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class EmployeeController extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('EmployeeModel', 'employee');
    }

    public function registration() {
        $this->load->view("Employee/RegistrationView");
    }

    public function experienceYears() {
        $fromYear = $this->input->post('FromYear');
        $toYear = $this->input->post('ToYear');

        //convert into second
        $fromYear = strtotime($fromYear);
        $toYear = strtotime($toYear);

        $diff = abs($toYear - $fromYear);
        $years = floor($diff / (365 * 60 * 60 * 24));

        echo $years;
    }

    public function saveEmployee() {
        $this->form_validation->set_rules('ResumeNo', 'ResumeNo', 'trim|min_length[1]|max_length[11]|integer');
        $this->form_validation->set_rules('EmployeeCode', 'EmployeeCode', 'trim|required|min_length[1]|max_length[31]|is_unique[employee.EmployeeCode]');
        $this->form_validation->set_rules('Salutation', 'Salutation', 'trim|required|min_length[1]|max_length[11]|alpha');
        $this->form_validation->set_rules('FirstName', 'FirstName', 'trim|required|min_length[1]|max_length[31]|alpha_numeric_spaces');
        $this->form_validation->set_rules('LastName', 'LastName', 'trim|required|min_length[1]|max_length[31]|alpha_numeric_spaces');
        $this->form_validation->set_rules('ShortName', 'ShortName', 'trim|min_length[1]|max_length[11]|alpha_numeric_spaces');
        $this->form_validation->set_rules('DateOfBirth', 'DateOfBirth', 'trim|min_length[1]|max_length[10]');
        $this->form_validation->set_rules('FatherName', 'FatherName', 'trim|required|min_length[1]|max_length[31]|alpha_numeric_spaces');
        $this->form_validation->set_rules('MotherName', 'MotherName', 'trim|required|min_length[1]|max_length[31]|alpha_numeric_spaces');
        $this->form_validation->set_rules('JobType', 'JobType', 'trim|required|integer|min_length[1]|max_length[2]');
        $this->form_validation->set_rules('Department', 'Department', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('Designation', 'Designation', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('EmployeeType', 'EmployeeType', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('JoiningDate', 'JoiningDate', 'trim|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('Gender', 'Gender', 'trim|required|min_length[1]|max_length[3]');
        $this->form_validation->set_rules('MaritalStatus', 'MaritalStatus', 'trim|required|min_length[1]|max_length[3]');
        $this->form_validation->set_rules('BankAccountNo', 'BankAccountNo', 'trim|min_length[1]|max_length[41]');
        $this->form_validation->set_rules('BankName', 'BankName', 'trim|min_length[1]|max_length[51]');
        $this->form_validation->set_rules('ESINo', 'ESINo', 'trim|min_length[1]|max_length[31]');
        $this->form_validation->set_rules('PFNo', 'PFNo', 'trim|min_length[1]|max_length[31]');
        $this->form_validation->set_rules('PANNo', 'PANNo', 'trim|min_length[1]|max_length[31]');
        $this->form_validation->set_rules('Nationality', 'Nationality', 'trim|integer|min_length[1]|max_length[2]');
        $this->form_validation->set_rules('BloodGroup', 'BloodGroup', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('CurrentEmployee', 'CurrentEmployee', 'trim|required|integer|min_length[1]|max_length[2]');
        $this->form_validation->set_rules('Address', 'Address', 'trim|required|min_length[1]|max_length[51]');
        $this->form_validation->set_rules('StateOrProvince', 'StateOrProvince', 'trim|required|min_length[1]|max_length[31]');
        $this->form_validation->set_rules('City', 'City', 'trim|required|min_length[1]|max_length[31]');
        $this->form_validation->set_rules('PinOrZip', 'PinOrZip', 'trim|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('PhoneNumber', 'PhoneNumber', 'trim|required|min_length[1]|max_length[15]|integer');
        $this->form_validation->set_rules('Email', 'Email', 'trim|valid_email|min_length[1]|max_length[31]');
        $this->form_validation->set_rules('PrevClinicName', 'PrevClinicName', 'trim|min_length[1]|max_length[31]');
        $this->form_validation->set_rules('JobNature', 'JobNature', 'trim|min_length[1]|max_length[3]|integer');
        $this->form_validation->set_rules('PrevClinicAddress', 'PrevClinicAddress', 'trim|min_length[1]|max_length[51]');
        $this->form_validation->set_rules('PrevPhoneNo', 'PrevPhoneNo', 'trim|min_length[1]|max_length[15]|integer');
        $this->form_validation->set_rules('FromYear', 'FromYear', 'trim|min_length[1]|max_length[15]');
        $this->form_validation->set_rules('ToYear', 'ToYear', 'trim|min_length[1]|max_length[15]');
        $this->form_validation->set_rules('Experience', 'Experience', 'trim|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('Salary', 'Salary', 'trim|min_length[1]|max_length[51]|numeric');
        $this->form_validation->set_rules('PrevDepartment', 'PrevDepartment', 'trim|required|min_length[1]|max_length[11]|integer');
        $this->form_validation->set_rules('PreDesignation', 'PreDesignation', 'trim|required|min_length[1]|max_length[11]|integer');
        $this->form_validation->set_rules('JobProfile', 'JobProfile', 'trim|min_length[1]|max_length[51]');
        $this->form_validation->set_rules('HighestQualification', 'HighestQualification', 'trim|required|min_length[1]|max_length[31]');
        $this->form_validation->set_rules('University', 'University', 'trim|min_length[1]|max_length[31]');
        $this->form_validation->set_rules('YearOfPassing', 'YearOfPassing', 'trim|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('GradeOrPercentage', 'GradeOrPercentage', 'trim|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('Subject', 'Subject', 'trim|min_length[1]|max_length[31]');
        $this->form_validation->set_rules('Specialization', 'Specialization', 'trim|min_length[1]|max_length[31]');
        $this->form_validation->set_rules('Remarks', 'Remarks', 'trim|min_length[1]|max_length[51]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
            exit();
        } else {
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



            $dataEmp = [
                'ResumeNo' => html_escape(strip_tags($this->input->post('ResumeNo'))),
                'EmployeeCode' => html_escape(strip_tags($this->input->post('EmployeeCode'))),
                'Salutation' => html_escape(strip_tags($this->input->post('Salutation'))),
                'FirstName' => html_escape(strip_tags($this->input->post('FirstName'))),
                'LastName' => html_escape(strip_tags($this->input->post('LastName'))),
                'ShortName' => html_escape(strip_tags($this->input->post('ShortName'))),
                'DateOfBirth' => html_escape(strip_tags($this->input->post('DateOfBirth'))),
                'FatherName' => html_escape(strip_tags($this->input->post('FatherName'))),
                'MotherName' => html_escape(strip_tags($this->input->post('MotherName'))),
                'JobType' => html_escape(strip_tags($this->input->post('JobType'))),
                'DepartmentID' => html_escape(strip_tags($this->input->post('Department'))),
                'DesignationID' => html_escape(strip_tags($this->input->post('Designation'))),
                'EmployeeType' => html_escape(strip_tags($this->input->post('EmployeeType'))),
                'JoiningDate' => html_escape(strip_tags($this->input->post('JoiningDate'))),
                'Gender' => html_escape(strip_tags($this->input->post('Gender'))),
                'MaritalStatus' => html_escape(strip_tags($this->input->post('MaritalStatus'))),
                'BankAccountNo' => html_escape(strip_tags($this->input->post('BankAccountNo'))),
                'BankName' => html_escape(strip_tags($this->input->post('BankName'))),
                'ESINo' => html_escape(strip_tags($this->input->post('ESINo'))),
                'PFNo' => html_escape(strip_tags($this->input->post('PFNo'))),
                'PANNo' => html_escape(strip_tags($this->input->post('PANNo'))),
                'Nationality' => html_escape(strip_tags($this->input->post('Nationality'))),
                'BloodGroupID' => html_escape(strip_tags($this->input->post('BloodGroup'))),
                'CurrentEmployee' => html_escape(strip_tags($this->input->post('CurrentEmployee'))),
                'Address' => html_escape(strip_tags($this->input->post('Address'))),
                'StateOrProvince' => html_escape(strip_tags($this->input->post('StateOrProvince'))),
                'City' => html_escape(strip_tags($this->input->post('City'))),
                'PinOrZip' => html_escape(strip_tags($this->input->post('PinOrZip'))),
                'PhoneNumber' => html_escape(strip_tags($this->input->post('PhoneNumber'))),
                'Email' => html_escape(strip_tags($this->input->post('Email'))),
                'PrevClinicName' => html_escape(strip_tags($this->input->post('PrevClinicName'))),
                'JobNature' => html_escape(strip_tags($this->input->post('JobNature'))),
                'PrevClinicAddress' => html_escape(strip_tags($this->input->post('PrevClinicAddress'))),
                'PrevPhoneNo' => html_escape(strip_tags($this->input->post('PrevPhoneNo'))),
                'FromYear' => html_escape(strip_tags($this->input->post('FromYear'))),
                'ToYear' => html_escape(strip_tags($this->input->post('ToYear'))),
                'Experience' => html_escape(strip_tags($this->input->post('Experience'))),
                'Salary' => html_escape(strip_tags($this->input->post('Salary'))),
                'PrevDepartment' => html_escape(strip_tags($this->input->post('PrevDepartment'))),
                'PreDesignation' => html_escape(strip_tags($this->input->post('PreDesignation'))),
                'JobProfile' => html_escape(strip_tags($this->input->post('JobProfile'))),
                'HighestQualification' => html_escape(strip_tags($this->input->post('HighestQualification'))),
                'University' => html_escape(strip_tags($this->input->post('University'))),
                'YearOfPassing' => html_escape(strip_tags($this->input->post('YearOfPassing'))),
                'GradeOrPercentage' => html_escape(strip_tags($this->input->post('GradeOrPercentage'))),
                'Subject' => html_escape(strip_tags($this->input->post('Subject'))),
                'Specialization' => html_escape(strip_tags($this->input->post('Specialization'))),
                'Remarks' => html_escape(strip_tags($this->input->post('Remarks'))),
                'ProfileUrl' => $fileName,
                'CreatedAt' => date('Y-m-d'),
                'UpdatedAt' => date('Y-m-d')
            ];


            $dataEmp = $this->security->xss_clean($dataEmp);
            $empAttendanceId = $this->getAttendanceId('empattendanceregistration');
            if ($this->employee->isSavedEmployee($dataEmp, $empAttendanceId)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function searchEmployee() {
        $this->load->view("Employee/SearchEmployeeView");
    }

    public function filterEmployee() {
        $this->form_validation->set_rules('EmployeeCode', 'EmployeeCode', 'trim|min_length[1]|max_length[51]');
        $this->form_validation->set_rules('EmployeeName', 'EmployeeName', 'trim|min_length[1]|max_length[31]');
        $this->form_validation->set_rules('FatherName', 'FatherName', 'trim|min_length[1]|max_length[31]|alpha_numeric_spaces');
        $this->form_validation->set_rules('Department', 'Department', 'trim|min_length[1]|max_length[11]|integer');
        $this->form_validation->set_rules('Designation', 'Designation', 'trim|min_length[1]|max_length[11]|integer');
        $this->form_validation->set_rules('JoiningDate', 'JoiningDate', 'trim|min_length[1]|max_length[10]');
        $this->form_validation->set_rules('BirthDate', 'BirthDate', 'trim|min_length[1]|max_length[10]');
        $this->form_validation->set_rules('CurrentEmployee', 'CurrentEmployee', 'trim|min_length[1]|max_length[2]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $dataFilter = [
                "EmployeeCode" => html_escape(strip_tags($this->input->post('EmployeeCode'))),
                "FirstName" => html_escape(strip_tags($this->input->post('EmployeeName'))),
                "FatherName" => html_escape(strip_tags($this->input->post('FatherName'))),
                "DepartmentID" => html_escape(strip_tags($this->input->post('Department'))),
                "DesignationID" => html_escape(strip_tags($this->input->post('Designation'))),
                "JoiningDate" => html_escape(strip_tags($this->input->post('JoiningDate'))),
                "DateOfBirth" => html_escape(strip_tags($this->input->post('BirthDate'))),
                "CurrentEmployee" => html_escape(strip_tags($this->input->post('CurrentEmployee'))),
            ];

            $dataFilter = $this->security->xss_clean($dataFilter);
            $result = $this->employee->supplyFilteredEmployee($dataFilter);

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

    public function importEmployee() {
        $this->load->view("Employee/ImportEmployeeView");
    }

    public function designationHome() {
        $this->load->view("Employee/DesignationHomeView");
    }

    public function saveDesignation() {
        $this->form_validation->set_rules('Designation', 'Designation', 'trim|required|alpha_numeric_spaces|min_length[1]|max_length[31]|is_unique[designation.Designation]');
        $this->form_validation->set_rules('Description', 'Description', 'trim|min_length[1]|max_length[31]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $designation = html_escape(strip_tags($this->input->post('Designation')));
            $description = html_escape(strip_tags($this->input->post('Description')));

            $dataDesignation = [
                "Designation" => $designation,
                "Description" => $description,
                "CreatedAt" => date('Y-m-d'),
                "UpdatedAt" => date('Y-m-d')
            ];

            $dataDesignation = $this->security->xss_clean($dataDesignation);
            if ($this->employee->isDesignationSaved($dataDesignation)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function deleteDesignation() {
        $this->form_validation->set_rules('DesignationID', 'DesignationID', 'trim|required|min_length[1]|max_length[11]|integer');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $designationId = html_escape(strip_tags($this->input->post('DesignationID')));
            $dataDesignation = [
                'ID' => $designationId
            ];

            if ($this->employee->isDeletedDesignation($dataDesignation)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function editDesignation() {
        $this->form_validation->set_rules('DesignationID', 'designation', 'trim|integer|required|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');

        if ($this->form_validation->run() == false) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            //get values
            $designationId = html_escape(strip_tags($this->input->post('DesignationID')));

            $where = [
                'ID' => $designationId,
            ];
            $where = $this->security->xss_clean($where);

            $result = $this->employee->supplyEmployee($where);
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

    public function updateDesignation() {
        $this->form_validation->set_rules('Designation', 'designation', 'trim|required|min_length[1]|max_length[31]');
        $this->form_validation->set_rules('Description', 'description', 'trim|min_length[1]|max_length[51]');
        $this->form_validation->set_rules('DesignationID', 'designation ID', 'trim|integer|required|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            //get values 
            $designation = strtoupper(html_escape(strip_tags($this->input->post('Designation'))));
            $description = strtoupper(html_escape(strip_tags($this->input->post('Description'))));
            $designationId = $this->input->post('DesignationID');
            $dataDesignation = [
                'Designation' => $designation,
                'Description' => $description,
                'UpdatedAt' => date('Y-m-d'),
            ];
            $where = [
                'ID' => $designationId
            ];
            $dataDesignation = $this->security->xss_clean($dataDesignation);
            $result = $this->employee->isUpdatedDesignation($dataDesignation, $where);
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

    public function attendanceRegistration() {
        $this->load->view("Employee/AttendanceRegistrationView");
    }

    public function getAttendanceRegistration() {
        $result = $this->employee->supplyAttendanceRegistration();

        if (!empty($result)) {
            $data['status'] = 1;
            $data['result'] = $result;
            echo json_encode($data);
        } else {
            $data['status'] = -1;
            echo json_encode($data);
        }
    }

    public function salaryScheme() {
        $this->load->view("Employee/SalarySchemeView");
    }

    public function provideEmployee() {
        $result = $this->employee->supplyAllEmployee();


        if (!empty($result)) {
            $data['status'] = 1;
            $data['result'] = $result;
            echo json_encode($data);
        } else {
            $data['status'] = -1;
            echo json_encode($data);
        }
    }

    public function provideSingleEmployee() {
        $this->form_validation->set_rules('EmployeeID', 'EmployeeID', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $where = [
                'ID' => html_escape(strip_tags($this->input->post('EmployeeID')))
            ];

            $result = $this->employee->supplySingleEmployee($where);
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

    public function saveEmployeeSalaryScheme() {
        $this->form_validation->set_rules('EmployeeID', 'Employee', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('SalarySchemeID', 'Salary scheme', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('SalaryMonth', 'Salary month/year', 'trim|required');
        $this->form_validation->set_rules('BasicSalary', 'Basic salary', 'trim|required|decimal|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $employeeId = html_escape(strip_tags($this->input->post('EmployeeID')));
            $salarySchemeId = html_escape(strip_tags($this->input->post('SalarySchemeID')));
            $salaryMonth = $this->input->post('SalaryMonth');
            $basicSalary = html_escape(strip_tags($this->input->post('BasicSalary')));

            $dataEmployeeSalaryScheme = [
                "EmployeeID" => $employeeId,
                "SalarySchemeID" => $salarySchemeId,
                "SalaryMonth" => $salaryMonth,
                "BasicSalary" => $basicSalary,
                "CreatedAt" => date('Y-m-d'),
                "UpdatedAt" => date('Y-m-d')
            ];

            $dataEmployeeSalaryScheme = $this->security->xss_clean($dataEmployeeSalaryScheme);

            if ($this->employee->isSavedEmployeeSalaryScheme($dataEmployeeSalaryScheme)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function provideEmployeeSalaryScheme() {
        $this->form_validation->set_rules('EmployeeID', 'Employee ID', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $where = [
                'EmployeeID' => $this->input->post('EmployeeID')
            ];
            $result = $this->employee->supplyEmployeeSalaryScheme($where);
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

    public function deleteEmployeeSalaryScheme() {
        $this->form_validation->set_rules('SalarySchemeID', 'Salary scheme ID', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $where = [
                'ID' => $this->input->post('SalarySchemeID')
            ];

            if ($this->employee->isDeletedEmployeeSalaryScheme($where)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function deleteEmployee() {
        $this->form_validation->set_rules('EmployeeID', 'Employee id', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == false) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $empId = $this->input->post('EmployeeID');

            $wh = [
                'ID' => $empId
            ];
            $wh = $this->security->xss_clean($wh);

            if ($this->employee->isDeletedEmployee($wh)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    /*
     * Update employee
     *      
     */

    public function updateEmployee() {
        $this->form_validation->set_rules('EmployeeID', 'Employee id', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('ResumeNo', 'ResumeNo', 'trim|min_length[1]|max_length[11]|integer');
        $this->form_validation->set_rules('EmployeeCode', 'EmployeeCode', 'trim|required|min_length[1]|max_length[31]');
        $this->form_validation->set_rules('Salutation', 'Salutation', 'trim|required|min_length[1]|max_length[11]|alpha');
        $this->form_validation->set_rules('FirstName', 'FirstName', 'trim|required|min_length[1]|max_length[31]|alpha_numeric_spaces');
        $this->form_validation->set_rules('LastName', 'LastName', 'trim|required|min_length[1]|max_length[31]|alpha_numeric_spaces');
        $this->form_validation->set_rules('ShortName', 'ShortName', 'trim|min_length[1]|max_length[11]|alpha_numeric_spaces');
        $this->form_validation->set_rules('DateOfBirth', 'DateOfBirth', 'trim|min_length[1]|max_length[10]');
        $this->form_validation->set_rules('FatherName', 'FatherName', 'trim|required|min_length[1]|max_length[31]|alpha_numeric_spaces');
        $this->form_validation->set_rules('MotherName', 'MotherName', 'trim|required|min_length[1]|max_length[31]|alpha_numeric_spaces');
        $this->form_validation->set_rules('JobType', 'JobType', 'trim|required|integer|min_length[1]|max_length[2]');
        $this->form_validation->set_rules('Department', 'Department', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('Designation', 'Designation', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('EmployeeType', 'EmployeeType', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('JoiningDate', 'JoiningDate', 'trim|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('Gender', 'Gender', 'trim|required|min_length[1]|max_length[3]');
        $this->form_validation->set_rules('MaritalStatus', 'MaritalStatus', 'trim|required|min_length[1]|max_length[3]');
        $this->form_validation->set_rules('BankAccountNo', 'BankAccountNo', 'trim|min_length[1]|max_length[41]');
        $this->form_validation->set_rules('BankName', 'BankName', 'trim|min_length[1]|max_length[51]');
        $this->form_validation->set_rules('ESINo', 'ESINo', 'trim|min_length[1]|max_length[31]');
        $this->form_validation->set_rules('PFNo', 'PFNo', 'trim|min_length[1]|max_length[31]');
        $this->form_validation->set_rules('PANNo', 'PANNo', 'trim|min_length[1]|max_length[31]');
        $this->form_validation->set_rules('Nationality', 'Nationality', 'trim|integer|min_length[1]|max_length[2]');
        $this->form_validation->set_rules('BloodGroup', 'BloodGroup', 'trim|required|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('CurrentEmployee', 'CurrentEmployee', 'trim|required|integer|min_length[1]|max_length[2]');
        $this->form_validation->set_rules('Address', 'Address', 'trim|required|min_length[1]|max_length[51]');
        $this->form_validation->set_rules('StateOrProvince', 'StateOrProvince', 'trim|required|min_length[1]|max_length[31]');
        $this->form_validation->set_rules('City', 'City', 'trim|required|min_length[1]|max_length[31]');
        $this->form_validation->set_rules('PinOrZip', 'PinOrZip', 'trim|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('PhoneNumber', 'PhoneNumber', 'trim|required|min_length[1]|max_length[15]|integer');
        $this->form_validation->set_rules('Email', 'Email', 'trim|valid_email|min_length[1]|max_length[31]');
        $this->form_validation->set_rules('PrevClinicName', 'PrevClinicName', 'trim|min_length[1]|max_length[31]');
        $this->form_validation->set_rules('JobNature', 'JobNature', 'trim|min_length[1]|max_length[3]|integer');
        $this->form_validation->set_rules('PrevClinicAddress', 'PrevClinicAddress', 'trim|min_length[1]|max_length[51]');
        $this->form_validation->set_rules('PrevPhoneNo', 'PrevPhoneNo', 'trim|min_length[1]|max_length[15]|integer');
        $this->form_validation->set_rules('FromYear', 'FromYear', 'trim|min_length[1]|max_length[15]');
        $this->form_validation->set_rules('ToYear', 'ToYear', 'trim|min_length[1]|max_length[15]');
        $this->form_validation->set_rules('Experience', 'Experience', 'trim|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('Salary', 'Salary', 'trim|min_length[1]|max_length[51]|numeric');
        $this->form_validation->set_rules('PrevDepartment', 'PrevDepartment', 'trim|required|min_length[1]|max_length[11]|integer');
        $this->form_validation->set_rules('PreDesignation', 'PreDesignation', 'trim|required|min_length[1]|max_length[11]|integer');
        $this->form_validation->set_rules('JobProfile', 'JobProfile', 'trim|min_length[1]|max_length[51]');
        $this->form_validation->set_rules('HighestQualification', 'HighestQualification', 'trim|required|min_length[1]|max_length[31]');
        $this->form_validation->set_rules('University', 'University', 'trim|min_length[1]|max_length[31]');
        $this->form_validation->set_rules('YearOfPassing', 'YearOfPassing', 'trim|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('GradeOrPercentage', 'GradeOrPercentage', 'trim|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('Subject', 'Subject', 'trim|min_length[1]|max_length[31]');
        $this->form_validation->set_rules('Specialization', 'Specialization', 'trim|min_length[1]|max_length[31]');
        $this->form_validation->set_rules('Remarks', 'Remarks', 'trim|min_length[1]|max_length[51]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == false) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $empId = $this->input->post('EmployeeID');

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



            $update = [
                'ResumeNo' => html_escape(strip_tags($this->input->post('ResumeNo'))),
                'EmployeeCode' => html_escape(strip_tags($this->input->post('EmployeeCode'))),
                'Salutation' => html_escape(strip_tags($this->input->post('Salutation'))),
                'FirstName' => html_escape(strip_tags($this->input->post('FirstName'))),
                'LastName' => html_escape(strip_tags($this->input->post('LastName'))),
                'ShortName' => html_escape(strip_tags($this->input->post('ShortName'))),
                'DateOfBirth' => html_escape(strip_tags($this->input->post('DateOfBirth'))),
                'FatherName' => html_escape(strip_tags($this->input->post('FatherName'))),
                'MotherName' => html_escape(strip_tags($this->input->post('MotherName'))),
                'JobType' => html_escape(strip_tags($this->input->post('JobType'))),
                'DepartmentID' => html_escape(strip_tags($this->input->post('Department'))),
                'DesignationID' => html_escape(strip_tags($this->input->post('Designation'))),
                'EmployeeType' => html_escape(strip_tags($this->input->post('EmployeeType'))),
                'JoiningDate' => html_escape(strip_tags($this->input->post('JoiningDate'))),
                'Gender' => html_escape(strip_tags($this->input->post('Gender'))),
                'MaritalStatus' => html_escape(strip_tags($this->input->post('MaritalStatus'))),
                'BankAccountNo' => html_escape(strip_tags($this->input->post('BankAccountNo'))),
                'BankName' => html_escape(strip_tags($this->input->post('BankName'))),
                'ESINo' => html_escape(strip_tags($this->input->post('ESINo'))),
                'PFNo' => html_escape(strip_tags($this->input->post('PFNo'))),
                'PANNo' => html_escape(strip_tags($this->input->post('PANNo'))),
                'Nationality' => html_escape(strip_tags($this->input->post('Nationality'))),
                'BloodGroupID' => html_escape(strip_tags($this->input->post('BloodGroup'))),
                'CurrentEmployee' => html_escape(strip_tags($this->input->post('CurrentEmployee'))),
                'Address' => html_escape(strip_tags($this->input->post('Address'))),
                'StateOrProvince' => html_escape(strip_tags($this->input->post('StateOrProvince'))),
                'City' => html_escape(strip_tags($this->input->post('City'))),
                'PinOrZip' => html_escape(strip_tags($this->input->post('PinOrZip'))),
                'PhoneNumber' => html_escape(strip_tags($this->input->post('PhoneNumber'))),
                'Email' => html_escape(strip_tags($this->input->post('Email'))),
                'PrevClinicName' => html_escape(strip_tags($this->input->post('PrevClinicName'))),
                'JobNature' => html_escape(strip_tags($this->input->post('JobNature'))),
                'PrevClinicAddress' => html_escape(strip_tags($this->input->post('PrevClinicAddress'))),
                'PrevPhoneNo' => html_escape(strip_tags($this->input->post('PrevPhoneNo'))),
                'FromYear' => html_escape(strip_tags($this->input->post('FromYear'))),
                'ToYear' => html_escape(strip_tags($this->input->post('ToYear'))),
                'Experience' => html_escape(strip_tags($this->input->post('Experience'))),
                'Salary' => html_escape(strip_tags($this->input->post('Salary'))),
                'PrevDepartment' => html_escape(strip_tags($this->input->post('PrevDepartment'))),
                'PreDesignation' => html_escape(strip_tags($this->input->post('PreDesignation'))),
                'JobProfile' => html_escape(strip_tags($this->input->post('JobProfile'))),
                'HighestQualification' => html_escape(strip_tags($this->input->post('HighestQualification'))),
                'University' => html_escape(strip_tags($this->input->post('University'))),
                'YearOfPassing' => html_escape(strip_tags($this->input->post('YearOfPassing'))),
                'GradeOrPercentage' => html_escape(strip_tags($this->input->post('GradeOrPercentage'))),
                'Subject' => html_escape(strip_tags($this->input->post('Subject'))),
                'Specialization' => html_escape(strip_tags($this->input->post('Specialization'))),
                'ProfileUrl' => $fileName,
                'Remarks' => html_escape(strip_tags($this->input->post('Remarks'))),
                'UpdatedAt' => date('Y-m-d')
            ];

            $wh = [
                'ID' => $empId
            ];

            $update = $this->security->xss_clean($update);
            if ($this->employee->isUpdatedEmployee($update, $wh)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

}
