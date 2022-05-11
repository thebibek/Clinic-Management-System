<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>

    <body>
        <?php $this->load->view('Partials/NavbarView'); ?>
        <div class="container-fluid" ng-app="LedgerApp" ng-controller="LedgerAppCtrl">
            <div class="card card shadow border-primary mt-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p class="fs-5 m-0">Ledger</p>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url("app/dashboard"); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url("app/ledger/under/group"); ?>">Group</a></li>
                                    <li class="breadcrumb-item active">Ledger</li>
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
                                            <button class="btn btn-warning btn-sm shadow"><img src="<?php echo base_url("assets/img/icons/list2.png"); ?>"></button>
                                            <strong> Ledgers</strong>
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <button class="btn btn-outline-dark shadow btn-sm rounded-0" ng-click="showAddPanel()" type="button"><img src="<?php echo base_url("assets/img/icons/add.png"); ?>"> Add Ledger</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="p-2">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label"><strong>Ledger Name</strong></label>
                                                    <input class="form-control border-warning bg-light rounded-0" type="text" name="LedgerName" ng-model="aLedgerNameModel" placeholder="Enter Ledger Name">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label"><strong>Ledger Group</strong></label>
                                                    <select class="form-select border-warning bg-light rounded-0" ng-model="aLedgerGroupModel">
                                                        <option value="">Please Select Ledger Group</option>
                                                        <option ng-repeat="d2 in ledgergroups" value="{{d2.ID}}">{{d2.LedgerGroup}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                <button class="btn btn-info border-primary rounded-0 mt-4" ng-click="searchLedgers()"><span class="glyphicon glyphicon-search"></span> Search</button>
                                                <a href="<?php echo base_url('app/ledger'); ?>" class="btn  btn-danger border-danger rounded-0 mt-4">Reset</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="scrollbar" id="style-7">
                                        <div class="force-overflow">


                                            <table class="table table-bordered border-warning table-striped mt-5 table-sm">
                                                <thead class="bg-warning">
                                                    <tr>
                                                        <th class="border-start-0 text-center">#</th>
                                                        <th>Company Name</th>
                                                        <th>Ledger</th>
                                                        <th>Ledegr Group</th>
                                                        <th>Ledger Alias</th>
                                                        <th>TB</th>
                                                        <th>PL</th>
                                                        <th>BL</th>
                                                        <th>Remarks</th>
                                                        <th class="border-end-0">Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <tr ng-repeat="d1 in ledgers" ng-cloak>
                                                        <td class="border-start-0 text-center">
                                                            <button class="btn btn-success btn-sm shadow">
                                                                <img src="<?php echo base_url("assets/img/icons/category1.png"); ?>">
                                                            </button>
                                                        </td>
                                                        <td class="fs-14">{{d1.LabName}}</td>
                                                        <td class="fs-14">{{d1.Ledger}}</td>
                                                        <td class="fs-14">{{d1.LedgerGroup}}</td>
                                                        <td class="fs-14">{{d1.LedgerAlias}}</td>
                                                        <td ng-if="d1.LedgerTB == 1">DEBIT</td>
                                                        <td ng-if="d1.LedgerTB == 2">CREDIT</td>
                                                        <td ng-if="d1.LedgerTB == 0">NONE</td>
                                                        <td ng-if="d1.LedgerPL == 1">DEBIT</td>
                                                        <td ng-if="d1.LedgerPL == 2">CREDIT</td>
                                                        <td ng-if="d1.LedgerPL == 0">NONE</td>
                                                        <td ng-if="d1.LedgerBS == 1">DEBIT</td>
                                                        <td ng-if="d1.LedgerBS == 2">CREDIT</td>
                                                        <td ng-if="d1.LedgerBS == 0">NONE</td>
                                                        <td>{{d1.LedgerRemarks}}</td>
                                                        <td class="border-end-0">
                                                            <?php
                                                            if ($this->aauth->is_admin() || $this->aauth->is_allowed('Delete')) {
                                                                ?>
                                                                <a href="#" ng-click="deleteLedger(d1.LedgerID)"><img src="<?php echo base_url("assets/img/delete.png"); ?>"></a>
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
                                                                <a href="#" ng-click="editLedger(d1.LedgerID)"><img src="<?php echo base_url("assets/img/edit.png"); ?>"></a>
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
                                            <div ng-show="Spinner1" class="text-center"><img src="<?php echo base_url('assets/img/icons/loader.png'); ?>"></div>
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
                                            <button class="btn btn-warning btn-sm shadow"><img src="<?php echo base_url("assets/img/icons/category1.png"); ?>"></button>
                                            <strong> &nbsp;Ledgers</strong>
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <button ng-click="reset()" class="btn btn-outline-dark rounded-0 shadow btn-sm" type="button"><img src="<?php echo base_url("assets/img/icons/close1.png"); ?>"></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label"><strong>Ledger Name</strong><span class="text-bold text-18 text-red">*</span></label>
                                                        <input class="form-control border-warning bg-light" type="text" name="Ledger" ng-model="LedgerModel" placeholder="Enter Ledger Name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label"><strong>Ledger Alias</strong><span class="text-bold text-18 text-red">*</span></label>
                                                        <input class="form-control border-warning bg-light" type="text" name="LedgerAlias" ng-model="LedgerAliasModel" placeholder="Enter Ledger Alias">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label"><strong>Select Company</strong></label>
                                                        <select class="form-select border-warning bg-light" ng-model="CompanyModel">
                                                            <option value="">Please Select Company</option>
                                                            <option value="1">Modern Pathology</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label"><strong>Select Ledger Group</strong></label>
                                                        <select class="form-select border-warning bg-light" ng-model="LedgerGroupModel">
                                                            <option value="">Please Select Ledger Group</option>
                                                            <option ng-repeat="d1 in ledgergroups" value="{{d1.ID}}">{{d1.LedgerGroup}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="card border-warning shadow">
                                                <div class="card-header">
                                                    <strong>Side of the Group in Accounts</strong>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label"><strong>Trial Balance(TB)</strong></label>
                                                                <select class="form-select border-warning bg-light" ng-model="TBModel">
                                                                    <option value="">Please Select</option>
                                                                    <option value="0">NONE</option>
                                                                    <option value="1">DEBIT</option>
                                                                    <option value="2">CREDIT</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label"><strong>Profit & Loss(PL)</strong></label>
                                                                <select class="form-select border-warning bg-light " ng-model="PLModel">
                                                                    <option value="">Please Select</option>
                                                                    <option value="0">NONE</option>
                                                                    <option value="1">DEBIT</option>
                                                                    <option value="2">CREDIT</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label"><strong>Balance Sheet(BS)</strong></label>
                                                                <select class="form-select border-warning bg-light" ng-model="BSModel">
                                                                    <option value="">Please Select</option>
                                                                    <option value="0">NONE</option>
                                                                    <option value="1">ASSETS</option>
                                                                    <option value="2">LIABLITIES</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label"><strong>Remarks</strong></label>
                                                        <textarea class="form-control border-warning bg-light" placeholder="Enter Remarks" rows="5" ng-model="RemarksModel"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-primary " ng-show="SaveBtn" ng-click="saveLedger()" type="button"><span class="icon-save"></span> Save</button>
                                    <button class="btn btn-warning" ng-show="UpdateBtn" ng-click="updateLedger()" type="button"><span class="icon-save"></span> Update</button>
                                    <a href="<?php echo base_url('app/ledger'); ?>" class="btn btn-danger"><span class="icon-update"></span> Close</a>
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
        <?php $this->load->view("Partials/LedgerJs"); ?>
    </body>
</html>