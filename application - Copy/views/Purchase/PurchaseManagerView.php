<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>

    <body>
        <?php $this->load->view('Partials/NavbarView'); ?>
        <div class="container-fluid"  ng-app="PurchaseManageApp" ng-controller="PurchaseManageAppCtrl">
            <div class="card card shadow border-primary mt-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p class="fs-5 m-0">Purchase Manager</p>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url("app/dashboard"); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('app/item/inward'); ?>">Purchase</a></li>
                                    <li class="breadcrumb-item active">Purchase Manager</li>
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
                                            <button class="btn btn-warning btn-sm shadow"><img src="<?php echo base_url("assets/img/icons/purchase1.png"); ?>"></button>
                                            <strong> &nbsp;Purchase Manager</strong> 
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <a href="<?php echo base_url('app/item/inward'); ?>" class="btn btn-outline-dark fs-6 rounded-0 btn-sm"><img src="<?php echo base_url("assets/img/icons/add.png"); ?>"> Edit Purchase</a>  
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="p-2">
                                        <div class="row">
                                            <div class="col-md-3 col-lg-3 col-sm-3 col-xs-12">
                                                <div class="form-group">
                                                    <label class="control-label"><strong>Purchase Date</strong></label>
                                                    <input class="form-control border-warning bg-light" type="text" id="PurchaseDate" name="PurchaseDate" ng-model="PurchaseDateModel" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label"><strong>Bill No</strong></label>
                                                    <input class="form-control border-warning bg-light" type="text" name="Bill No" ng-model="BillNoModel" placeholder="Bill No">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label"><strong>Vendor</strong></label>
                                                    <select class="form-select border-warning bg-light" ng-model="VendorModel">
                                                        <option value="">Please Select Vendor</option>
                                                        <option ng-repeat="d1 in vendors"  value="{{d1.ID}}" >{{d1.Vendor}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                <button class="btn  btn-info border-primary rounded-0 mt-4" ng-click="searchPurchaseBills()"><span class="glyphicon glyphicon-search"></span> Search</button>
                                                <a href="<?php echo base_url('app/manage/purchase'); ?>" class="btn btn-danger rounded-0 mt-4">Reset</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="scrollbar" id="style-7">
                                        <div class="force-overflow">
                                            <hr class="ln-4">
                                            <table class="table table-bordered border-warning table-striped mt-5 table-sm">
                                                <thead >
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Purchase Date</th>
                                                        <th>Vendor</th>
                                                        <th>Bill No</th>
                                                        <th>Bill Amount</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr ng-repeat="d1 in bills">
                                                        <td>
                                                            <button class="btn btn-success btn-xs">
                                                                <img src="<?php echo base_url("assets/img/icons/category1.png"); ?>">
                                                            </button>
                                                        </td>
                                                        <td class="text-bold text-green">{{d1.PurchaseDate}}</td>
                                                        <td>{{d1.Vendor}}</td>
                                                        <td class="text-bold text-danger">{{d1.BillNo}}</td>
                                                        <td>{{d1.BillAmount}}</td>
                                                        <td>
                                                            <?php
                                                            if ($this->aauth->is_admin() || $this->aauth->is_allowed('View')) {
                                                                ?>
                                                                <a  href="<?php echo base_url("app/purchase/bill/view/"); ?>{{d1.PurchaseID}}"><img src="<?php echo base_url("assets/img/icons/view.png"); ?>"></a>
                                                                <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($this->aauth->is_allowed('Print')) {
                                                                ?>
                                                                <a target="_blank" href="<?php echo base_url('app/purchase/bill/print/'); ?>{{d1.PurchaseID}}"><img src="<?php echo base_url("assets/img/print.png"); ?>"></a>
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
                                            <div ng-show="Spinner1" class="text-center m-t-10"><img src="<?php echo base_url('assets/img/icons/loader.png'); ?>"></div>
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
        <?php $this->load->view("Partials/PurchaseManagerJs"); ?>
    </body>
</html>