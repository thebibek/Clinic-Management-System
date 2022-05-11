<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>

    <body>
        <?php $this->load->view('Partials/NavbarView'); ?>
        <div class="container-fluid"  ng-app="VisitApp" ng-controller="VisitAppCtrl">
            <div class="card card shadow border-primary mt-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p class="fs-5 m-0">Enter MRNo</p>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url("app/dashboard"); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Category</li>
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
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card border-warning shadow rounded-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="d-flex align-items-center ">
                                                <div class="form-group">
                                                    <input type="text" class="form-control border-warning bg-light text-danger me-2" placeholder="Enter MR No" ng-model="MRNoModel">
                                                </div>
                                                <button class="btn btn-info rounded-0 border-primary ms-2" ng-click="getPatientVisits()"><span class="glyphicon glyphicon-search"></span> Search</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mt-3 border-warning shadow">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button class="btn btn-warning btn-sm shadow "><img src="<?php echo base_url("assets/img/icons/list2.png"); ?>"></button>
                                            <strong> &nbsp;Visit Details</strong> 
                                        </div>
                                        <div class="col-md-6">
                                            <a href="<?php echo base_url("app/patient/registration"); ?>" class="btn btn-outline-dark rounded-0 float-end"><img src="<?php echo base_url('assets/img/icons/registration.png'); ?>"> Registration</a>  
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="scrollbar" id="style-7">
                                        <div class="force-overflow">
                                            <table class="table table-bordered border-warning table-striped mt-5 table-sm">
                                                <thead>
                                                    <tr class="bg-warning">
                                                        <th class="border-start-0 text-center">#</th>
                                                        <th>Patient</th>
                                                        <th>Date</th>
                                                        <th>Receipt No</th>
                                                        <th>Total Amount</th>
                                                        <th>Paid Amount</th>
                                                        <th>Amount Due</th>
                                                        <th class="border-end-0">Report Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr ng-repeat="d1 in visits" ng-cloak="">
                                                        <td class="border-start-0 text-center"><button class="btn btn-success btn-sm"><img src="<?php echo base_url("assets/img/icons/patient2.png"); ?>"></button></td>
                                                        <td class="fw-bold text-primary">{{d1.FirstName}} {{d1.LastName}}</td>
                                                        <td>{{d1.ReceiptDate}}</td>
                                                        <td class="fw-bold text-danger">{{d1.ReceiptNo}}</td>
                                                        <td>{{d1.TotalAmount}}</td>
                                                        <td>{{d1.PaidAmount}}</td>
                                                        <td>{{d1.DueAmount}}</td>
                                                        <td ng-if="d1.IsReportGenerated == 0" class="border-end-0"><span class="badge bg-danger">No</span></td>
                                                        <td ng-if="d1.IsReportGenerated == 1" class="border-end-0"><span class="badge bg-success">Yes</span></td>
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
        <?php $this->load->view("Partials/VisitJs"); ?>
    </body>
</html>