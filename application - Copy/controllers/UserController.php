<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library("Aauth");
        $this->load->model('GroupModel', 'group');
        $this->load->model('UserModel', 'user');
    }

    public function index() {
        //listing of groups of roles
        $groups = $this->aauth->list_groups();

        //return array of objects
        $data['groups'] = $groups;


        $this->load->view("User/UserView", $data);
    }

    public function createUser() {
        $this->form_validation->set_rules('Email', 'Email', 'trim|required|valid_email|min_length[1]');
        $this->form_validation->set_rules('Password', 'Password', 'trim|required|min_length[6]|max_length[8]');
        $this->form_validation->set_rules('UserName', 'UserName', 'trim|required|min_length[4]|max_length[15]|alpha_numeric_spaces');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $email = $this->input->post('Email');
            $password = $this->input->post('Password');
            $userName = $this->input->post('UserName');
            if ($this->aauth->create_user($email, $password, $userName)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function deleteUser() {
        $this->form_validation->set_rules('UserID', 'User id', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == false) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $userId = $this->input->post('UserID');
            if ($this->aauth->delete_user($userId)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function editUser() {
        $this->form_validation->set_rules('UserID', 'UserID', 'trim|required|integer|min_length[1]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $userId = $this->input->post('UserID');
            $row = $this->aauth->get_user($userId);
            $result = [
                'id' => $row->id,
                'email' => $row->email,
                'username' => $row->username
            ];

            $data['status'] = 1;
            $data['result'] = $result;
            echo json_encode($data);
        }
    }

    public function saveGroup() {
        $this->form_validation->set_rules('Group', 'Group', 'trim|required|alpha_numeric_spaces|min_length[1]');
        $this->form_validation->set_rules('GroupDefinition', 'GroupDefinition', 'trim|alpha_numeric_spaces|min_length[1]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $group = $this->input->post('Group');
            $groupDefinition = $this->input->post('GroupDefinition');

            if ($this->aauth->create_group($group, $groupDefinition)) {


                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = 0;
                $data['error'] = $this->aauth->print_errors();
                echo json_encode($data);
            }
        }
    }

    public function deleteUserGroup() {
        $this->form_validation->set_rules('GroupID', 'Group id', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == false) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $groupId = $this->input->post('GroupID');
            if ($this->aauth->delete_group($groupId)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function editGroup() {
        $this->form_validation->set_rules('GroupID', 'GroupID', 'trim|required|integer|min_length[1]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $where = [
                'id' => $this->input->post('GroupID')
            ];

            $result = $this->group->supplyGroup($where);
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

    public function updateGroup() {
        $this->form_validation->set_rules('GroupID', 'GroupID', 'trim|required|integer|min_length[1]');
        $this->form_validation->set_rules('Group', 'Group', 'trim|required|alpha_numeric_spaces|min_length[1]');
        $this->form_validation->set_rules('GroupDefinition', 'GroupDefinition', 'trim|alpha_numeric_spaces|min_length[1]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $groupId = $this->input->post('GroupID');
            $group = $this->input->post('Group');
            $groupDefinition = $this->input->post('GroupDefinition');

            if ($this->aauth->update_group($groupId, $group, $groupDefinition)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function updateUser() {
        $this->form_validation->set_rules('UserID', 'UserID', 'trim|required|integer|min_length[1]');
        $this->form_validation->set_rules('Email', 'Email', 'trim|required|valid_email|min_length[1]');
        $this->form_validation->set_rules('Password', 'Password', 'trim|required|min_length[6]|max_length[8]');
        $this->form_validation->set_rules('UserName', 'User name', 'trim|required|min_length[4]|max_length[15]|alpha_numeric_spaces');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $userId = $this->input->post('UserID');
            $email = $this->input->post('Email');
            $password = $this->input->post('Password');
            $userName = $this->input->post('UserName');

            if ($this->aauth->update_user($userId, $email, $password, $userName)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = 0;
                $data['error'] = $this->aauth->print_errors();
                echo json_encode($data);
            }
        }
    }

    public function assignUser() {
        $this->form_validation->set_rules('GroupID', 'GroupID', 'trim|required|integer|min_length[1]');
        $this->form_validation->set_rules('UserID', 'UserID', 'trim|required|integer|min_length[1]');
        $this->form_validation->set_error_delimiters('', '');

        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors($data);
            echo json_encode($data);
        } else {
            $groupId = $this->input->post('GroupID');
            $userId = $this->input->post('UserID');

            if ($this->aauth->add_member($userId, $groupId)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function getUsers() {
        $data = $this->user->supplyUser();
        echo json_encode($data);
        exit();
    }

    //for testing purpose
    public function test() {
        $data = $this->user->supplyUser();
        //echo '<pre>';
        //print_r($data);
        //exit();
    }

    public function savePermission() {
        $this->form_validation->set_rules('Permission', 'Permission', 'trim|required|alpha_numeric_spaces|min_length[1]|max_length[25]');
        $this->form_validation->set_rules('PermDef', 'PermDef', 'trim|alpha_numeric_spaces|min_length[1]|max_length[50]');
        $this->form_validation->set_error_delimiters('', '');

        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {

            $permission = $this->input->post('Permission');
            $permDef = $this->input->post('PermDef');

            if ($this->aauth->create_perm($permission, $permDef)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function editPermission() {
        $this->form_validation->set_rules('PermissionID', 'PermissionID', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $where = [
                'id' => $this->input->post('PermissionID')
            ];

            $result = $this->user->supplyPermission($where);
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

    public function updatePermission() {
        $this->form_validation->set_rules('PermissionID', 'PermissionID', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('Permission', 'Permission', 'trim|required|alpha_numeric_spaces|min_length[1]|max_length[25]');
        $this->form_validation->set_rules('PermDef', 'PermDef', 'trim|alpha_numeric_spaces|min_length[1]|max_length[50]');
        $this->form_validation->set_error_delimiters('', '');

        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $permId = $this->input->post('PermissionID');
            $perm = $this->input->post('Permission');
            $definition = $this->input->post('PermDef');

            if ($this->aauth->update_perm($permId, $perm, $definition = false)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function assignPermission() {
        $this->form_validation->set_rules('UserID', 'UserID', 'trim|required|integer|min_length[1]|max_length[11]');

        if ($this->form_validation->run() == FALSE) {
            redirect(base_url("app/user/management"));
        } else {
            $userId = $this->input->post('UserID');

            if (!empty($this->input->post('data'))) {
                //echo '<pre>';
                //print_r($this->input->post('data'));
                //exit();

                $data = $this->input->post('data');

                $this->db->delete('aauth_perm_to_user', ['user_id' => $userId]);

                foreach ($data as $d) {
                    $this->aauth->allow_user($userId, $d);
                }

                redirect(base_url("app/user/management"));
                exit();
            } else {
                redirect(base_url("app/user/management"));
            }
        }
    }

    public function editUserPermission($id) {
        if (empty($id)) {
            redirect('app/user/management');
            exit();
        }
        $id = (integer) $id;
        if (!is_integer($id)) {
            redirect('app/user/management');
            exit();
        }

        $userInfo = $this->aauth->get_user($id);
        $assignedPerm = $this->user->supplyUserPermissions($id);
        $perms = $this->aauth->list_perms();
        $data['perms'] = $perms;
        $data['assignedPerm'] = $assignedPerm;
        $data['userId'] = $id;
        $data['user'] = $userInfo;
        $this->load->view("User/UserPermissionView", $data);
    }

    public function changePassword() {
        $this->load->view("User/ChangePasswordView");
    }

    public function linkUser() {
        $this->form_validation->set_rules('EmployeeID', 'Employee id', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('UserID', 'User id', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == false) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $empId = $this->input->post('EmployeeID');
            $userId = $this->input->post('UserID');

            if ($this->user->isUserLinkSaved($empId, $userId)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

    public function provideLinkedUser() {
        $this->form_validation->set_rules('method', 'method', 'trim|required|alpha|min_length[4]|max_length[4]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == false) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $result = $this->user->supplyLinkedUser();
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

    public function updateUserLink() {
        $this->form_validation->set_rules('UserID', 'User id', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('EmployeeID', 'Employee id', 'trim|required|integer|min_length[1]|max_length[11]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == false) {
            $data['status'] = 0;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {
            $userId = $this->input->post('UserID');
            $empId = $this->input->post('EmployeeID');
            if ($this->user->isUpdatedUserLink($empId, $userId)) {
                $data['status'] = 1;
                echo json_encode($data);
            } else {
                $data['status'] = -1;
                echo json_encode($data);
            }
        }
    }

}
