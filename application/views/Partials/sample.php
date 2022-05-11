<div ng-show="Spinner1" class="text-center m-t-10"><img src="<?php echo base_url('assets/img/icons/loader.png'); ?>"></div>
<a href="" class="btn btn-default btn-sm hr-form-btn-sm"><img src="<?php echo base_url('assets/img/icons/reset.png'); ?>" title="reset"></a>
//message


<script>
    if (response.data.status === 0) {
        swal({
            title: "There are some errors !!",
            text: response.data.error,
            icon: "warning",
            dangerMode: true

        });
    }

    if (response.data.status == 1) {
        swal("Record deleted successfully !!", {
            icon: "success",
            closeOnClickOutside: false
        }).then((ok) => {
            if (ok) {

                window.location.href = '<?php echo base_url("app/assign/leave"); ?>';
            }
        });
    }

    if (response.data.status == -1) {
        swal('Could not delete,please try again.');
    }
</script>
<td>
    <a href="#"><img src="<?php echo base_url("assets/img/prohibit.png"); ?>"></a>
    <a href="#"><img src="<?php echo base_url("assets/img/delete2.png"); ?>"></a>
    
    <?php
    if ($this->aauth->is_allowed('Delete')) {
        ?>
        <a href="#" ng-click="deleteLedgerGroup(d1.LedgerGroupID)"><img src="<?php echo base_url("assets/img/delete.png"); ?>"></a>
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
        <a href="#" ng-click="editLedgerGroup(d1.LedgerGroupID)"><img src="<?php echo base_url("assets/img/edit.png"); ?>"></a>
        <?php
    } else {
        ?>
        <a href="#"><img src="<?php echo base_url("assets/img/prohibit.png"); ?>"></a>
        <?php
    }
    ?>
</td>


<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
        <?php $this->load->view("Partials/DataTableCss"); ?>
    </head>

    <body>
        <?php $this->load->view('Partials/TopHeader'); ?>
        <?php $this->load->view('Partials/NavbarView'); ?>
        <div class="dashboard-wrapper" ng-app="SalaryAdvanceApp" ng-controller="SalaryAdvanceAppCtrl">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row gutter">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="page-title">
                                            <h3>Salary Advance Manager</h3>
                                            <ol class="breadcrumb">
                                                <li><a href="<?php echo base_url(); ?>">Dashboard</a></li>
                                                <li><a href="<?php ?>">Employee</a></li>
                                                <li class="active">Salary Advance</li>
                                            </ol>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-right">
                                        <?php $this->load->view("Partials/IconBarsView"); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!--Salary Advance Panel-->
                <section ng-show="SalaryAdvancePanel">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class=" panel-heading">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button class="btn btn-warning btn-hd"><img src="<?php echo base_url("assets/img/icons/list.png"); ?>"></button>
                                            <strong> &nbsp;Salary Advance</strong>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default bg-white text-danger"> <strong>ECODE-{{EmployeeCode}}</strong> </button>
                                                <button type="button" class="btn btn-default bg-white text-green"><strong>{{EmpName}}</strong> </button>
                                                <a href="<?php echo base_url('app/advance/payment'); ?>" class="btn btn-danger">Close</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <section>
                                        <table class="table table-striped table-bordered no-margin" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Date</th>
                                                    <th>Advance Amount</th>
                                                    <th>PayType</th>
                                                    <th>Mode</th>
                                                    <th>Bank</th>
                                                    <th>RefNo</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="d3 in advances" ng-cloak>
                                                    <td>
                                                        <button class="btn btn-success btn-xs">
                                                            <img src="<?php echo base_url("assets/img/icons/category1.png"); ?>">
                                                        </button>
                                                    </td>
                                                    <td class="text-bold text-green" ng-cloak>{{d3.AdvanceDate}}</td>
                                                    <td class="text-bold text-danger" ng-cloak>{{d3.AdvanceAmount}}</td>
                                                    <td ng-cloak ng-if="d3.PayType == 1"><strong>CASH</strong></td>
                                                    <td ng-cloak ng-if="d3.PayType == 2"><strong>OTHERS</strong></td>
                                                    <td ng-cloak>{{d3.PaymentMode}}</td>
                                                    <td ng-cloak>{{d3.Bank}}</td>
                                                    <td ng-cloak>{{d3.RefNo}}</td>
                                                    <td>
                                                        <img src="<?php echo base_url('assets/img/delete.png'); ?>" alt="">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </section>
                                    <div class="panel-footer">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-light  text-danger"> <strong>TOTAL ADVANCE</strong> </button>
                                                    <button type="button" class="btn btn-light  text-danger"><strong>{{TotalAdvance}}</strong> </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--Salary Advance Panel End-->

                <section>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class=" panel-heading">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button class="btn btn-warning btn-hd"><img src="<?php echo base_url("assets/img/icons/list.png"); ?>"></button>
                                            <strong> &nbsp;{{LabelModel}}</strong>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>


        <?php $this->load->view("Partials/FooterView"); ?>
        <?php $this->load->view("Partials/TestJs"); ?>
        <?php $this->load->view("Partials/JqueryUI"); ?>
        <?php $this->load->view("Partials/AngularJs"); ?>
        <?php $this->load->view("Partials/SweetAlertJs"); ?>
        <?php $this->load->view("Partials/DateJs"); ?>
        <?php $this->load->view("Partials/SalaryAdvanceJs"); ?>
    </body>

