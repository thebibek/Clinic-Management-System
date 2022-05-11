<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>

    <body>
        <?php $this->load->view('Partials/NavbarView'); ?>
        <div class="container-fluid" ng-app="BillApp" ng-controller="BillAppCtrl">
            <div class="card card shadow border-primary mt-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p class="fs-5 m-0">Bills Manager</p>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url("app/dashboard"); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('app/receipt'); ?>">Invoice</a></li>
                                    <li class="active"><a href="<?php echo base_url('app/bills'); ?>">Bills</a></li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <?php $this->load->view("Partials/IconBarsView"); ?>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <section ng-show="BillListingPanel">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="card border-warning shadow">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button class="btn btn-secondary btn-sm shadow"><img src="<?php echo base_url("assets/img/icons/bill3.png"); ?>"></button> &nbsp;<strong>Bills</strong>
                                            </div>
                                            <div class="col-md-6 text-end">
                                                <a href="<?php echo base_url("app/receipt"); ?>" class="btn btn-outline-dark btn-sm rounded-0 shadow"><img src="<?php echo base_url("assets/img/icons/add.png"); ?>"> Create Invoice</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="scrollbar" id="style-7">
                                            <div class="force-overflow">
                                                <table  class="table table-bordered border-warning table-striped mt-5 table-sm">
                                                    <thead class="text-white bg-warning">
                                                        <tr>
                                                            <th class="border-start-0 text-center">#</th>
                                                            <th>ReceiptNo</th>
                                                            <th>Date</th>
                                                            <th>Patient Name</th>
                                                            <th>Total Amount</th>
                                                            <th>Net Amount</th>
                                                            <th>Paid Amt</th>
                                                            <th>Due Amt</th>
                                                            <th>Payment Status</th>
                                                            <th class="border-end-0">Action</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php
                                                        $count = 1;
                                                        if (isset($bills)) {
                                                            if (!empty($bills)) {
                                                                foreach ($bills as $b) {

                                                                    //Date format according to settings
                                                                    $receiptDate = $b['ReceiptDate'];
                                                                    if ($rs2['DateFormat'] == 1) {
                                                                        $receiptDate = date('d-m-Y', strtotime($receiptDate));
                                                                    }

                                                                    if ($rs2['DateFormat'] == 2) {
                                                                        $receiptDate = date('m-d-Y', strtotime($receiptDate));
                                                                    }

                                                                    if ($rs2['DateFormat'] == 3) {
                                                                        $receiptDate = date('Y-m-d', strtotime($receiptDate));
                                                                    }
                                                                    ?>
                                                                    <tr>
                                                                        <td class="border-start-0 text-center"><button class="btn btn-secondary btn-sm"><img src="<?php echo base_url("assets/img/icons/bill2.png"); ?>"></button></td>
                                                                        <td><?php echo $b['ReceiptNo']; ?></td>
                                                                        <td><?php echo $receiptDate; ?></td>
                                                                        <td><?php echo $b['FirstName'] . " " . $b['LastName']; ?></td>
                                                                        <td><?php echo $b['TotalAmount']; ?></td>
                                                                        <td><?php echo $b['NetAmount']; ?></td>
                                                                        <td><?php echo $b['PaidAmount']; ?></td>
                                                                        <td><?php echo $b['DueAmount']; ?></td>
                                                                        <?php
                                                                        if ($b['IsPaid'] == 1) {
                                                                            $paymentStatus = 'Paid';
                                                                            $class = 'bg-success';
                                                                        } else {
                                                                            $paymentStatus = 'Pending';
                                                                            $class = 'bg-danger';
                                                                        }
                                                                        ?>
                                                                        <td><span class="badge <?php echo $class; ?>"><?php echo $paymentStatus; ?></span></td>
                                                                        <td class="border-end-0">
                                                                            <?php
                                                                            if ($b['IsPaid'] == 0 && $this->aauth->is_admin()) {
                                                                                ?>
                                                                                <a href="#" ng-click="clearDues(<?php echo $b['ReceiptNo']; ?>)"  type="button"><img src="<?php echo base_url("assets/img/payment.png"); ?>"  title="Clear Dues"></a>
                                                                                <?php
                                                                            } else {
                                                                                ?>
                                                                                <a href="#"><img src="<?php echo base_url("assets/img/prohibit.png"); ?>"></a>
                                                                                <?php
                                                                            }
                                                                            ?>


                                                                            <?php
                                                                            if ($this->aauth->is_allowed('Print Report')) {
                                                                                ?>
                                                                                <a href="<?php echo base_url('app/print/bill/' . $b['ReceiptNo']); ?>" target="_blank" title="Print Bill"><img src="<?php echo base_url("assets/img/print.png"); ?>"></a>    
                                                                                <?php
                                                                            } else {
                                                                                ?>
                                                                                <a href="#"><img src="<?php echo base_url("assets/img/prohibit.png"); ?>"></a>
                                                                                <?php
                                                                            }
                                                                            ?>    


                                                                            <?php
                                                                            if ($this->aauth->is_allowed('Delete')) {
                                                                                ?>
                                                                                <a href="#" ng-click="deleteBill(<?php echo $b['ReceiptID']; ?>)"><img src="<?php echo base_url("assets/img/delete.png"); ?>"></a>
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
                                                                                <a href="#" ng-click="editBill(<?php echo $b['ReceiptID']; ?>)"><img src="<?php echo base_url("assets/img/edit.png"); ?>"></a>
                                                                                <?php
                                                                            } else {
                                                                                ?>
                                                                                <a href="#"><img src="<?php echo base_url("assets/img/prohibit.png"); ?>"></a>
                                                                                <?php
                                                                            }
                                                                            ?>    
                                                                        </td>
                                                                    </tr>
                                                                    <?php
                                                                    $count++;
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <?php $this->load->view("Bill/EditReceiptView"); ?>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="ClearDuesModal" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Clear Dues</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Net Amount</label>
                            <input class="form-control" type="text" placeholder="Net Amount" id="NetAmount" ng-model="NetAmountModel" readonly="">
                        </div>
                        <div class="form-group">
                            <label>Paid Amount</label>
                            <input class="form-control" type="text" placeholder="Paid Amount" id="PaidAmount" ng-model="PaidAmountModel" readonly="">
                        </div>
                        <div class="form-group">
                            <label>Dues Amount</label>
                            <input class="form-control" type="text" placeholder="Dues Amount" id="DuesAmount" ng-model="DuesAmountModel" readonly="">
                        </div>
                        <div class="form-group">
                            <label>Enter Dues Amount</label>
                            <input class="form-control" type="text" ng-model="PayAmountModel" id="PayAmount" placeholder="Enter Dues Amount">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="SaveDues" class="btn btn-warning">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->load->view("Partials/FooterView"); ?>
        <?php $this->load->view("Partials/TestJs"); ?>
        <?php $this->load->view("Partials/JqueryUI"); ?>
        <?php $this->load->view("Partials/AngularJs"); ?>
        <?php $this->load->view("Partials/SweetAlertJs"); ?>
        <?php $this->load->view("Partials/BillJs"); ?>
    </body>
</html>