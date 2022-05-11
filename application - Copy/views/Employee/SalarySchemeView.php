<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>
    <body>
        <?php $this->load->view("Partials/NavbarView"); ?>
        <div class="container-fluid" ng-app="SalarySchemeApp" ng-controller="SalarySchemeAppCtrl">
            <div class="card card shadow border-primary mt-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p class="fs-5 m-0">Employee Salary Scheme/Allowance</p>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url("app/dashboard"); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('app/employee/registration'); ?>">HRM</a></li>
                                    <li class="breadcrumb-item active">Employee Salary Scheme / Allowance</li>
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
                            <div class="card border-warning shadow">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button class="btn btn-warning btn-sm"><img src="<?php echo base_url("assets/img/icons/employee1.png"); ?>"></button>
                                            <strong> &nbsp;Employee Salary Scheme/Allowance</strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="card border-dark shadow">
                                        <div class="card-header">
                                            <ul class="nav nav-tabs card-header-tabs">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Allowance/Deduction</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Salary Scheme</button>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content" id="myTabContent">
                                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class='card border-warning shadow'>
                                                                <div class="card-header">
                                                                    <strong>Allowance/Deduction</strong>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label  class="col-sm-4 form-label"><strong>Allowance/Deduction</strong></label>
                                                                                <div class="col-sm-8">
                                                                                    <select class="form-select border-warning rounded-0 bg-light" ng-model="AllowanceModel">
                                                                                        <option value="">Please Select Type</option>
                                                                                        <option value="A">Allowance</option>
                                                                                        <option value="D">Deduction</option>
                                                                                        <option value="C">Contribution</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label  class="col-sm-4 form-label"><strong>Name</strong></label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="text" class="form-control border-warning rounded-0 bg-light" id="" placeholder="Enter Allowance/Deduction Name" ng-model="AllowanceNameModel">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label  class="col-sm-4 form-label"><strong>Code</strong></label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="text" class="form-control border-warning rounded-0 bg-light" id="" placeholder="Enter Allowance/Deduction Code" ng-model="AllowanceCodeModel">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card-footer">
                                                                    <div class="form-group">
                                                                        <div class="col-sm-12 text-end">
                                                                            <button class="btn btn-primary" ng-click="saveAllowance()" type="button"><span class="icon-save"></span> Save</button>
                                                                            <a class="btn btn-danger" href="<?php echo base_url('app/employee/salary/scheme'); ?>" >Close</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="card border-warning shadow">
                                                                <div class="card-header">
                                                                    <strong>Allowance/Deduction</strong>
                                                                </div>
                                                                <div class="card-body p-0">
                                                                    <div class="scrollbar" id="style-7">
                                                                        <div class="force-overflow">
                                                                            <table class="table table-bordered border-warning table-striped mt-3 table-sm">
                                                                                <thead class="bg-warning">
                                                                                    <tr>
                                                                                        <th class="border-start-0 text-center">#</th>
                                                                                        <th>Name</th>
                                                                                        <th>Code</th>
                                                                                        <th>Allowance/Deduction</th>
                                                                                        <th class="border-end-0">Action</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr ng-repeat="d1 in allowances" ng-cloak="">
                                                                                        <td class="border-start-0 text-center"><button class="btn btn-success btn-sm" type="button"><img src="<?php echo base_url('assets/img/icons/allowance.png'); ?>"></button></td>
                                                                                        <td>{{d1.Name}}</td>
                                                                                        <td>{{d1.Code}}</td>
                                                                                        <td>{{d1.AllowanceType}}</td>
                                                                                        <td class="border-end-0"><span class="badge bg-success">Yes</span></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                                    <section ng-show="ListPanel">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="card ">
                                                                    <div class="card-header">
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <button class="btn btn-warning btn-sm shadow"><img src="<?php echo base_url("assets/img/icons/scheme.png"); ?>"></button>
                                                                                <strong> Manage Salary Scheme</strong>
                                                                            </div>
                                                                            <div class="col-md-6 text-end">
                                                                                <button class="btn btn-outline-dark fs-6 rounded-0 shadow btn-sm" ng-click="showAddPanel()" type="button"><img src="<?php echo base_url("assets/img/icons/add.png"); ?>"> Add Salary Scheme</button>
                                                                                <button ng-click="showAddPanel()" class="btn btn-outline-dark  fs-6 rounded-0 shadow btn-sm" type="button"><img src="<?php echo base_url("assets/img/icons/close1.png"); ?>"></button>
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
                                                                                            <th>Scheme Code</th>
                                                                                            <th>Scheme Name</th>
                                                                                            <th class="border-end-0">Action</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <tr ng-repeat="d4 in salaryschemes" ng-cloak="">
                                                                                            <td class="border-start-0 text-center">
                                                                                                <button class="btn btn-success btn-sm">
                                                                                                    <img src="<?php echo base_url("assets/img/icons/allowance1.png"); ?>">
                                                                                                </button>
                                                                                            </td>
                                                                                            <td>{{d4.SchemeCode}}</td>
                                                                                            <td>{{d4.SchemeName}}</td>
                                                                                            <td>
                                                                                                <?php
                                                                                                if ($this->aauth->is_admin() || $this->aauth->is_allowed('Delete')) {
                                                                                                    ?>
                                                                                                    <a href="#" ng-click="deleteSalaryScheme(d4.ID)"><img src="<?php echo base_url("assets/img/delete.png"); ?>"></a>
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
                                                                                                    <a href="#" ng-click="editSalaryScheme(d4.ID)"><img src="<?php echo base_url("assets/img/edit.png"); ?>"></a>
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
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>
                                                    <section ng-show="AddPanel">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class='card border-warning shadow mb-2'>
                                                                    <div class="card-header">
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <strong>Salary Scheme</strong>
                                                                            </div>
                                                                            <div class="col-md-6 text-end">
                                                                                <button ng-click="reset()" class="btn btn-outline-dark fs-6 rounded-0 shadow btn-sm" type="button"><img src="<?php echo base_url("assets/img/icons/close1.png"); ?>"></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-sm-12">
                                                                                <div class="form-group">
                                                                                    <label  class="col-sm-4 form-label"><strong>Scheme Code</strong></label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="text" class="form-control " id="" placeholder="Enter Scheme Code" ng-model="SchemeCodeModel">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group">
                                                                                    <label  class="col-sm-4 form-label"><strong>Scheme Name</strong></label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="text" class="form-control " id="" placeholder="Enter Scheme Name" ng-model="SchemeNameModel">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label  class="col-sm-4 form-label"><strong>Allowance/Deduction</strong></label>
                                                                                    <div class="col-sm-8">
                                                                                        <select class="form-select " ng-change="getAllowanceName()" ng-model="SchemeAllowanceModel">
                                                                                            <option value="">Please Select Type</option>
                                                                                            <option value="A">Allowance</option>
                                                                                            <option value="D">Deduction</option>
                                                                                            <option value="C">Contribution</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label  class="col-sm-4 form-label"><strong>Allowance Name</strong></label>
                                                                                    <div class="col-sm-8">
                                                                                        <select class="form-select" ng-model="SchemeAllowanceNameModel" ng-options="y.Name for y in allowancesnames">
                                                                                            <option value="">Please Select Name</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class='card border-warning shadow'>
                                                                    <div class="card-header">
                                                                        <strong>Allowance/Deduction Based On</strong>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-sm-12">
                                                                                <div class="form-group">
                                                                                    <label  class="col-sm-4 form-label"><strong>Formula/Amount</strong></label>
                                                                                    <div class="col-sm-8">
                                                                                        <select class="form-select" ng-change="changeBasedUpon()" ng-model="BasedOnModel">
                                                                                            <option value="">Please Select Formula Or Amount</option>
                                                                                            <option value="1">Formula</option>
                                                                                            <option value="2">Amount</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="card border-warning shadow" ng-show="AmountPanel">
                                                                    <div class="card-header">
                                                                        <strong>Amount(Allowance/Deduction)</strong>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label  class="col-sm-2 form-label"><strong>Amount</strong></label>
                                                                                    <div class="col-sm-10">
                                                                                        <input type="text" class="form-control " ng-model="AmountModel" placeholder="Enter Amount">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-6"></div>
                                                                            <div class="col-md-6">
                                                                                <button class="btn btn-info btn-block" ng-click="addSchemeAmount()">Add To Scheme</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class='card border-warning shadow mb-2' ng-show="FormulaPanel">
                                                                    <div class="card-header">
                                                                        <strong>Formula(Allowance/Deduction)</strong>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-sm-12">
                                                                                <div class="form-group">
                                                                                    <label  class="col-sm-4 form-label"><strong>Basic Salary</strong></label>
                                                                                    <div class="input-group">
                                                                                        <select class="form-select" ng-model="BasicSalaryModel">
                                                                                            <option value="">Please Select Basic Salary</option>
                                                                                            <option value="BS">Basic Salary</option>
                                                                                        </select>
                                                                                        <button class="btn btn-sm btn-primary" ng-click="addBasicSalary()">Add</button>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label  class="col-sm-4 form-label"><strong>Operator</strong></label>
                                                                                    <div class="input-group">
                                                                                        <select class="form-select " ng-model="OperatorModel">
                                                                                            <option value="">Please Select Operator</option>
                                                                                            <option value="+">+</option>
                                                                                            <option value="-">-</option>
                                                                                            <option value="*">*</option>
                                                                                            <option value="/">/</option>
                                                                                        </select>
                                                                                        <button class="btn btn-sm  btn-primary" ng-click="addOperator()">Add</button>
                                                                                    </div> 
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label  class="form-label"><strong>Value</strong></label>
                                                                                    <div class="input-group">
                                                                                        <input type="text" class="form-control " ng-model="FormulaValueModel">
                                                                                        <button class="btn btn-sm btn-block btn-primary" ng-click="addValue()">Add</button>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group mb-2">
                                                                                    <label  class="form-label text-danger"><strong>Formula</strong></label>
                                                                                    <div class="input-group">
                                                                                        <input type="text" class="form-control  text-bold text-green" ng-model="FormulaModel" readonly>
                                                                                        <button class="btn btn-sm btn-block btn-danger" ng-click="removeFormula()">Remove</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-12 text-end">
                                                                                <button class="btn btn-info shadow rounded-0 btn-sm" ng-click="addSchemeFormula()">Add To Scheme</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card border-warning shadow">
                                                                    <div class="card-header">
                                                                        <strong>Formula/Amount Added to Salary Scheme</strong>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <table class="table table-bordered border-warning table-striped mt-2 table-sm">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>#</th>
                                                                                    <th>Allowance/Deduction</th>
                                                                                    <th>Scheme Based On</th>
                                                                                    <th>Amount</th>
                                                                                    <th>Formula</th>
                                                                                    <th>Action</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr ng-repeat="d3 in items" ng-cloak="">
                                                                                    <td><button class="btn btn-success btn-sm shadow" type="button"><img src="<?php echo base_url('assets/img/icons/allowance.png'); ?>"></button></td>
                                                                                    <td>{{d3.AllowanceName}}</td>
                                                                                    <td ng-if="d3.SchemeBasedOn == 1">Formula</td>
                                                                                    <td ng-if="d3.SchemeBasedOn == 2">Amount</td>
                                                                                    <td>{{d3.Amount}}</td>
                                                                                    <td>{{d3.Formula}}</td>
                                                                                    <td>
                                                                                        <?php
                                                                                        if ($this->aauth->is_allowed('Remove')) {
                                                                                            ?>
                                                                                            <button class="btn btn-danger btn-sm shadow" ng-click="removeItem($index)">--</button>
                                                                                            <?php
                                                                                        } else {
                                                                                            ?>
                                                                                            <button class="btn btn-danger btn-sm shadow">--</button>
                                                                                            <?php
                                                                                        }
                                                                                        ?>    
                                                                                    </td>     
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <div class="card-footer">
                                                                        <div class="row">
                                                                            <div class="col-md-12 text-end">
                                                                                <button class="btn btn-primary" ng-show="SaveBtn" ng-click="saveSalaryScheme()" type="button"><span class="icon-save"></span> Save</button>
                                                                                <button class="btn btn-warning" ng-show="UpdateBtn" ng-click="updateSalaryScheme()" type="button"><span class="icon-save"></span> Update</button>
                                                                                <a class="btn btn-danger" href="<?php echo base_url('app/employee/salary/scheme'); ?>">Close</a>
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
        <?php $this->load->view("Partials/SweetAlertJs"); ?>
        <?php $this->load->view("Partials/DateJs"); ?>
        <?php $this->load->view("Partials/AngularJs"); ?>
        <?php $this->load->view("Partials/SalarySchemeJs"); ?>

    </body>
</html>