<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>

    <body>
        <?php $this->load->view('Partials/NavbarView'); ?>
        <div class="container-fluid"  ng-app="SearchReportApp" ng-controller="SearchReportAppCtrl">
            <div class="card card shadow border-primary mt-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card border-warning shadow mt-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                            <div class="form-group">
                                                <label class="control-label text-red">Enter MRNo</label>
                                                <input type="text" class="form-control border-warning bg-light text-danger " placeholder="Enter MR No" ng-model="MRNoModel">
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                            <button class="btn btn-info border-primary shadow mt-4" ng-click="getReports()"><span class="glyphicon glyphicon-search"></span> Search</button>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-right">
                                            <?php $this->load->view("Partials/IconBarsView"); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card border-warning shadow p-0">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button class="btn btn-warning btn-sm"><img src="<?php echo base_url("assets/img/icons/report7.png"); ?>"></button><strong> &nbsp;&nbsp; Reports</strong>
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <a class="btn btn-outline-dark rounded-0 btn-sm fs-6" href="<?php echo base_url("app/report"); ?>"><img src="<?php echo base_url("assets/img/icons/add.png"); ?>">Create Report</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body" >
                                    <table  class="table table-bordered border-warning table-striped mt-5 table-sm">
                                        <thead class="bg-warning text-white">
                                            <tr>
                                                <th class="border-start-0 text-center">#</th>
                                                <th>ReportNo</th>
                                                <th>MRNo</th>
                                                <th>Date</th>
                                                <th>Patient Name</th>
                                                <th>Report Status</th>
                                                <th class="border-end-0">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="d1 in reports">
                                                <td class="border-start-0 text-center"><button class="btn btn-success btn-sm"><img src="<?php echo base_url("assets/img/icons/report5.png"); ?>"></button></td>
                                                <td class="text-green text-bold">{{d1.ReceiptNo}}</td>
                                                <td class="text-danger text-bold">{{d1.MRNo}}</td>
                                                <td>{{d1.ReceiptDate}}</td>
                                                <td>{{d1.FirstName}} {{d1.LastName}}</td>
                                                <td ng-if="d1.IsReportGenerated == 1"><span class="badge bg-success">Completed</span></td>
                                                <td ng-if="d1.IsReportGenerated == 0"><span class="badge bg-danger">Not Completed</span></td>
                                                <td class="border-end-0">
                                                    <?php
                                                    if ($this->aauth->is_allowed('PrintReport')) {
                                                        ?>
                                                        <a ng-if="d1.IsReportGenerated == 0"></a>
                                                        <a ng-if="d1.IsReportGenerated == 1" href="<?php echo base_url("app/print/report/"); ?>{{d1.ReceiptNo}}" target="_blank" title="Print Report" ><img src="<?php echo base_url("assets/img/print.png"); ?>"></a> 
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <a href="#"><img src="<?php echo base_url("assets/img/prohibit.png"); ?>"></a>
                                                        <?php
                                                    }
                                                    ?>

                                                    <?php
                                                    if ($this->aauth->is_allowed('Edit')) {
                                                        ?>
                                                        <a href="<?php echo base_url("app/report/pending/"); ?>{{d1.ReceiptNo}}" title="Edit" ><img src="<?php echo base_url("assets/img/edit.png"); ?>"></a>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <a href="#" title="Edit" ><img src="<?php echo base_url("assets/img/prohibit.png"); ?>"></a>
                                                        <?php
                                                    }
                                                    ?>    
                                                </td>
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


        <?php $this->load->view("Partials/FooterView"); ?>
        <?php $this->load->view("Partials/TestJs"); ?>
        <?php $this->load->view("Partials/JqueryUI"); ?>
        <?php $this->load->view("Partials/AngularJs"); ?>
        <?php $this->load->view("Partials/SweetAlertJs"); ?>
        <?php $this->load->view("Partials/SearchReportJs"); ?>
    </body>
</html>