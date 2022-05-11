<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>

    <body>
        <?php $this->load->view('Partials/NavbarView'); ?>
        <div class="container-fluid" ng-app="SalaryGenerationApp" ng-controller="SalaryGenerationAppCtrl">
            <div class="card card shadow border-primary mt-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p class="fs-5 m-0">Salary Generation</p>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url("app/dashboard"); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php ?>">Employee</a></li>
                                    <li class="breadcrumb-item active">Salary Generation</li>
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
                                                <button class="btn btn-warning btn-sm"><img src="<?php echo base_url("assets/img/icons/scheme.png"); ?>"></button>
                                                <strong> &nbsp;Salary Generation</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="p-2 m-2 rounded-0 border shadow border-dark">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label  class="col-sm-4 control-label"><strong>Employee Code</strong></label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control " id="" placeholder="Enter Employee Code" ng-model="EmployeeCodeModel">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label  class="col-sm-4 control-label"><strong>Employee Name</strong></label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control " id="" placeholder="Enter Employee Name" ng-model="EmployeeNameModel">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label  class="col-sm-4 control-label"><strong>Father Name</strong></label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control " id="" placeholder="Enter Father Name" ng-model="FatherModel">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label  class="col-sm-4 control-label"><strong>Department</strong></label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control " ng-model="DepartmentModel">
                                                                <option value="">Please select department</option>
                                                                <option ng-repeat="d1 in departments" value="{{d1.ID}}">{{d1.Department}}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label  class="col-sm-4 control-label"><strong>Designation</strong></label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control " ng-model="DesignationModel">
                                                                <option value="">Please Select Designation</option>
                                                                <option ng-repeat="d2 in designations" value="{{d2.ID}}">{{d2.Designation}}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label  class="col-sm-4 control-label"><strong>Joining Date</strong></label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control " id="JoiningDate" placeholder="Joining Date" readonly ng-model="JoiningDateModel">
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
                                                            <select class="form-control " ng-model="CurrentEmployeeModel">
                                                                <option value="">Please Select Status</option>
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
                                                <table class="table table-bordered border-warning table-striped mt-5 table-sm">
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
                                                        <tr ng-repeat="d1 in employees" ng-cloak="">
                                                            <td class="border-start-0 text-center">
                                                                <button class="btn btn-success btn-sm">
                                                                    <img src="<?php echo base_url("assets/img/icons/employee1.png"); ?>">
                                                                </button>
                                                            </td>
                                                            <td class="fw-bold text-success">{{d1.EmployeeCode}}</td>
                                                            <td>{{d1.Salutation}} {{d1.FirstName}} {{d1.LastName}}</td>
                                                            <td>{{d1.Gender}}</td>
                                                            <td class="fw-bold text-danger">{{d1.PhoneNumber}}</td>
                                                            <td>{{d1.Department}}</td>
                                                            <td>{{d1.Designation}}</td>
                                                            <td>{{d1.City}}</td>
                                                            <td>{{d1.JoiningDate}}</td>
                                                            <td class="border-end-0">
                                                                <?php
                                                                if ($this->aauth->is_allowed('Generate Salary')) {
                                                                    ?>
                                                                    <button class="btn btn-sm btn-danger" ng-click="showAddPanel(d1.EmployeeID)">Generate Salary</button>

                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <button class="btn btn-sm btn-danger"><img src="<?php echo base_url('assets/img/prohibit.png'); ?>">Generate Salary</button>
                                                                    <?php
                                                                }
                                                                ?>

                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
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
                                                <button class="btn btn-warning btn-sm"><img src="<?php echo base_url("assets/img/icons/employee1.png"); ?>"></button>
                                                <strong> &nbsp;Employee Details</strong>
                                            </div>
                                            <div class="col-md-6 text-end">
                                                <a href="<?php echo base_url('app/salary/generation'); ?>" class="btn btn-outline-dark fs-6 rounded-0 btn-sm"><img src="<?php echo base_url('assets/img/icons/close1.png'); ?>"></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="input-group mb-1">
                                                            <span class="input-group-text border-warning rounded-0" id="basic-addon1">Salary Slip No</span>
                                                            <input type="text" class="form-control border-warning rounded-0 bg-light  fw-bold text-danger" placeholder="Salary Slip" ng-model="SalarySlipModel">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-1">
                                                            <div class="input-group">
                                                                <span class="input-group-text border-warning rounded-0">Emp Code</span> 
                                                                <input type="text" class="form-control border-warning rounded-0 bg-light  fw-bold text-success" placeholder="Employee Code" ng-model="EmployeeCodeModel" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-1">
                                                            <div class="input-group">
                                                                <span class="input-group-text border-warning rounded-0">Employee</span> 
                                                                <input type="text" class="form-control border-warning rounded-0 bg-light fw-bold text-danger" placeholder="Employee Name" ng-model="EmployeeNameModel" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-1">
                                                            <div class="input-group"><span class="input-group-text border-warning rounded-0">Father Name</span> <input type="text" class="form-control border-warning rounded-0 bg-light" placeholder="Father Name" ng-model="FatherNameModel" readonly></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-1">
                                                            <div class="input-group"><span class="input-group-text border-warning rounded-0">Birth Date</span> <input type="text" class="form-control border-warning rounded-0 bg-light" placeholder="Birth Date" ng-model="BirthDateModel" readonly></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-1">
                                                            <div class="input-group"><span class="input-group-text border-warning rounded-0">Joining Date</span> <input type="text" class="form-control border-warning rounded-0 bg-light" placeholder="Joining Date" ng-model="JoiningDateModel" readonly></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-1">
                                                            <div class="input-group"><span class="input-group-text border-warning rounded-0">Email</span> <input type="text" class="form-control border-warning rounded-0 bg-light" placeholder="Email" ng-model="EmailModel" readonly></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-1">
                                                            <div class="input-group"><span class="input-group-text border-warning rounded-0">Mobile No</span> <input type="text" class="form-control border-warning rounded-0 bg-light" placeholder="Mobile No" ng-model="MobileNoModel" readonly></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-1">
                                                            <div class="input-group"><span class="input-group-text border-warning rounded-0">Department</span>
                                                                <select class="form-select border-warning rounded-0 bg-light " ng-model="DesignationModel">
                                                                    <option value="">Please Select Designation</option>
                                                                    <option ng-repeat="d3 in departments" value="{{d3.ID}}">{{d3.Department}}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-1">
                                                            <div class="input-group"><span class="input-group-text border-warning rounded-0">Designation</span>
                                                                <select class="form-select border-warning rounded-0 bg-light " ng-model="DesignationModel">
                                                                    <option value="">Please Select Designation</option>
                                                                    <option ng-repeat="d2 in designations" value="{{d2.ID}}">{{d2.Designation}}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-1">
                                                            <div class="input-group"><span class="input-group-text border-warning rounded-0">Payment Mode</span> <input type="text" class="form-control border-warning rounded-0 bg-light" placeholder="PaymentMode" ng-model="PaymentModeModel" readonly></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-1">
                                                            <div class="input-group"><span class="input-group-text border-warning rounded-0">ESI No</span> <input type="text" class="form-control border-warning rounded-0 bg-light" placeholder="ESI No" ng-model="ESINoModel" readonly></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-1">
                                                            <div class="input-group"><span class="input-group-text border-warning rounded-0">Bank A/C No</span> <input type="text" class="form-control border-warning rounded-0 bg-light" placeholder="Bank A/C No" ng-model="BankAcNoModel" readonly></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-1">
                                                            <div class="input-group"><span class="input-group-text border-warning rounded-0">Bank Name</span> <input type="text" class="form-control border-warning rounded-0 bg-light" placeholder="Bank Name" ng-model="BankNameModel" readonly></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-1">
                                                            <div class="input-group"><span class="input-group-text border-warning rounded-0">PAN No</span> <input type="text" class="form-control border-warning rounded-0 bg-light" placeholder="PAN No" ng-model="PANNoModel" readonly></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-1">
                                                            <div class="input-group"><span class="input-group-text border-warning rounded-0">Emp Type</span> <input type="text" class="form-control border-warning rounded-0 bg-light" placeholder="Employee Type" ng-model="EmployeeTypeModel" readonly></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-1">
                                                            <div class="input-group"><span class="input-group-text border-warning rounded-0">Job Type</span> <input type="text" class="form-control border-warning rounded-0 bg-light" placeholder="Job Type" ng-model="JobTypeModel" readonly></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-1">
                                                            <div class="input-group"><span class="input-group-text border-warning rounded-0">PF Number</span> <input type="text" class="form-control border-warning rounded-0 bg-light" placeholder="PF No" ng-model="PFNoModel" readonly></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="avatar-img">
                                                    <img id="PatientPhoto" src="<?php echo base_url('assets/img/default.png'); ?>" class="img-responsive" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card border-warning shadow mt-2">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button class="btn btn-warning btn-sm shadow"><img src="<?php echo base_url("assets/img/icons/scheme.png"); ?>"></button>
                                                <strong> &nbsp;Salary Details</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <span class="input-group-text border-danger rounded-0 bg-danger text-white">
                                                                    <strong>Salary Month</strong>
                                                                </span> 
                                                                <input type="text" class="form-control  fw-bold text-danger border-danger rounded-0 bg-light" id="SalaryMonthYear" placeholder="Salary Month/Year" ng-model="SalaryMonthModel" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <div class="input-group"><span class="input-group-text border-danger rounded-0 bg-danger text-white"><strong>Salary Date</strong></span> <input type="text" class="form-control  fw-bold text-success border-danger rounded-0 bg-light" id="SalaryDate" placeholder="Salary Date" ng-model="SalaryDateModel" readonly></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button class="btn btn-info border-primary btn-sm mt-1 rounded-0" ng-click="getSalaryScheme()"><strong>Find Scheme</strong></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="ln-4">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-text">Salary Scheme</span>
                                                        <input type="text" class="form-control  fw-bold text-danger" placeholder="Salary Scheme" ng-model="SalarySchemeModel" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-text">Basic Salary</span>
                                                        <input type="text" class="form-control  fw-bold text-danger" placeholder="Basic Salary" ng-model="BasicSalaryModel" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="card border-dark shadow mb-3">
                                                    <div class="card-header">
                                                        <strong> &nbsp;Allowance</strong>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group" ng-repeat="d4 in assignedSchemeAllowances">
                                                                    <div class="input-group">
                                                                        <span class="input-group-text"><strong>{{d4.AllowanceName}}</strong></span>
                                                                        <input type="text" class="form-control  fw-bold text-danger" ng-model="d4.Allowance" ng-change="changeAllowance()" placeholder="Enter Amount">
                                                                    </div>
                                                                </div>
                                                                <span class="text-danger">{{ms1}}</span>
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <span class="input-group-text"><strong>Total Allowance</strong></span>
                                                                        <input type="text" class="form-control  fw-bold text-danger" ng-model="TotalAllowanceModel" placeholder="Enter Amount" readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card border-dark shadow mb-3">
                                                    <div class="card-header">
                                                        <strong> &nbsp;Deduction</strong>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group" ng-repeat="d5 in assignedSchemeDeductions">
                                                                    <div class="input-group">
                                                                        <span class="input-group-text"><strong>{{d5.AllowanceName}}</strong></span>
                                                                        <input type="text" class="form-control  fw-bold text-danger" ng-model="d5.Deduction" ng-change="changeDeduction()" placeholder="Enter Decimal Amount">
                                                                    </div>
                                                                </div>
                                                                <span class="text-danger">{{ms2}}</span>
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <span class="input-group-text"><strong>Total Deduction</strong></span>
                                                                        <input type="text" class="form-control  fw-bold text-danger" ng-model="TotalDeductionModel" placeholder="Enter Decimal Amount" readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card border-dark  shadow mb-3">
                                                    <div class="card-header">
                                                        <strong> &nbsp;Contribution</strong>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group" ng-repeat="d6 in assignedSchemeContributions">
                                                                    <div class="input-group">
                                                                        <span class="input-group-text"><strong>{{d6.AllowanceName}}</strong></span>
                                                                        <input type="text" class="form-control  fw-bold text-danger" ng-model="d6.Contribution" ng-change="changeContribution()" placeholder="Enter Decimal Amount">
                                                                    </div>
                                                                </div>
                                                                <span class="text-danger">{{ms3}}</span>
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <span class="input-group-text"><strong>Total Contribution</strong></span>
                                                                        <input type="text" class="form-control  fw-bold text-danger" ng-model="TotalContributionModel" placeholder="Enter Decimal Amount" readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="card border-primary shadow">
                                                    <div class="card-header">
                                                        <strong> &nbsp;Absent</strong>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <span class="text-danger">{{ms4}}</span>
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <span class="input-group-text"><strong>No Of Days</strong></span>
                                                                        <input type="text" class="form-control  fw-bold text-danger" ng-model="DaysAbsentModel" placeholder="Absent Days">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card border-primary shadow">
                                                    <div class="card-header">
                                                        <strong> &nbsp;Advance</strong>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <span class="text-danger">{{ms5}}</span>
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <span class="input-group-text"><strong>Advance Amount</strong></span>
                                                                        <input type="text" class="form-control  fw-bold text-danger" ng-model="AdvanceModel" placeholder="Enter Advance Amount">
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
                                                <button class="btn btn-primary" ng-click="saveSalary()">Save</button>
                                                <a href="<?php echo base_url('app/salary/generation'); ?>" class="btn btn-danger">Close</a>
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
        <?php $this->load->view("Partials/SalaryGenerationJs"); ?>
    </body>
</html>