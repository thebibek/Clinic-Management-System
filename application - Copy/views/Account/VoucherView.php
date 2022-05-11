<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>

    <body>
        <?php $this->load->view('Partials/NavbarView'); ?>
        <div class="container-fluid" ng-app="VoucherApp" ng-controller="VoucherAppCtrl">
            <div class="card card shadow border-primary mt-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p class="fs-5 m-0">Voucher Entry</p>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url("app/dashboard"); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url("app/account/voucher/entry"); ?>">Account</a></li>
                                    <li class="breadcrumb-item active">Voucher Entry</li>
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
                                            <button class="btn btn-warning btn-sm shadow"><img src="<?php echo base_url("assets/img/icons/voucher.png"); ?>"></button>
                                            <strong> &nbsp;Voucher Entry</strong>
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <button ng-click="reset()" class="btn btn-outline-dark rounded-0 fs-6 shadow btn-sm"><img src="<?php echo base_url("assets/img/icons/reset.png"); ?>"></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label"><strong>Date</strong><span class="fw-bold text-18 text-red">*</span></label>
                                                <input class="form-control text-danger fw-bold" type="text" id="VoucherDate" name="VoucherDate" ng-model="VoucherDateModel" placeholder="Enter Date" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label"><strong>Company Name</strong><span class="fw-bold text-18 text-red">*</span></label>
                                                <select class="form-select" ng-model="CompanyModel">
                                                    <option value="">Please Select Company</option>
                                                    <option ng-repeat="d4 in companies" value="{{d4.ID}}">{{d4.LabName}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label"><strong>Amount</strong><span class="fw-bold text-18 text-red">*</span></label>
                                                <input class="form-control" type="text" name="Amount" ng-model="AmountModel" placeholder="Enter Voucher Amount">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row g-2">
                                        <div class="col-md-2">
                                            <div class="d-grid gap-2">
                                                <button class="btn btn-info border-primary rounded-0" ng-click="contraEntry()">CONTRA</button>
                                                <button class="btn btn-success border-secondary rounded-0" ng-click="paymentEntry()">PAYMENT</button>
                                                <button class="btn btn-warning border-danger rounded-0" ng-click="receiptEntry()">RECEIPT</button>
                                                <button class="btn btn-danger border-dark rounded-0" ng-click="journalEntry()">JOURNAL</button>
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="card border-warning shadow">
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
                                                                <th>Debit</th>
                                                                <th>Credit</th>
                                                                <th class="border-end-0">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr ng-repeat="d6 in items" ng-cloak="">
                                                                <td class="border-start-0 text-center">
                                                                    <h5 class="{{d6.color}} fw-bold">{{d6.EntryType}}</h5>
                                                                </td>
                                                                <td>{{d6.Date}}</td>
                                                                <td class="fw-bold">{{d6.Particulars}}</td>
                                                                <td><input type="text" class=" form-control  fw-bold text-danger" ng-model="d6.Debit"></td>
                                                                <td><input type="text" class=" form-control  fw-bold text-success" ng-model="d6.Credit"></td>
                                                                <td class="border-end-0">
                                                                    <a type="button" class="btn btn-danger btn-sm"  ng-click="removeItem($index)">
                                                                        -
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="p-2">
                                                                <div class="form-group">
                                                                    <label class="control-label"><strong>Comments</strong></label>
                                                                    <textarea class="form-control" placeholder="Enter Comments" rows="5" ng-model="CommentsModel"></textarea>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card border-warning shadow" ng-show="DebitSide">
                                                <div class="card-header">
                                                    <h5 class="text-danger">SELECT DEBIT ENTRY</h5>
                                                </div>
                                                <div class="card-body p-0">
                                                    <div class="scrollbar" id="style-7">
                                                        <div class="force-overflow">
                                                            <table class="table table-bordered border-primary table-striped mt-4 table-sm">
                                                                <thead class="bg-primary text-white">
                                                                    <tr>
                                                                        <th class="border-start-0 text-center">#</th>
                                                                        <th>Ledger</th>
                                                                        <th class="border-end-0">Balance</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr ng-repeat="d5 in ledgeraccounts">
                                                                        <td class="border-start-0 text-center">
                                                                            <button class="btn btn-warning btn-sm" ng-click="debitEntry(d5.ID, d5.Ledger)" type="button"><img src="<?php echo base_url("assets/img/icons/back-20.png"); ?>"></button>
                                                                        </td>
                                                                        <td>{{d5.Ledger}}</td>
                                                                        <td class="border-end-0">{{d5.OpeningBalance}}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card border-warning shadow" ng-show="CreditSide">
                                                <div class="card-header">
                                                    <h5 class="text-danger">SELECT CREDIT ENTRY</h5>
                                                </div>
                                                <div class="card-body p-0">
                                                    <div class="scrollbar" id="style-7">
                                                        <div class="force-overflow">
                                                            <table class="table table-bordered border-primary table-striped mt-4 table-sm">
                                                                <thead class="bg-primary text-white">
                                                                    <tr>
                                                                        <th class="border-start-0 text-center">#</th>
                                                                        <th>Ledger</th>
                                                                        <th class="border-end-0">Balance</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr ng-repeat="d5 in ledgeraccounts">
                                                                        <td class="border-start-0 text-center">
                                                                            <button class="btn btn-warning btn-sm" ng-click="creditEntry(d5.ID, d5.Ledger)" type="button"><img src="<?php echo base_url("assets/img/icons/back-20.png"); ?>"></button>
                                                                        </td>
                                                                        <td>{{d5.Ledger}}</td>
                                                                        <td class="border-end-0">{{d5.OpeningBalance}}</td>
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
                                <div class="card-footer">
                                    <button class="btn btn-primary" ng-click="saveVoucher()" type="button"> Save</button>
                                    <a href="<?php echo base_url('app/account/voucher/entry'); ?>" class="btn btn-danger"> Close</a>
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
        <?php $this->load->view("Partials/VoucherJs"); ?>
    </body>
</html>