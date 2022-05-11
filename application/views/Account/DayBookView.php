<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>

    <body>
        <?php $this->load->view('Partials/NavbarView'); ?>
        <div class="container-fluid" ng-app="DayBookApp" ng-controller="DayBookAppCtrl">
            <div class="card card shadow border-primary mt-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p class="fs-5 m-0">Test Categories</p>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url("app/dashboard"); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url("app/account/voucher/entry"); ?>">Account</a></li>
                                    <li class="breadcrumb-item active">Day Book</li>
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
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                            <div class="card border-warning shadow">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button class="btn btn-warning btn-sm"><img src="<?php echo base_url("assets/img/icons/daybook.png"); ?>"></button>
                                            <strong> &nbsp;Day Book</strong>
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <button ng-click="reset()" class="btn btn-outline-dark rounded-0 fs-6 shadow btn-sm" type="button"><img src="<?php echo base_url("assets/img/icons/close1.png"); ?>"></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card border-dark shadow rounded-0">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="VoucherTypeRadio" ng-change="changeVoucher()" id="flexRadioDefault1" ng-model="VoucherTypeModel" value="1" ng-checked="true">
                                                                <label class="form-check-label" for="flexRadioDefault1">
                                                                    <strong>All VOUCHERS</strong>
                                                                </label>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="VoucherTypeRadio"  ng-change="changeVoucher()" ng-model="VoucherTypeModel" value="2">
                                                                <label class="form-check-label" for="flexRadioDefault1">
                                                                    <strong class="text-danger">CONTRA</strong>
                                                                </label>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="VoucherTypeRadio"  ng-change="changeVoucher()" ng-model="VoucherTypeModel" value="3">
                                                                <label class="form-check-label" for="flexRadioDefault1">
                                                                    <strong class="text-success">RECEIPT</strong>
                                                                </label>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="VoucherTypeRadio"  ng-change="changeVoucher()" ng-model="VoucherTypeModel" value="4">
                                                                <label class="form-check-label" for="flexRadioDefault1">
                                                                    <strong class="text-warning">PAYMENT</strong>
                                                                </label>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="VoucherTypeRadio"  ng-change="changeVoucher()" ng-model="VoucherTypeModel" value="5">
                                                                <label class="form-check-label" for="flexRadioDefault1">
                                                                    <strong class="text-info">JOURNAL</strong>
                                                                </label>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card border-dark shadow mt-3 rounded-0">
                                                <div class="card-header">
                                                    <p class="m-0 fs-6">Search vouchers</p>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label"><strong>From Date</strong><span class="fw-bold text-18 text-red">*</span></label>
                                                                <input class="form-control border-warning bg-light text-danger fw-bold" type="text" id="FromDate" name="FromDate" ng-model="FromDateModel" placeholder="Enter From Date" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label"><strong>To Date</strong><span class="fw-bold text-18 text-red">*</span></label>
                                                                <input class="form-control border-warning bg-light text-danger fw-bold" type="text" id="ToDate" name="ToDate" ng-model="ToDateModel" placeholder="Enter To Date" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label"><strong>Ledger Groups</strong><span class="fw-bold text-18 text-red">*</span></label>
                                                                <select class="form-select border-warning bg-light" ng-model="LedgerGroupModel">
                                                                    <option value="">Please Select Group</option>
                                                                    <option ng-repeat="d7 in ledgergroups" value="{{d7.ID}}">{{d7.LedgerGroup}}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label"><strong>Ledger</strong><span class="fw-bold text-18 text-red">*</span></label>
                                                                <select class="form-select border-warning bg-light" ng-model="LedgerModel">
                                                                    <option value="">Please Select Ledger</option>
                                                                    <option ng-repeat="d8 in ledgers" value="{{d8.LedgerID}}">{{d8.Ledger}}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <button class="btn btn-primary" ng-click="searchVoucher()" type="button"><span class="icon-save"></span> Search</button>
                                                            <a href="<?php echo base_url('app/account/day/book'); ?>" class="btn btn-danger"><span class="icon-update"></span> Close</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card border-dark shadow rounded-0 mt-3">
                                                <div class="card-header">
                                                    <strong>Ledger Entry</strong>
                                                </div>
                                                <div class="card-body p-0">
                                                    <table class="table table-bordered border-warning table-striped mt-5 table-sm">
                                                        <thead class="bg-warning">
                                                            <tr>
                                                                <th class="border-start-0 text-center">::</th>
                                                                <th>Date</th>
                                                                <th>Particulars</th>
                                                                <th>Voucher No</th>
                                                                <th>Narration</th>
                                                                <th>Debit</th>
                                                                <th>Credit</th>
                                                                <th>Balance</th>
                                                                <th class="border-end-0">Voucher Type</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr ng-repeat="d9 in vouchers" ng-cloak>
                                                                <td class="border-start-0 text-center">
                                                                    <h5 class="fw-bold">::</h5>
                                                                </td>
                                                                <td class="text-success">{{d9.VDate}}</td>
                                                                <td class="fw-bold text-info">{{d9.Ledger}}</td>
                                                                <td>{{d9.VNo}}</td>
                                                                <td>{{d9.Narration}}</td>
                                                                <td class="fw-bold text-danger">{{d9.Debit}}</td>
                                                                <td class="fw-bold text-success">{{d9.Credit}}</td>
                                                                <td>0.00</td>
                                                                <td ng-if="d9.Vtype == 'contra'" class="border-end-0"><span class="text-red">{{d9.Vtype}}</span></td>
                                                                <td ng-if="d9.Vtype == 'payment'" class="border-end-0"><span class="text-warning">{{d9.Vtype}}</span></td>
                                                                <td ng-if="d9.Vtype == 'receipt'" class="border-end-0"><span class="text-info">{{d9.Vtype}}</span></td>
                                                                <td ng-if="d9.Vtype == 'journal'" class="border-end-0"><span class="text-success">{{d9.Vtype}}</span></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="card-footer">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            -
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text text-info fw-bold" id="basic-addon1">DEBIT</span>
                                                                <input type="text" class="form-control fw-bold text-danger" ng-model="Debit" placeholder="DEBIT">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text text-info fw-bold" id="basic-addon1">CREDIT</span>
                                                                <input type="text" class="form-control fw-bold text-success" ng-model="Credit" placeholder="CREDIT"></div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-group"><span class="input-group-addon fw-bold text-success"> 
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
                </div>
            </div>
        </div>


        <?php $this->load->view("Partials/FooterView"); ?>
        <?php $this->load->view("Partials/TestJs"); ?>
        <?php $this->load->view("Partials/JqueryUI"); ?>
        <?php $this->load->view("Partials/AngularJs"); ?>
        <?php $this->load->view("Partials/SweetAlertJs"); ?>
        <?php $this->load->view("Partials/DateJs"); ?>
        <?php $this->load->view("Partials/DayBookJs"); ?>
    </body>
</html>