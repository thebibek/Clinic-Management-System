<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>

    <body>
        <?php $this->load->view('Partials/NavbarView'); ?>
        <div class="container-fluid" ng-app="FillAttendanceApp" ng-controller="FillAttendanceAppCtrl">
            <div class="card card shadow border-primary mt-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p class="fs-5 m-0">Employee Attendane Filling</p>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url("app/dashboard"); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url("app/employee/registration"); ?>">Employee</a></li>
                                    <li class="breadcrumb-item active">Employee Attendance</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <?php $this->load->view("Partials/IconBarsView"); ?>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <section>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card border-warning shadow">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button class="btn btn-warning btn-sm shadow"><img src="<?php echo base_url("assets/img/icons/attendance.png"); ?>"></button>
                                                <strong> &nbsp;Filling Attendance</strong>
                                            </div>
                                            <div class="col-md-6  text-end">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-outline-dark rounded-0  bg-light text-danger"> <strong>A-ABSENT</strong> </button>
                                                    <button type="button" class="btn btn-outline-dark rounded-0 bg-light text-success"> <strong>P-PRESENT</strong> </button>
                                                    <button type="button" class="btn btn-outline-dark rounded-0 bg-light text-primary"> <strong>L-LEAVE</strong> </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body p-0">
                                        <div class="p-3 m-2 shadow border border-dark mb-3">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="input-group">
                                                        <span class="input-group-text border-danger bg-danger rounded-0 text-white" id="basic-addon1">Department</span>
                                                        <select class="form-select border-danger bg-light rounded-0" ng-model="DepartmentModel">
                                                            <option value="">Please select department</option>
                                                            <option ng-repeat="d1 in departments" value="{{d1.ID}}">{{d1.Department}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="input-group">
                                                        <span class="input-group-text border-warning bg-warning text-white rounded-0" id="basic-addon1">Month/Year</span>
                                                        <input type="text" class="form-control border-warning rounded-0 bg-light" id="AttendanceMonthYear" readonly ng-model="AttendanceMonthModel">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div class="col-sm-6">
                                                            <button class="btn btn-success rounded-0" ng-click="searchEmployee()">Search</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="scrollbar" id="style-7">
                                            <div class="force-overflow">
                                                <div class="table-responsive">
                                                    <table  class="table table-bordered border-warning table-striped mt-5 table-sm">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Emp Code</th>
                                                                <th>First Name</th>
                                                                <th>1</th>
                                                                <th>2</th>
                                                                <th>3</th>
                                                                <th>4</th>
                                                                <th>5</th>
                                                                <th>6</th>
                                                                <th>7</th>
                                                                <th>8</th>
                                                                <th>9</th>
                                                                <th>10</th>
                                                                <th>11</th>
                                                                <th>12</th>
                                                                <th>13</th>
                                                                <th>14</th>
                                                                <th>15</th>
                                                                <th>16</th>
                                                                <th>17</th>
                                                                <th>18</th>
                                                                <th>19</th>
                                                                <th>20</th>
                                                                <th>21</th>
                                                                <th>22</th>
                                                                <th>23</th>
                                                                <th>24</th>
                                                                <th>25</th>
                                                                <th>26</th>
                                                                <th>27</th>
                                                                <th>28</th>
                                                                <th>29</th>
                                                                <th>30</th>
                                                                <th>31</th>
                                                                <th>Leave Taken</th>
                                                                <th>Total Absent</th>
                                                                <th>Working Days</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr ng-repeat="d2 in empattends" ng-cloak>
                                                                <td>{{$index}}</td>
                                                                <td>{{d2.EmployeeCode}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                                <td>{{d2.Salutation}}&nbsp;{{d2.FirstName}}&nbsp;{{d2.LastName}}</td>
                                                                <td ng-repeat="d4 in d2.attendance">
                                                                    <input type="text" ng-if="d4.Status == 'A'"  ng-model="d4.IsPresent"  class="form-control form-control-sm  fw-bold text-danger border-dark width-40 rounded-0" >
                                                                    <input type="text" ng-if="d4.Status == 'L'"  ng-model="d4.IsPresent"  class="form-control form-control-sm  fw-bold text-black border-dark bg-warning rounded-0 width-40">
                                                                    <input type="text" ng-if="d4.Status == 'HL'"  ng-model="d4.IsPresent"  class="form-control form-control-sm fw-bold text-black border-dark bg-warning rounded-0 width-40">
                                                                    <input type="text" ng-if="d4.Status == 'S'"  ng-model="d4.IsPresent"  class="form-control form-control-sm fw-bold text-white border-dark bg-danger width-40 rounded-0">
                                                                    <input type="text" ng-if="d4.Status == 'P'"  ng-model="d4.IsPresent"  class="form-control form-control-sm fw-bold bg-green border-dark rounded-0 width-40">
                                                                    <input type="text" ng-if="d4.Status == 'D'"  ng-model="d4.IsPresent"  class="form-control form-control-sm bg-warning fw-bold border-dark" disabled>
                                                                </td>
                                                                <td class="fw-bold">{{d2.TotalLeave}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                                <td class="fw-bold text-danger">{{d2.TotalAbsent}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                                <td class="fw-bold text-success">{{d2.WorkingDays}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div ng-show="Spinner1" class="text-center"><img src="<?php echo base_url('assets/img/icons/loader.png'); ?>"></div>
                                            </div>
                                        </div>
                                        <div class="f-box">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <button class="btn-lg btn-success" ng-click="saveAttendance()" type="button">+ SAVE</button>
                                                </div>
                                                <div class="col-md-6"></div>
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
        <?php $this->load->view("Partials/FillAttendanceJs"); ?>
    </body>
</html>