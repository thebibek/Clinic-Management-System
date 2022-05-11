<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>

    <body>
        <?php $this->load->view('Partials/NavbarView'); ?>
        <div class="container-fluid" ng-app="ProfitAndLossApp" ng-controller="ProfitAndLossAppCtrl">
            <div class="card card shadow border-primary mt-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p class="fs-5 m-0">Profit And Loss Account</p>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url("app/dashboard"); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url("app/account/profit/loss"); ?>">Account</a></li>
                                    <li class="breadcrumb-item">Profit & Loss</li>
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
                                            <button class="btn btn-warning btn-sm shadow"><img src="<?php echo base_url("assets/img/icons/profit1.png"); ?>"></button>
                                            <strong> &nbsp;Profit & Loss</strong>
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <button ng-click="reset()" class="btn btn-outline-dark shadow fs-6 rounded-0  btn-sm" type="button"><img src="<?php echo base_url("assets/img/icons/close1.png"); ?>"></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row ">
                                        <div class="col-md-6">
                                            <div class="card border-warning shadow">
                                                <div class="card-header">
                                                    <strong class="text-danger">Dr</strong>
                                                </div>
                                                <div class="card-body">
                                                    <table class="table table-striped table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>::</th>
                                                                <th>Particulars</th>
                                                                <th>Amount</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr ng-repeat="d1 in expenses" ng-cloak>
                                                                <td>
                                                                    <h5 class="fw-bold">::</h5>
                                                                </td>
                                                                <td>{{d1.Ledger}}</td>
                                                                <td class="text-success">{{d1.Debit}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card border-warning shadow">
                                                <div class="card-header">
                                                    <strong class="text-danger">Cr</strong>
                                                </div>
                                                <div class="card-body">
                                                    <table class="table table-striped table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>::</th>
                                                                <th>Particulars</th>
                                                                <th>Amount</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr ng-repeat="d2 in incomes" ng-cloak>
                                                                <td>
                                                                    <h5 class="fw-bold">::</h5>
                                                                </td>
                                                                <td>{{d2.Ledger}}</td>
                                                                <td class="text-success">{{d2.Credit}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group mt-3">
                                                <span class="input-group-text bg-danger text-white border-danger" id="basic-addon1">NET PROFIT</span>
                                                <input type="text" class="form-control fw-bold text-danger border-danger" ng-model="Profit" placeholder="DEBIT">
                                            </div>

                                            <br>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text text-white bg-success border-success" id="basic-addon1">DEBIT BALANCE</span>
                                                <input type="text" class="form-control fw-bold text-danger border-success" ng-model="DebitBalance" placeholder="DEBIT">
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text bg-secondary text-white border-secondary" id="basic-addon1">CREDIT BALANCE</span>
                                                <input type="text" class="form-control fw-bold text-danger border-secondary" ng-model="CreditBalance" placeholder="DEBIT">
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
        <?php $this->load->view("Partials/ProfitAndLossJs"); ?>
    </body>
</html>