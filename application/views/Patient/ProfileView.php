<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>

    <body>
        <?php $this->load->view('Partials/NavbarView'); ?>
        <div class="container-fluid"  ng-app="CategoryApp" ng-controller="CategoryAppCtrl">
            <div class="card border-primary shadow mt-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p class="fs-5 m-0">Patient Profile</p>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url("app/dashboard"); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url("app/patient/registration"); ?>">Patient</a></li>
                                    <li class="breadcrumb-item active">Profile</li>
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
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="card border-warning shadow">
                                <div class="card-body text-center p-5">
                                    <div class="user-profile clearfix">
                                        <?php
                                        if (isset($profile['Image']) && !empty($profile['Image'])) {
                                            $bloodGroup = $profile['BloodGroup'];
                                            $src = base_url('assets/uploads/') . $profile['Image'];
                                        } else {
                                            $bloodGroup = 'NA';
                                            $src = base_url("assets/uploads/default.png");
                                        }
                                        ?>

                                        <div class="box"><img src="<?php echo $src; ?>" alt="Patient Info" class="img-thumbnail"></div>
                                        <?php
                                        if (isset($profile) && !empty($profile)) {
                                            echo '<h4 class="mb-0">' . $profile['FirstName'] . " " . $profile['LastName'] . '</h4>';
                                            echo '<p>Age:' . $profile['Age'] . '</p>';
                                            echo '<h5 class="mb-0 text-danger fw-bold">MR No: ' . $profile['MRNo'] . '</h5>';
                                            echo '<p class="mb-0">' . $profile['Address'] . '</p>';
                                            echo '<p class="mb-0">' . $profile['MobileNo'] . '</p>';
                                        }
                                        ?>
                                        <p><img src="<?php echo base_url('assets/img/icons/blood1.png'); ?>"> <span>Blood Group : <?php echo $bloodGroup; ?></span></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                            <div class="row gutter">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="card border-warning shadow">
                                        <div class="card-header">
                                            <h4> History</h4>
                                        </div>
                                        <div class="card-body p-0">
                                            <div class="scrollbar" id="style-7">
                                                <div class="force-overflow bg-light">
                                                    <h5 class="fw-bold text-danger text-center mt-2">Pathology Tests</h5>
                                                    <table class="table table-bordered border-warning table-striped mt-3 table-sm">
                                                        <thead class="bg-warning">
                                                            <tr>
                                                                <th class="border-start-0 text-center">#</th>
                                                                <th>ReceiptNo</th>
                                                                <th>Receipt Date</th>
                                                                <th>Net Amount</th>
                                                                <th>PaidAmount</th>
                                                                <th>Test</th>
                                                                <th class="border-end-0">Charges</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            if (isset($test) && !empty($test)) {
                                                                foreach ($test as $value) {
                                                                    ?>
                                                                    <tr>
                                                                        <td class="border-start-0 text-center"><button class="btn btn-success btn-sm shadow" type="button"><img src="<?php echo base_url("assets/img/icons/location.png"); ?>"></button></td>
                                                                        <td><?php echo $value['ReceiptNo']; ?></td>
                                                                        <td class="text-danger fw-bold"><?php echo $value['ReceiptDate']; ?></td>
                                                                        <td><span class="badge bg-danger"><?php echo $value['NetAmount']; ?></span></td>
                                                                        <td><?php echo $value['PaidAmount']; ?></td>
                                                                        <td class="fs-6"><?php echo $value['TestDescription']; ?></th>
                                                                        <td class="border-end-0"><?php echo $value['Charges']; ?></td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                    <br>
                                                    <h5 class="fw-bold text-center">Visits</h5>
                                                    <table class="table table-bordered border-primary table-striped mt-3 table-sm">
                                                        <thead class="bg-primary">
                                                            <tr>
                                                                <th class="border-start-0 text-center">#</th>
                                                                <th>Visit Date</th>
                                                                <th>ReceiptNo</th>
                                                                <th>NetAmount</th>
                                                                <th>PaidAmount</th>
                                                                <th>DueAmount</th>
                                                                <th class="border-end-0">Report Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            if (isset($visit) && !empty($visit)) {
                                                                foreach ($visit as $value) {
                                                                    ?>
                                                                    <tr>
                                                                        <td class="border-start-0 text-center"><button class="btn btn-success btn-sm shadow" type="button"><img src="<?php echo base_url("assets/img/icons/location.png"); ?>"></button></td>
                                                                        <td><?php echo $value['ReceiptDate']; ?></td>
                                                                        <td class="text-danger fw-bold"><?php echo $value['ReceiptNo']; ?></td>
                                                                        <td><span class="badge bg-danger"><?php echo $value['NetAmount']; ?></span></td>
                                                                        <td><?php echo $value['PaidAmount']; ?></td>
                                                                        <td class="text-info fw-bold"><?php echo $value['DueAmount']; ?></th>
                                                                        <td class="border-end-0">
                                                                            <?php
                                                                            if ($value['IsReportGenerated'] == 1) {
                                                                                echo 'Yes';
                                                                            } else {
                                                                                echo 'No';
                                                                            }
                                                                            ?>
                                                                        </td>
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
        <?php $this->load->view("Partials/CategoryJs"); ?>
    </body>
</html>