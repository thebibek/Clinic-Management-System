<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>

    <body>
        <?php $this->load->view('Partials/NavbarView'); ?>
        <div class="container-fluid"  ng-app="PurchaseManageApp" ng-controller="PurchaseManageAppCtrl">
            <div class="card border-primary shadow mt-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row gutter">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="page-title">
                                                <h3>Purchase Bill</h3>
                                                <ol class="breadcrumb">
                                                    <li><a href="<?php echo base_url(); ?>">Dashboard</a></li>
                                                    <li><a href="<?php echo base_url('app/item/inward'); ?>">Purchase</a></li>
                                                    <li class="active">Purchase Bill</li>
                                                </ol>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-right">
                                            <?php $this->load->view("Partials/IconBarsView"); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="invoice">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row gutter">
                                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12"><a href="#"><img src="<?php echo base_url('assets/img/fav.png'); ?>" alt="Logo" class="logo" width="50" height="50"></a></div>
                                            <div class="col-md-9 col-sm-8 col-xs-12">
                                                <div class="text-end">
                                                    <h4 class="fw-bold text-danger">Invoice</h4>
                                                    <h4 class=" text-info"><?php echo isset($bill['BillNo']) ? $bill['BillNo'] : "xxxxxxxx"; ?></h4>
                                                    <p class="text-info"><?php echo isset($bill['PurchaseDate']) ? $bill['PurchaseDate'] : ""; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <hr><br><br>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <address>
                                                    <h4 class="text-danger fw-bold"><?php echo isset($bill['Vendor']) ? $bill['Vendor'] : ''; ?></h4>
                                                    <abbr><?php echo isset($bill['Address']) ? $bill['Address'] : "" ?></abbr>
                                                    <br>
                                                    <abbr title="email">E-mail:</abbr> 
                                                    <a href="mailto:#"  title="">xxxxxxxxxxxx</a>
                                                    <br>
                                                    <abbr title="Phone">Phone:</abbr> <?php echo isset($bill['ContactNo']) ? $bill['ContactNo'] : ""; ?><br>
                                                    <abbr title="Fax">Fax:</abbr> xxxxxxxxxxxxx
                                                </address>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <address class="text-end">
                                                    <h4 class="text-success fw-bold"><?php echo isset($rs['LabName']) ? $rs['LabName'] : ""; ?></h4>
                                                    <abbr><?php echo isset($rs['Address']) ? $rs['Address'] : ""; ?></abbr><br>
                                                    <abbr title="email">E-mail:</abbr> 
                                                    <a href="mailto:#"  title=""><?php echo isset($rs['Email']) ? $rs['Email'] : ""; ?></a><br>
                                                    <abbr title="Phone">Phone:</abbr> <?php echo isset($rs['PhoneNo1']) ? $rs['PhoneNo1'] : ""; ?>,<?php echo isset($rs['PhoneNo2']) ? $rs['PhoneNo2'] : ""; ?><br>
                                                    <abbr title="Fax">Fax:</abbr> xxxxxxxxxxxx
                                                </address>
                                            </div>
                                        </div><br>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table class="table table-striped border-primary table-sm table-bordered text-center align-middle">
                                                        <thead>
                                                            <tr>
                                                                <th style="width:10%">Sl. No.</th>
                                                                <th style="width:20%">Product Name</th>
                                                                <th style="width:40%">Description</th>
                                                                <th style="width:10%">Quantity</th>
                                                                <th style="width:10%">Price</th>
                                                                <th style="width:10%">Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            if (isset($items) && !empty($items)) {
                                                                foreach ($items as $key => $val) {
                                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo $key + 1; ?></td>
                                                                        <td><?php echo $val['ItemName']; ?></td>
                                                                        <td><?php echo $val['Description'] ?></td>
                                                                        <td><span class="btn btn-info btn-sm shadow"><?php echo $val['Quantity']; ?></span></td>
                                                                        <td><?php echo $val['Rate']; ?></td>
                                                                        <td><?php echo $val['Total']; ?></td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <?php
                                                if (isset($billId)) {
                                                    $id = $billId;
                                                } else {
                                                    $id = 0;
                                                }
                                                ?>
                                                <div class="btn-group">
                                                    <?php
                                                    if ($this->aauth->is_allowed('Print')) {
                                                        ?>
                                                        <a href="<?php echo base_url('app/purchase/bill/print/') . $id; ?>" target="_blank" class="btn btn-info">Print</a>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <a href="#"  class="btn btn-info">Print Denied</a>
                                                        <?php
                                                    }
                                                    ?>

                                                    <a href="<?php echo base_url('app/manage/purchase'); ?>" class="btn btn-danger">Close</a>
                                                </div>
                                            </div>
                                        </div><br><br>
                                        <div class="row">
                                            <div class="col-md-12 col-lg-12 text-end">
                                                <div class="btn btn-warning"><strong>Total</strong><br><strong>$<?php echo isset($bill['BillAmount']) ? $bill['BillAmount'] : ""; ?></strong></div>
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
        <?php $this->load->view("Partials/PurchaseManagerJs"); ?>
    </body>
</html>