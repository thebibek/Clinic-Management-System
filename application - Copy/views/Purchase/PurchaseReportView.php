<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>

    <body>
        <?php $this->load->view('Partials/NavbarView'); ?>
        <div class="container-fluid"  ng-app="PurchaseReportApp" ng-controller="PurchaseReportAppCtrl">
            <div class="card card shadow border-primary mt-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p class="fs-5 m-0">Purchase Report Manager</p>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url("app/dashboard"); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url("app/patient/registration"); ?>">Patient</a></li>
                                    <li class="breadcrumb-item active">Report</li>
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
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                                    <div class="card border-warning shadow">
                                        <div class="card-header">
                                            <button class="btn btn-success btn-sm shadow"><img src="<?php echo base_url("assets/img/icons/list2.png"); ?>"></button> <strong>Purchase Reports</strong>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label class="control-label text-danger">From Date</label>
                                                <input type="text" class="form-control border-warning bg-light" ng-model="FromDateModel" id="FromDate" readonly>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label text-danger">To Date</label>
                                                <input class="form-control border-warning bg-light" ng-model="ToDateModel" id="ToDate" readonly>
                                            </div>

                                        </div>
                                        <div class="card-footer">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <button class="btn btn-info btn-sm border-primary shadow rounded-0" ng-click="getReport()">Preview</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="card border-warning shadow" id="ReportPanel">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h4>Summary</h4>
                                                </div>
                                                <div class="col-md-6 text-end">
                                                    <button ng-click="getPdf()" class="btn btn-outline-dark rounded-0 shadow btn-sm" href="#">
                                                        <img src="<?php echo base_url("assets/img/icons/print1.png"); ?>"> Print
                                                    </button>
                                                </div>
                                            </div>
                                            <hr>
                                            <div id="ReportHtml">
                                                <br><br><br><br><br><br>
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
        <?php $this->load->view("Partials/AngularJs"); ?>
        <?php $this->load->view("Partials/SweetAlertJs"); ?>
        <?php $this->load->view("Partials/DateJs"); ?>
        <?php $this->load->view("Partials/PurchaseReportJs"); ?>
    </body>
</html>