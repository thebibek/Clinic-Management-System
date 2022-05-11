<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>

    <body>
        <?php $this->load->view('Partials/NavbarView'); ?>
        <div class="container-fluid" ng-app="LeaveApplicationApp" ng-controller="LeaveApplicationAppCtrl">
            <div class="card card shadow border-primary mt-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p class="fs-5 m-0">Leave Application Manager</p>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url("app/dashboard"); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php ?>">Employee</a></li>
                                    <li class="breadcrumb-item active">Leave Application</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <?php $this->load->view("Partials/IconBarsView"); ?>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <section ng-show="ListPanel">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card border-warning shadow">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button class="btn btn-warning btn-sm shadow"><img src="<?php echo base_url("assets/img/icons/leaveapp.png"); ?>"></button>
                                                <strong> &nbsp;Leave Application</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="p-3 m-2 shadow border border-dark mb-3">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label  class="col-sm-4 control-label"><strong>Employee
                                                                Code</strong></label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" id="" placeholder="Enter Employee Code" ng-model="EmployeeCodeModel">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label  class="col-sm-4 control-label"><strong>Employee
                                                                Name</strong></label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" id="" placeholder="Enter Employee Name" ng-model="EmployeeNameModel">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label  class="col-sm-4 control-label"><strong>Father
                                                                Name</strong></label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" id="" placeholder="Enter Father Name" ng-model="FatherModel">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label  class="col-sm-4 control-label"><strong>Department</strong></label>
                                                        <div class="col-sm-8">
                                                            <select class="form-select " ng-model="DepartmentModel">
                                                                <option value="">Please select department</option>
                                                                <option ng-repeat="d1 in departments" value="{{d1.ID}}">
                                                                    {{d1.Department}}</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label  class="col-sm-4 control-label"><strong>Designation</strong></label>
                                                        <div class="col-sm-8">
                                                            <select class="form-select " ng-model="DesignationModel">
                                                                <option value="">Please Select Designation</option>
                                                                <option ng-repeat="d2 in designations" value="{{d2.ID}}">
                                                                    {{d2.Designation}}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label  class="col-sm-4 control-label"><strong>Joining Date</strong></label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control " id="JoiningDate" readonly placeholder="Joining Date" ng-model="JoiningDateModel">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label  class="col-sm-4 control-label"><strong>Birth Date</strong></label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control " id="DateOfBirth" placeholder="Date Of Birth" readonly ng-model="BirthDateModel">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label  class="col-sm-6 control-label"><strong>Is Current Employee</strong></label>
                                                        <div class="col-sm-6">
                                                            <select class="form-select " ng-model="CurrentEmployeeModel">
                                                                <option value="">Select Status</option>
                                                                <option value="1">Yes</option>
                                                                <option value="2">No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label  class="col-sm-6 control-label"><strong></strong></label>
                                                        <div class="col-sm-6">
                                                            <button class="btn btn-success btn-block btn-sm" ng-click="searchEmployee()">Search</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="scrollbar" id="style-7">
                                            <div class="force-overflow">
                                                <table class="table table-bordered border-warning table-striped mt-2 table-sm">
                                                    <thead class="bg-warning">
                                                        <tr>
                                                            <th class="border-start-0 text-center">#</th>
                                                            <th>Emp Code</th>
                                                            <th>Name</th>
                                                            <th>Gender</th>
                                                            <th>Ph No</th>
                                                            <th>Department</th>
                                                            <th>Designation</th>
                                                            <th>City</th>
                                                            <th>Joining Date</th>
                                                            <th class="border-end-0">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr ng-repeat="d1 in employees" ng-cloak>
                                                            <td class="border-start-0 text-center">
                                                                <button class="btn btn-danger btn-sm">
                                                                    <img src="<?php echo base_url("assets/img/icons/employee.png"); ?>">
                                                                </button>
                                                            </td>
                                                            <td class="fw-bold text-green" ng-cloak>{{d1.EmployeeCode}}</td>
                                                            <td ng-cloak>{{d1.Salutation}} {{d1.FirstName}} {{d1.LastName}}</td>
                                                            <td ng-cloak>{{d1.Gender}}</td>
                                                            <td class="fw-bold text-danger" ng-cloak>{{d1.PhoneNumber}}</td>
                                                            <td ng-cloak>{{d1.Department}}</td>
                                                            <td ng-cloak>{{d1.Designation}}</td>
                                                            <td ng-cloak>{{d1.City}}</td>
                                                            <td ng-cloak>{{d1.JoiningDate}}</td>
                                                            <td class="border-end-0">
                                                                <button class="btn btn-sm btn-danger" ng-click="showAddPanel(d1.EmployeeID, d1.EmployeeCode, d1.FirstName, d1.LastName, d1.DepartmentID)">Apply Leave</button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div ng-show="Spinner1" class="text-center"><img src="<?php echo base_url('assets/img/icons/loader.png'); ?>"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </section>
                    <section ng-show="AddPanel">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card border-warning shadow">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button class="btn btn-warning btn-sm"><img src="<?php echo base_url("assets/img/icons/leaveapp.png"); ?>"></button>
                                                <strong> &nbsp;Leave Application</strong>
                                            </div>
                                            <div class="col-md-6 text-end">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-outline-dark rounded-0  text-danger"><strong>ECODE-</strong><strong ng-bind="ECodeModel"></strong> </button>
                                                    <button type="button" class="btn btn-outline-dark rounded-0 text-success"><strong ng-bind="ENameModel"></strong> </button>
                                                    <a href="<?php echo base_url('app/advance/payment'); ?>" class="btn btn-danger rounded-0 border-dark">Close</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="card border-primary shadow">
                                                    <div class="card-header">
                                                        <strong> &nbsp;Application For</strong>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text border-danger bg-danger rounded-0 text-white" id="basic-addon1">Application Date</span>
                                                            <input type="text" class="form-control bg-light  border-danger rounded-0 text-green" id="LeaveApplicationDate" placeholder="Leave Application Date" ng-model="LeaveApplicationDateModel" readonly>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="input-group mb-2">
                                                                    <span class="input-group-text">
                                                                        <input type="radio" name="ApplicationFor" ng-model="ApplicationForModel" value="1" ng-change="changeApplicationFor()" ng-checked="true" >
                                                                    </span>
                                                                    <input type="text" value="LEAVE" class="form-control  fw-bold text-black" aria-label="..." readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="input-group mb-2">
                                                                    <span class="input-group-text">
                                                                        <input type="radio" name="ApplicationFor" ng-model="ApplicationForModel" ng-change="changeApplicationFor()" value="2" aria-label="...">
                                                                    </span>
                                                                    <input type="text" value="TOUR" class="form-control  fw-bold text-black" aria-label="..." readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="input-group mb-2">
                                                                    <span class="input-group-text">
                                                                        <input type="radio" name="ApplicationFor" ng-model="ApplicationForModel" ng-change="changeApplicationFor()" value="3" aria-label="...">
                                                                    </span>
                                                                    <input type="text" value="OFFICE WORK" class="form-control  fw-bold text-black" aria-label="..." readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="input-group mb-2">
                                                                    <span class="input-group-text">
                                                                        <input type="radio" name="ApplicationFor" ng-model="ApplicationForModel" ng-change="changeApplicationFor()" value="4" aria-label="...">
                                                                    </span>
                                                                    <input type="text" value="VACATION" class="form-control  fw-bold text-black" aria-label="..." readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><strong>Remark</strong></span>
                                                            <input type="text" class="form-control " id="" placeholder="Enter Remark" ng-model="RemarkModel">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="card border-primary shadow">
                                                    <div class="card-header">
                                                        <strong> &nbsp;Leave Details</strong>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="form-check form-check-inline">
                                                            <input type="radio" name="LeaveForRadio" ng-change="changeLeaveFor()" ng-model="LeaveForModel" value="1" ng-checked="true">
                                                            <label class="form-check-label" for="inlineRadio1">DAY</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input type="radio" name="LeaveForRadio" ng-change="changeLeaveFor()" ng-model="LeaveForModel" value="2">
                                                            <label class="form-check-label" for="inlineRadio2">MULTIPLE DAY</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input type="radio" name="LeaveForRadio" ng-change="changeLeaveFor()" ng-model="LeaveForModel" value="3">
                                                            <label class="form-check-label" for="inlineRadio2">HALF DAY</label>
                                                        </div>
                                                        <hr>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text"><strong>Leave From</strong></span>
                                                            <input type="text" class="form-control  fw-bold text-green" id="LeaveFromDate" placeholder="Leave From" ng-model="LeaveFromModel" readonly>
                                                        </div>
                                                        <div class="input-group mb-3" ng-show="LeaveToInput">
                                                            <span class="input-group-text"><strong>Leave To &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></span>
                                                            <input type="text" class="form-control  fw-bold text-green" id="LeaveToDate" placeholder="Leave To" ng-change="changeLeaveToDate()" ng-model="LeaveToModel" readonly>
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text"><strong>Leave Type</strong></span>
                                                            <select class="form-control " ng-model="LeaveTypeModel" ng-change="changeLeaveType()" ng-options="y.LeaveType for y in leavetypes">
                                                                <option value="">Select Leave Type</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="card border-warning shadow">
                                                    <div class="card-header">
                                                        <strong> &nbsp;Application For</strong>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="checkbox">
                                                            <label><input type="checkbox" ng-model="IsSundayIncluded" ng-true-value="'1'" ng-false-value="'0'"><strong class="text-danger">Include Sunday In Leave/Absent</strong></label>
                                                        </div>
                                                        <p class="fw-bold">Leave From : <span class="text-danger"> {{LeaveFromModel}}</span></p>
                                                        <p class="fw-bold">Total Days :<span class="text-danger"> {{DayCount}}</span></p>
                                                        <p class="fw-bold">Status :<span class="text-danger"> {{IsPaid}}</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 text-end">
                                                <button class="btn btn-primary" ng-click="addLeave()">Add</button>
                                                <a href="<?php echo base_url('app/leave/application'); ?>" class="btn btn-danger">Close</a>
                                            </div>
                                        </div>
                                        <hr class="ln-4">
                                        <table class="table table-bordered border-warning table-striped mt-5 table-sm">
                                            <thead class="bg-warning">
                                                <tr>
                                                    <th>#</th>
                                                    <th>App Date</th>
                                                    <th>App For</th>
                                                    <th>Leave For</th>
                                                    <th>Leave From</th>
                                                    <th>Leave To</th>
                                                    <th>Leave Type</th>
                                                    <th>Status</th>
                                                    <th>Day Count</th>
                                                    <th>Remarks</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="d4 in items" ng-cloak="">
                                                    <td>
                                                        <button class="btn btn-secondary btn-sm shadow">
                                                            <img src="<?php echo base_url("assets/img/icons/leave.png"); ?>">
                                                        </button>
                                                    </td>
                                                    <td class="fw-bold text-green">{{d4.ApplicationDate}}</td>
                                                    <td ng-if="d4.ApplicationFor == 1">LEAVE</td>
                                                    <td ng-if="d4.ApplicationFor == 2">TOUR</td>
                                                    <td ng-if="d4.ApplicationFor == 3">OFFICE WORK</td>
                                                    <td ng-if="d4.ApplicationFor == 4">VACATION</td>
                                                    <td ng-if="d4.LeaveFor == 1">ONE DAY</td>
                                                    <td ng-if="d4.LeaveFor == 2">MULTIPLE DAY</td>
                                                    <td ng-if="d4.LeaveFor == 3">HALF DAY</td>
                                                    <td class="fw-bold text-danger">{{d4.LeaveFrom}}</td>
                                                    <td>{{d4.LeaveTo}}</td>
                                                    <td>{{d4.LeaveType}}</td>
                                                    <td>{{d4.Status}}</td>
                                                    <td>{{d4.DayCount}}</td>
                                                    <td>{{d4.Remarks}}</td>
                                                    <td>

                                                        <?php
                                                        if ($this->aauth->is_allowed('Remove')) {
                                                            ?>
                                                            <button class="btn btn-sm btn-danger" ng-click="removeItem($index)">--</button>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <button class="btn btn-sm btn-danger">--</button>
                                                            <?php
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row" ng-show="SaveBtn">
                                            <div class="col-md-12 text-end">
                                                <button class="btn btn-success" ng-click="saveLeave()">Save</button>
                                                <a href="<?php echo base_url('app/leave/application'); ?>" class="btn btn-danger">Close</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>  
        </div>

        <?php $this->load->view("Partials/FooterView"); ?>
        <?php $this->load->view("Partials/TestJs"); ?>
        <?php $this->load->view("Partials/JqueryUI"); ?>
        <?php $this->load->view("Partials/AngularJs"); ?>
        <?php $this->load->view("Partials/SweetAlertJs"); ?>
        <?php $this->load->view("Partials/DateJs"); ?>
        <?php $this->load->view("Partials/LeaveApplicationJs"); ?>
    </body>
</html>