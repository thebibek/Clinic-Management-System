<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>

    <body>
        <?php $this->load->view('Partials/NavbarView'); ?>
        <div class="container-fluid" ng-app="AssignLeaveApp" ng-controller="AssignLeaveAppCtrl">
            <div class="card shadow border-primary mt-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p class="fs-5 m-0">Assign Leave Manager</p>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url("app/dashboard"); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php ?>">Employee</a></li>
                                    <li class="breadcrumb-item active">Assign Leave</li>
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
                                                <button class="btn btn-warning btn-sm"><img src="<?php echo base_url("assets/img/icons/leave.png"); ?>"></button>
                                                <strong> &nbsp;Assign Leave Manager</strong>
                                            </div>
                                            <div class="col-md-6 text-end">
                                                <button class="btn btn-outline-dark fs-6 rounded-0 shadow btn-sm" ng-click="showAddPanel()" type="button"><img src="<?php echo base_url("assets/img/icons/add2.png"); ?>"> Assign New Leave</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="p-2 m-2 border border-dark shadow">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text border-danger bg-danger rounded-0 text-white" id="basic-addon1">Designation</span>
                                                        <select class="form-select border-danger rounded-0 bg-light" ng-model="DesignationModel">
                                                            <option value="">Please Select Designation</option>
                                                            <option ng-repeat="d2 in designations" value="{{d2.ID}}">{{d2.Designation}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text border-warning bg-warning rounded-0 text-white" id="basic-addon1">Leave Type</span>
                                                        <select class="form-select border-warning bg-light rounded-0" ng-model="LeaveTypeModel">
                                                            <option value="">Please select Type</option>
                                                            <option ng-repeat="d3 in leavetypes" value="{{d3.ID}}">{{d3.LeaveType}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div class="col-sm-6">
                                                            <button class="btn btn-success shadow rounded-0" ng-click="searchAssignedLeave()">Search</button>
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
                                                            <th>Designation</th>
                                                            <th>LeaveType</th>
                                                            <th>No Of Leave</th>
                                                            <th class="border-end-0">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr ng-repeat="d1 in assignedleaves">
                                                            <td class="border-start-0 text-center">
                                                                <button class="btn btn-secondary btn-sm">
                                                                    <img src="<?php echo base_url("assets/img/icons/leave1.png"); ?>">
                                                                </button>
                                                            </td>
                                                            <td class="fw-bold text-success">{{d1.Designation}}</td>
                                                            <td>{{d1.LeaveType}}</td>
                                                            <td>{{d1.LeaveNo}}</td>
                                                            <td class="fw-bold text-danger border-end-0">
                                                                <?php
                                                                if ($this->aauth->is_admin() || $this->aauth->is_allowed('Delete')) {
                                                                    ?>
                                                                    <a href="#" ng-click="deleteAssignedLeave(d1.AssignedLeaveID)"><img src="<?php echo base_url("assets/img/delete.png"); ?>"></a>
                                                                    <?php
                                                                } else {
                                                                    ?>    
                                                                    <a href="#"><img src="<?php echo base_url("assets/img/delete2.png"); ?>" title="Disabled"></a>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div ng-show="Spinner1" class="text-center m-t-10"><img src="<?php echo base_url('assets/img/icons/loader.png'); ?>"></div>
                                                <div class="text-center text-danger">{{ErrorPlaceHolder}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </section>
                    <section ng-show="AddPanel">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class=" panel-heading">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button class="btn btn-warning btn-hd"><img src="<?php echo base_url("assets/img/icons/leave.png"); ?>"></button>
                                                <strong> &nbsp;Assign Leave</strong>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <a href="<?php echo base_url('app/assign/leave'); ?>" class="btn btn-default bg-white btn-sm"><img src="<?php echo base_url('assets/img/icons/close1.png'); ?>"></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="input-group"><span class="input-group-addon"><strong>Designation</strong></span>
                                                        <select class="form-control " ng-model="DesignationModel">
                                                            <option value="">Please Select Designation</option>
                                                            <option ng-repeat="d2 in designations" value="{{d2.ID}}">{{d2.Designation}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="input-group"><span class="input-group-addon"><strong>Leave Type</strong></span>
                                                        <select class="form-control " ng-model="LeaveTypeModel">
                                                            <option value="">Please select Type</option>
                                                            <option ng-repeat="d3 in leavetypes" value="{{d3.ID}}">{{d3.LeaveType}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="input-group"><span class="input-group-addon"><strong>No Of Leave</strong></span>
                                                        <input type="text" class="form-control " ng-model="LeaveNoModel" placeholder="Enter No Of Leave">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 text-right">
                                                <button class="btn btn-success" ng-click="saveAssignedLeave()">Save</button>
                                                <a href="<?php echo base_url("app/assign/leave"); ?>" class="btn btn-danger">Close</a>
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
        <?php $this->load->view("Partials/AssignLeaveJs"); ?>
    </body>
</html>