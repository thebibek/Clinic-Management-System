<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>
    
    <body>
        <?php $this->load->view('Partials/NavbarView'); ?>
        <div class="container-fluid" ng-app="CashBankApp" ng-controller="CashBankAppCtrl">
            <div class="card card shadow border-primary mt-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p class="fs-5 m-0">Cash And Bank Book</p>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url("app/dashboard"); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url("app/account/voucher/entry"); ?>">Account</a></li>
                                    <li class="breadcrumb-item">Cash And Bank</li>
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
                                            <button class="btn btn-warning btn-sm shadow"><img src="<?php echo base_url("assets/img/icons/cashandbank.png"); ?>"></button>
                                            <strong> &nbsp;Cash And Bank Book</strong>
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <button ng-click="reset()" class="btn btn-outline-dark shadow fs-6 rounded-0 btn-sm" type="button"><img src="<?php echo base_url("assets/img/icons/close1.png"); ?>"></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card border-warning shadow">
                                                <div class="card-header">
                                                    <strong>Trial Balance</strong>
                                                </div>
                                                <div class="card-body p-0">
                                                    <table class="table table-bordered border-warning table-striped mt-3 table-sm">
                                                        <thead class="bg-warning">
                                                            <tr>
                                                                <th class="border-start-0 text-center">::</th>
                                                                <th>Particulars</th>
                                                                <th>Group</th>
                                                                <th>Op.Bal.Dr</th>
                                                                <th>Op.Bal.Cr</th>
                                                                <th>Debit(Dr)</th>
                                                                <th>Credit(Cr)</th>
                                                                <th class="border-end-0">Closing Bal.</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr ng-repeat="d1 in balances" ng-cloak>
                                                                <td class="border-start-0 text-center">
                                                                    <h5>::</h5>
                                                                </td>
                                                                <td class="text-success fw-bold">{{d1.Ledger}}</td>
                                                                <td class="text-info">{{d1.LedgerGroup}}</td>
                                                                <td>0.00</td>
                                                                <td>0.00</td>
                                                                <td class="fw-bold text-danger">{{d1.Debit}}</td>
                                                                <td class="fw-bold text-success">{{d1.Credit}}</td>
                                                                <td class="border-end-0">0.00</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <div ng-show="Spinner1" class="text-center m-t-10"><img src="<?php echo base_url('assets/img/icons/loader.png'); ?>"></div>
                                                    <hr>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row gutter">
                                        <div class="col-md-6">
                                            -
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">DEBIT</span>
                                                <input type="text" class="form-control fw-bold text-danger" ng-model="Debit" placeholder="DEBIT">
                                            </div>

                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">CREDIT</span>
                                                <input type="text" class="form-control fw-bold text-success" ng-model="Credit" placeholder="CREDIT">
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
        <?php $this->load->view("Partials/CashAndBankJs"); ?>
    </body>
</html>