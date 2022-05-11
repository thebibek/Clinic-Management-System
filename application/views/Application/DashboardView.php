<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>
    <body>
        <?php $this->load->view("Partials/NavbarView"); ?>
        <div class="container-fluid" ng-app="DashboardApp" ng-controller="DashboardAppCtrl">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card shadow mt-3 border-primary">
                        <div class="card-header">
                            <div class="row g-1">
                                <div class="col-md-1 col-lg-1 col-sm-4 col-xs-12">
                                    <?php
                                    if (!empty($profile)) {
                                        $img = $profile['ProfileUrl'];
                                    } else {
                                        $img = 'default.png';
                                    }
                                    ?>
                                    <img src="<?php echo base_url('assets/uploads/') . $img; ?>" class="img-thumbnail float-end" height="60" width="60">
                                </div>
                                <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">

                                    <div class="page-title">
                                        <h4 class="mb-0">Dashboard</h4>
                                        <p class="mb-0"><?php echo $this->session->userdata('username'); ?></p>
                                    </div>
                                </div>
                                <div class="col-md-7 col-lg-7 col-sm-4 col-xs-12">
                                    <?php $this->load->view("Partials/IconBarsView"); ?>
                                </div>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="card shadow border-warning mb-3">
                                        <div class="card-header">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="p-1 bd-highlight">
                                                    <p class="m-0"><strong>TODAY VISIT(<span class="text-danger"  ng-bind="PatientCountModel"></span>)</strong></p>
                                                </div>
                                                <div class="p-1 bd-highlight">
                                                    <div class="input-group shadow">
                                                        <span class="input-group-text border-dark rounded-0"><img src="<?php echo base_url('assets/img/icons/back-20.png'); ?>" ng-click="previousDay()" alt=""></span>
                                                        <button type="button" class="btn btn-outline-dark"><span ng-bind="TodayModel"></span> <span ng-bind="CurrentDateModel"></span></button>
                                                        <span class="input-group-text border-dark rounded-0"><img src="<?php echo base_url('assets/img/icons/next-20.png'); ?>" ng-click="nextDay()" alt=""></span>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="card-body p-0">
                                            <div class="scrollbar  mt-4" id="style-7">
                                                <div class="force-overflow bg-light">
                                                    <table class="table text-center table-hover table-sm">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Patient Name</th>
                                                                <th>MR Number</th>
                                                                <th>Report No</th>
                                                                <th>Report Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr ng-repeat="d1 in todayvisits" ng-cloak>
                                                                <td><button class="btn btn-success btn-sm" type="button"><img src="<?php echo base_url("assets/img/icons/location.png"); ?>"></button></td>
                                                                <td><span ng-bind="d1.FirstName"></span> <span ng-bind="d1.LastName"></span></td>
                                                                <td class="text-danger" ng-bind="d1.MRNo"></td>
                                                                <td ng-if="d1.ReceiptNo == null"><span class="badge bg-danger">No</span></td>
                                                                <td class="text-success" ng-if="d1.ReceiptNo != null"><span ng-bind="d1.ReceiptNo"></span></td>
                                                                <td ng-if="d1.IsReportGenerated == null"><span class="badge bg-danger">No</span></td>
                                                                <td ng-if="d1.IsReportGenerated == 0"><span class="badge bg-danger">No</span></td>
                                                                <td ng-if="d1.IsReportGenerated == 1"><span class="badge bg-success">Yes</span></td>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                    <div ng-show="Error1Model" class="text-center m-t-10 text-danger" ng-bind="error1"></div>
                                                    <div ng-show="Spinner1" class="text-center m-t-10"><img src="<?php echo base_url('assets/img/icons/loader.png'); ?>"></div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="card-footer">
                                            <a href="<?php echo base_url('app/patient/registration'); ?>" class="btn btn-outline-dark rounded-0 "><img src="<?php echo base_url("assets/img/icons/registration.png"); ?>"> New Registration</a>
                                            <a href="<?php echo base_url('app/patient/visits'); ?>" class="btn btn-outline-dark rounded-0"><img src="<?php echo base_url("assets/img/icons/location.png"); ?>"> Visit Details</a>
                                            <a href="<?php echo base_url('app/receipt'); ?>" class="btn btn-outline-dark rounded-0"><img src="<?php echo base_url("assets/img/icons/invoice1.png"); ?>"> Create Invoice</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">


                                    <!--COMPLETED REPORTS PANEL-->

                                    <div class="card shadow border-warning">
                                        <div class="card-header">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="p-1 bd-highlight">
                                                    <p class="h-v-m mb-0"><strong>RECENT REPORTS(<span class="text-danger"  ng-bind="ReportCountModel"></span>)</strong></p>
                                                </div>
                                                <div class="p-1 bd-highlight">
                                                    <a href="#" class="btn btn-outline-dark rounded-0 shadow"><span ng-cloak><img src="<?php echo base_url("assets/img/icons/calender1.png"); ?>"> <span ng-bind="TodayModel"></span> <span ng-bind="CurrentDateModel"></span></span></a>
                                                    <a href="<?php echo base_url('app/report'); ?>" class="btn btn-outline-dark rounded-0 shadow"><img src="<?php echo base_url("assets/img/icons/report5.png"); ?>"> Create Report</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body p-0">
                                            <div class="scrollbar   mt-4" id="style-7">
                                                <div class="force-overflow bg-light">
                                                    <table class="table text-center table-hover table-sm">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>MR Number</th>
                                                                <th>Report No</th>
                                                                <th>Report Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr ng-repeat="d2 in completedreports" ng-cloak>
                                                                <td><button class="btn btn-warning btn-sm" type="button"><img src="<?php echo base_url("assets/img/icons/report9.png"); ?>"></button></td>
                                                                <td class="text-danger text-bold" ng-bind="d2.MRNo"></td>
                                                                <td class="text-info text-bold"><span ng-bind="d2.ReceiptNo"></span></td>
                                                                <td><span class="badge bg-success">Yes</span></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <div ng-show="Error1Model" class="text-center m-t-10 text-danger" ng-bind="error1"></div>
                                                    <div ng-show="Spinner1" class="text-center m-t-10"><img src="<?php echo base_url('assets/img/icons/loader.png'); ?>"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <a href="<?php echo base_url('app/pending/report'); ?>" class="btn btn-outline-dark rounded-0"><img src="<?php echo base_url("assets/img/icons/pending.png"); ?>"> Pending Report</a>
                                            <a href="<?php echo base_url('app/complete/report'); ?>" class="btn btn-outline-dark rounded-0"><img src="<?php echo base_url("assets/img/icons/complete.png"); ?>"> Completed Report</a>
                                        </div>
                                    </div>
                                    <!--END OF COMPLETED REPORT PANEL-->
                                </div>
                            </div>
                            <!--CARDS INFORMATION-->
                            <div class="row g-2">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <div class="card shadow border-danger">
                                        <div class="card-body">
                                            <h5 class="card-title text-danger">CASH IN HAND</h5>
                                            <div class="d-flex flex-row bd-highlight mb-3">
                                                <div class="p-2 bd-highlight">
                                                    <img src="<?php echo base_url('assets/img/icons/cash1.png'); ?>">
                                                </div>
                                                <div class="p-2 bd-highlight">
                                                    <p class="text-success fw-bold mb-0" ng-bind="CashInHandModel"></p>
                                                    <span class="fs-5 text-info">As on <?php echo date('Y-m-d'); ?></span> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <div class="card shadow border-success">
                                        <div class="card-body">
                                            <h5 class="card-title text-danger">TOTAL INCOME</h5>
                                            <div class="d-flex flex-row bd-highlight mb-3">
                                                <div class="p-2 bd-highlight">
                                                    <img src="<?php echo base_url('assets/img/icons/currency.png'); ?>">
                                                </div>
                                                <div class="p-2 bd-highlight">
                                                    <p class="text-success fw-bold mb-0" ng-bind="IncomeModel"></p>
                                                    <span class="fs-5 text-info">As on <?php echo date('Y-m-d'); ?></span> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <div class="card shadow border-warning">
                                        <div class="card-body">
                                            <h5 class="card-title text-danger">TOTAL EXPENSES</h5>
                                            <div class="d-flex flex-row bd-highlight mb-3">
                                                <div class="p-2 bd-highlight">
                                                    <img src="<?php echo base_url('assets/img/icons/expense.png'); ?>">
                                                </div>
                                                <div class="p-2 bd-highlight">
                                                    <p class="text-success fw-bold mb-0" ng-bind="ExpenseModel"></p>
                                                    <span class="fs-5 text-info">As on <?php echo date('Y-m-d'); ?></span> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <div class="card shadow border-info">
                                        <div class="card-body">
                                            <h5 class="card-title text-danger">PROFIT</h5>
                                            <div class="d-flex flex-row bd-highlight mb-3">
                                                <div class="p-2 bd-highlight">
                                                    <img src="<?php echo base_url('assets/img/icons/profit.png'); ?>">
                                                </div>
                                                <div class="p-2 bd-highlight">
                                                    <p class="text-success fw-bold mb-0" ng-bind="ProfitModel"></p>
                                                    <span class="fs-5 text-info">As on <?php echo date('Y-m-d'); ?></span> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <br>
                            <!--END OF CARDS INFORMATION -->
                            <!--GRAPHS-->    
                            <div class="row">
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                                    <div class="card border-warning shadow mb-3">
                                        <div class="card-header">
                                            <p class="fs-6 m-0"><strong>SALES & EXPENSES</strong></p>
                                        </div>
                                        
                                        <div class="card-body">
                                            <div id="chart"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                    <div class="card border-warning shadow mb-3">
                                        <div class="card-header">
                                            <p class="fs-6 m-0"><strong>MONTHLY TESTS PERFORMED</strong></p>
                                        </div>
                                        <div class="card-body">
                                            <canvas id="myChart" width="600" height="435"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--GRAPHS END-->

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="card shadow border-warning">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="fs-6 m-0"><strong>RECENT INVOICE</strong></p>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="card-body p-0">
                                            <div class="scrollbar  " id="style-7">
                                                <div class="force-overflow bg-light">
                                                    <table class="table text-center table-hover table-sm mt-3">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Date</th>
                                                                <th>Invoice Number</th>
                                                                <th>Bill Amount</th>
                                                                <th>Paid Amount</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr ng-repeat="d4 in invoices">
                                                                <td><button class="btn btn-info btn-sm shadow" type="button"><img src="<?php echo base_url("assets/img/icons/invoice4.png"); ?>"></button></td>
                                                                <td>{{d4.ReceiptDate}}</td>
                                                                <td class="text-danger text-bold" ng-bind="d4.ReceiptNo"></td>
                                                                <td class="text-green text-bold"><span ng-bind="d4.NetAmount"></span></td>
                                                                <td class="text-green text-bold"><span ng-bind="d4.PaidAmount"></span></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <div ng-show="Error3Model" class="text-center m-t-10 text-danger" ng-bind="error3"></div>
                                                    <div ng-show="Spinner3" class="text-center m-t-10"><img src="<?php echo base_url('assets/img/icons/loader.png'); ?>"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <a href="<?php echo base_url('app/patient/registration'); ?>" class="btn btn-outline-dark rounded-0"><img src="<?php echo base_url("assets/img/icons/invoice4.png"); ?>"> Create Invoice</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">

                                    <!--COMPLETED REPORTS PANEL-->
                                    <div class="card shadow border-warning">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="fs-6 m-0"><strong>TODAY EMPLOYEE STATUS</strong></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body p-0">
                                            <div class="scrollbar" id="style-7">
                                                <div class="force-overflow bg-light">
                                                    <table class="table text-center table-hover table-sm mt-3">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Name</th>
                                                                <th>Department</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr ng-repeat="d5 in attendances">
                                                                <td><button class="btn btn-info btn-sm shadow" type="button"><img src="<?php echo base_url("assets/img/icons/emp.png"); ?>"></button></td>
                                                                <td class="text-danger fs-6" ><span ng-bind="d5.FirstName"></span> <span ng-bind="d5.LastName"></span></td>
                                                                <td class="text-info fs-6"><span ng-bind="d5.Department"></span></td>
                                                                <td><span class="badge bg-danger" ng-bind="d5.Status"></span></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <div ng-show="Error4Model" class="text-center m-t-10 text-danger" ng-bind="error4"></div>
                                                    <div ng-show="Spinner4" class="text-center m-t-10"><img src="<?php echo base_url('assets/img/icons/loader.png'); ?>"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <a href="<?php echo base_url('app/employee/daily/attendance'); ?>" class="btn btn-outline-dark rounded-0"><img src="<?php echo base_url("assets/img/icons/employee.png"); ?>"> Daily Attendance</a>
                                        </div>
                                    </div>
                                    <!--END OF COMPLETED REPORT PANEL-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->load->view('Partials/FooterView'); ?>

        <!-- Begin Chart-->

        <script src="<?php echo base_url("assets/dist/Chart.bundle.js"); ?>"></script>
        <?php $this->load->view("Partials/DonutJs");?>
        
       
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <?php $this->load->view("Partials/VerticalJs");?>
        
        <!--End Chart-->

        <?php $this->load->view("Partials/AngularJs"); ?>
        <?php $this->load->view("Partials/SweetAlertJs"); ?>

        <?php $this->load->view("Partials/DashboardJs"); ?>
    </body>
</html>