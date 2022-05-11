<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>

    <body>
        <?php $this->load->view('Partials/NavbarView'); ?>
        <div class="container-fluid" ng-app="EmployeeManagerApp" ng-controller="EmployeeManagerAppCtrl">
            <div class="card card shadow border-primary mt-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p class="fs-5 m-0">Employee Manager</p>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url("app/dashboard"); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="#">Employee</a></li>
                                    <li class="breadcrumb-item active">Employee Manager</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <?php $this->load->view("Partials/IconBarsView"); ?>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card border-warning shadow" ng-show="ListPanel"">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button class="btn btn-warning btn-sm"><img src="<?php echo base_url("assets/img/icons/employee1.png"); ?>"></button>
                                            <strong> &nbsp;Employee Manager</strong>
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <a class="btn btn-outline-dark shadow rounded-0 fs-6  btn-sm" href="<?php echo base_url('app/employee/registration'); ?>"><img src="<?php echo base_url("assets/img/icons/add.png"); ?>">+ Add New Employee</a>
                                            <a href="<?php echo base_url('app/employee/search'); ?>" class="btn btn-danger btn-sm rounded-0 fs-6 shadow">Close</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="p-3 m-3 border border-dark bg-light mb-3 shadow">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label"><strong>Employee Code</strong></label>
                                                    <input type="text" class="form-control input-sm" id="" placeholder="Enter Employee Code" ng-model="EmployeeCodeModel">
                                                </div>
                                                <div class="form-group">
                                                    <label  class="form-label"><strong>Employee Name</strong></label>
                                                    <input type="text" class="form-control input-sm" id="" placeholder="Enter Employee Name" ng-model="EmployeeNameModel">
                                                </div>
                                                <div class="form-group">
                                                    <label  class="form-label"><strong>Father Name</strong></label>
                                                    <input type="text" class="form-control input-sm" id="" placeholder="Enter Father Name" ng-model="FatherModel">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label  class="form-label"><strong>Department</strong></label>
                                                    <select class="form-select input-sm" ng-model="DepartmentModel">
                                                        <option value="">Please select department</option>
                                                        <option ng-repeat="d1 in departments" value="{{d1.ID}}">{{d1.Department}}</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label  class="form-label"><strong>Designation</strong></label>
                                                    <select class="form-select input-sm" ng-model="DesignationModel">
                                                        <option value="">Please Select Designation</option>
                                                        <option ng-repeat="d2 in designations" value="{{d2.ID}}">{{d2.Designation}}</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label"><strong>Joining Date</strong></label>
                                                    <input type="text" class="form-control input-sm" placeholder="Enter Joining Date" id="JoiningDate" readonly ng-model="JoiningDateModel">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label  class="form-label"><strong>Birth Date</strong></label>
                                                    <input type="text" class="form-control input-sm" placeholder="Enter Birth Date" id="DateOfBirth" readonly ng-model="BirthDateModel">
                                                </div>
                                                <div class="form-group">
                                                    <label  class="form-label"><strong>Is Current Employee</strong></label>
                                                    <select class="form-select input-sm" ng-model="CurrentEmployeeModel">
                                                        <option value="">Select Status</option>
                                                        <option value="1">Yes</option>
                                                        <option value="2">No</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label  class="col-sm-6 control-label"><strong></strong></label>
                                                    <div class="col-sm-6">
                                                        <button class="btn btn-success  btn-sm" ng-click="searchEmployee()">Search</button>
                                                        <a href="<?php echo base_url("app/employee/search"); ?>" class="btn btn-danger btn-sm">Reset</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="scrollbar" id="style-7">
                                        <div class="force-overflow">
                                            <table class="table table-bordered border-warning table-striped mt-3 table-sm">
                                                <thead class="bg-warning">
                                                    <tr>
                                                        <th class="border-start-0 text-center">#</th>
                                                        <th>Emp Code</th>
                                                        <th>Name</th>
                                                        <th>Gender</th>
                                                        <th>Ph No</th>
                                                        <th>Department</th>
                                                        <th>Designation</th>
                                                        <th>City</th>
                                                        <th>Joining Date</th>
                                                        <th class="border-end-0">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr ng-repeat="d1 in employees">
                                                        <td class="border-start-0 text-center">
                                                            <button class="btn btn-danger btn-sm shadow">
                                                                <img src="<?php echo base_url("assets/img/icons/employee.png"); ?>">
                                                            </button>
                                                        </td>
                                                        <td class="fw-bold text-success" ng-bind="d1.EmployeeCode"></td>
                                                        <td><span ng-bind="d1.Salutation"></span> <span ng-bind="d1.FirstName"></span> <span ng-bind="d1.LastName"></span></td>
                                                        <td ng-if="d1.Gender == 1" class="text-danger" ng-cloak="">Male</td>
                                                        <td ng-if="d1.Gender == 2" class="text-success" ng-cloak="">Female</td>
                                                        <td class="fw-bold text-danger" ng-bind="d1.PhoneNumber"></td>
                                                        <td ng-bind="d1.Department"></td>
                                                        <td ng-bind="d1.Designation"></td>
                                                        <td ng-bind="d1.City"></td>
                                                        <td ng-bind="d1.JoiningDate"></td>
                                                        <td class="border-end-0">
                                                            <?php
                                                            if ($this->aauth->is_admin() || $this->aauth->is_allowed('Delete')) {
                                                                ?>
                                                                <a href="#" ng-click="deleteEmployee(d1.EmployeeID)"><img src="<?php echo base_url("assets/img/delete.png"); ?>"></a>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <a href="#"><img src="<?php echo base_url("assets/img/delete2.png"); ?>"></a>
                                                                <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($this->aauth->is_allowed('Edit')) {
                                                                ?>
                                                                <a href="#" ng-click="editEmployee(d1.EmployeeID)"><img src="<?php echo base_url("assets/img/edit.png"); ?>"></a>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <a href="#"><img src="<?php echo base_url("assets/img/prohibit.png"); ?>"></a>
                                                                <?php
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                            <div ng-show="Spinner1" class="text-center m-t-10"><img src="<?php echo base_url('assets/img/icons/loader.png'); ?>"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Edit Employee-->
                    <?php $this->load->view("Employee/UpdateEmployeeView"); ?>
                    <!--End Edit Employee-->
                </div>
            </div>  
        </div>

        <?php $this->load->view("Partials/FooterView"); ?>
        <?php $this->load->view("Partials/TestJs"); ?>
        <?php $this->load->view("Partials/JqueryUI"); ?>
        <?php $this->load->view("Partials/DateJs"); ?>
        <?php $this->load->view("Partials/AngularJs"); ?>
        <?php $this->load->view("Partials/SweetAlertJs"); ?>
        <?php $this->load->view("Partials/EmployeeManagerJs"); ?>
    </body>
</html>