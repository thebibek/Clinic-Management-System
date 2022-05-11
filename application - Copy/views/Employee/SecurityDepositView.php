<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>

    <body>
        <?php $this->load->view('Partials/NavbarView'); ?>
        <div class="container-fluid" ng-app="SecurityDepositApp" ng-controller="SecurityDepositAppCtrl">
            <div class="card border-primary shadow">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p class="fs-5 m-0">Security Deposit Manager</p>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url("app/dashboard"); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php ?>">Employee</a></li>
                                    <li class="breadcrumb-item active">Security Deposit</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <?php $this->load->view("Partials/IconBarsView"); ?>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!--Security Deposit Panel-->
                    <section ng-show="SecurityDepositPanel">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card border-warning shadow mb-3">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button class="btn btn-warning btn-sm shadow"><img src="<?php echo base_url("assets/img/icons/deposit.png"); ?>"></button>
                                                <strong> &nbsp;Security Deposit</strong>
                                            </div>
                                            <div class="col-md-6 text-end">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-outline-dark rounded-0 shadow  text-danger"> <strong>ECODE-{{EmployeeCode}}</strong> </button>
                                                    <button type="button" class="btn btn-outline-dark rounded-0 shadow text-success"><strong>{{EmpName}}</strong> </button>
                                                    <a href="<?php echo base_url('app/employee/security/deposit'); ?>" class="btn btn-danger border-dark rounded-0 ">Close</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <section>
                                            <table class="table table-bordered border-warning table-striped mt-5 table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Date</th>
                                                        <th>Total Amount</th>
                                                        <th>Amount Paid</th>
                                                        <th>Amt Due</th>
                                                        <th>PayType</th>
                                                        <th>Mode</th>
                                                        <th>Bank</th>
                                                        <th>RefNo</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr ng-repeat="d2 in securitydeposits">
                                                        <td>
                                                            <button class="btn btn-warning btn-sm shadow">
                                                                <img src="<?php echo base_url("assets/img/icons/deposit1.png"); ?>">
                                                            </button>
                                                        </td>
                                                        <td class="text-bold text-green" ng-cloak>{{d2.SecurityDepositDate}}</td>
                                                        <td>{{d2.TotalAmount}}</td>
                                                        <td>{{d2.AmountPaid}}</td>
                                                        <td class="text-bold text-danger">{{d2.AmountDue}}</td>
                                                        <td ng-if="d2.PayType == 1">CASH</td>
                                                        <td ng-if="d2.PayType == 2">OTHERS</td>
                                                        <td>{{d2.PaymentMode}}</td>
                                                        <td>{{d2.Ledger}}</td>
                                                        <td>{{d2.RefNo}}</td>
                                                        <td>
                                                            <?php
                                                            if ($this->aauth->is_allowed('Delete')) {
                                                                ?>
                                                                <a href="#" ng-click="deleteSecurityDeposit(d2.SecurityDepositID)"><img src="<?php echo base_url('assets/img/delete.png'); ?>" alt="Delete"></a>
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

                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger  text-white"> <strong>TOTAL DUE</strong> </button>
                                                    <button type="button" class="btn btn-warning  text-white"><strong>{{TotalDue}}</strong> </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!--Security Deposit Panel End-->
                    <section>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card border-primary shadow">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button class="btn btn-warning btn-sm shadow"><img src="<?php echo base_url("assets/img/icons/employee1.png"); ?>"></button>
                                                <strong> &nbsp;{{label}}</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <section ng-show="AddPanel">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="card border-primary shadow m-4">
                                                        <div class="card-header">
                                                            <strong> &nbsp;Security Deposit</strong>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="input-group mb-2">
                                                                <span class="input-group-text"><strong>Security Deposit Date</strong></span>
                                                                <input type="text" class="form-control  text-bold text-green" id="SecurityDepositDate" placeholder="Security Deposit Date" ng-model="SecurityDepositDateModel" readonly>
                                                            </div>
                                                            <div class="input-group mb-2">
                                                                <span class="input-group-text"><strong>Total Amount</strong></span>
                                                                <input type="text" class="form-control  text-bold text-danger" id="" placeholder="Enter Total Amount" ng-model="TotalAmountModel" ng-change="changeTotalAmt()">
                                                            </div>
                                                            <div class="input-group mb-2">
                                                                <span class="input-group-text"><strong>Amount Paid</strong></span>
                                                                <input type="text" class="form-control  text-bold text-success" id="" placeholder="Enter Amount Paid" ng-model="AmountPaidModel" ng-change="changeAmtPaid()">
                                                            </div>
                                                            <div class="input-group mb-2">
                                                                <span class="input-group-text"><strong>Amount Due</strong></span>
                                                                <input type="text" class="form-control  text-bold text-black" id="" placeholder="Enter Amount Due" ng-model="AmountDueModel" readonly>
                                                            </div>
                                                            <div class="input-group mb-2">
                                                                <span class="input-group-text"><strong>Remark</strong></span>
                                                                <input type="text" class="form-control " id="" placeholder="Enter Remark" ng-model="RemarkModel">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="card border-primary shadow m-4">
                                                        <div class="card-header">
                                                            <strong> &nbsp;Payment Details</strong>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="form-check form-check-inline">
                                                                <input type="radio" name="PayTypeRadio" ng-change="changePayType()" ng-model="PayTypeModel" value="1" ng-checked="true">
                                                                <label class="form-check-label" for="Cash">CASH</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input type="radio" name="PayTypeRadio" ng-change="changePayType()" ng-model="PayTypeModel" value="2">
                                                                <label class="form-check-label" for="Other">OTHER</label>
                                                            </div>
                                                            <hr class="mb-2 mt-0">
                                                            <div class="input-group mb-2">
                                                                <span class="input-group-text"><strong>Payment Mode</strong></span>
                                                                <select class="form-select" ng-model="PaymentModeModel">
                                                                    <option value="">Select Payment Mode</option>
                                                                    <option ng-repeat="d1 in paymentmodes" value="{{d1.ID}}">{{d1.PaymentMode}}</option>
                                                                </select>
                                                            </div>
                                                            <div class="input-group mb-2">
                                                                <span class="input-group-text"><strong>Bank &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></span>
                                                                <select class="form-select" ng-model="BankModel">
                                                                    <option value="0">Select Bank</option>
                                                                    <option ng-repeat="d3 in banks" value="{{d3.ID}}">{{d3.Ledger}}</option>
                                                                </select>
                                                            </div>
                                                            <div class="input-group mb-2">
                                                                <span class="input-group-text"><strong>Ref No</strong></span>
                                                                <input class="form-control " ng-model="RefNoModel" placeholder="Enter Ref No">
                                                            </div>
                                                        </div>
                                                        <div class="card-footer">
                                                            <div class="row">
                                                                <div class="col-md-12 text-end">
                                                                    <button class="btn btn-primary" ng-click="saveSecurityDeposit()">Save</button>
                                                                    <a href="<?php echo base_url('app/employee/security/deposit'); ?>" class="btn btn-danger">Close</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <section ng-show="ListPanel">
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
                                                        <th class="border-end-0">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr ng-repeat="d1 in employees" ng-cloak>
                                                        <td class="border-start-0 text-center">
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
                                                        <td class="border-end-0">
                                                            <button class="btn btn-sm btn-success" ng-click="showAddPanel(d1.EmployeeID, d1.DepartmentID)">Deposit Security</button>
                                                            <button class="btn btn-sm btn-warning" ng-click="showSecurityDeposits(d1.EmployeeID, d1.Salutation, d1.FirstName, d1.LastName, d1.EmployeeCode)"><img src="<?php echo base_url('assets/img/icons/view.png'); ?>"></button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </section>
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
        <?php $this->load->view("Partials/SecurityDepositJs"); ?>
    </body>
</html>