<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>

    <body>
        <?php $this->load->view('Partials/NavbarView'); ?>
        <div class="container-fluid" ng-app="BalanceSheetApp" ng-controller="BalanceSheetAppCtrl">
            <div class="card shadow border-primary mt-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p class="fs-5 m-0">Balance Sheet</p>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url("app/dashboard"); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url("app/account/profit/loss"); ?>">Profit and Loss</a></li>
                                    <li class="breadcrumb-item active">Balance Sheet</li>
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
                                            <button class="btn btn-warning btn-sm shadow"><img src="<?php echo base_url("assets/img/icons/balance.png"); ?>"></button>
                                            <strong> &nbsp;Balance Sheet As On <span class="text-danger"><?php echo date('Y-m-d'); ?></span></strong>
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <a href="<?php echo base_url("app/account/balance/sheet"); ?>"  class="btn btn-outline-dark shadow fs-6  rounded-0 btn-sm"><img src="<?php echo base_url("assets/img/icons/close1.png"); ?>"></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <strong class="text-danger">Liabilities</strong>
                                                </div>
                                                <div class="panel-body">
                                                    <table class="table table-striped table-bordered border-warning">
                                                        <thead>
                                                            <tr>
                                                                <th>::</th>
                                                                <th>Particulars</th>
                                                                <th>Amount</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr ng-repeat="d1 in liabilities" ng-cloak>
                                                                <td>
                                                                    <h5 class="fw-bold">::</h5>
                                                                </td>
                                                                <td>{{d1.Ledger}}</td>
                                                                <td class="text-success">{{d1.Credit}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <strong class="text-success">Assets</strong>
                                                </div>
                                                <div class="panel-body">
                                                    <table class="table table-striped table-bordered border-primary">
                                                        <thead>
                                                            <tr>
                                                                <th>::</th>
                                                                <th>Particulars</th>
                                                                <th>Amount</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr ng-repeat="d2 in assets" ng-cloak>
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
                                            <div class="input-group mb-3">
                                                <span class="input-group-text bg-warning text-white border-warning" id="basic-addon1">Total</span>
                                                <input type="text" class="form-control fw-bold text-danger border-warning" ng-model="TotalLiabilities">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text bg-primary text-white border-primary" id="basic-addon1">Total</span>
                                                <input type="text" class="form-control fw-bold text-danger border-primary" ng-model="TotalAssets">
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
        <?php $this->load->view("Partials/BalanceSheetJs"); ?>
    </body>
</html>