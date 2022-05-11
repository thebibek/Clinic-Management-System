<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>

    <body>
        <?php $this->load->view('Partials/NavbarView'); ?>
        <div class="container-fluid"  ng-app="LedgerGroupApp" ng-controller="LedgerGroupAppCtrl">
            <div class="card card shadow border-primary mt-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p class="fs-5 m-0">Ledger Groups</p>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url("app/dashboard"); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php ?>">Ledger Groups</a></li>
                                    <li class="breadcrumb-item active">Ledger Groups</li>
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
                                            <button class="btn btn-warning btn-sm shadow"><img src="<?php echo base_url("assets/img/icons/list.png"); ?>"></button>
                                            <strong> Ledger Groups</strong> 
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <button class="btn btn-outline-dark rounded-0 fs-6 btn-sm" ng-click="showAddPanel()" type="button"><img src="<?php echo base_url("assets/img/icons/add.png"); ?>"> Add Ledger Group</button>  
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="p-2">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label"><strong>Ledger Group Name</strong></label>
                                                    <input class="form-control border-warning rounded-0 bg-light" type="text" name="LedgerGroup" ng-model="sLedgerGroupModel" placeholder="Ledger Group Name">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label"><strong>Select Under Group</strong></label>
                                                    <select class="form-select border-warning rounded-0 bg-light" ng-model="sUnderGroupModel">
                                                        <option value="">Please Select Under Group</option>
                                                        <option ng-repeat="d1 in groups"  value="{{d1.ID}}" >{{d1.UnderGroup}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                <button class="btn btn-info border-primary mt-4 rounded-0 shadow" ng-click="searchLedgerGroups()"><span class="glyphicon glyphicon-search"></span> Search</button>
                                                <a href="<?php echo base_url('app/ledger/group'); ?>" class="btn btn-outline-dark shadow rounded-0 mt-4"><img src="<?php echo base_url('assets/img/icons/reset.png'); ?>" title="reset"></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="scrollbar" id="style-7">
                                        <div class="force-overflow">



                                            <table class="table table-bordered border-warning table-striped mt-3 table-sm">
                                                <thead class="bg-warning">
                                                    <tr>
                                                        <th class="border-start-0 text-center">#</th>
                                                        <th>Ledger Group</th>
                                                        <th>Under Group</th>
                                                        <th>TB(Trial Balance)</th>
                                                        <th>PL(Profit & Loss)</th>
                                                        <th>BL(Balance Sheet)</th>
                                                        <th class="border-end-0">Remarks</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr ng-repeat="d1 in ledgergroups">
                                                        <td class="border-start-0 text-center">
                                                            <button class="btn btn-success btn-sm shadow">
                                                                <img src="<?php echo base_url("assets/img/icons/category1.png"); ?>">
                                                            </button>
                                                        </td>
                                                        <td>{{d1.LedgerGroup}}</td>
                                                        <td>{{d1.UnderGroup}}</td>
                                                        <td ng-if="d1.TrialBalance == 1">DEBIT</td>
                                                        <td ng-if="d1.TrialBalance == 2">CREDIT</td>
                                                        <td ng-if="d1.TrialBalance == 0">NONE</td>
                                                        <td ng-if="d1.ProfitLoss == 1">DEBIT</td>
                                                        <td ng-if="d1.ProfitLoss == 2">CREDIT</td>
                                                        <td ng-if="d1.ProfitLoss == 0">NONE</td>
                                                        <td ng-if="d1.BalanceSheet == 1">DEBIT</td>
                                                        <td ng-if="d1.BalanceSheet == 2">CREDIT</td>
                                                        <td ng-if="d1.BalanceSheet == 0">NONE</td>
                                                        <td class="border-end-0">
                                                            <?php
                                                            if ($this->aauth->is_allowed('Delete')) {
                                                                ?>
                                                                <a href="#" ng-click="deleteLedgerGroup(d1.LedgerGroupID)"><img src="<?php echo base_url("assets/img/delete.png"); ?>"></a>
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
                                                                <a href="#" ng-click="editLedgerGroup(d1.LedgerGroupID)"><img src="<?php echo base_url("assets/img/edit.png"); ?>"></a>
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
                                            <button class="btn btn-warning btn-sm shadow"><img src="<?php echo base_url("assets/img/icons/category1.png"); ?>"></button>
                                            <strong> &nbsp;Ledger Group Name</strong>
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <a href="<?php echo base_url('app/ledger/group'); ?>" class="btn btn-outline-dark shadow fs-6 rounded-0 btn-sm"><img src="<?php echo base_url("assets/img/icons/close1.png"); ?>"></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" >
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label"><strong>Ledger Group Name</strong><span class="text-danger">*</span></label>
                                                        <input class="form-control border-warning bg-light" type="text" name="Category" ng-model="LedgerGroupModel" placeholder="Enter Ledger Group Name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label"><strong>Select Under Group</strong></label>
                                                        <select class="form-select border-warning bg-light" ng-model="UnderGroupModel">
                                                            <option value="">Please Select Under Group</option>
                                                            <option ng-repeat="d1 in groups"  value="{{d1.ID}}" >{{d1.UnderGroup}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label"><strong>Remarks</strong></label>
                                                        <textarea class="form-control border-warning bg-light" placeholder="Enter Remarks" ng-model="RemarksModel"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="card border-warning shadow rounded-0">
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
                                                                <select class="form-select border-warning bg-light" ng-model="PLModel">
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
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-primary" ng-show="SaveBtn" ng-click="saveLedgerGroup()" type="button"> Save</button>
                                    <button class="btn btn-warning text-white" ng-show="UpdateBtn" ng-click="updateLedgerGroup()" type="button"> Update</button>
                                    <a href="<?php echo base_url('app/ledger/group'); ?>" class="btn btn-danger " > Close</a>
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
        <?php $this->load->view("Partials/LedgerGroupJs"); ?>
    </body>
</html>