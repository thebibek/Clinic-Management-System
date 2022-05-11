<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>

    <body>
        <?php $this->load->view('Partials/NavbarView'); ?>
        <div class="container-fluid" ng-app="AttendanceRegdApp" ng-controller="AttendanceRegdAppCtrl">
            <div class="card card shadow border-primary mt-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p class="fs-5 m-0">Employee Attendance Registration</p>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url("app/dashboard"); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url("app/employee/registration") ?>">Employee</a></li>
                                    <li class="breadcrumb-item active">Employee Attendance Registration</li>
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
                            <div class="card border-warning shadow">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button class="btn btn-warning btn-sm shadow"><img src="<?php echo base_url("assets/img/icons/attendance.png"); ?>"></button>
                                            <strong> Employee Attendance Registration</strong>
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <a href="<?php echo base_url('app/employee/search'); ?>" class="btn btn-outline-dark fs-6 rounded-0 shadow btn-sm"><img src="<?php echo base_url('assets/img/icons/list1.png'); ?>">Employees</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="scrollbar" id="style-7">
                                        <div class="force-overflow">
                                            <table class="table table-bordered border-warning table-striped mt-5 table-sm">
                                                <thead class="bg-warning">
                                                    <tr>
                                                        <th class="border-start-0 text-center">#</th>
                                                        <th>Emp Code</th>
                                                        <th>Emp Name</th>
                                                        <th>Department</th>
                                                        <th>Designation</th>
                                                        <th class="border-end-0">Attendance ID</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr ng-repeat="d1 in attendanceregistrations" ng-cloak="">
                                                        <td class="border-start-0 text-center">
                                                            <button class="btn btn-info btn-sm shadow">
                                                                <img src="<?php echo base_url("assets/img/icons/employee1.png"); ?>">
                                                            </button>
                                                        </td>
                                                        <td class="text-bold text-danger">{{d1.EmployeeCode}}</td>
                                                        <td>{{d1.FirstName}} {{d1.LastName}}</td>
                                                        <td>{{d1.Department}}</td>
                                                        <td>{{d1.Designation}}</td>
                                                        <td class="text-bold text-green border-end-0" >{{d1.AttendanceID}}</td>
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


        <?php $this->load->view("Partials/FooterView"); ?>
        <?php $this->load->view("Partials/TestJs"); ?>
        <?php $this->load->view("Partials/JqueryUI"); ?>
        <?php $this->load->view("Partials/AngularJs"); ?>
        <?php $this->load->view("Partials/SweetAlertJs"); ?>
        <?php $this->load->view("Partials/AttendanceRegistrationJs"); ?>
    </body>
</html>