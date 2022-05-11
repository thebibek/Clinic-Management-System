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
                            <p class="fs-5 m-0">Completed Report Manager</p>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url("app/dashboard"); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('app/report'); ?>">Report</a></li>
                                    <li class="breadcrumb-item active">Completed Report</li>
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
                            <div class="card border-warning shadow p-0">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button class="btn btn-danger btn-sm"><img src="<?php echo base_url("assets/img/icons/list2.png"); ?>"></button><strong> &nbsp;&nbsp;Completed Reports</strong>
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <a class="btn btn-outline-dark rounded-0 btn-sm shadow" href="<?php echo base_url("app/report"); ?>"><img src="<?php echo base_url("assets/img/icons/add.png"); ?>">Create Report</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body p-0" >
                                    <div class="scrollbar" id="style-7">
                                        <div class="force-overflow">
                                            <table  class="table table-bordered border-warning table-striped mt-5 table-sm">
                                                <thead class="bg-warning text-white">
                                                    <tr>
                                                        <th class="border-start-0 text-center">#</th>
                                                        <th>ReportNo</th>
                                                        <th>MRNo</th>
                                                        <th>Date</th>
                                                        <th>Patient Name</th>
                                                        <th>Report Status</th>
                                                        <th class="border-end-0">Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php
                                                    $count = 1;
                                                    if (isset($completedReports)) {
                                                        if (!empty($completedReports)) {
                                                            foreach ($completedReports as $r) {

                                                                $receiptNo = $r['ReceiptNo'];
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
                                                                    <td class="border-start-0 text-center"><?php echo $count; ?></td>
                                                                    <td class="text-green fw-bold"><?php echo $receiptNo; ?></td>
                                                                    <td class="text-danger fw-bold"><?php echo $r['MRNo']; ?></td>
                                                                    <td><?php echo $receiptDate; ?></td>
                                                                    <td><?php echo $r['FirstName'] . " " . $r['LastName']; ?></td>
                                                                    <td><span class="badge bg-info">completed</span></td>

                                                                    <td class="border-end-0">
                                                                        <?php
                                                                        if ($this->aauth->is_allowed('PrintReport')) {
                                                                            ?>
                                                                            <a href="<?php echo base_url("app/print/report/" . $receiptNo); ?>" target="_blank" title="Print Report" ng-click="deleteDoctor(<?php echo $r['ID']; ?>)"><img src="<?php echo base_url("assets/img/print.png"); ?>"></a> 
                                                                            <?php
                                                                        } else {
                                                                            ?>
                                                                            <a href="#"  title="Print Report Disabled"><img src="<?php echo base_url("assets/img/prohibit.png"); ?>"></a> 
                                                                            <?php
                                                                        }
                                                                        ?>

                                                                        <?php
                                                                        if ($this->aauth->is_allowed('Edit')) {
                                                                            ?>
                                                                            <a href="<?php echo base_url("app/report/pending/" . $receiptNo); ?>" title="Edit" ng-click="editDoctor(<?php echo $r['ID']; ?>)"><img src="<?php echo base_url("assets/img/edit.png"); ?>"></a>
                                                                            <?php
                                                                        } else {
                                                                            ?>
                                                                            <a href="#" title="Edit"><img src="<?php echo base_url("assets/img/prohibit.png"); ?>"></a>
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