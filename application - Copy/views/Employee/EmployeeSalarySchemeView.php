<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>

    <body>
        <?php $this->load->view('Partials/NavbarView'); ?>
        <div class="container-fluid" ng-app="EmployeeSalarySchemeApp" ng-controller="EmployeeSalarySchemeAppCtrl">
            <div class="card card shadow border-primary mt-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p class="fs-5 m-0">Employee Salary Scheme</p>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url("app/dashboard"); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php ?>">Employee</a></li>
                                    <li class="breadcrumb-item active">Employee Manager</li>
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
                                                <strong> &nbsp;Salary Scheme Manager</strong>
                                            </div>
                                            <div class="col-md-6 text-end">
                                                <a href="<?php echo base_url('app/add/employee/salary/scheme'); ?>" class="btn btn-danger btn-sm">Reset</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="p-2 shadow m-2 border border-dark">
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
                                                            <select class="form-select " ng-model="DepartmentModel">
                                                                <option value="">Please select department</option>
                                                                <option ng-repeat="d1 in departments" value="{{d1.ID}}">{{d1.Department}}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label  class="col-sm-4 control-label"><strong>Designation</strong></label>
                                                        <div class="col-sm-8">
                                                            <select class="form-select " ng-model="DesignationModel">
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
                                                            <select class="form-select " ng-model="CurrentEmployeeModel">
                                                                <option value="">Please Select Status</option>
                                                                <option value="1">Yes</option>
                                                                <option value="2">No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label  class="col-sm-6 control-label"><strong></strong></label>
                                                        <div class="col-sm-6">
                                                            <button class="btn btn-primary" ng-click="searchEmployee()">Search</button>
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
                                                                <button class="btn btn-danger btn-sm  shadow">
                                                                    <img src="<?php echo base_url("assets/img/icons/employee.png"); ?>">
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
                                                                <button class="btn btn-sm border-primary rounded-0 btn-info" ng-click="showAddPanel(d1.EmployeeID)">Add Scheme</button>
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

                    <!--Adding Salary Scheme Panel Start-->
                    <section ng-show="AddPanel">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card border-warning shadow">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button class="btn btn-warning btn-sm"><img src="<?php echo base_url("assets/img/icons/scheme.png"); ?>"></button>
                                                <strong> &nbsp;Add Salary Scheme</strong>
                                            </div>
                                            <div class="col-md-6 text-end">
                                                <a href="<?php echo base_url('app/add/employee/salary/scheme'); ?>" class="btn btn-sm btn-outline-dark fs-6 rounded-0 shadow" ><img src="<?php echo base_url('assets/img/icons/close1.png'); ?>" alt="close"></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="p-2 m-2 shadow border border-dark">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label  class="col-sm-4 control-label"><strong>Employee Name</strong></label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control  text-danger fw-bold" id="" placeholder="Enter Employee Name" ng-model="SEmployeeNameModel" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label  class="col-sm-4 control-label"><strong>Department</strong></label>
                                                        <div class="col-sm-8">
                                                            <select class="form-select  fw-bold" ng-model="SDepartmentModel" disabled>
                                                                <option value="">Please select department</option>
                                                                <option ng-repeat="d1 in departments" value="{{d1.ID}}">{{d1.Department}}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label  class="col-sm-4 control-label"><strong>Designation</strong></label>
                                                        <div class="col-sm-8">
                                                            <select class="form-select  fw-bold" ng-model="SDesignationModel" disabled>
                                                                <option value="">Please Select Designation</option>
                                                                <option ng-repeat="d2 in designations" value="{{d2.ID}}">{{d2.Designation}}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label  class="col-sm-4 control-label"><strong>Employee Code</strong></label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control  fw-bold text-success" id="" placeholder="Enter Employee Code" ng-model="SEmployeeCodeModel" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label  class="col-sm-4 control-label"><strong>Employee Type</strong></label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control  fw-bold" id="" placeholder="Enter Employee Type" ng-model="SEmployeeTypeModel" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label  class="col-sm-4 control-label"><strong>Job Type</strong></label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control  fw-bold" placeholder="Enter JoB Type" ng-model="SJobTypeModel" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label  class="col-sm-4 control-label"><strong>Basic Salary</strong></label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control " id="" placeholder="Enter Basic Salary" ng-model="BasicSalaryModel">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-4 control-label"><strong>Salary Scheme</strong></label>
                                                        <div class="col-sm-8">
                                                            <select class="form-select " ng-model="SalarySchemeModel">
                                                                <option value="">Please Select Salary Scheme</option>
                                                                <option ng-repeat="d3 in salaryschemes" value="{{d3.ID}}">{{d3.SchemeName}}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label  class="col-sm-6 control-label"><strong>Salary Month/Year</strong></label>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control " placeholder="Year/Month" id="SalaryMonthYear" readonly ng-model="SalaryMonthYearModel">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 text-end">
                                                    <button class="btn btn-info rounded-0 border-primary btn-sm" ng-click="saveEmployeeSalaryScheme()">Add Salary Scheme</button>
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
                                                            <th>Salary Month</th>
                                                            <th>Salary Year</th>
                                                            <th>Basic Salary</th>
                                                            <th>Scheme Name</th>
                                                            <th>Dept</th>
                                                            <th>Designation</th>
                                                            <th>Emp Type</th>
                                                            <th>Job Type</th>
                                                            <th class="border-end-0">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr ng-repeat="d4 in employeeschemes" ng-cloak="">
                                                            <td class="border-start-0 text-center">#</td>
                                                            <td class="fw-bold text-success">{{SEmployeeCodeModel}}</td>
                                                            <td class="fw-bold text-danger">{{d4.Month}}</td>
                                                            <td class="fw-bold text-danger">{{d4.Year}}</td>
                                                            <td>{{d4.BasicSalary}}</td> 
                                                            <td>{{d4.SchemeName}}</td>
                                                            <td>{{SDepartmentModel}}</td>
                                                            <td>{{SDesignationModel}}</td>
                                                            <td>{{SEmployeeTypeModel}}</td>
                                                            <td>{{SJobTypeModel}}</td>
                                                            <td class="border-end-0">
                                                                <?php
                                                                if ($this->aauth->is_admin() || $this->aauth->is_allowed('Delete')) {
                                                                    ?>
                                                                    <a href="#" ng-click="deleteEmployeeScheme(d4.EmployeesalaryschemeID)"><img src="<?php echo base_url("assets/img/delete.png"); ?>"></a>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <a href="#"><img src="<?php echo base_url("assets/img/delete2.png"); ?>"></a> 
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
                    <!--Adding Salary Scheme Panel End-->
                </div>
            </div>  
        </div>

        <?php $this->load->view("Partials/FooterView"); ?>
        <?php $this->load->view("Partials/TestJs"); ?>
        <?php $this->load->view("Partials/JqueryUI"); ?>
        <?php $this->load->view("Partials/AngularJs"); ?>
        <?php $this->load->view("Partials/SweetAlertJs"); ?>
        <?php $this->load->view("Partials/DateJs"); ?>
        <?php $this->load->view("Partials/EmployeeSalarySchemeJs"); ?>
    </body>
</html>