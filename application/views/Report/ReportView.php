<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>

    <body>
        <?php $this->load->view('Partials/NavbarView'); ?>
        <div class="container-fluid" ng-app="ReportApp" ng-controller="ReportAppCtrl">
            <div class="card card shadow border-primary mt-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p class="fs-5 m-0">Pathology Report</p>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url("app/report"); ?>">Pathology</a></li>
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
                    <div class="row g-2">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="card border-warning shadow mb-3">
                                <div class="card-body">
                                    <div class="row g-1">
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                            <div class="form-group">
                                                <label class="control-label text-danger" >Enter Receipt No.</label>
                                                <input type="text" class="form-control text-danger bg-light rounded-0 border-warning" ng-model="ReceiptNoModel" placeholder="Enter Receipt No">
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                            <button class="btn btn-info border-primary shadow mt-4 rounded-0" ng-click="getTests()" type="button">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card border-warning shadow">
                                <div class="card-header">
                                    <button class="btn btn-success btn-sm shadow"><img src="<?php echo base_url("assets/img/icons/patient2.png"); ?>"></button><strong> Patient Information</strong>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="MRNo" class="control-label">MRNo</label>
                                                <input type="text" class="form-control border-warning bg-light text-danger" ng-model="MRNoModel"  placeholder="MRNo" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="PatientName" class="control-label">Patient Name</label>
                                                <input type="text" class="form-control border-warning bg-light" ng-model="PatientNameModel"  placeholder="Patient Name" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="ContactNo" class="control-label">Contact No</label>
                                                <input type="text" class="form-control border-warning bg-light" ng-model="ContactNoModel"   placeholder="Contact No" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="DueAmount" class="control-label">Due Amount</label>
                                                <input type="text" class="form-control border-warning bg-light" ng-model="DueAmountModel"   placeholder="Due Amount" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="card border-warning shadow mb-3">
                                <div class="card-header">
                                    <button class="btn btn-warning btn-sm" type="button">
                                        <img src="<?php echo base_url("assets/img/icons/test3.png"); ?>">
                                    </button>
                                    <strong> &nbsp;&nbsp; Select Test To Make Report</strong>
                                </div>
                                <div class="card-body p-0">
                                    <div class="scrollbar1" id="style-7">
                                        <div class="force-overflow">
                                            <table class="table table-bordered border-warning table-striped table-sm">
                                                <thead class="bg-warning">
                                                    <tr>
                                                        <th class="border-start-0 text-center">#</th>
                                                        <th>Test No</th>
                                                        <th>Test Description</th>
                                                        <th class="border-end-0">ReportMade</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="TestListing">
                                                    <tr  ng-repeat="t in tests" >
                                                        <td class="border-start-0 text-center">#</td>
                                                        <td ng-bind="t.TestNo"></td>
                                                        <td class="Test" ng-click="getTestParticulars(t.TestNo, t.CategoryID)" ng-bind="t.TestDescription"></td>
                                                        <td ng-if="t.IsReportMade == 1" class="border-end-0"><input ng-model="ReportMadeModel" type="checkbox" ng-init="ReportMadeModel = t.IsReportMade" ng-checked="{{t.IsReportMade}}" ng-true-value="'1'" ng-false-value="'0'"></td>
                                                        <td ng-if="t.IsReportMade == 0" class="border-end-0"><input ng-model="ReportMadeModel" type="checkbox" ng-init="ReportMadeModel = t.IsReportMade" ng-checked="{{t.IsReportMade}}" ng-true-value="'1'" ng-false-value="'0'"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>   
                                </div>
                            </div>

                            <div class="card border-warning shadow">
                                <div class="card-header">
                                    <button class="btn btn-danger btn-sm" type="button">
                                        <img src="<?php echo base_url("assets/img/icons/list2.png"); ?>">
                                    </button>
                                    <strong> &nbsp;&nbsp; Enter Test Results</strong>
                                </div>
                                <div class="card-body p-0">
                                    <div class="scrollbar" id="style-7">
                                        <div class="force-overflow">
                                            <table class="table table-bordered border-warning table-striped table-sm">
                                                <thead class="bg-warning">
                                                    <tr class="f-s-12">
                                                        <th ng-hide="true">#</th>
                                                        <th class="border-start-0 text-center">Test No</th>
                                                        <th>Particulars</th>
                                                        <th>Result</th>
                                                        <th>Unit</th>
                                                        <th>Normal Range</th>
                                                        <th class="border-end-0">Abnormal</th>
                                                    </tr>
                                                </thead>
                                                <tbody ng-cloak="">
                                                    <tr ng-repeat="(key, value) in particulars">
                                                        <td ng-hide="true" ng-model="ResultModel[key]['ParticularsID']" ng-init="ResultModel[key]['ParticularsID'] = value.ParticularsID" class="border-start-0 text-center">{{value.ParticularsID}}</td>
                                                        <td ng-model="ResultModel[key]['TestID']" ng-init="ResultModel[key]['TestID'] = value.TestID">{{value.TestID}}</td>
                                                        <td ng-model="ResultModel[key]['TestParticulars']" ng-init="ResultModel[key]['TestParticulars'] = value.TestParticulars">{{value.TestParticulars}}</td>
                                                        <td>
                                                            <input type="text" ng-if="value.IsAbnormal == 1" style="background-color: red;color:#fff" class="form-control border-warning rounded-0" ng-model="ResultModel[key]['Result']" ng-init="ResultModel[key]['Result'] = value.Result">
                                                            <input type="text" ng-if="value.IsAbnormal == 0" class="form-control border-warning rounded-0" ng-model="ResultModel[key]['Result']" ng-init="ResultModel[key]['Result'] = value.Result">
                                                        </td>
                                                        <td ng-model="ResultModel[key]['Units']" ng-init="ResultModel[key]['Units'] = value.Units">{{value.Units}}</td>
                                                        <td ng-if="value.Gender == 1" ng-model="ResultModel[key]['NormalValue']" ng-init="ResultModel[key]['NormalValue'] = value.MaleValue">{{value.MaleValue}}</td>
                                                        <td ng-if="value.Gender == 2" ng-model="ResultModel[key]['NormalValue']" ng-init="ResultModel[key]['NormalValue'] = value.FemaleValue">{{value.FemaleValue}}</td>
                                                        <td class="border-end-0"><input ng-model="ResultModel[key]['IsAbnormal']" type="checkbox" ng-init="ResultModel[key]['IsAbnormal'] = value.IsAbnormal" ng-checked="{{value.IsAbnormal}}" ng-true-value="'1'" ng-false-value="'0'"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>   
                                </div>
                                <div class="card-footer text-center">
                                    <a href="<?php echo base_url('app/receipt'); ?>" class="btn btn-dark rounded-0">New</a> 
                                    <a href="javascript:void(0)" ng-click="savePathoResult()"   class="btn btn-success rounded-0">Save</a> 
                                    <a href="<?php echo base_url("app/report"); ?>" class="btn btn-danger rounded-0">Close</a> 
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="card border-warning shadow">
                                <div class="card-header">
                                    <button class="btn btn-success btn-sm shadow" type="button">
                                        <img src="<?php echo base_url("assets/img/icons/list2.png"); ?>">
                                    </button>
                                    <strong> &nbsp;&nbsp; Pending Reports</strong>
                                </div>
                                <div class="card-body p-0">
                                    <div class="scrollbar" id="style-7">
                                        <div class="force-overflow">
                                            <table class="table table-bordered border-primary table-striped table-sm">
                                                <thead class="bg-primary">
                                                    <tr>
                                                        <th class="border-start-0 text-center">#</th>
                                                        <th>ReceiptNo</th>
                                                        <th class="border-end-0">Patient Name</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $count = 1;
                                                    if (isset($pendingReports)) {
                                                        if (!empty($pendingReports)) {
                                                            foreach ($pendingReports as $pr) {
                                                                ?>
                                                                <tr class="test-row" ng-click="generateReport(<?php echo $pr['ReceiptNo']; ?>)">
                                                                    <td class="border-start-0 text-center">
                                                                        <?php echo $count; ?>
                                                                    </td>
                                                                    <td><?php echo $pr['ReceiptNo']; ?></td>
                                                                    <td class="border-end-0"><?php echo $pr['FirstName'] . " " . $pr['LastName']; ?></td>

                                                                </tr>
                                                                <?php
                                                                $count++;
                                                            }
                                                        }
                                                    }
                                                    ?>
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
        <?php $this->load->view("Partials/ReportJs"); ?>
    </body>
</html>