<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>

    <body>
        <?php $this->load->view('Partials/NavbarView'); ?>
        <div class="container-fluid" ng-app="DoctorApp" ng-controller="DoctorAppCtrl">
            <div class="card card shadow border-primary mt-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p class="fs-5 m-0">Doctors</p>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Doctors</li>
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
                        <div class="col-md-12">
                            <div class="card border-warning shadow" ng-show="ListPanel">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button class="btn btn-warning btn-sm shadow"><img src="<?php echo base_url("assets/img/icons/list.png"); ?>"></button>
                                            <strong> &nbsp;Manage Doctors</strong>
                                        </div>
                                        <div class="col-md-6">
                                            <a class="btn btn-outline-dark shdow rounded-0 btn-sm float-end" href="<?php echo base_url("app/doctor/list/print"); ?>" target="_blank" ng-click="printDoctor()"><img src="<?php echo base_url("assets/img/icons/print1.png"); ?>"> Print</a>
                                            <button class="btn btn-outline-dark rounded-0 btn-sm float-end" ng-click="showAddPanel()" type="button"><img src="<?php echo base_url("assets/img/icons/add.png"); ?>"> Add Doctor</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="scrollbar" id="style-7">
                                        <div class="force-overflow">
                                            <table class="table table-bordered border-warning table-striped mt-5 table-sm">
                                                <thead class="bg-warning">
                                                    <tr>
                                                        <th class="border-start-0 text-center">#</th>
                                                        <th>Doctor</th>
                                                        <th>Designation</th>
                                                        <th>MobileNo</th>
                                                        <th>Department</th>
                                                        <th>Hospital</th>
                                                        <th>Commision</th>
                                                        <th>Status</th>
                                                        <th class="border-end-0">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $count = 1;
                                                    if (isset($doctors)) {
                                                        if (!empty($doctors)) {
                                                            foreach ($doctors as $d) {
                                                                ?>
                                                                <tr>
                                                                    <td class="border-start-0 text-center">
                                                                        <button class="btn btn-info btn-sm shadow" type="button">

                                                                            <img src="<?php echo base_url("assets/img/icons/doctor1.png"); ?>">
                                                                        </button>
                                                                    </td>
                                                                    <td>
                                                                        <span class="text-red text-bold"><?php echo $d['Salutation'] . " " . $d['FirstName'] . " " . $d['LastName']; ?></span>
                                                                    </td>
                                                                    <td><?php echo $d['Designation']; ?></td>
                                                                    <td>
                                                                        <span class="text-green text-bold"><?php echo $d['MobileNo']; ?></span>
                                                                    </td>
                                                                    <td><?php echo $d['Department']; ?></td>
                                                                    <td>
                                                                        <?php echo $d['Hospital']; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $d['Commision'] . '%'; ?>
                                                                    </td>
                                                                    <td><?php echo $d['IsDrActive'] == 1 ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>'; ?></td>
                                                                    <td class="border-end-0">
                                                                        <?php
                                                                        if ($this->aauth->is_allowed('Delete')) {
                                                                            ?>
                                                                            <a href="#" ng-click="deleteDoctor(<?php echo $d['DoctorID']; ?>)"><img src="<?php echo base_url("assets/img/delete.png"); ?>"></a>
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
                                                                            <a href="#" ng-click="editDoctor(<?php echo $d['DoctorID']; ?>)"><img src="<?php echo base_url("assets/img/edit.png"); ?>"></a>
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
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card border-warning shadow" ng-show="AddPanel">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button class="btn btn-success btn-sm shadow"><img src="<?php echo base_url("assets/img/icons/add.png"); ?>"></button>
                                            <strong> &nbsp;Add New Doctor</strong>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <button class="btn btn-outline-dark rounded-0 btn-sm float-end" ng-click="reset()"><img src="<?php echo base_url("assets/img/icons/list1.png"); ?>"> Doctor List</button>
                                            <button ng-click="reset()" class="btn btn-outline-dark rounded-0 btn-sm float-end" type="button"><img src="<?php echo base_url("assets/img/icons/close1.png"); ?>"></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label"><strong>Salutation</strong><span class="text-danger">*</span></label>
                                                <select class="form-select bg-light border-warning" ng-model="SalutationModel">
                                                    <option value="">Please select salutation</option>
                                                    <option value="Dr">Dr</option>
                                                    <option value="Mr">Mr</option>
                                                    <option value="Miss">Miss</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label"><strong>First Name</strong><span class="text-bold text-18 text-red">*</span></label>
                                                <input class="form-control bg-light border-warning" type="text" name="FirstName" ng-model="FirstNameModel" placeholder="Enter First Name">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label"><strong>Last Name</strong><span class="text-bold text-18 text-red">*</span></label>
                                                <input class="form-control bg-light border-warning" type="text" name="LastName" ng-model="LastNameModel" placeholder="Enter Last Name">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label"><strong>Mobile No</strong><span class="text-bold text-18 text-red">*</span></label>
                                                <input class="form-control bg-light border-warning" type="text" name="MobileNo" ng-model="MobileNoModel" placeholder="Enter Mobile No">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label"><strong>Email</strong></label>
                                                <input class="form-control bg-light border-warning" type="text" name="Email" ng-model="EmailModel" placeholder="Enter Email">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label"><strong>Designation</strong><span class="text-bold text-18 text-red">*</span></label>
                                                <input class="form-control bg-light border-warning" type="text" name="Designation" ng-model="DesignationModel" placeholder="Enter Designation">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label"><strong>Department</strong><span class="text-bold text-18 text-red">*</span></label>
                                                <select class="form-select bg-light border-warning" ng-model="DepartmentModel">
                                                    <option value="">Please Select Department</option>
                                                    <option ng-repeat="d1 in departments" value="{{d1.ID}}">{{d1.Department}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label"><strong>Specialist</strong><span class="text-bold text-18 text-red">*</span></label>
                                                <input class="form-control bg-light border-warning" type="text" name="Specialist" ng-model="SpecialistModel" placeholder="Enter Specialist In">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label"><strong>Qualification</strong></label>
                                                <input class="form-control bg-light border-warning" type="text" name="Qualification" ng-model="QualificationModel" placeholder="Enter Qualification">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label"><strong>Address</strong><span class="text-bold text-18 text-red">*</span></label>
                                                <input class="form-control bg-light border-warning" type="text" name="Address" ng-model="AddressModel" placeholder="Enter Address">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label"><strong>Hospital</strong><span class="text-bold text-18 text-red">*</span></label>
                                                <input class="form-control bg-light border-warning" type="text" name="Hospital" ng-model="HospitalModel" placeholder="Enter Hospital Name">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label"><strong>Comission(in %)</strong></label>
                                                <input class="form-control bg-light border-warning" type="text" name="Comission" ng-model="ComissionModel" placeholder="Enter Commission">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="checkbox" class="checkbox-control" ng-model="ActiveModel" ng-true-value="'1'" ng-false-value="'0'">
                                                <p class="inline-control"> Is Active</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-primary" ng-show="SaveBtn" ng-click="saveDoctor()" type="button"><span class="icon-save"></span> Save</button>
                                    <button class="btn btn-warning" ng-show="UpdateBtn" ng-click="updateDoctor()" type="button"><span class="icon-save"></span> Update</button>
                                    <a class="btn btn-danger" href="<?php echo base_url("app/doctor "); ?>">Close</a>
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
        <?php $this->load->view("Partials/DoctorJs"); ?>
    </body>
</html>