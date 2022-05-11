<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>

    <body>
        <?php $this->load->view("Partials/NavbarView"); ?>
        <div class="container-fluid" ng-app="UserApp" ng-controller="UserAppCtrl">
            <div class="card border-primary shadow mt-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p class="fs-5 m-0">User Management</p>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url("app/dashboard"); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('app/employee/registration'); ?>">Employee</a></li>
                                    <li class="breadcrumb-item active">User</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <?php $this->load->view("Partials/IconBarsView"); ?>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row gutter">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card border-warning shadow">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button class="btn btn-warning btn-sm shadow"><img src="<?php echo base_url("assets/img/icons/user-25.png"); ?>"></button>
                                            <strong> &nbsp;User Management</strong>
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <div class="btn-group">
                                                <a href="<?php echo base_url('app/user/management'); ?>" class="btn btn-danger btn-sm shadow">Close</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="card">
                                        <div class="card-header">
                                            <ul class="nav nav-tabs card-header-tabs">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link active" id="tabOne-tab" data-bs-toggle="tab" data-bs-target="#tabOne" type="button" role="tab" aria-controls="home" aria-selected="true">Group</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="tabTwo-tab" data-bs-toggle="tab" data-bs-target="#tabTwo" type="button" role="tab" aria-controls="profile" aria-selected="false">Users</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="tabThree-tab" data-bs-toggle="tab" data-bs-target="#tabThree" type="button" role="tab" aria-controls="contact" aria-selected="false">Create Permission</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="tabFour-tab" data-bs-toggle="tab" data-bs-target="#tabFour" type="button" role="tab" aria-controls="contact" aria-selected="false">User Permission</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="tabFive-tab" data-bs-toggle="tab" data-bs-target="#tabFive" type="button" role="tab" aria-controls="contact" aria-selected="false">UserLink</button>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content" id="myTabContent">
                                                <div class="tab-pane fade show active" id="tabOne" role="tabpanel" aria-labelledby="tabOne-tab">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="card border-warning shadow">
                                                                <div class="card-header">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <button class="btn btn-warning btn-sm"><img src="<?php echo base_url("assets/img/icons/add2.png"); ?>"></button>
                                                                            <strong>Create Group</strong>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                        <label>Group Name</label>
                                                                        <input type="text" class="form-control" ng-model="GroupNameModel"  placeholder="Enter Group Name">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Group Definition</label>
                                                                        <input type="text" class="form-control"  ng-model="GroupDefinitionModel" placeholder="Enter Group Definition">
                                                                    </div>
                                                                    <br><br>
                                                                    <button type="button" ng-click="saveGroup()" ng-show="SaveGroupBtn" class="btn btn-success">Save</button>
                                                                    <button type="button" ng-click="updateGroup()" ng-show="UpdateGroupBtn" class="btn btn-success">Update</button>
                                                                    <button type="button" ng-click="closeGroup()" ng-show="CloseGroupBtn" class="btn btn-danger">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="card border-warning shadow">
                                                                <div class="card-header">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <button class="btn btn-danger btn-sm shadow"><img src="<?php echo base_url("assets/img/icons/groupuser.png"); ?>"></button>
                                                                            <strong> &nbsp;Groups</strong>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="scrollbar" id="style-7">
                                                                        <div class="force-overflow white-bg">
                                                                            <table class="table table-striped table-bordered border-warning table-sm">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>#</th>
                                                                                        <th>Group</th>
                                                                                        <th>Action</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr ng-repeat="d1 in groups">
                                                                                        <td class="text-black">{{$index + 1}}</td>
                                                                                        <td class="text-black">{{d1.name}}</td>
                                                                                        <td ng-if="d1.id == 1">
                                                                                        </td>
                                                                                        <td ng-if="d1.id > 1">
                                                                                            <a href="#" ng-click="deleteUserGroup(d1.id)"><img src="<?php echo base_url("assets/img/delete.png"); ?>"></a>
                                                                                            <a href="#" ng-click="editGroup(d1.id)"><img src="<?php echo base_url("assets/img/edit.png"); ?>"></a>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="tab-pane fade" id="tabTwo" role="tabpanel" aria-labelledby="tabTwo-tab">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="card border-warning shadow">
                                                                <div class="card-header">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <button class="btn btn-warning btn-sm"><img src="<?php echo base_url("assets/img/icons/add2.png"); ?>"></button>
                                                                            <strong> &nbsp;Add Users</strong>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                        <label>User Name</label>
                                                                        <input type="text" class="form-control" ng-model="UserNameModel"  placeholder="Enter Name">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>User Email</label>
                                                                        <input type="text" class="form-control" ng-model="EmailModel"  placeholder="Enter Email">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Password</label>
                                                                        <input type="text" class="form-control"  ng-model="PasswordModel" maxlength="8" placeholder="Enter Password">
                                                                    </div>
                                                                    <br><br>
                                                                    <button type="button" ng-click="saveUser()" ng-show="SaveUserBtn" class="btn btn-success">Save</button>
                                                                    <button type="button" ng-click="updateUser()" ng-show="UpdateUserBtn" class="btn btn-success">Update</button>
                                                                    <button type="button" ng-click="closeUser()" ng-show="CloseUserBtn" class="btn btn-danger">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="card border-warning shadow">
                                                                <div class="card-header">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <button class="btn btn-warning btn-sm shadow"><img src="<?php echo base_url("assets/img/icons/groupuser.png"); ?>"></button>
                                                                            <strong> &nbsp;Users</strong>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="panel-body">
                                                                    <div class="scrollbar" id="style-7">
                                                                        <div class="force-overflow">
                                                                            <table class="table table-striped table-bordered border-warning table-sm">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>#</th>
                                                                                        <th>User Email</th>
                                                                                        <th>Group</th>
                                                                                        <th>Action</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr ng-repeat="d1 in users">
                                                                                        <td class="text-black">{{$index + 1}}</td>
                                                                                        <td class="text-black">{{d1.email}}</td>
                                                                                        <td ng-if="d1.id == 1">Super Admin</td>
                                                                                        <td ng-if="d1.id > 1">{{d1.role}}</td>
                                                                                        <td ng-if="d1.id == 1"></td>
                                                                                        <td ng-if="d1.id > 1">
                                                                                            <a href="#" title="Delete" ng-click="deleteUser(d1.id)"><img src="<?php echo base_url("assets/img/delete.png"); ?>"></a>
                                                                                            <a href="#" title="Edit" ng-click="editUser(d1.id)"><img src="<?php echo base_url("assets/img/edit.png"); ?>"></a>
                                                                                            <a href="#" title="Assign Group" data-bs-toggle="modal" data-bs-target="#myModal" ng-click="getUserID(d1.id)"><img src="<?php echo base_url("assets/img/icons/assign.png"); ?>"></a>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="tabThree" role="tabpanel" aria-labelledby="tabThree-tab">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="card border-warning shadow">
                                                                <div class="card-header">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <button class="btn btn-warning btn-sm shadow"><img src="<?php echo base_url("assets/img/icons/add2.png"); ?>"></button>
                                                                            <strong> &nbsp;Add Permission</strong>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                        <label>Permission</label>
                                                                        <input type="text" class="form-control" ng-model="PermissionModel"  placeholder="Enter Permission">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Definition</label>
                                                                        <input type="text" class="form-control"  ng-model="PermDefModel"  placeholder="Enter Definition">
                                                                    </div>
                                                                    <br><br>
                                                                    <button type="button" ng-click="savePermission()" ng-show="SavePermBtn" class="btn btn-success">Save</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="card border-warning shadow">
                                                                <div class="card-header">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <button class="btn btn-warning btn-sm shadow"><img src="<?php echo base_url("assets/img/icons/permission.png"); ?>"></button>
                                                                            <strong> &nbsp;Permissions</strong>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="scrollbar" id="style-7">
                                                                        <div class="force-overflow">
                                                                            <table class="table table-striped table-bordered border-warning btn-sm table-sm">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>#</th>
                                                                                        <th>Permission</th>
                                                                                        <th>Action</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr ng-repeat="d3 in permissions">
                                                                                        <td class="text-dark">{{$index + 1}}</td>
                                                                                        <td class="text-dark">{{d3.name}}</td>
                                                                                        <td>
                                                                                            <a href="#"><img src="<?php echo base_url("assets/img/icons/prohibit.png"); ?>"></a>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>  
                                                </div>
                                                <div class="tab-pane fade" id="tabFour" role="tabpanel" aria-labelledby="tabFour-tab">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <div class="card border-warning shadow">
                                                                <div class="card-header">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <button class="btn btn-warning btn-sm"><img src="<?php echo base_url("assets/img/icons/permission.png"); ?>"></button>
                                                                            <strong> &nbsp;User Permissions</strong>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="scrollbar" id="style-7">
                                                                        <div class="force-overflow white-bg">
                                                                            <table class="table table-striped table-bordered border-warning table-sm">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>#</th>
                                                                                        <th>User Email</th>
                                                                                        <th>Group</th>
                                                                                        <th>Action</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr ng-repeat="d4 in users">
                                                                                        <td class="text-black">{{$index + 1}}</td>
                                                                                        <td class="text-black">{{d4.email}}</td>
                                                                                        <td ng-if="d4.id == 1">Super Admin</td>
                                                                                        <td ng-if="d4.id > 1">{{d4.role}}</td>
                                                                                        <td ng-if="d4.id == 1"></td>
                                                                                        <td ng-if="d4.id > 1">
                                                                                            <a href="<?php echo base_url('app/user/permission/edit/'); ?>{{d4.id}}"><img src="<?php echo base_url("assets/img/edit.png"); ?>"></a>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="tabFive" role="tabpanel" aria-labelledby="tabFive-tab">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="card border-warning shadow">
                                                                <div class="card-header">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <button class="btn btn-warning btn-sm shadow"><img src="<?php echo base_url("assets/img/icons/employee.png"); ?>"></button>
                                                                            <strong>Employee User Link</strong>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                        <label>Employee</label>
                                                                        <select class="form-select" ng-model="EmployeeModel">
                                                                            <option value="">Please Select Employee</option>
                                                                            <option ng-repeat="d2 in employees" ng-value="{{d2.EmployeeID}}">{{d2.FirstName}}({{d2.Designation}})</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>User</label>
                                                                        <select class="form-control" ng-model="UserModel">
                                                                            <option value="">Please Select User</option>
                                                                            <option ng-repeat="d3 in users" ng-value="{{d3.id}}">{{d3.username}} ({{d3.email}})</option>
                                                                        </select>
                                                                    </div>
                                                                    <br><br>
                                                                    <button type="button" ng-click="linkUser()" ng-show="SaveGroupBtn" class="btn btn-success">Save</button>
                                                                    <a href="<?php echo base_url('app/user/management'); ?>"  class="btn btn-danger">Close</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="card border-warning shadow">
                                                                <div class="card-header">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <button class="btn btn-warning btn-sm"><img src="<?php echo base_url("assets/img/icons/unlink.png"); ?>"></button>
                                                                            <strong> &nbsp;Employee User Unlink</strong>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="panel-body">
                                                                    <div class="scrollbar" id="style-7">
                                                                        <div class="force-overflow white-bg">
                                                                            <table class="table table-striped table-bordered border-warning table-sm" cellspacing="0" width="100%">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>#</th>
                                                                                        <th>Employee</th>
                                                                                        <th>User</th>
                                                                                        <th>Action</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr ng-repeat="d5 in linkedusers">
                                                                                        <td>
                                                                                            <button class="btn btn-warning btn-sm shadow">
                                                                                                <img src="<?php echo base_url("assets/img/icons/unlink1.png"); ?>">
                                                                                            </button>
                                                                                        </td>
                                                                                        <td class="text-black">{{d5.FirstName}} {{d5.LastName}} ({{d5.Designation}})</td>
                                                                                        <td>{{d5.username}} ({{d5.UserEmail}})</td>
                                                                                        <td><button class="btn btn-danger btn-sm" ng-click="unlinkUser(d5.UserID, d5.EmployeeID)">Unlink</button></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for assign group-->
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">

                        <h4 class="modal-title">Assign Group</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <select class="form-select" id="GroupID">
                                <?php
                                if (isset($groups)) {
                                    if (!empty($groups)) {
                                        foreach ($groups as $g) {
                                            ?>
                                            <option  value="<?php echo $g->id; ?>"><?php echo $g->name; ?></option>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="AssignUser" class="btn btn-success">Save</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!--Moal for assign permisiion-->
        <div class="modal fade" id="AssignPermModal" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">User Permissions</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="<?php echo base_url("app/assign/perm"); ?>" method="post">
                        <input type="hidden" id="UserID" name="UserID" value="">    
                        <div class="modal-body">
                            <table  class="table">
                                <?php
                                if (isset($perms)) {
                                    if (!empty($perms)) {
                                        foreach ($perms as $p) {
                                            ?>
                                            <tr>
                                                <td><?php echo $p->name; ?></td>
                                                <td>
                                                    <input type="checkbox" name="data[]" value=<?php echo $p->id; ?>>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="AssignUser" class="btn btn-success">Save</button>
                        </div>
                    </form>  
                </div>
            </div>
        </div>
        <?php $this->load->view("Partials/FooterView"); ?>
        <?php $this->load->view("Partials/TestJs"); ?>
        <?php $this->load->view("Partials/JqueryUI"); ?>
        <?php $this->load->view("Partials/SweetAlertJs"); ?>
        <?php $this->load->view("Partials/AngularJs"); ?>
        <?php $this->load->view("Partials/UserJs"); ?>
    </body>
</html>