</html>

<!--Scrollsample-->
<div class="scrollbar" id="style-10">
    <div class="force-overflow">
    </div>
</div>    

Array
(
[0] => Array
(
[Salutation] => Dr
[FirstName] => Nilambar
[LastName] => Panda
[MobileNo] => 8956784589
[CommisionAmount] => 93.00
[PayAmount] => 93.00
)

[1] => Array
(
[Salutation] => Dr
[FirstName] => Amit
[LastName] => Panigrahi
[MobileNo] => 7077607837
[CommisionAmount] => 32.00
[PayAmount] => 32.00
)

[2] => Array
(
[Salutation] => Miss
[FirstName] => Anuradha
[LastName] => Mahopatra
[MobileNo] => 7845895685
[CommisionAmount] => 40.00
[PayAmount] => 40.00
)

[3] => Array
(
[Salutation] => Dr
[FirstName] => Devid
[LastName] => Shephard
[MobileNo] => 8956235689
[CommisionAmount] => 285.00
[PayAmount] => 280.00
)

[4] => Array
(
[Salutation] => Dr
[FirstName] => Menaka
[LastName] => Singhania
[MobileNo] => 785895685
[CommisionAmount] => 73.50
[PayAmount] => 73.50
)

)

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-3">
                <p class="h-v-m mb-0"><strong>TODAY VISIT<span class="text-danger">({{PatientCountModel}})</span></strong></p>
            </div>
            <div class="col-md-7 text-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-light "><img src="<?php echo base_url('assets/img/icons/back-20.png'); ?>" ng-click="previousDay()" alt=""></button>
                    <button type="button" class="btn btn-light "><span class="t-15 text-bold" ng-cloak>{{TodayModel}} {{CurrentDateModel}}</span></button>
                    <button type="button" class="btn btn-light "><img src="<?php echo base_url('assets/img/icons/next-20.png'); ?>" ng-click="nextDay()" alt=""></button>
                </div>
            </div>
            <div class="col-md-2">
            </div>
        </div>
    </div>
    <div class="panel-body">
        <div class="scrollbar pad-0 height-200" id="style-7">
            <div class="force-overflow white-bg">
                <table class="table list">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Patient Name</th>
                            <th>MR Number</th>
                            <th>Report No</th>
                            <th>Report Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="d1 in todayvisits" ng-cloak>
                            <td><button class="btn btn-success btn-xs" type="button"><img src="<?php echo base_url("assets/img/icons/location.png"); ?>"></button></td>
                            <td>{{d1.FirstName}} {{d1.LastName}}</td>
                            <td class="text-danger text-bold">{{d1.MRNo}}</td>
                            <td ng-if="d1.ReceiptNo == null"><span class="badge badge-danger">No</span></td>
                            <td class="text-green text-bold" ng-if="d1.ReceiptNo != null"><span>{{d1.ReceiptNo}}</span></td>
                            <th ng-if="d1.IsReportGenerated == null"><span class="badge badge-danger">No</span></th>
                            <th ng-if="d1.IsReportGenerated == 1"><span class="badge badge-success">Yes</span></th>
                        </tr>
                    </tbody>
                </table>
                <div ng-show="Error1Model" class="text-center m-t-10 text-danger">{{error1}}</div>
                <div ng-show="Spinner1" class="text-center m-t-10"><img src="<?php echo base_url('assets/img/icons/loader.png'); ?>"></div>
            </div>
        </div>
    </div>
    <div class="panel-footer">
        <a href="<?php echo base_url('app/patient/registration'); ?>" class="btn btn-light"><img src="<?php echo base_url("assets/img/icons/registration.png"); ?>"> New Registration</a>
        <a href="javascript:void(0)" class="btn btn-light"><img src="<?php echo base_url("assets/img/icons/registration.png"); ?>"> Visit Details</a>
        <a href="javascript:void(0)" class="btn btn-light"><img src="<?php echo base_url("assets/img/icons/registration.png"); ?>"> Create Invoice</a>
    </div>
</div>