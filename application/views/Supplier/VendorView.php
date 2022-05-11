<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>

    <body>
        <?php $this->load->view('Partials/NavbarView'); ?>
        <div class="container-fluid"  ng-app="VendorApp" ng-controller="VendorAppCtrl">
            <div class="card card shadow border-primary mt-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p class="fs-5 m-0">Vendor Manager</p>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url("app/dashboard"); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('app/item/vendor'); ?>">Vendor</a></li>
                                    <li class="breadcrumb-item active">Vendor</li>
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
                                            <button class="btn btn-danger btn-sm"><img src="<?php echo base_url("assets/img/icons/supplier1.png"); ?>"></button>
                                            <strong> Manage Vendor</strong> 
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <button class="btn btn-outline-dark shadow rounded-0 fs-6 btn-sm" ng-click="showAddPanel()" type="button"><img src="<?php echo base_url("assets/img/icons/add2.png"); ?>"> Add Vendor</button>  
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
                                                        <th>Vendor</th>
                                                        <th>Address</th>
                                                        <th>Contact No</th>
                                                        <th>Status</th>
                                                        <th class="border-end-0">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr ng-repeat="d1 in vendors" ng-cloak>
                                                        <td class="border-start-0 text-center">
                                                            <button class="btn btn-danger btn-sm shadow">
                                                                <img src="<?php echo base_url("assets/img/icons/supplier1.png"); ?>">
                                                            </button>
                                                        </td>
                                                        <td>{{d1.Vendor}}</td>
                                                        <td>{{d1.Address}}</td>
                                                        <td>{{d1.ContactNo}}</td>
                                                        <td ng-if="d1.IsActive == 1"><span class="badge bg-success">Active</span></td>
                                                        <td ng-if="d1.IsActive == 0"><span class="badge bg-danger">InActive</span></td>
                                                        <td class="border-end-0">
                                                            <?php
                                                            if ($this->aauth->is_admin() || $this->aauth->is_allowed('Delete')) {
                                                                ?>
                                                                <a href="#" ng-click="deleteVendor(d1.ID)"><img src="<?php echo base_url("assets/img/delete.png"); ?>"></a>
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
                                                                <a href="#" ng-click="editVendor(d1.ID)"><img src="<?php echo base_url("assets/img/edit.png"); ?>"></a>
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
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                            <div class="card border-warning shadow" ng-show="AddPanel">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button class="btn btn-warning btn-sm shadow"><img src="<?php echo base_url("assets/img/icons/add2.png"); ?>"></button>
                                            <strong> &nbsp;Add Vendor</strong>
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <button ng-click="reset()" class="btn btn-outline-dark shadow fs-6 rounded-0 bg-white btn-sm" type="button"><img src="<?php echo base_url("assets/img/icons/close1.png"); ?>"></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" >
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label"><strong>Vendor</strong><span class="text-bold text-18 text-red">*</span></label>
                                                        <input class="form-control" type="text" name="Vendor" ng-model="VendorModel" placeholder="Enter Vendor Name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row white-bg">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label"><strong>Address</strong><span class="text-bold text-18 text-red">*</span></label>
                                                        <input class="form-control" type="text" name="Address" ng-model="AddressModel" placeholder="Enter Vendor Address">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row white-bg">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label"><strong>Contact No</strong><span class="text-bold text-18 text-red">*</span></label>
                                                        <input class="form-control" type="text" name="ContactNo" ng-model="ContactNoModel" placeholder="Enter Vendor Contact No">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label"><strong>Company</strong></label>
                                                        <select class="form-select" ng-model="CompanyModel">
                                                            <option value="">Please select company</option>
                                                            <option value="1">Modern Pathology</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label"><strong>Select Ledger Group</strong></label>
                                                        <select class="form-select" ng-model="LedgerGroupModel">
                                                            <option value="">Please Select Ledger Group</option>
                                                            <option ng-repeat="d1 in ledgergroups"  value="{{d1.ID}}" >{{d1.LedgerGroup}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="checkbox" class="checkbox-control" id="" ng-model="ActiveModel" ng-true-value="'1'" ng-false-value="'0'">  <p class="inline-control text-bold">IsActive</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>    
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-primary" ng-show="SaveBtn" ng-click="saveVendor()" type="button"><span class="icon-save"></span> Save</button>
                                    <button class="btn btn-warning" ng-show="UpdateBtn" ng-click="updateVendor()" type="button"> Update</button>
                                    <a href="<?php echo base_url('app/item/vendor'); ?>" class="btn btn-danger"> Close</a>
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
        <?php $this->load->view("Partials/VendorJs"); ?>
    </body>
</html>