<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>

    <body>
        <?php $this->load->view("Partials/NavbarView"); ?>
        <div class="container-fluid" ng-app="SalarySlipApp" ng-controller="SalarySlipAppCtrl">
            <div class="card card shadow border-primary mt-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p class="fs-5 m-0">Salary Slip Printing</p>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php ?>">Employee</a></li>
                                    <li class="breadcrumb-item active">Salary Printing</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <?php $this->load->view("Partials/IconBarsView"); ?>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card border-dark shadow rounded-0 mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text bg-danger border-danger rounded-0 text-white" id="basic-addon1">Salary Month/Year</span>
                                        <input type="text" class="form-control border-danger rounded-0 text-danger text-bold bg-light" placeholder="Salary Month Year" id="SalaryMonthYear" ng-model="SalaryMonthModel" readonly>
                                    </div>
                                    
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text border-warning bg-warning text-white rounded-0 " id="basic-addon1">Employee Code</span>
                                        <input type="text" class="form-control border-warning  rounded-0 bg-light" placeholder="Employee Code" ng-model="EmployeeCodeModel">
                                    </div>
                                    
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-success rounded-0" ng-click="searchEmployeSalary()">Search</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <section>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card border-warning shadow">
                                    <div class=" card-header">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button class="btn btn-success btn-sm shadow"><img src="<?php echo base_url("assets/img/icons/slip.png"); ?>"></button>
                                                <strong> &nbsp;Salary Slip</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="scrollbar" id="style-7">
                                            <div class="force-overflow">
                                               
                                                <table class="table table-bordered border-warning table-striped mt-5 table-sm">
                                                    <thead class="bg-warning">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Slip No</th>
                                                            <th>Emp Code</th>
                                                            <th>EmpName</th>
                                                            <th>Salary Date</th>
                                                            <th>Gross Salary</th>
                                                            <th>Net Salary</th>
                                                            <th>IsPaid</th>
                                                            <th class="border-end-0">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr ng-repeat="d1 in salaries">
                                                            <td class="border-start-0 text-center">
                                                                <button class="btn btn-success btn-sm">
                                                                    <img src="<?php echo base_url("assets/img/icons/slip.png"); ?>">
                                                                </button>
                                                            </td>
                                                            <td class="text-bold text-green">{{d1.SlipNo}}</td>
                                                            <td>{{d1.EmployeeCode}}</td>
                                                            <td>{{d1.Salutation}} {{d1.FirstName}} {{d1.LastName}}</td>
                                                            <td>{{d1.SalaryMonth}}</td>
                                                            <td>{{d1.GrossSalary}}</td>
                                                            <td>{{d1.NetSalary}}</td>
                                                            <td ng-if="d1.IsPaid == 0"><span class="badge bg-danger">No</span></td>
                                                            <td ng-if="d1.IsPaid == 1"><span class="badge bg-success">Yes</span></td>
                                                            <td class="border-end-0">
                                                                <?php
                                                                if ($this->aauth->is_allowed('Print')) {
                                                                    ?>
                                                                    <a href="<?php echo base_url('app/slip/print/{{d1.SalaryID}}'); ?>" target="_blank"><img src="<?php echo base_url("assets/img/print.png"); ?>"></a>
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
        <?php $this->load->view("Partials/SalarySlipJs"); ?>
    </body>
</html>