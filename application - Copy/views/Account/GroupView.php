<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>

    <body>
        <?php $this->load->view('Partials/NavbarView'); ?>
        <div class="container-fluid"  ng-app="GroupApp" ng-controller="GroupAppCtrl">
            <div class="card card shadow border-primary mt-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p class="fs-5 m-0">Group Manager</p>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url("app/dashboard"); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Group</li>
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
                        <div class="col-md-12">
                            <div class="card border-warning shadow" ng-show="ListPanel">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button class="btn btn-warning btn-sm shadow"><img src="<?php echo base_url("assets/img/icons/ledger2.png"); ?>"></button>
                                            <strong> Manage Group</strong> 
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <button class="btn btn-outline-dark rounded-0 btn-sm fs-6" ng-click="showAddPanel()" type="button"><img src="<?php echo base_url("assets/img/icons/add.png"); ?>"> Add Group</button>  
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="scrollbar" id="style-7">
                                        <div class="force-overflow">
                                            <table class="table table-bordered border-warning table-striped mt-5 table-sm">
                                                <thead class="bg-warning">
                                                    <tr >
                                                        <th class="border-start-0 text-center">#</th>
                                                        <th>Group</th>
                                                        <th>Description</th>
                                                        <th>Status</th>
                                                        <th class="border-end-0">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr ng-repeat="d1 in groups" ng-cloak="">
                                                        <td class="border-start-0 text-center"><button class="btn btn-success btn-sm shadow"><img src="<?php echo base_url("assets/img/icons/ledger1.png"); ?>"></button></td>
                                                        <td>{{d1.UnderGroup}}</td>
                                                        <td>{{d1.Description}}</td>
                                                        <td ng-if="d1.IsActive == 1"><span class="badge bg-success">Active</span></td>
                                                        <td ng-if="d1.IsActive == 0"><span class="badge bg-danger">Inactive</span></td>
                                                        <td class="border-end-0">
                                                            <?php
                                                            if ($this->aauth->is_allowed('Delete')) {
                                                                ?>
                                                                <a href="#" ng-click="deleteGroup(d1.ID)"><img src="<?php echo base_url("assets/img/delete.png"); ?>"></a>
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
                                                                <a href="#" ng-click="editGroup(d1.ID)"><img src="<?php echo base_url("assets/img/edit.png"); ?>"></a>
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card border-warning shadow" ng-show="AddPanel">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button class="btn btn-warning btn-sm shadow"><img src="<?php echo base_url("assets/img/icons/category1.png"); ?>"></button>
                                            <strong> &nbsp;Add New Group</strong>
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <button ng-click="reset()" class="btn btn-outline-dark rounded-0 btn-sm" type="button"><img src="<?php echo base_url("assets/img/icons/close1.png"); ?>"></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" >
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label"><strong>Group</strong><span class="text-danger">*</span></label>
                                                <input class="form-control border-warning" type="text" name="Group" ng-model="GroupModel" placeholder="Enter Group">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label"><strong>Description</strong></label>
                                                <input class="form-control border-warning" type="text" name="Description" ng-model="DescriptionModel" placeholder="Enter Description">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="checkbox" class="checkbox-control" ng-model="ActiveModel" ng-true-value="'1'" ng-false-value="'0'">
                                                <p class="inline-control fw-bold"> Is Active</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-primary" ng-click="saveGroup()" ng-show="SaveBtn" type="button"><span class="icon-save"></span> Save</button>
                                    <button class="btn btn-warning" ng-click="updateGroup()" ng-show="UpdateBtn" type="button"><span class="icon-save"></span> Update</button>
                                    <a href="<?php echo base_url('app/ledger/under/group'); ?>" class="btn btn-danger"><span class="icon-update"></span> Close</a>
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
        <?php $this->load->view("Partials/GroupJs"); ?>
    </body>
</html>