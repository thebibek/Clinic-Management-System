<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>

    <body>
        <?php $this->load->view('Partials/NavbarView'); ?>
        <div class="container-fluid" ng-app="PendingReportApp" ng-controller="PendingReportAppCtrl">
            <div class="card card shadow border-primary mt-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p class="fs-5 m-0">Pending Reports Manager</p>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url("app/dashboard"); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('app/report'); ?>">Report</a></li>
                                    <li class="breadcrumb-item active">Pending Reports</li>
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
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card  border-warning  p-0">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button class="btn btn-warning btn-sm shadow"><img src="<?php echo base_url("assets/img/icons/list2.png"); ?>"></button><strong> &nbsp;&nbsp;Pending Reports</strong>
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <a class="btn btn-outline-dark rounded-0 btn-sm" href="<?php echo base_url("app/report"); ?>"><img src="<?php echo base_url("assets/img/icons/add.png"); ?>">Create Report</a>
                                        </div>
                                    </div>

                                </div>
                                <div class="panel-body pad-0" >
                                    <div class="scrollbar" id="style-7">
                                        <div class="force-overflow">
                                            <table  class="table table-bordered border-warning table-striped mt-5 table-sm">
                                                <thead class="bg-warning text-white">
                                                    <tr>
                                                        <th class="border-start-0 text-center">#</th>
                                                        <th>ReceiptNo</th>
                                                        <th>Date</th>
                                                        <th>Patient Name</th>
                                                        <th>Net Amount</th>
                                                        <th>Paid Amt</th>
                                                        <th>Due Amt</th>
                                                        <th>Payment Status</th>
                                                        <th>Report Status</th>
                                                        <th class="border-end-0">Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php
                                                    $count = 1;
                                                    if (isset($pendingReports)) {
                                                        if (!empty($pendingReports)) {
                                                            foreach ($pendingReports as $r) {

                                                                //Date format according to settings
                                                                $receiptDate = $r['ReceiptDate'];
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
                                                                    <td class="border-start-0 text-center"><button class="btn btn-success btn-sm"><img src="<?php echo base_url("assets/img/icons/report5.png"); ?>"></button></td>
                                                                    <td><?php echo $r['ReceiptNo']; ?></td>
                                                                    <td><?php echo $receiptDate; ?></td>
                                                                    <td><?php echo $r['FirstName'] . " " . $r['LastName']; ?></td>
                                                                    <td><?php echo $r['NetAmount']; ?></td>
                                                                    <td><?php echo $r['PaidAmount']; ?></td>
                                                                    <td><?php echo $r['DueAmount']; ?></td>
                                                                    <?php
                                                                    if ($r['IsPaid'] == 1) {
                                                                        $paymentStatus = 'Paid';
                                                                        $class = 'bg-success';
                                                                    } else {
                                                                        $paymentStatus = 'Pending';
                                                                        $class = 'bg-danger';
                                                                    }
                                                                    ?>
                                                                    <td><span class="badge <?php echo $class; ?>"><?php echo $paymentStatus; ?></span></td>
                                                                    <td><span class="badge bg-danger">Pending</span></td>
                                                                    <td class="border-end-0">
                                                                        <?php
                                                                        if ($r['IsPaid'] == 0 && $this->aauth->is_admin()) {
                                                                            ?>
                                                                            <a href="#" ng-click="clearDues(<?php echo $r['ReceiptNo']; ?>)"  type="button"><img src="<?php echo base_url("assets/img/payment.png"); ?>"></a>
                                                                            <?php
                                                                        }
                                                                        ?>

                                                                        <?php
                                                                        if ($r['IsReportGenerated'] == 0 && $this->aauth->is_allowed('Edit')) {
                                                                            ?>
                                                                            <a title="Report" href="<?php echo base_url("app/report/pending/" . $r['ReceiptNo']); ?>"><img src="<?php echo base_url("assets/img/edit.png"); ?>"></a>
                                                                            <?php
                                                                        } else {
                                                                            ?>
                                                                            <a title="Report" href="#"><img src="<?php echo base_url("assets/img/prohibit.png"); ?>"></a>
                                                                            <?php
                                                                        }
                                                                        ?>

                                                                        <?php
                                                                        if ($this->aauth->is_admin() || $this->aauth->is_allowed('DeleteReport')) {
                                                                            ?>
                                                                            <a title="Delete" href="#" ng-click="deleteReport(<?php echo $r['ReceiptID']; ?>)"><img src="<?php echo base_url("assets/img/delete.png"); ?>"></a>
                                                                            <?php
                                                                        } else {
                                                                            ?>
                                                                            <a title="Delete Disabled" href="#"><img src="<?php echo base_url("assets/img/delete2.png"); ?>"></a>
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
        <?php $this->load->view("Partials/PendingReportJs"); ?>
    </body>
</html>