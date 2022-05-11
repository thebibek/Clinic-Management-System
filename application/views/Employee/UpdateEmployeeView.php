<section ng-show="EditPanel">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card border-warning shadow">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <button class="btn btn-warning btn-sm"><img src="<?php echo base_url("assets/img/icons/add2.png"); ?>"></button>
                            <strong> &nbsp;Update Employee</strong>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="<?php echo base_url('app/employee/search'); ?>" class="btn btn-outline-dark rounded-0 shadow btn-sm"><img src="<?php echo base_url('assets/img/icons/employee1.png'); ?>">Employees</a>
                            <a href="<?php echo base_url('app/employee/registration'); ?>" class="btn btn-outline-dark rounded-0 btn-sm shadow"><img src="<?php echo base_url("assets/img/icons/close1.png"); ?>"></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card border-warning shadow">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Personal</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Experience</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Qualification</button>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class='card border-dark shadow rounded-0 mb-2'>
                                        <div class="card-header">
                                            <strong>Personal Info</strong>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-9">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-2">
                                                                <label  class="form-label"><strong>Resume No</strong></label>
                                                                <div class="">
                                                                    <input type="text" class="form-control " id="" placeholder="Enter Resume No" ng-model="ResumeNoModel">
                                                                </div>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label  class="form-label"><strong>Employee Code</strong></label>
                                                                <div class="">
                                                                    <input type="text" class="form-control " id="" placeholder="Enter Employee Code" ng-model="EmployeeCodeModel">
                                                                </div>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label  class="form-label"><strong>Salutation</strong></label>
                                                                <div class="">
                                                                    <select class="form-select" ng-model="SalutationModel">
                                                                        <option value="">Please Select Salutation</option>
                                                                        <option value="Mr">Mr</option>
                                                                        <option value="Mrs">Mrs</option>
                                                                        <option value="Miss">Miss</option>
                                                                        <option value="Master">Master</option>
                                                                        <option value="Dr">Dr</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label  class="form-label"><strong>First Name</strong></label>
                                                                <div class="">
                                                                    <input type="text" class="form-control " id="" placeholder="Enter First Name" ng-model="FirstNameModel">
                                                                </div>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label  class="form-label"><strong>Last Name</strong></label>
                                                                <div class="">
                                                                    <input type="text" class="form-control " id="" placeholder="Enter Last Name" ng-model="LastNameModel">
                                                                </div>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label  class="form-label"><strong>Short Name</strong></label>
                                                                <div class="">
                                                                    <input type="text" class="form-control " id="" placeholder="Enter Short Name" ng-model="ShortNameModel">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-2">
                                                                <label  class="form-label"><strong>Date Of Birth</strong></label>
                                                                <div class="">
                                                                    <input type="text" class="form-control " id="DateOfBirth" ng-model="DateOfBirthModel" readonly placeholder="Enter Date Of Birth">
                                                                </div>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label  class="form-label"><strong>Father's Name</strong></label>
                                                                <div class="">
                                                                    <input type="text" class="form-control " ng-model="FatherNameModel" id="" placeholder="Enter Father Name">
                                                                </div>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label  class="form-label"><strong>Mother's Name</strong></label>
                                                                <div class="">
                                                                    <input type="text" class="form-control " ng-model="MotherNameModel" id="" placeholder="Enter Mother Name">
                                                                </div>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label  class="form-label"><strong>Job Type</strong></label>
                                                                <div class="">
                                                                    <select class="form-select" ng-model="JobTypeModel">
                                                                        <option value="">Please Select Job Type</option>
                                                                        <option value="1">Permanent</option>
                                                                        <option value="2">Temprorary</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label  class="form-label"><strong>Dept</strong></label>
                                                                <div class="">
                                                                    <select class="form-select" ng-model="DepartmentModel">
                                                                        <option value="">Please select department</option>
                                                                        <option ng-repeat="d1 in departments" value="{{d1.ID}}">{{d1.Department}}</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label  class="form-label"><strong>Designation</strong></label>
                                                                <div class="">
                                                                    <select class="form-select" ng-model="DesignationModel">
                                                                        <option value="">Please Select Designation</option>
                                                                        <option ng-repeat="d2 in designations" value="{{d2.ID}}">{{d2.Designation}}</option>

                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 col-md-3">
                                                    <div class="avatar-img">
                                                        <img id="PatientPhoto" src="<?php echo base_url("assets/img/default.png"); ?>" class="img-responsive" alt="">
                                                        <input  onchange="readURL(this);" type="file" file-input="files">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card border-dark shadow rounded-0">
                                        <div class="card-header">
                                            <strong>Personal Info</strong>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-2">
                                                        <label  class="form-label"><strong>Employee Type</strong></label>
                                                        <div class="">
                                                            <select class="form-select " ng-model="EmployeeTypeModel">
                                                                <option value="">Select Employee Type</option>
                                                                <option value="1">Permanent</option>
                                                                <option value="2">Contract</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label  class="form-label"><strong>Joining Date</strong></label>
                                                        <div class="">
                                                            <input type="text" class="form-control " id="JoiningDate" readonly placeholder="Enter Joining Date" ng-model="JoiningDateModel">
                                                        </div>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label  class="form-label"><strong>Gender</strong></label>
                                                        <div class="">
                                                            <select class="form-select" ng-model="GenderModel">
                                                                <option value="">Select Gender</option>
                                                                <option value="1">Male</option>
                                                                <option value="2">Female</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label  class="form-label"><strong>Marital Status</strong></label>
                                                        <div class="">
                                                            <select class="form-select" ng-model="MaritalStatusModel">
                                                                <option value="">Select Marital Status</option>
                                                                <option value="1">Married</option>
                                                                <option value="2">Unmarraid</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label  class="form-label"><strong>Bank A/c No</strong></label>
                                                        <div class="">
                                                            <input type="text" class="form-control " ng-model="BankAccountModel" id="" placeholder="Enter Bank Ac No">
                                                        </div>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label  class="form-label"><strong>Bank Name</strong></label>
                                                        <div class="">
                                                            <input type="text" class="form-control " ng-model="BankNameModel" id="" placeholder="Enter Bank Name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-2">
                                                        <label  class="form-label"><strong>ESI No</strong></label>
                                                        <div class="">
                                                            <input type="text" class="form-control " id="" ng-model="ESINoModel" placeholder="Enter ESI No">
                                                        </div>
                                                    </div>

                                                    <div class="mb-2">
                                                        <label  class="form-label"><strong>PF No</strong></label>
                                                        <div class="">
                                                            <input type="text" class="form-control " ng-model="PFNoModel" id="" placeholder="Enter PF No">
                                                        </div>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label  class="form-label"><strong>PAN No</strong></label>
                                                        <div class="">
                                                            <input type="text" class="form-control " ng-model="PANNoModel" id="" placeholder="Enter PAN No">
                                                        </div>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label  class="form-label"><strong>Nationality</strong></label>
                                                        <div class="">
                                                            <select class="form-select " ng-model="NationalityModel">
                                                                <option value="">Select Nationality</option>
                                                                <option ng-repeat="d7 in nationalities" value="{{d7.ID}}">{{d7.Nationality}}</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label  class="form-label"><strong>Blood Group</strong></label>
                                                        <div class="">
                                                            <select class="form-select " ng-model="BloodGroupModel">
                                                                <option value="">Select Blood Group</option>
                                                                <option ng-repeat="d3 in bloodgroups" value="{{d3.ID}}">{{d3.BloodGroup}}</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label  class="col-sm-6 control-label"><strong>Current Employee?</strong></label>
                                                        <div class="col-sm-6">
                                                            <select class="form-select " ng-model="IsCurrentEmployeeModel">
                                                                <option value="">Select Status</option>
                                                                <option value="1">Yes</option>
                                                                <option value="2">No</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-2">
                                                        <label  class="form-label"><strong>Address</strong></label>
                                                        <div class="">
                                                            <textarea class="form-control" placeholder="Address" ng-model="AddressModel"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="mb-2">
                                                        <label  class="form-label"><strong>State/Province</strong></label>
                                                        <div class="">
                                                            <input type="text" class="form-control " ng-model="StateProvinceModel" id="" placeholder="Enter State Or Province">
                                                        </div>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label  class="form-label"><strong>City</strong></label>
                                                        <div class="">
                                                            <input type="text" class="form-control " id="" ng-model="CityModel" placeholder="Enter City">
                                                        </div>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label  class="form-label"><strong>Pin/Zip</strong></label>
                                                        <div class="">
                                                            <input type="text" class="form-control " ng-model="PinzipModel" id="" placeholder="Enter PIN OR ZIP">
                                                        </div>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label  class="form-label"><strong>Phone Number</strong></label>
                                                        <div class="">
                                                            <input type="text" class="form-control " id="" ng-model="PhoneNumberModel" placeholder="Enter Phone No">
                                                        </div>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label  class="form-label"><strong>Email</strong></label>
                                                        <div class="">
                                                            <input type="text" class="form-control " id="" ng-model="EmailModel" placeholder="Enter Email">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class='card border-dark shadow'>
                                        <div class="card-header">
                                            <strong>Previuos Clinic</strong>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-9">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-2">
                                                                <label  class="form-label"><strong>Clinic Name</strong></label>
                                                                <div class="">
                                                                    <input type="text" class="form-control " id="" placeholder="Enter Clinic Name" ng-model="ClinicModel">
                                                                </div>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label  class="form-label"><strong>Job Nature</strong></label>
                                                                <div class="">
                                                                    <select class="form-select " ng-model="JobNatureModel">
                                                                        <option value="">Select Job Nature</option>
                                                                        <option value="1">Full Time</option>
                                                                        <option value="2">Part Time</option>
                                                                        <option value="3">Visiting</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label  class="form-label"><strong>Address</strong></label>
                                                                <div class="">
                                                                    <textarea class="form-control" placeholder="Enter Address" ng-model="ExAddressModel"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label  class="form-label"><strong>Phone No</strong></label>
                                                                <div class="">
                                                                    <input type="text" class="form-control " id="" ng-model="ExPhoneNoModel" placeholder="Enter Phone No">
                                                                </div>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label  class="form-label"><strong>From Year</strong></label>
                                                                <div class="">
                                                                    <input type="text" class="form-control " placeholder="Enter From Date" id="ExFromYear" ng-model="ExFromYearModel" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label  class="form-label"><strong>To Year</strong></label>
                                                                <div class="">
                                                                    <input type="text" class="form-control " placeholder="Enter To Date" id="ExToYear" ng-model="ExToYearModel" ng-change="getExperience()" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-2">
                                                                <label  class="form-label"><strong>Experience(Yrs)</strong></label>
                                                                <div class="">
                                                                    <input type="text" class="form-control " id="" placeholder="Enter Year Of Experience" ng-model="WorkExperienceModel">
                                                                </div>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label  class="form-label"><strong>Salary</strong></label>
                                                                <div class="">
                                                                    <input type="text" class="form-control " id="" ng-model="SalaryModel" placeholder="Enter Salary">
                                                                </div>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label  class="form-label"><strong>Department</strong></label>
                                                                <div class="">
                                                                    <select class="form-select " ng-model="ExDepartmentModel">
                                                                        <option value="">Please Select Department</option>
                                                                        <option ng-repeat="d3 in departments" value="{{d3.ID}}">{{d3.Department}}</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label  class="form-label"><strong>Designation</strong></label>
                                                                <div class="">
                                                                    <select class="form-select " ng-model="ExDesignationModel">
                                                                        <option value="">Please Select Designation</option>
                                                                        <option ng-repeat="d4 in designations" value="{{d4.ID}}">{{d4.Designation}}</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label  class="form-label"><strong>Job Profile</strong></label>
                                                                <div class="">
                                                                    <textarea class="form-control" ng-model="JobProfileModel" placeholder="Enter Job Profile"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                    <div class='card border-dark shadow'>
                                        <div class="card-header">
                                            <strong>Qualification</strong>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-2">
                                                                <label  class="form-label"><strong>Highest Qualification</strong></label>
                                                                <div class="">
                                                                    <input type="text" class="form-control " id="" placeholder="Enter Highest Qualification" ng-model="QualificationModel">
                                                                </div>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label  class="form-label"><strong>Board/College/University</strong></label>
                                                                <div class="">
                                                                    <input type="text" class="form-control " id="" placeholder="Enter Board/college/University" ng-model="UniversityModel">
                                                                </div>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label  class="form-label"><strong>Year Of Passing</strong></label>
                                                                <div class="">
                                                                    <select class="form-select" ng-model="PassingYearModel">
                                                                        <option value="">Select Passing Year</option>
                                                                        <?php
                                                                        for ($i = 1970; $i <= 2030; $i++) {
                                                                            ?>
                                                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label  class="form-label"><strong>Grade/Percentage</strong></label>
                                                                <div class="">
                                                                    <input type="text" class="form-control " id="" ng-model="GradeModel" placeholder="Enter Grade OR Percentage">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-2">
                                                                <label  class="form-label"><strong>Subject</strong></label>
                                                                <div class="">
                                                                    <input type="text" class="form-control" id="" placeholder="Enter Subject" ng-model="SubjectModel">
                                                                </div>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label  class="form-label"><strong>Specialization</strong></label>
                                                                <div class="">
                                                                    <input type="text" class="form-control" id="" ng-model="SpecializationModel" placeholder="Enter Specialization">
                                                                </div>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label  class="form-label"><strong>Remarks</strong></label>
                                                                <div class="">
                                                                    <input type="text" class="form-control" ng-model="RemarksModel" id="" placeholder="Enter Remarks">
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
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12 text-end">
                            <button class="btn btn-warning shadow" ng-click="updateEmployee()" type="button"><span class="icon-save"></span> Update</button>
                            <a class="btn btn-danger shadow" href="<?php echo base_url('app/employee/registration'); ?>">Reset</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>