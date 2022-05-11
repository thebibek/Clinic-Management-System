<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>

    <body>
        <?php $this->load->view('Partials/NavbarView'); ?>
        <div class="container-fluid"  ng-app="DoctorReportApp" ng-controller="DoctorReportAppCtrl">
            <div class="card card shadow border-primary mt-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p class="fs-5 m-0">Report Manager</p>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url("app/doctor"); ?>">Doctor</a></li>
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
                                            <button class="btn btn-success btn-sm shadow"><img src="<?php echo base_url("assets/img/icons/list2.png"); ?>"></button> <strong>Summary Reports</strong>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label class="control-label text-red">Report</label>
                                                <select class="form-select input-sm" ng-model="ReportModel">
                                                    <option value="">Please select report</option>
                                                    <option value="1">Monthly commission</option>
                                                    <option value="2">Month wise doctor commission </option>
                                                    <option value="3">Date wise doctor commission </option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label text-red">Select Month</label>
                                                <select class="form-select input-sm" ng-model="MonthModel">
                                                    <option value="">Select month</option>
                                                    <option value="1">January</option>
                                                    <option value="2">Frebruary</option>
                                                    <option value="3">March</option>
                                                    <option value="4">April</option>
                                                    <option value="5">May</option>
                                                    <option value="6">June</option>
                                                    <option value="7">July</option>
                                                    <option value="8">August</option>
                                                    <option value="9">September</option>
                                                    <option value="10">October</option>
                                                    <option value="11">November</option>
                                                    <option value="12">December</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label text-red">Select Date</label>
                                                <input class="form-control input-sm" ng-model="DateModel" placeholder="Select date  "  id="ReportDate">
                                            </div>

                                        </div>
                                        <div class="card-footer">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <button class="btn btn-danger  text-white btn-sm" ng-click="getReport()">Preview</button>
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
                                            <div class="row g-2">
                                                <div class="col-md-6">
                                                    <h4> Summary</h4>
                                                </div>
                                                <div class="col-md-6">
                                                    <button ng-click="getPdf()" class="btn btn-outline-dark rounded-0 btn-sm float-end" href="#">
                                                        <img src="<?php echo base_url("assets/img/icons/print1.png"); ?>"> Print
                                                    </button>
                                                </div>
                                            </div>

                                            <hr>

                                            <div id="ReportHtml"></div>
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
        <?php $this->load->view("Partials/DoctorReportJs"); ?>

    </body>
</html>