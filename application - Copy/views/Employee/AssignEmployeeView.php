<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>

    <body>

        <?php $this->load->view("Partials/NavbarView"); ?>
        <div class="container-fluid" ng-app="AssignEmployeeApp" ng-controller="AssignEmployeeAppCtrl">
            <div class="card card shadow border-primary mt-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p class="fs-5 m-0">Assign Employee Leave</p>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url("app/dashboard"); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('app/employee/registration'); ?>">HRM</a></li>
                                    <li class="breadcrumb-item active">Assign Leave</li>
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
                                        <div class="col-md-12">
                                            <button class="btn btn-warning btn-sm"><img src="<?php echo base_url("assets/img/icons/leave.png"); ?>"></button>
                                            <strong> &nbsp;Assign Employee Leave</strong>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class='card border-primary shadow'>
                                                <div class="card-header">
                                                    <strong>Employees</strong>
                                                </div>
                                                <div class="card-body p-0">
                                                    <table class="table table-bordered border-primary table-striped mt-2 table-sm">
                                                        <thead class="bg-primary">
                                                            <tr>
                                                                <th class="border-start-0 text-center">#</th>
                                                                <th>Emp Code</th>
                                                                <th>Emp Name</th>
                                                                <th>Designation</th>
                                                                <th class="border-end-0">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr ng-repeat="d1 in employees">
                                                                <td class="border-start-0 text-center"><button class="btn btn-danger btn-sm" type="button"><img src="<?php echo base_url("assets/img/icons/employee.png"); ?>"></button></td>
                                                                <td class="fs-6 text-danger">{{d1.EmployeeCode}}</td>
                                                                <td class="fs-6">{{d1.Salutation}} {{d1.FirstName}} {{d1.LastName}}</td>
                                                                <td>{{d1.Designation}}</td>
                                                                <td class="border-end-0">
                                                                    <div class="btn btn-info border-primary btn-sm" ng-click="assignLeave(d1.EmployeeID)">ADD</div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card border-primary shadow">
                                                <div class="card-header">
                                                    <strong>Type Of Leaves</strong>
                                                </div>
                                                <div class="card-body">
                                                    <table class="table table-bordered border-primary table-striped mt-2 table-sm">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Leave Type</th>
                                                                <th>No Of Leaves</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr ng-repeat="d1 in leaves">
                                                                <td><button class="btn btn-success btn-sm" type="button"><img src="<?php echo base_url("assets/img/icons/leave2.png"); ?>"></button></td>
                                                                <td>{{d1.LeaveType}}</td>
                                                                <td><input type="text" ng-model="d1.NoOfLeave" ng-change="calTotalLeave()"  class="form-control fw-bold text-center text-danger border-dark bg-light rounded-0" placeholder="Please Enter No Of Leave"></td>
                                                                <td><span class="fw-bold text-danger">-</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2">
                                                                    <h5 class="fw-bold text-danger">Total Leave</h5>
                                                                </td>
                                                                <td>
                                                                    <h5 class="fw-bold text-danger text-center">{{TotalLeaveModel}}</h5>
                                                                </td>
                                                                <td>
                                                                    <h5 class="fw-bold text-danger">-</h5>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <div class="row">
                                                        <div class="col-md-12 text-end">
                                                            <button class="btn btn-primary" ng-click="saveEmployeeLeaves()">Save</button>
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

        <?php $this->load->view("Partials/FooterView"); ?>
        <?php $this->load->view("Partials/TestJs"); ?>
        <?php $this->load->view("Partials/JqueryUI"); ?>
        <?php $this->load->view("Partials/SweetAlertJs"); ?>
        <?php $this->load->view("Partials/DateJs"); ?>
        <?php $this->load->view("Partials/AngularJs"); ?>
        <?php $this->load->view("Partials/AssignEmployeeJs"); ?>
    </body>
</html>