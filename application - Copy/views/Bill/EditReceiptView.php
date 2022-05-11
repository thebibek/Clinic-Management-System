<!--Edit Receipt Part Start Here-->
<section ng-show="EditPanel">
    <div class="card card shadow border-warning">
        <div class="card-header">
            <div class="row gutter">
                <div class="col-lg-6 col-md-6">
                    <h4 class="text-muted"> Edit Bill</h4>
                </div>
                <div class="col-lg-6 col-md-6 text-end">
                    <a href="<?php echo base_url('app/bills'); ?>" class="btn btn-outline-dark btn-sm rounded-0"><img src="<?php echo base_url("assets/img/icons/close1.png"); ?>"></a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="card border-warning shadow mb-3">
                        <div class="card-body bg-white">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button data-bs-toggle="modal" title="Find Doctor"  data-bs-target="#myModal" class="btn btn-sm btn-info rounded-0 border-primary">Search</button>
                                    <div class="form-group">
                                        <label class="control-label" for="refererdoctor">Referer Doctor</label>
                                        <input type="text" class="form-control border-warning bg-light" ng-model="DoctorNameModel" value="" id="DoctorName" readonly="">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="mobileno">Mobile No</label>
                                        <input type="text" class="form-control border-warning bg-light" value="" ng-model="DoctorMobileNoModel" value="" id="DrMobileNo" readonly="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-warning shadow">
                        <div class="card-header">
                            <button class="btn btn-success btn-sm"><img src="<?php echo base_url("assets/img/icons/patient2.png"); ?>"></button><strong> Patient Information</strong>
                        </div>
                        <div class="card-body">
                            <div class="row g-2">
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label class="control-label text-red">MRNo</label>
                                        <input type="text" class="form-control border-warning rounded-0 bg-light text-danger" placeholder="Enter MR No" ng-model="MRNoModel">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-info border-primary rounded-0 mt-4" ng-click="getPatient()"><span class="glyphicon glyphicon-search"></span> Search</button>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row gutter">
                                    <div class="col-md-12">
                                        <label class="control-label">Patient Name</label>
                                        <input type="text" class="form-control border-warning rounded-0" placeholder="Enter Patient Name" ng-model="PatientNameModel" name="" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <div class="row gutter">
                                    <div class="col-md-12">
                                        <label class="control-label">Age(Years)</label>
                                        <input type="text" class="form-control border-warning rounded-0" ng-model="AgeModel" placeholder="Enter Years" id="" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <div class="row gutter">
                                    <div class="col-md-12">
                                        <label class="control-label">Gender</label>
                                        <select  class="form-select border-warning rounded-0" ng-model="GenderModel" readonly>
                                            <option value="">Please Select Gender</option>
                                            <option value="1">Male</option>
                                            <option value="2">Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <div class="row gutter">
                                    <div class="col-md-12">
                                        <label class="control-label">Mobile No</label>
                                        <input type="text" class="form-control border-warning rounded-0" ng-model="PatientMobileNoModel" onkeypress="return isNumber(event)" maxlength="15" placeholder="Enter Mobile No" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card border-warning shadow mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <form id="SearchTestPanel">
                                        <div class="form-group">
                                            <label class="control-label" for="Test">Enter TestNo or Test Name</label>
                                            <div class="input-group mb-3">
                                                <button class="btn btn-outline-warning" type="button"><img src="<?php echo base_url("assets/img/icons/test1.png"); ?>"></button>
                                                <input type="text" class="form-control" ng-model="TestModel" id="TestAutoSearch" placeholder="Enter Test No Or Test Name For Searching" aria-describedby="basic-addon1">
                                                <button class="btn btn-danger border-danger" type="button" id="button-addon2">Search Test</button>
                                                <button class="btn btn-primary" ng-click="addTest()" type="button">+ ADD</button>
                                            </div>
                                        </div>
                                    </form>	
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-warning shadow mb-2">
                        <div class="card-header">
                            <button class="btn btn-warning btn-sm" type="button">
                                <img src="<?php echo base_url("assets/img/icons/list2.png"); ?>">
                            </button>
                            <strong> &nbsp;&nbsp;List Of Added Test</strong>
                        </div>
                        <div class="card-body p-0">
                            <div class="scrollbar1" id="style-7">
                                <div class="force-overflow">
                                    <table class="table table-bordered border-primary table-striped table-sm">
                                        <thead class="bg-primary text-white">
                                            <tr>
                                                <th class="border-start-0 text-center">#</th>
                                                <th>Test No</th>
                                                <th>Test Description</th>
                                                <th>Charges</th>
                                                <th class="border-end-0">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody ng-cloak>
                                            <tr ng-repeat="d1 in tests">
                                                <td class="border-start-0 text-center"><button class="btn btn-success btn-sm"><img src="<?php echo base_url("assets/img/icons/test3.png"); ?>"></button></td>
                                                <td>{{d1.TestNo}}</td>
                                                <td>{{d1.TestDescription}}</td>
                                                <td>{{d1.Charges}}</td>
                                                <td class="border-end-0">
                                                    <button class="btn btn-danger btn-sm" ng-click="removeTest($index)" type="button">--</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>   
                        </div>
                    </div>
                    <div class="card border-warning shadow">
                        <div class="card-body">
                            <div class="row g-2">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text bg-danger border-danger text-white rounded-0" id="basic-addon1">SUB TOTAL</span>
                                        <input type="text" class="form-control border-danger rounded-0 text-success" ng-model="SubTotalModel" placeholder="0.00" readonly>
                                    </div>

                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text bg-success border-success text-white rounded-0" id="basic-addon1">DISCOUNT</span>
                                        <input type="text" class="form-control border-success rounded-0 text-info" ng-model="DiscountModel" ng-change="discount()" placeholder="0.00">
                                    </div>

                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text bg-warning border-warning text-white rounded-0" id="basic-addon1">NET AMOUNT</span>
                                        <input type="text" class="form-control border-warning rounded-0 text-dark" ng-model="NetAmountModel" placeholder="0.00" readonly>
                                    </div>

                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text bg-info border-info text-white rounded-0" id="basic-addon1">PAID</span>
                                        <input type="text" class="form-control border-info rounded-0 text-dark" ng-change="payment()" ng-model="PaidModel" placeholder="0.00">
                                    </div>

                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text bg-primary border-primary text-white rounded-0" id="basic-addon1">DUE</span>
                                        <input type="text" class="form-control border-primary rounded-0 text-dark" ng-model="DueModel" placeholder="0.00" readonly>
                                    </div>

                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text bg-secondary border-secondary text-white rounded-0" id="basic-addon1">PAY BACK</span>
                                        <input type="text" class="form-control border-secondary rounded-0 text-dark" ng-model="PayBackModel" placeholder="0.00" readonly>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="<?php echo base_url('app/receipt'); ?>" class="btn btn-dark rounded-0">New</a> 
                            <a href="javascript:void(0)" ng-show="SaveBtn" ng-click="saveBill(0)" class="btn btn-danger rounded-0">Save</a> 
                            <a href="javascript:void(0)" ng-show="UpdateBtn" class="btn btn-warning rounded-0">Update</a> 
                            <a href="javascript:void(0)" ng-click="saveBill(1)" class="btn btn-success rounded-0">Save and Print</a> 
                            <a href="<?php echo base_url("app/report"); ?>" class="btn btn-secondary rounded-0">Report</a> 
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="card border-warning shadow mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label text-red" >Receipt No.</label>
                                        <input type="text" class="form-control bg-light border-warning rounded-0 text-danger fw-bold" ng-model="ReceiptNoModel"  id="" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label" >Date Time</label>
                                        <input type="text" class="form-control bg-light border-warning rounded-0" value="" ng-model="ReceiptDateModel"  id="" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-warning shadow">
                        <div class="card-header">
                            <button class="btn btn-warning btn-sm shadow" type="button">
                                <img src="<?php echo base_url("assets/img/icons/list2.png"); ?>">
                            </button>
                            <strong> &nbsp;&nbsp; Pending Reports</strong>
                        </div>
                        <div class="card-body p-0">
                            <div class="scrollbar" id="style-7">
                                <div class="force-overflow">
                                    <table class="table table-bordered table-striped border-primary  table-sm">
                                        <thead class="bg-primary text-white">
                                            <tr>
                                                <th class="border-start-0 text-center">#</th>
                                                <th>ReceiptNo</th>
                                                <th class="border-end-0">Patient Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count = 1;
                                            if (isset($pendingReports)) {
                                                if (!empty($pendingReports)) {
                                                    foreach ($pendingReports as $pr) {
                                                        ?>
                                                        <tr class="test-row" ng-click="generateReport(<?php echo $pr['ReceiptNo']; ?>)">
                                                            <td class="border-start-0 text-center">
                                                                <?php echo $count; ?>
                                                            </td>
                                                            <td><?php echo $pr['ReceiptNo']; ?></td>
                                                            <td class="border-end-0"><?php echo $pr['FirstName'] . " " . $pr['LastName']; ?></td>

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
        </div>
    </div>
</section>
<!--Edit Receipt Part End Here-->