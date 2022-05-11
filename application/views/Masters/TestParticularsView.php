<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>

    <body>
        <?php $this->load->view('Partials/NavbarView'); ?>
        <div class="container-fluid" ng-app="TestApp" ng-controller="TestAppCtrl">
            <div class="card card shadow border-primary mt-3">
                <div class="card-header">
                    <div class="row gutter">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p class="fs-5 m-0">Test Particulars</p>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item" aria-current="page">Test</li>
                                    <li class="breadcrumb-item">Test Particulars</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <?php $this->load->view("Partials/IconBarsView"); ?>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div class="card shadow border-warning">
                        <div class="card-header">
                            <button class="btn btn-danger btn-sm" type="button">
                                <img src="<?php echo base_url("assets/img/icons/add2.png"); ?>">
                            </button>
                            <strong> &nbsp;&nbsp;Add Test Particulars</strong>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card shadow">
                                        <div class="card-header">
                                            <button class="btn btn-warning btn-sm" type="button">
                                                <img src="<?php echo base_url("assets/img/icons/list2.png"); ?>">
                                            </button>
                                            <strong> &nbsp;&nbsp;Select Test</strong>
                                        </div>
                                        <div class="card-body p-0 ">
                                            <div class="scrollbar" id="style-7">
                                                <div class="force-overflow">
                                                    <table class="table table-bordered border-warning table-striped mt-5 table-sm">
                                                        <thead class="bg-warning">
                                                            <tr>
                                                                <th class="border-start-0 text-center">#</th>
                                                                <th>TestNo</th>
                                                                <th class="border-end-0">Description</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $count = 1;
                                                            if (isset($tests)) {
                                                                if (!empty($tests)) {
                                                                    foreach ($tests as $test) {
                                                                        ?>

                                                                        <tr class="test-row" data-id="<?php echo $test['ID']; ?>" data-description="<?php echo $test['Description']; ?>" data-heading="<?php echo $test['ReportHeading']; ?>">
                                                                            <td class="border-start-0 text-center">
                                                                                <button class="btn btn-success btn-sm"><img src="<?php echo base_url("assets/img/icons/test.png"); ?>"></button>

                                                                            </td>
                                                                            <td><?php echo $test['ID']; ?></td>
                                                                            <td class="border-end-0"><?php echo $test['Description']; ?></td>
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
                                        <div class="card-footer">
                                            <a href="<?php echo base_url("app/test"); ?>" class="btn btn-info border-primary rounded-0 btn-sm float-end shadow"><img src="<?php echo base_url("assets/img/icons/add1.png"); ?>"> Add New Test</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="card shadow border-warning" ng-cloak="">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="control-label"><strong>Test No</strong></label>
                                                        <input class="form-control input-sm" id="testNo" type="text" ng-model="TestNoModel" value=""  placeholder="Enter Test No">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="control-label">Test Description</label>
                                                    <div class="form-group no-margin">
                                                        <input class="form-control input-sm" id="TestDescription" type="text"  placeholder="Description" >
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Report Heading</label>
                                                        <input class="form-control input-sm" type="text" id="ReportHeading"  placeholder="Report Heading">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mt-4">
                                                        <a href="javascript:void(0)" ng-click="fetchTestParticulars()" class="btn btn-info  btn-sm btn-sm border-primary rounded-0"><img src="<?php echo base_url("assets/img/icons/search.png"); ?>"> Search</a>
                                                        <a href="<?php echo base_url("app/test/particulars"); ?>" class="btn btn-outline-dark btn-sm rounded-0" ><img src="<?php echo base_url("assets/img/icons/reset.png"); ?>" title="reset"></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button ng-show="AddParticularsBtn"  class="btn btn-danger btn-sm float-end" ng-click="showTestParticularsPanel()">Add Test Particulars</button>
                                        </div>
                                    </div>
                                    <div class="card shadow border-warning mt-3" ng-show="TestParticularsPanel" ng-cloak="">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <button class="btn btn-primary btn-sm" type="button">
                                                        <img src="<?php echo base_url("assets/img/icons/test2.png"); ?>">
                                                    </button>
                                                    <strong> &nbsp;&nbsp;Add Test Particulars To Test</strong>
                                                </div>
                                                <div class="col-md-6">
                                                    <a href="<?php echo base_url('app/test/particulars'); ?>" class="btn btn-outline-dark btn-sm float-end"><img src="<?php echo base_url("assets/img/icons/close1.png"); ?>"></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="control-label">Test Particulars</label>
                                                        <input class="form-control input-sm" type="text" ng-model="TestParticularsModel" placeholder="Enter Particulars">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="control-label">Units</label>
                                                        <input class="form-control input-sm" type="text" ng-model="UnitsModel" placeholder="Enter Units">
                                                    </div>  
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="control-label">Male Value</label>
                                                        <input class="form-control input-sm" type="text" ng-model="MaleValueModel" placeholder="Enter Male Value">
                                                    </div>  
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">	
                                                        <label class="control-label">Female Value</label>
                                                        <input class="form-control input-sm" type="text" ng-model="FemaleValueModel" placeholder="Enter Female Value ">
                                                    </div>  
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="control-label">Part Heading</label>
                                                        <input class="form-control input-sm" type="text" ng-model="PartHeadingModel" placeholder="Enter Part Heading">
                                                    </div>  
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="checkbox" class="checkbox-control" id="" ng-model="ActiveModel" ng-true-value="'1'" ng-false-value="'0'">  <p class="inline-control text-bold">IsActive</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <a class="btn btn-success btn-sm" ng-show="SaveBtn" ng-click="saveTestParticulars()">+ Add</a>
                                                    <a class="btn btn-success btn-sm" ng-show="UpdateBtn" ng-click="updateTestParticulars()">+ Update</a>
                                                    <a class="btn btn-danger btn-sm" href="<?php echo base_url('app/test/particulars'); ?>">Close</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card shadow border-warning mt-3">
                                        <div class="card-header">
                                            <button class="btn btn-primary btn-sm" type="button"><img src="<?php echo base_url("assets/img/icons/test2.png"); ?>"></button><strong> &nbsp;&nbsp;Test Particulars</strong>
                                        </div>
                                        <div class="card-body pad-0">
                                            <div class="scrollbar" id="style-7">
                                                <div class="force-overflow">
                                                    <table  class="table table-bordered border-warning table-striped table-sm">
                                                        <thead class="bg-warning">
                                                            <tr>
                                                                <th class="border-start-0 text-center">#</th>
                                                                <th>Test No</th>
                                                                <th>Test Particulars</th>
                                                                <th>Units</th>
                                                                <th>Male Value</th>
                                                                <th>Female Value</th>
                                                                <th>Part Heading</th>
                                                                <th class="border-end-0">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr ng-repeat="d1 in particulars">
                                                                <td class="border-start-0 text-center"><button class="btn btn-info btn-sm"><img src="<?php echo base_url("assets/img/icons/test3.png"); ?>"></button></td>
                                                                <td>{{d1.TestID}}</td>
                                                                <td>{{d1.TestParticulars}}</td>
                                                                <td>{{d1.Units}}</td>
                                                                <td>{{d1.MaleValue}}</td>
                                                                <td>{{d1.FemaleValue}}</td>
                                                                <td>{{d1.PartHeading}}</td>
                                                                <td class="border-end-0">
                                                                    <?php
                                                                    if ($this->aauth->is_allowed('Delete')) {
                                                                        ?>
                                                                        <a href="#" ng-click="deleteParticulars(d1.ID)"><img src="<?php echo base_url("assets/img/delete.png"); ?>"></a>
                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <a href="#"><img src="<?php echo base_url("assets/img/delete2.png"); ?>"></a>
                                                                        <?php
                                                                    }
                                                                    ?>

                                                                    <?php
                                                                    if ($this->aauth->is_allowed('Edit')) {
                                                                        ?>
                                                                        <a href="#" ng-click="editParticulars(d1.ID)"><img src="<?php echo base_url("assets/img/edit.png"); ?>"></a>
                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <a href="#"><img src="<?php echo base_url("assets/img/prohibit.png"); ?>"></a>
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
                    </div>
                </div>
            </div>
        </div>

        <?php $this->load->view("Partials/FooterView"); ?>
        <?php $this->load->view("Partials/TestJs"); ?>
        <?php $this->load->view("Partials/JqueryUI"); ?>
        <?php $this->load->view("Partials/AngularJs"); ?>
        <?php $this->load->view("Partials/SweetAlertJs"); ?>
        <?php $this->load->view("Partials/TestParticularsJs"); ?>
    </body>
</html>