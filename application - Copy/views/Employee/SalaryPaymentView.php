<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>

    <body>
        <?php $this->load->view('Partials/NavbarView'); ?>
        <div class="container-fluid" ng-app="SalaryPaymentApp" ng-controller="SalaryPaymentAppCtrl">
            <div class="card card shadow border-primary mt-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p class="fs-5 m-0">Employee Pay Slip Report & Payment</p>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url("app/dashboard"); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Category</li>
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
                    <div class="card border-warning rounded-0 shadow">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text border-warning rounded-0 bg-warning text-white" id="basic-addon1">Salary Month/Year</span>
                                        <input type="text" class="form-control rounded-0  text-danger fw-bold border-warning bg-light" placeholder="Salary Month Year" id="SalaryMonthYear" ng-model="SalaryMonthModel" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text border-warning rounded-0 bg-warning text-white" id="basic-addon1">Employee Code</span>
                                        <input type="text" class="form-control rounded-0 text-danger fw-bold border-warning bg-light" placeholder="Employee Code" ng-model="EmployeeCodeModel">
                                    </div>


                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-success rounded-0 shadow" ng-click="searchEmployeSalary()">Search</button>
                                </div>

                            </div>
                        </div>
                    </div>
                    <section>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card border-warning shadow mt-3">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button class="btn btn-warning btn-sm"><img src="<?php echo base_url("assets/img/icons/scheme.png"); ?>"></button>
                                                <strong> &nbsp;Salary Slip Manager</strong>
                                            </div>
                                            <div class="col-md-3"></div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-text border-info bg-info"><img src="<?php echo base_url("assets/img/icons/date.png"); ?>"></span>
                                                        <input type="text" class="form-control border-info bg-light fw-bold text-success" placeholder="Payment Date(YY-MM-DD)" id="PaymentDate" readonly="" ng-model="PaymentDateModel">
                                                    </div>
                                                </div>
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
                                                            <th>#</th>
                                                            <th>Slip No</th>
                                                            <th>Emp Code</th>
                                                            <th>EmpName</th>
                                                            <th>Salary Date</th>
                                                            <th>Net Salary</th>
                                                            <th>Payment Mode</th>
                                                            <th>Bank Name</th>
                                                            <th>CHQ/DD No</th>
                                                            <th>CHQ/DD Date</th>
                                                            <th>IsPaid</th>
                                                            <th class="border-end-0">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr ng-repeat="d1 in salaries" class="align-middle">
                                                            <td ng-if="d1.IsPaid == 0" class="border-start-0 text-center "><input type="checkbox" class="checkbox-control" id="" ng-model="d1.IsChecked" ng-true-value="'1'" ng-false-value="'0'"></td>
                                                            <td ng-if="d1.IsPaid == 1" class="border-start-0 text-center"><div class="check-box"></div></td>
                                                            <td>
                                                                <button class="btn btn-primary btn-sm">
                                                                    <img src="<?php echo base_url("assets/img/icons/pay1.png"); ?>">
                                                                </button>
                                                            </td>
                                                            <td class="fw-bold text-success">{{d1.SlipNo}}</td>
                                                            <td>{{d1.EmployeeCode}}</td>
                                                            <td>{{d1.FirstName}} {{d1.LastName}}</td>
                                                            <td>{{d1.SalaryGeneratedDate}}</td>
                                                            <td>{{d1.NetSalary}}</td>
                                                            <td>
                                                                <select class="form-select" ng-model="d1.PaymentMode">
                                                                    <option value="">Select</option>
                                                                    <option ng-repeat="d2 in pmodes" value="{{d2.ID}}">{{d2.PaymentMode}}</option>

                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select class="form-select" ng-model="d1.BankName">
                                                                    <option value="">Select</option>
                                                                    <option ng-repeat="d3 in banks" value="{{d3.ID}}">{{d3.Ledger}}</option>
                                                                </select>
                                                            </td>
                                                            <td><input type="text" class="form-control" placeholder="Enter Cheque/DD No" ng-model="d1.CHQNo"></td>
                                                            <td><input type="text" class="form-control" placeholder="Enter Cheque/DD Date" ng-model="d1.CHQDate"></td>
                                                            <td ng-if="d1.IsPaid == 0"><span class="badge bg-danger">No</span></td>
                                                            <td ng-if="d1.IsPaid == 1"><span class="badge bg-success">Yes</span></td>
                                                            <td class="border-end-0">
                                                                <?php
                                                                if ($this->aauth->is_admin() || $this->aauth->is_allowed('Delete')) {
                                                                    ?>
                                                                    <a href="#" ng-click="deleteSalary(d1.SalaryID)"><img src="<?php echo base_url("assets/img/delete.png"); ?>"></a>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div ng-show="Spinner1" class="text-center"><img src="<?php echo base_url('assets/img/icons/loader.png'); ?>"></div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="card-footer">
                                        <div class="f-box">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="btn-group">
                                                        <?php
                                                        if ($this->aauth->is_allowed('MakePayment')) {
                                                            ?>
                                                            <button type="button" class="btn btn-danger" ng-click="makePayment()"> Make Payment </button>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <button type="button" class="btn btn-danger"><img src="<?php echo base_url('assets/img/prohibit.png'); ?>"> Make Payment </button>
                                                            <?php
                                                        }
                                                        ?>
                                                        <?php
                                                        if ($this->aauth->is_allowed('PrintPaySlip')) {
                                                            ?>
                                                            <button type="button" ng-click="printPaySlip()" class="btn btn-primary">  Print Pay Slip </button>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <button type="button" class="btn btn-primary"><img src="<?php echo base_url('assets/img/prohibit.png'); ?>"> Print Pay Slip </button>
                                                            <?php
                                                        }
                                                        ?>    
                                                        <?php
                                                        if ($this->aauth->is_allowed('PrintReport')) {
                                                            ?>
                                                            <button type="button" class="btn btn-secondary"> Print Report </button>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <button type="button" class="btn btn-secondary"><img src="<?php echo base_url('assets/img/prohibit.png'); ?>"> Print Report </button>
                                                                <?php
                                                            }
                                                            ?>
                                                    </div>
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
        <?php $this->load->view("Partials/SalaryPaymentJs"); ?>
    </body>
</html>