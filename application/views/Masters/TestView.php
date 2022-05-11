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
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p class="fs-5 m-0">Pathology Test Manager</p>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Pathology Test</li>
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
                            <div class="card border-warning shadow" ng-show="TestListingPanel" >
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button class="btn btn-warning btn-hd"><img src="<?php echo base_url("assets/img/icons/list.png"); ?>"></button>
                                            <strong> &nbsp;Pathology Test</strong>
                                        </div>
                                        <div class="col-md-6">
                                            <a class="btn btn-outline-dark rounded-0 btn-sm float-end" href="" target="_blank"><img src="<?php echo base_url("assets/img/icons/print1.png"); ?>"> Print</a>
                                            <button class="btn btn-outline-dark rounded-0  btn-sm float-end" ng-show="AddTestBtn" ng-click="addTest()"><img src="<?php echo base_url("assets/img/icons/add2.png"); ?>"> Add New Test</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="scrollbar" id="style-7">
                                        <div class="force-overflow">
                                            <table class="table table-bordered border-warning table-striped mt-5 table-sm">
                                                <thead class="bg-warning">
                                                    <tr>
                                                        <th class="border-start-0 text-center">#</th>
                                                        <th>Test No</th>
                                                        <th>Description</th>
                                                        <th>Report Heading</th>
                                                        <th>Charges</th>
                                                        <th>Carry Out</th>
                                                        <th>Report Delivery</th>
                                                        <th>Type</th>
                                                        <th>Status</th>
                                                        <th class="border-end-0">Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php
                                                    $count = 1;
                                                    if (isset($tests)) {
                                                        if (!empty($tests)) {
                                                            foreach ($tests as $test) {
                                                                ?>
                                                                <tr>
                                                                    <td class="border-start-0 text-center">
                                                                        <button class="btn btn-info btn-sm">
                                                                            <img src="<?php echo base_url("assets/img/icons/test.png"); ?>">
                                                                        </button>
                                                                    </td>
                                                                    <td><?php echo $test['ID']; ?></td>
                                                                    <td class="text-danger text-bold"><?php echo $test['Description']; ?></td>
                                                                    <td><?php echo $test['ReportHeading']; ?></td>
                                                                    <td class="text-green text-bold"><?php echo $test['Charge']; ?></td>
                                                                    <td><?php echo $test['CarryOut']; ?></td>
                                                                    <td><?php echo $test['ReportTiming']; ?></td>
                                                                    <td><?php echo ($test['TypeID'] == 1) ? 'Routine' : 'Special'; ?></td>
                                                                    <td><?php echo ($test['IsActive'] == 1 ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>'); ?></td>
                                                                    <td class="border-end-0">
                                                                        <?php
                                                                        if ($this->aauth->is_allowed('Delete')) {
                                                                            ?>
                                                                            <a href="#" ng-click="deleteTest(<?php echo $test['ID']; ?>)"><img src="<?php echo base_url("assets/img/delete.png"); ?>"></a>
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
                                                                            <a href="#" ng-click="editTest(<?php echo $test['ID']; ?>)"><img src="<?php echo base_url("assets/img/edit.png"); ?>"></a>
                                                                            <?php
                                                                        } else {
                                                                            ?>
                                                                            <a href="#"><img src="<?php echo base_url("assets/img/prohibit.png"); ?>"></a>
                                                                            <?php
                                                                        }
                                                                        ?>    
                                                                    </td>
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
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card shadow border-warning" ng-show="TestPanel">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button class="btn btn-warning btn-sm"><img src="<?php echo base_url("assets/img/icons/add2.png"); ?>"></button>
                                            <strong> &nbsp;Add New Test</strong>
                                        </div>
                                        <div class="col-md-6">
                                            <button class="btn btn-outline-dark rounded-0  btn-sm float-end" ng-click="reset()"><img src="<?php echo base_url("assets/img/icons/list1.png"); ?>"> Test List</button>
                                            <button ng-click="reset()" class="btn btn-outline-dark rounded-0 btn-sm float-end" type="button"><img src="<?php echo base_url("assets/img/icons/close1.png"); ?>"></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label"><strong>Description</strong></label>
                                                <input class="form-control input-sm" type="text" ng-model="DescriptionModel" placeholder="Enter Description">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class=""><strong>Category</strong></label>
                                            <div class="form-group no-margin">
                                                <select class="form-select input-sm" ng-model="CategoryModel">
                                                    <option value="">Select Category</option>
                                                    <option ng-repeat="d1 in categories" value="{{d1.ID}}">{{d1.Category}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label"><strong>Report Head</strong></label>
                                                <input class="form-control input-sm" type="text" ng-model="ReportHeadModel" placeholder="Enter Report Head">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label"><strong>Charges</strong></label>
                                                <input class="form-control input-sm" type="text" ng-model="ChargeModel" placeholder="Enter Amount">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label"><strong>Carry Out</strong></label>
                                                <input class="form-control input-sm" type="text" ng-model="CarryOutModel" placeholder="Enter Carry Out Ex. Everyday,Weekly">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label"><strong>Report Delivery</strong></label>
                                                <input class="form-control input-sm" type="text" ng-model="ReportDeliveryModel" placeholder="Enter Report Delivery Ex.After 1 day,Same day ">
                                            </div>  
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class=""><strong>Type</strong></label>
                                            <div class="form-group">
                                                <select class="form-select input-sm" ng-model="TypeModel">
                                                    <option value="">Select Type</option>
                                                    <option value="1">Routine</option>
                                                    <option value="2">Special</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="checkbox">
                                                <input type="checkbox" class="" id="" ng-model="ActiveModel" ng-true-value="'1'" ng-false-value="'0'">
                                                <i class="form-control-feedback fa fa-check" data-bv-icon-for="acceptTerms" style="top: 0px;"></i> 
                                                Is Active
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group has-feedback"><label class="control-label"><strong>Remarks</strong></label>
                                                <textarea class="form-control" name="remarks" rows="5" ng-model="RemarksModel"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="demo-btn-group right-text">
                                                <button class="btn btn-primary shadow" ng-show="SaveBtn" ng-click="saveTest()" type="button"> Save</button>
                                                <button class="btn btn-warning shadow" ng-show="UpdateBtn" ng-click="updateTest()" type="button"> Update</button> 										

                                                <a href="<?php echo base_url("app/test"); ?>" class="btn btn-danger shadow"> Close</a> 
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
        <?php $this->load->view("Partials/TestViewJs"); ?>
    </body>
</html>