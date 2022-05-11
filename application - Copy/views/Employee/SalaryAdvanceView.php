<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>

    <body>
        <?php $this->load->view('Partials/NavbarView'); ?>
        <div class="container-fluid" ng-app="SalaryAdvanceApp" ng-controller="SalaryAdvanceAppCtrl">
            <div class="card border-primary shadow mt-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p class="fs-5 m-0">Salary Advance Manager</p>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url("app/dashboard"); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php ?>">Employee</a></li>
                                    <li class="breadcrumb-item active">Salary Advance</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <?php $this->load->view("Partials/IconBarsView"); ?>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!--Salary Advance Panel-->
                    <section ng-show="SalaryAdvancePanel">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card border-warning shadow mb-3">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button class="btn btn-warning btn-sm shadow"><img src="<?php echo base_url("assets/img/icons/advance.png"); ?>"></button>
                                                <strong> &nbsp;Salary Advance</strong>
                                            </div>
                                            <div class="col-md-6 text-end">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-outline-dark rounded-0 bg-light text-danger"> <strong>ECODE-{{EmployeeCode}}</strong> </button>
                                                    <button type="button" class="btn btn-outline-dark rounded-0 bg-light text-success"><strong>{{EmpName}}</strong> </button>
                                                    <a href="<?php echo base_url('app/advance/payment'); ?>" class="btn btn-danger rounded-0 border-dark">Close</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <section>
                                            <table class="table table-striped table-bordered border-primary table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Date</th>
                                                        <th>Advance Amount</th>
                                                        <th>PayType</th>
                                                        <th>Mode</th>
                                                        <th>Bank</th>
                                                        <th>RefNo</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr ng-repeat="d3 in advances" ng-cloak="">
                                                        <td>
                                                            <button class="btn btn-warning btn-sm">
                                                                <img src="<?php echo base_url("assets/img/icons/advance1.png"); ?>">
                                                            </button>
                                                        </td>
                                                        <td class="text-bold text-green" ng-cloak>{{d3.AdvanceDate}}</td>
                                                        <td class="text-bold text-danger" ng-cloak>{{d3.AdvanceAmount}}</td>
                                                        <td ng-if="d3.PayType == 1"><strong>CASH</strong></td>
                                                        <td ng-if="d3.PayType == 2"><strong>OTHERS</strong></td>
                                                        <td>{{d3.PaymentMode}}</td>
                                                        <td>{{d3.Ledger}}</td>
                                                        <td>{{d3.RefNo}}</td>
                                                        <td>
                                                            <?php
                                                            if ($this->aauth->is_allowed('Delete')) {
                                                                ?>
                                                                <a href="#" ng-click="deleteSalaryAdvance(d3.AdvanceID)"><img src="<?php echo base_url('assets/img/delete.png'); ?>" alt="Delete"></a>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <a href="#"><img src="<?php echo base_url('assets/img/delete2.png'); ?>" alt="Delete Disabled"></a>
                                                                <?php
                                                            }
                                                            ?>

                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </section>
                                        <div class="panel-footer">
                                            <div class="row">
                                                <div class="col-md-12 text-center">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-outline-dark bg-light rounded-0 shadow  text-danger"> <strong>TOTAL ADVANCE</strong> </button>
                                                        <button type="button" class="btn btn-outline-dark bg-light rounded-0 shadow  text-danger"><strong>{{TotalAdvance}}</strong> </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!--Salary Advance Panel End-->
                    <section>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card border-warning shadow">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button class="btn btn-warning btn-sm shadow"><img src="<?php echo base_url("assets/img/icons/employee1.png"); ?>"></button>
                                                <strong> &nbsp;{{LabelModel}}</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <!--Add Panel Of Employee Advance Amount-->
                                        <section ng-show="AddPanel">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="card border-primary shadow">
                                                        <div class="card-header">
                                                            <strong> &nbsp;Salary Advance</strong>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text"><strong>Advance Date</strong></span>
                                                                <input type="text" class="form-control  text-bold text-green" id="AdvanceDate" placeholder="Advance Date" ng-model="AdvanceDateModel" readonly>
                                                            </div>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text"><strong>Amount Paid</strong></span>
                                                                <input type="text" class="form-control " id="" placeholder="Enter Advance Amount" ng-model="AdvanceAmountModel">
                                                            </div>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text"><strong>Remark</strong></span>
                                                                <input type="text" class="form-control " id="" placeholder="Enter Remark" ng-model="RemarkModel">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="card border-primary shadow">
                                                        <div class="card-header">
                                                            <strong> &nbsp;Payment Details</strong>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="form-check form-check-inline">
                                                                <input type="radio" name="PayTypeRadio" ng-change="changePayType()" ng-model="PayTypeModel" value="1" ng-checked="true">
                                                                <label class="form-check-label" for="cash">CASH</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input type="radio" name="PayTypeRadio" ng-change="changePayType()" ng-model="PayTypeModel" value="2">
                                                                <label class="form-check-label" for="inlineRadio1">OTHER</label>
                                                            </div>

                                                            <hr>
                                                            <div class="input-group mb-4">
                                                                <span class="input-group-text"><strong>Payment Mode</strong></span>
                                                                <select class="form-select" ng-model="PaymentModeModel">
                                                                    <option value="">Select Payment Mode</option>
                                                                    <option ng-repeat="d1 in paymentmodes" value="{{d1.ID}}">{{d1.PaymentMode}}</option>
                                                                </select>
                                                            </div>
                                                            <div class="input-group mb-4">
                                                                <span class="input-group-text"><strong>Bank &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></span>
                                                                <select class="form-select " ng-model="BankModel">
                                                                    <option value="0">Select Bank</option>
                                                                    <option ng-repeat="d2 in banks" value="{{d2.ID}}">{{d2.Ledger}}</option>
                                                                </select>
                                                            </div>
                                                            <div class="input-group mb-4">
                                                                <span class="input-group-text"><strong>Ref No</strong></span>
                                                                <input class="form-control " ng-model="RefNoModel" placeholder="Enter Ref No">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 text-right">
                                                    <button class="btn btn-success" ng-click="saveAdvancePayment()">Save</button>
                                                    <a href="<?php echo base_url('app/advance/payment'); ?>" class="btn btn-danger">Close</a>
                                                </div>
                                            </div>
                                        </section>
                                        <!--End Panel Of Employee Advance-->

                                        <!--List Panel Of Employees-->
                                        <section ng-show="ListPanel">
                                            <table class="table table-bordered border-warning table-striped mt-5 table-sm">
                                                <thead class="bg-warning">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Emp Code</th>
                                                        <th>Name</th>
                                                        <th>Gender</th>
                                                        <th>Ph No</th>
                                                        <th>Department</th>
                                                        <th>Designation</th>
                                                        <th>City</th>
                                                        <th>Joining Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr ng-repeat="d1 in employees" ng-cloak>
                                                        <td>
                                                            <button class="btn btn-danger btn-sm shadow">
                                                                <img src="<?php echo base_url("assets/img/icons/employee.png"); ?>">
                                                            </button>
                                                        </td>
                                                        <td class="text-bold text-green" ng-cloak>{{d1.EmployeeCode}}</td>
                                                        <td ng-cloak>{{d1.Salutation}} {{d1.FirstName}} {{d1.LastName}}</td>
                                                        <td ng-cloak>{{d1.Gender}}</td>
                                                        <td class="text-bold text-danger" ng-cloak>{{d1.PhoneNumber}}</td>
                                                        <td ng-cloak>{{d1.Department}}</td>
                                                        <td ng-cloak>{{d1.Designation}}</td>
                                                        <td ng-cloak>{{d1.City}}</td>
                                                        <td ng-cloak>{{d1.JoiningDate}}</td>
                                                        <td>
                                                            <button class="btn btn-sm btn-info border-primary rounded-0 shadow" ng-click="showAddPanel(d1.EmployeeID, d1.DepartmentID)">Pay Advance</button>
                                                            <?php
                                                            if ($this->aauth->is_allowed('View')) {
                                                                ?>
                                                                <button class="btn btn-sm btn-warning border-danger rounded-0 shadow" title="View" ng-click="provideSalaryAdvance(d1.EmployeeID, d1.Salutation, d1.FirstName, d1.LastName, d1.EmployeeCode)"><img src="<?php echo base_url('assets/img/icons/view.png'); ?>"></button>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <button class="btn btn-sm btn-warning border-danger rounded-0 shadow" title="View" ><img src="<?php echo base_url('assets/img/icons/prohibit.png'); ?>"></button>
                                                                    <?php
                                                                }
                                                                ?>

                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </section>
                                        <!--End Of Employee List Panle--->
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
        <?php $this->load->view("Partials/SalaryAdvanceJs"); ?>
    </body>
</html>