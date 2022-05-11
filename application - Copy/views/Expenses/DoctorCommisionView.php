<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>

    <body>
        <?php $this->load->view('Partials/NavbarView'); ?>
        <div class="container-fluid" ng-app="DoctorComissionApp" ng-controller="DoctorComissionAppCtrl">
            <div class="card card shadow border-primary mt-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p class="fs-5 m-0">Doctor Commision Manager</p>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url("app/dashboard"); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('app/doctor'); ?>">Doctor</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Doctor Commision</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <?php $this->load->view("Partials/IconBarsView"); ?>
                        </div>
                    </div>


                </div>
                <div class="card-body">
                    <!--List Panel Of doctor Comission-->
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card shadow border-warning" ng-show="CommissionListPanel">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button class="btn btn-warning btn-sm shadow"><img src="<?php echo base_url("assets/img/icons/list.png"); ?>"></button>
                                            <strong> Manage Commision</strong>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex justify-content-end">
                                                <a href="<?php echo base_url("app/doctor"); ?>" class="btn btn-outline-dark rounded-0 btn-sm"><img src="<?php echo base_url("assets/img/icons/list1.png"); ?>"><strong>ALL DOCTORS</strong></a>
                                                <a href="<?php echo base_url("app/doctor"); ?>" class="btn btn-outline-dark rounded-0 btn-sm"><img src="<?php echo base_url("assets/img/icons/close1.png"); ?>"></a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="scrollbar" id="style-7">
                                        <div class="force-overflow">
                                            <table  class="table table-bordered border-warning table-striped mt-5 table-sm">
                                                <thead class="bg-warning">
                                                    <tr>
                                                        <th class="border-start-0 text-center">#</th>
                                                        <th>ReceiptNo</th>
                                                        <th>Net Amt</th>
                                                        <th>Patient</th>
                                                        <th>Doctor</th>
                                                        <th>Commision</th>
                                                        <th>Comm Amt</th>
                                                        <th>Pay Amount</th>
                                                        <th>Status</th>
                                                        <th class="border-end-0">Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php
                                                    $count = 1;
                                                    if (isset($doctorCommisions)) {
                                                        if (!empty($doctorCommisions)) {
                                                            foreach ($doctorCommisions as $d) {
                                                                $doctorName = $d['Salutation'] . " " . $d['FirstName'] . " " . $d['LastName'];
                                                                ?>
                                                                <tr>
                                                                    <td class="border-start-0 text-center">
                                                                        <button class="btn btn-danger btn-sm">
                                                                            <img src="<?php echo base_url("assets/img/icons/comm.png"); ?>">
                                                                        </button>
                                                                    </td>
                                                                    <td class="text-danger text-bold"><?php echo $d['ReceiptNo']; ?></td>
                                                                    <td class="text-green text-bold"><?php echo $d['NetAmount']; ?></td>
                                                                    <td><?php echo $d['PatientName']; ?></td>
                                                                    <td><?php echo $d['Salutation'] . " " . $d['FirstName'] . " " . $d['LastName']; ?></td>
                                                                    <td class="text-warning text-bold"><?php echo $d['Commision'] . '%'; ?></td>
                                                                    <td><?php echo $d['CommisionAmount']; ?></td>
                                                                    <td><?php echo $d['PayAmount']; ?></td>
                                                                    <?php
                                                                    if ($d['IsPaid'] == 1) {
                                                                        echo '<td><span class="badge bg-info">Paid</span></td>';
                                                                    } else {
                                                                        echo '<td><span class="badge bg-danger">Not Paid</span></td>';
                                                                    }
                                                                    ?>
                                                                    <td class="border-end-0">
                                                                        <?php
                                                                        if ($this->aauth->is_allowed('MakePayment')) {
                                                                            if ($d['IsPaid'] == 0) {
                                                                                echo '<a href="#" ng-click="payCommission(' . $d['CommisionID'] . ',' . $d['PayAmount'] . ');" class="btn btn-success shadow btn-sm">Pay Now</a>';
                                                                            }
                                                                        }
                                                                        ?>

                                                                        <?php
                                                                        if ($this->aauth->is_allowed('Delete')) {
                                                                            ?>
                                                                            <a href="#" ng-click="deleteCommssion(<?php echo $d['CommisionID']; ?>)"><img src="<?php echo base_url("assets/img/delete.png"); ?>"></a>
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
                                                                            <a href="#" ng-click="editCommssion(<?php echo $d['CommisionID']; ?>, '<?php echo $doctorName; ?>')"><img src="<?php echo base_url("assets/img/edit.png"); ?>"></a> 
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
                            <div class="card border-warning shadow" ng-show="CommissionEditPanel">
                                <div class="card-header">
                                    <h4><img src="<?php echo base_url("assets/img/icons/add2.png"); ?>"> Update Doctor Commission</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Receipt No</label>
                                                        <input class="form-control input-sm" type="text" name="ReceiptNo" ng-model="ReceiptNoModel" readonly="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row white-bg">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Doctor Name</label>
                                                        <input class="form-control input-sm" type="text" name="Doctor" ng-model="DoctorModel" readonly="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Commission Amount</label>
                                                        <input class="form-control input-sm" type="text" name="CommissionAmount" ng-model="CommissionAmountModel" readonly="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Pay Amount</label>
                                                        <input class="form-control input-sm" type="text" name="PayAmount" ng-model="PayAmountModel" placeholder="Enter Pay Amount">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row white-bg">
                                        <div class="col-md-12">
                                            <div class="btn-box">
                                                <button class="btn btn-warning" ng-click="updateDoctorCommision()" type="button"><span class="icon-save"></span> Update</button>
                                                <a href="<?php echo base_url('app/doctor/commision'); ?>" class="btn btn-danger"><span class="icon-close"></span> Close</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Of List Panel-->
                </div>
            </div>
        </div>

        <!--Footer Part-->
        <?php $this->load->view("Partials/FooterView"); ?>
        <?php $this->load->view("Partials/TestJs"); ?>
        <?php $this->load->view("Partials/JqueryUI"); ?>
        <?php $this->load->view("Partials/AngularJs"); ?>
        <?php $this->load->view("Partials/SweetAlertJs"); ?>
        <?php $this->load->view("Partials/DoctorCommissionJs"); ?>
        <!--End Footer Part-->
    </body>
</html>