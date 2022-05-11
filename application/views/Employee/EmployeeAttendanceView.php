<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>
    <body>
        <?php $this->load->view('Partials/NavbarView'); ?>
        <div class="container-fluid" ng-app="EmployeeDailyAttendanceApp" ng-controller="EmployeeDailyAttendanceAppCtrl">
            <div class="card card shadow border-primary mt-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p class="fs-5 m-0">Employee Daily Attendane</p>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url("app/dashboard"); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('app/employee/registration'); ?>">Employee</a></li>
                                    <li class="breadcrumb-item active">Employee Attendance</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <?php $this->load->view("Partials/IconBarsView"); ?>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <section>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card border-warning shadow">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button class="btn btn-warning btn-sm"><img src="<?php echo base_url("assets/img/icons/attendance.png"); ?>"></button>
                                                <strong> &nbsp;Daily Attendance</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="p-2 m-2 shadow border  border-dark">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text border-danger bg-danger rounded-0 text-white" id="basic-addon1">Department</span>
                                                        <select class="form-select border-danger bg-light rounded-0" ng-model="DepartmentModel">
                                                            <option value="">Please select department</option>
                                                            <option ng-repeat="d1 in departments" value="{{d1.ID}}">{{d1.Department}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text border-warning text-white bg-warning rounded-0" id="basic-addon1">Date</span>
                                                        <input type="text" class="form-control border-warning rounded-0 bg-light" id="AttendanceDate" readonly ng-model="AttendanceDateModel">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div class="col-sm-6">
                                                            <button class="btn btn-success rounded-0" ng-click="searchEmployee()">Search</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="scrollbar" id="style-7">
                                            <div class="force-overflow">
                                                <table class="table table-bordered border-warning table-striped mt-5 table-sm">
                                                    <thead class="bg-warning">
                                                        <tr>
                                                            <th class="border-start-0 text-center">IsAbsent</th>
                                                            <th>#</th>
                                                            <th>Emp Code</th>
                                                            <th>Emp Name</th>
                                                            <th class="border-end-0">Attendance</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr ng-repeat="d1 in employees" ng-cloak="">
                                                            <td class="border-start-0 text-center">
                                                                <input class="form-check-input" type="checkbox"  ng-change="changeAttendance($index)" ng-model="d1.Status" ng-true-value="'1'" ng-false-value="'0'">
                                                            </td>
                                                            <td>
                                                                <button class="btn btn-success btn-sm">
                                                                    <img src="<?php echo base_url("assets/img/icons/category1.png"); ?>">
                                                                </button>
                                                            </td>
                                                            <td class="fw-bold text-success">{{d1.EmployeeCode}}</td>
                                                            <td>{{d1.Salutation}} {{d1.FirstName}} {{d1.LastName}}</td>
                                                            <td class="fw-bold {{d1.color}} border-end-0" >{{d1.Attendance}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div ng-show="Spinner1" class="text-center m-t-10"><img src="<?php echo base_url('assets/img/icons/loader.png'); ?>"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button class="btn btn-primary" ng-click="saveAttendance()" type="button">+ SAVE</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </section>
                </div>
            </div>  
        </div>

        <?php $this->load->view("Partials/FooterView"); ?>
        <?php $this->load->view("Partials/TestJs"); ?>
        <?php $this->load->view("Partials/JqueryUI"); ?>
        <?php $this->load->view("Partials/AngularJs"); ?>
        <?php $this->load->view("Partials/SweetAlertJs"); ?>
        <?php $this->load->view("Partials/DateJs"); ?>
        <?php $this->load->view("Partials/EmployeeDailyAttendanceJs"); ?>
    </body>
</html>