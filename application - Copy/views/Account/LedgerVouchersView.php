<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>

    <body>
        <?php $this->load->view('Partials/NavbarView'); ?>
        <div class="container-fluid" ng-app="LedgerVoucherApp" ng-controller="LedgerVoucherAppCtrl">
            <div class="card card shadow border-primary mt-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p class="fs-5 m-0">Ledger Vouchers</p>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url("app/dashboard"); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url("app/account/voucher/entry"); ?>">Account</a></li>
                                    <li class="breadcrumb-item active">Ledger Voucher</li>
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
                                            <button class="btn btn-warning btn-sm shadow"><img src="<?php echo base_url("assets/img/icons/ledger2.png"); ?>"></button>
                                            <strong> &nbsp;Ledger Voucher</strong>
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <button ng-click="reset()" class="btn btn-outline-dark fs-6 shadow rounded-0 btn-sm" type="button"><img src="<?php echo base_url("assets/img/icons/close1.png"); ?>"></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card border-warning shadow">
                                                <div class="card-header">
                                                    <strong>Delete Voucher</strong>
                                                </div>
                                                <div class="card-body">
                                                    <div class="card border-dark rounded-0 bg-light">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label class="control-label"><strong>From Date</strong><span class="fw-bold text-18 text-danger">*</span></label>
                                                                        <input class="form-control  text-danger fw-bold" type="text" id="FromDate" name="FromDate" ng-model="FromDateModel" placeholder="Enter From Date" readonly="">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label class="control-label"><strong>To Date</strong><span class="fw-bold text-18 text-danger">*</span></label>
                                                                        <input class="form-control  text-danger fw-bold" type="text" id="ToDate" name="ToDate" ng-model="ToDateModel" placeholder="Enter To Date" readonly="">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label class="control-label"><strong>Voucher No</strong><span class="fw-bold text-18 text-danger">*</span></label>
                                                                        <input class="form-control " type="text"  name="VoucherNo" ng-model="VoucherNoModel" placeholder="Enter Voucher No">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label class="control-label"><strong>Ledger Group</strong><span class="fw-bold text-18 text-danger">*</span></label>
                                                                        <select class="form-select " ng-model="LedgerGroupModel" ng-change="provideLedger()">
                                                                            <option value="">Please select group</option>
                                                                            <option ng-repeat="d1 in ledgergroups" value="{{d1.ID}}">{{d1.LedgerGroup}}</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label class="control-label"><strong>Ledger</strong><span class="fw-bold text-18 text-danger">*</span></label>
                                                                        <select class="form-select" ng-model="LedgerModel">
                                                                            <option value="">Please Select Ledger</option>
                                                                            <option ng-repeat="d2 in ledgers" value="{{d2.ID}}">{{d2.Ledger}}</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <button class="btn btn-info border-primary rounded-0 mt-4" ng-click="searchLedgerVoucher()">Search</button>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <table class="table table-bordered border-warning table-striped mt-5 table-sm">
                                                        <thead class="bg-warning">
                                                            <tr>
                                                                <th>::</th>
                                                                <th>Voucher No</th> 
                                                                <th>Date</th>
                                                                <th>Voucher Type</th>
                                                                <th>Particulars</th>
                                                                <th>Narration</th>
                                                                <th>Debit</th>
                                                                <th>Credit</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr ng-repeat="d9 in vouchers" ng-cloak>
                                                                <td>
                                                                    <h5 class="fw-bold">::</h5>
                                                                </td>
                                                                <td>{{d9.VNo}}</td>
                                                                <td class="text-green">{{d9.VDate}}</td>
                                                                <td ng-if="d9.Vtype == 'contra'"><span class="text-danger">{{d9.Vtype}}</span></td>
                                                                <td ng-if="d9.Vtype == 'payment'"><span class="text-warning">{{d9.Vtype}}</span></td>
                                                                <td ng-if="d9.Vtype == 'receipt'"><span class="text-info">{{d9.Vtype}}</span></td>
                                                                <td ng-if="d9.Vtype == 'journal'"><span class="text-green">{{d9.Vtype}}</span></td>
                                                                <td class="fw-bold text-info">{{d9.Ledger}}</td>
                                                                <td>{{d9.Narration}}</td>
                                                                <td class="fw-bold text-danger">{{d9.Debit}}</td>
                                                                <td class="fw-bold text-green">{{d9.Credit}}</td>
                                                                <td>
                                                                    <?php
                                                                    if ($this->aauth->is_allowed('Delete')) {
                                                                        ?>
                                                                        <a href="#" ng-click="deleteVoucher(d9.VNo)"><img src="<?php echo base_url("assets/img/delete.png"); ?>"></a>
                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <a href="#"><img src="<?php echo base_url("assets/img/delete2.png"); ?>"></a>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <hr>
                                                    <div class="row gutter">
                                                        <div class="col-md-8">
                                                            -
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text bg-danger text-white border-danger" id="basic-addon1">DEBIT</span>
                                                                <input type="text" class="form-control fw-bold text-danger border-danger" ng-model="Debit" placeholder="DEBIT">
                                                            </div>

                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text bg-success text-white border-success" id="basic-addon1">CREDIT</span>
                                                                <input type="text" class="form-control fw-bold text-success border-success" ng-model="Credit" placeholder="CREDIT">
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
        <?php $this->load->view("Partials/LedgerVoucherJs"); ?>
    </body>
</html>