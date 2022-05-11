<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>

    <body>
        <?php $this->load->view('Partials/NavbarView'); ?>
        <div class="container-fluid"  ng-app="ItemInwardApp" ng-controller="ItemInwardAppCtrl">
            <div class="card card shadow border-primary mt-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p class="fs-5 m-0">Item Inward</p>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url(); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active">ItemInward</li>
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
                                            <button class="btn btn-danger btn-sm shadow"><img src="<?php echo base_url("assets/img/icons/purchase1.png"); ?>"></button>
                                            <strong> &nbsp;Purchase Bills</strong> 
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <button class="btn btn-outline-dark fs-6 shadow rounded-0 btn-sm" ng-click="showAddPanel()" type="button"><img src="<?php echo base_url("assets/img/icons/add.png"); ?>"> Add Purchase</button>  
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="p-2">
                                        <div class="row g-2">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label"><strong>Bill No</strong></label>
                                                    <input class="form-control border-warning bg-light" type="text" name="Bill No" ng-model="sBillNoModel" placeholder="Bill No">
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                <button class="btn btn-info border-primary mt-4 rounded-0" ng-click="searchPurchaseBill()"><span class="glyphicon glyphicon-search"></span> Search</button>
                                                <a href="<?php echo base_url('app/item/inward'); ?>" class="btn  btn-danger mt-4 rounded-0">Reset</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="scrollbar" id="style-7">
                                        <div class="force-overflow">

                                            <hr class="ln-4">
                                            <table class="table table-bordered border-warning table-striped mt-5 table-sm">
                                                <thead class="bg-warning">
                                                    <tr>
                                                        <th class="border-start-0 text-center">#</th>
                                                        <th>Purchase Date</th>
                                                        <th>Vendor</th>
                                                        <th>Bill No</th>
                                                        <th>Bill Amount</th>
                                                        <th class="border-end-0">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr ng-repeat="d1 in bills">
                                                        <td class="border-start-0 text-center">
                                                            <button class="btn btn-danger btn-sm">
                                                                <img src="<?php echo base_url("assets/img/icons/purchase2.png"); ?>">
                                                            </button>
                                                        </td>
                                                        <td class="fw-bold text-success">{{d1.PurchaseDate}}</td>
                                                        <td>{{d1.Vendor}}</td>
                                                        <td class="fw-bold text-danger">{{d1.BillNo}}</td>
                                                        <td>{{d1.BillAmount}}</td>
                                                        <td class="border-end-0">
                                                            <?php
                                                            if ($this->aauth->is_admin() || $this->aauth->is_allowed('Delete')) {
                                                                ?>
                                                                <a href="#" ng-click="deletePurchaseBill(d1.PurchaseID)"><img src="<?php echo base_url("assets/img/delete.png"); ?>"></a>
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
                                                                <a href="#" ng-click="editPurchase(d1.PurchaseID)"><img src="<?php echo base_url("assets/img/edit.png"); ?>"></a>
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
                    <div class="row gutter">
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                            <div class="card border-warning shadow" ng-show="AddPanel">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button class="btn btn-danger btn-sm"><img src="<?php echo base_url("assets/img/icons/purchase1.png"); ?>"></button>
                                            <strong> &nbsp;Purchase</strong>
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <button class="btn btn-outline-dark rounded-0 fs-6 shadow btn-sm" ng-click="reset()"><img src="<?php echo base_url('assets/img/icons/list1.png'); ?>">Purchase List</button>
                                            <button ng-click="reset()" class="btn btn-outline-dark rounded-0 fs-6 shadow btn-sm" type="button"><img src="<?php echo base_url("assets/img/icons/close1.png"); ?>"></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" >
                                    <div class="row gutter">
                                        <div class="col-md-12">
                                            <div class="card border-dark shadow mb-3">
                                                <div class="card-header">
                                                    <strong>Purchase Vendor</strong>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label"><strong>Inward Date</strong><span class="fw-bold text-danger">*</span></label>
                                                                <input class="form-control" type="text" name="Date" id="InwardDate" ng-model="InwardDateModel" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label"><strong>Bill No</strong><span class="fw-bold text-danger">*</span></label>
                                                                <input class="form-control" type="text" name="BillNo" ng-model="BillNoModel" placeholder="Enter Bill No">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label"><strong>Vendor</strong></label>
                                                                <select class="form-select" ng-model="VendorModel">
                                                                    <option value="">Please Select Vendor</option>
                                                                    <option ng-repeat="d1 in vendors" value="{{d1.ID}}">{{d1.Vendor}}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card border-dark shadow mb-3">
                                                <div class="card-header">
                                                    <strong>Purchase Items</strong>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label"><strong>Item Type</strong><span class="fw-bold text-danger">*</span></label>
                                                                <select class="form-select" ng-model="ItemTypeModel"  ng-change="getItemNames()" ng-options="y.ItemType for (x, y) in itemtypes">
                                                                    <option value="" >Please select Item Type</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label"><strong>Item Name</strong><span class="fw-bold  text-danger">*</span></label>
                                                                <select class="form-select" ng-model="ItemNameModel" ng-options="y.ItemName for y in itemnames" ng-change="changeItemName()">
                                                                    <option value="">Please select item name</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label"><strong>Description</strong></label>
                                                                <input type="text" class="form-control" ng-model="DescriptionModel" place>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label"><strong>Purchase Rate</strong><span class="fw-bold text-danger">*</span></label>
                                                                <input class="form-control  text-primary fw-bold" type="text" name="PurchaseRate" ng-change="updateTotal()" ng-model="PurchaseRateModel" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label"><strong>Quanity</strong><span class="fw-bold text-danger">*</span></label>
                                                                <input class="form-control text-info fw-bold" type="text" name="Quantity" ng-change="updateTotal()" ng-model="QuantityModel" >
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label"><strong>Total Amount</strong></label>
                                                                <input type="text"  class="form-control text-danger fw-bold" name="TotalAmount" ng-model="TotalAmountModel" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <button class="btn btn-info border-primary mt-4 rounded-0" ng-click="addItem()">+ ADD</button>
                                                            <a class="btn btn-danger mt-4 rounded-0"  href="<?php echo base_url('app/item/inward'); ?>"> RESET</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="card border-dark shadow">
                                                <div class="card-header">
                                                    <button class="btn btn-warning btn-sm" type="button">
                                                        <img src="<?php echo base_url("assets/img/icons/list2.png"); ?>">
                                                    </button>
                                                    <strong> &nbsp;&nbsp;List Of Added Items</strong>
                                                </div>
                                                <div class="panel-body pad-0">
                                                    <div class="scrollbar1" id="style-7">
                                                        <div class="force-overflow">
                                                            <table class="table table-bordered border-warning table-striped table-sm">
                                                                <thead class="bg-warning">
                                                                    <tr class="border-start-0 text-center">
                                                                        <th>#</th>
                                                                        <th>Item Type</th>
                                                                        <th>Item Name</th>
                                                                        <th>Desc</th>
                                                                        <th>Rate</th>
                                                                        <th>Quantity</th>
                                                                        <th>Total</th>
                                                                        <th class="border-end-0">Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr ng-repeat="d5 in purchaseitems" ng-cloak="">
                                                                        <td class="border-start-0 text-center"><button class="btn btn-info btn-sm"><img src="<?php echo base_url("assets/img/icons/test3.png"); ?>"></button></td>
                                                                        <td>{{d5.ItemType}}</td>
                                                                        <td class="text-success fw-bold">{{d5.ItemName}}</td>
                                                                        <td>{{d5.Description}}</td>
                                                                        <td>{{d5.Rate}}</td>
                                                                        <td>{{d5.Quantity}}</td>
                                                                        <td class="text-danger fw-bold">{{d5.Total}}</td>
                                                                        <td class="border-end-0">
                                                                            <?php
                                                                            if ($this->aauth->is_allowed('Remove')) {
                                                                                ?>
                                                                                <button class="btn btn-outline-dark rounded-0 btn-sm" ng-click="removeItem($index)" type="button"><img src="<?php echo base_url("assets/img/icons/close1.png"); ?>"></button>
                                                                                <?php
                                                                            } else {
                                                                                ?>
                                                                                <button class="btn btn-outline-dark rounded-0 btn-sm" type="button"><img src="<?php echo base_url("assets/img/icons/prohibit.png"); ?>"></button>
                                                                                <?php
                                                                            }
                                                                            ?>    
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="6" class="text-end fw-bold " >Bill Amount</td>
                                                                        <td colspan="2" class="text-danger fw-bold">{{BillAmountModel}}</td>
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
                                <div class="card-footer text-end">
                                    <button class="btn btn-primary" ng-show="SaveBtn" ng-click="savePurchaseItems()" type="button"><span class="icon-save"></span> Save</button>
                                    <button class="btn btn-warning" ng-show="UpdateBtn" ng-click="updatePurchaseItems()" type="button"><span class="icon-save"></span> Update</button>
                                    <a href="<?php echo base_url('app/ledger/group'); ?>" class="btn btn-danger"><span class="icon-update"></span> Close</a>
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
        <?php $this->load->view("Partials/PurchaseJs"); ?>
    </body>
</html>