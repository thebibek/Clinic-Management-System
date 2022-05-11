<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>

    <body>
        <?php $this->load->view('Partials/NavbarView'); ?>
        <div class="container-fluid" ng-app="RegistrationApp" ng-controller="RegistrationAppCtrl">
            <div class="card card shadow border-primary mt-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p class="fs-5 m-0">Patient Manager</p>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url("app/dashboard"); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('app/patient/registration'); ?>">Patient</a></li>
                                    <li class="breadcrumb-item active">Manage Patient</li>
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
                                            <button class="btn btn-warning btn-sm"><img src="<?php echo base_url("assets/img/icons/list.png"); ?>"></button>
                                            <strong> Manage Patients</strong>
                                        </div>
                                        <div class="col-md-6">
                                            <a class="btn btn-outline-dark  rounded-0 btn-sm float-end" href="<?php echo base_url("app/patient/list/print"); ?>" target="_blank"><img src="<?php echo base_url("assets/img/icons/print1.png"); ?>"> Print</a>
                                            <button class="btn btn-outline-dark rounded-0 btn-sm float-end" ng-click="showAddPanel()" type="button"><img src="<?php echo base_url("assets/img/icons/add.png"); ?>"> New Registration</button>
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
                                                        <th>Patient</th>
                                                        <th>MRNo</th>
                                                        <th>MobileNo</th>
                                                        <th>BirthDate</th>
                                                        <th>Gender</th>
                                                        <th>Age</th>
                                                        <th>Status</th>
                                                        <th class="border-end-0">Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <tr ng-repeat="d1 in patients" ng-cloak="">
                                                        <td ng-if = "d1.Gender == 1" class="border-start-0 text-center"><button class="btn btn-info btn-sm" type="button"><img src="<?php echo base_url("assets/img/icons/male.png"); ?>"></button></td>
                                                        <td ng-if = "d1.Gender == 2" class="border-start-0 text-center"><button class="btn btn-info btn-sm" type="button"><img src="<?php echo base_url("assets/img/icons/female.png"); ?>"></button></td>
                                                        <td class="text-green text-bold">{{d1.FirstName}} {{d1.LastName}}</td>
                                                        <td class="text-danger text-bold">{{d1.MRNo}}</td>
                                                        <td>{{d1.MobileNo}}</td>
                                                        <td>{{d1.DateOfBirth}}</td>
                                                        <td ng-if="d1.Gender == 1" class="text-green text-bold">Male</td>
                                                        <td ng-if="d1.Gender == 2" class="text-danger text-bold">Female</td>
                                                        <td>{{d1.Age}}</td>
                                                        <td ng-if="d1.IsActive == 0"><span class="badge bg-danger">InActive</span></td>
                                                        <td ng-if="d1.IsActive == 1"><span class="badge bg-success">Active</span></td>	
                                                        <td class="border-end-0">
                                                            <?php
                                                            if ($this->aauth->is_admin() || $this->aauth->is_allowed('View')) {
                                                                ?>
                                                                <a href="<?php echo base_url("app/patient/profile/"); ?>{{d1.ID}}" ><img src="<?php echo base_url("assets/img/icons/view.png"); ?>"></a>
                                                                <?php
                                                            }
                                                            ?>
                                                            <?php
                                                            if ($this->aauth->is_admin() || $this->aauth->is_allowed('Delete')) {
                                                                ?>
                                                                <a href="#" ng-click="deletePatient(d1.ID)"><img src="<?php echo base_url("assets/img/delete.png"); ?>"></a>
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
                                                                <a href="#" ng-click="editPatient(d1.ID)"><img src="<?php echo base_url("assets/img/edit.png"); ?>"></a>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <a href="#"><img src="<?php echo base_url("assets/img/prohibit.png"); ?>"></a>
                                                                <?php
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <br>
                                            <div ng-show="LoaderHolder" class="text-center"><img src="<?php echo base_url("assets/img/icons/loader.png"); ?>"></div>
                                            <div class="text-center" ng-show="TextHolder" ng-cloak><span class="text-red">No records found</span></div>
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
                                            <button class="btn btn-danger btn-sm"><img src="<?php echo base_url("assets/img/icons/add2.png"); ?>"></button>
                                            <strong> &nbsp;Patient Registration</strong>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <button class="btn btn-outline-dark rounded-0 btn-sm float-end" ng-click="reset()"><img src="<?php echo base_url("assets/img/icons/list1.png"); ?>"> Patient List</button>
                                            <button ng-click="reset()" class="btn btn-outline-dark rounded-0  btn-sm float-end" type="button"><img src="<?php echo base_url("assets/img/icons/close1.png"); ?>"></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label"><strong>MRNo</strong><span class="text-danger">*</span></label>
                                                        <input class="form-control  text-danger border-warning bg-light fw-bold" type="text" name="MRNo"   ng-model="MrNoModel" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label"><strong>First Name</strong><span class="text-bold text-18 text-red">*</span></label>
                                                        <input class="form-control border-warning bg-light" type="text" name="FirstName" ng-model="FirstNameModel" placeholder="Enter First Name">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label"><strong>Last Name</strong><span class="text-bold text-18 text-red">*</span></label>
                                                        <input class="form-control border-warning bg-light" type="text" name="LastName" ng-model="LastNameModel" placeholder="Enter Last Name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label"><strong>Mobile No</strong><span class="text-bold text-18 text-red">*</span></label>
                                                        <input class="form-control border-warning bg-light" type="text" name="MobileNo" ng-model="MobileNoModel" placeholder="Enter Mobile No">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label"><strong>Email</strong></label>
                                                        <input class="form-control border-warning bg-light" type="text" name="Email" ng-model="EmailModel" placeholder="Enter Email">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label"><strong>Blood Group</strong><span class="text-bold text-18 text-red">*</span></label>
                                                        <select class="form-select border-warning bg-light" ng-model="BloodGroupModel">
                                                            <option value="">Please select BloodGroup</option>
                                                            <option ng-repeat="d2 in bloodgroups" value="{{d2.ID}}">{{d2.BloodGroup}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="control-label"><strong>Gender</strong><span class="text-bold text-18 text-red">*</span></label>
                                                    <select class="form-select border-warning bg-light" ng-model="GenderModel">
                                                        <option value="">Please select Gender</option>
                                                        <option value="1">Male</option>
                                                        <option value="2">Female</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label"><strong>Date Of Birth</strong><span class="text-bold text-18 text-red">*</span></label>
                                                        <input class="form-control border-warning bg-light" id="DateOfBirth" type="text" ng-change="getAge()" name="DateOfBirth" ng-model="DateOfBirthModel" placeholder="DateOfBirth" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label"><strong>Age(Year)</strong><span class="text-bold text-18 text-red">*</span></label>
                                                        <input class="form-control border-warning bg-light" type="text" name="Age" ng-model="AgeModel" placeholder="Age" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-md-3">

                                            <img id="PatientPhoto" src="{{ProfileModel}}" class="img-thumbnail">
                                            <input class="m-t-48" onchange="readURL(this);"  type="file" file-input="files">

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label"><strong>Address</strong></label>
                                                <textarea class="form-control border-warning bg-light" name="Address" ng-model="AddressModel" rows="5" placeholder="Please Enter Address"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" ng-model="ActiveModel" ng-true-value="'1'" ng-false-value="'0'">
                                                <i class="form-control-feedback fa fa-check" style="top: 0px;"></i> Is Active
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="btn-box text-right">
                                                <button class="btn btn-primary" ng-show="SaveBtn" ng-click="savePatient()" type="button"><span class="icon-save"></span> Save</button>
                                                <button class="btn btn-warning" ng-show="UpdateBtn" ng-click="updatePatient()" type="button"><span class="icon-save"></span> Update</button>
                                                <a class="btn btn-danger" href="<?php echo base_url("app/patient/registration"); ?>">Close</a>
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
        <?php $this->load->view("Partials/PatientJs"); ?>
        <?php $this->load->view("Partials/DateJs"); ?>
    </body>
</html>