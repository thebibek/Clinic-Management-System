<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>

    <body>
        <?php $this->load->view('Partials/NavbarView'); ?>
        <div class="container-fluid" ng-app="EmployeeImportApp" ng-controller="EmployeeImportAppCtrl">
            <div class="card card shadow border-primary mt-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p class="fs-5 m-0">Employee Import Manager</p>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url("app/dashboard"); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url("app/employee/registration") ?>">Employee</a></li>
                                    <li class="breadcrumb-item active">Employee Import</li>
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
                                            <button class="btn btn-warning btn-sm shadow"><img src="<?php echo base_url("assets/img/icons/employee1.png"); ?>"></button>
                                            <strong> &nbsp;Employee Manager</strong>
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <a class="btn btn-outline-dark fs-6 shadow rounded-0 btn-sm" href="<?php echo base_url('app/download/sample/excel'); ?>"><img src="<?php echo base_url("assets/img/icons/excel.png"); ?>"> Download</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="p-2 m-2 border border-dark shadow">
                                        <form method="post" accept-charset="utf-8" action="<?php echo base_url('app/upload/sample/excel'); ?>" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input type="file" name="EmployeeExcel">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-success rounded-0 shadow btn-sm"> Upload Excel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>    
                                    </div>
                                    <div class="scrollbar" id="style-7">
                                        <div class="force-overflow">
                                            <table class="table table-bordered border-warning table-striped mt-5 table-sm">
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
                                                        <th class="border-end-0">Email</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr ng-repeat="d1 in employees" ng-cloak="">
                                                        <td class="border-start-0 text-center">
                                                            <button class="btn btn-danger btn-sm shadow">
                                                                <img src="<?php echo base_url("assets/img/icons/employee.png"); ?>">
                                                            </button>
                                                        </td>
                                                        <td class="text-bold text-green">{{d1.EmployeeCode}}</td>
                                                        <td>{{d1.Salutation}} {{d1.FirstName}} {{d1.LastName}}</td>
                                                        <td>{{d1.Gender}}</td>
                                                        <td class="text-bold text-danger">{{d1.PhoneNumber}}</td>
                                                        <td>{{d1.Department}}</td>
                                                        <td>{{d1.Designation}}</td>
                                                        <td>{{d1.City}}</td>
                                                        <td>{{d1.JoiningDate}}</td>
                                                        <td class="border-end-0">{{d1.Email}}</td>
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
        <?php $this->load->view("Partials/DateJs"); ?>
        <?php $this->load->view("Partials/EmployeeImportJs"); ?>
    </body>
</html>