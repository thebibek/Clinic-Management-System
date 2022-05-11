<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>

    <body>
        <?php $this->load->view('Partials/NavbarView'); ?>
        <div class="container-fluid"  ng-app="PatientReportApp" ng-controller="PatientReportAppCtrl">
            <div class="card card shadow border-primary mt-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p class="fs-5 m-0">Report Manager</p>
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
                                    <div class="card border-warning shadow panel-default">
                                        <div class="card-header">
                                            <button class="btn btn-success btn-sm shadow"><img src="<?php echo base_url("assets/img/icons/list2.png"); ?>"></button> <strong>Summary Reports</strong>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label class="control-label text-danger">Report</label>
                                                <select class="form-select bg-light border-warning" ng-model="ReportModel">
                                                    <option value="">Please select report</option>
                                                    <option value="1">Monthly Collection</option>
                                                    <option value="2">Date wise collection</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label text-danger">Select Month</label>
                                                <select class="form-select bg-light border-warning" ng-model="MonthModel">
                                                    <option value="">Please Select Month</option>
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
                                                <label class="control-label text-danger">Select Date</label>
                                                <input class="form-control bg-light border-warning" placeholder="Enter Date" readonly="" ng-model="DateModel" id="Date">
                                            </div>

                                        </div>
                                        <div class="card-footer">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <button class="btn btn-info border-primary rounded-0 text-white btn-sm" ng-click="getReport()">Preview</button>
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
                                                    <h4> Summary</h4>
                                                </div>
                                                <div class="col-md-6 text-end">
                                                    <button ng-click="getPdf()" class="btn btn-outline-dark btn-sm rounded-0" href="#">
                                                        <img src="<?php echo base_url("assets/img/icons/print1.png"); ?>"> Print
                                                    </button>
                                                </div>
                                            </div>
                                            <hr>
                                            <div id="ReportHtml">
                                                <span class="text-danger">No records found</span>
                                                <br><br><br><br><br><br><br><br><br>
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
        <?php $this->load->view("Partials/BillReportJs"); ?>
    </body>
</html>