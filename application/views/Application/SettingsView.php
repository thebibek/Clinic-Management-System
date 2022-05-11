<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>

    <body>
        <?php $this->load->view('Partials/NavbarView'); ?>
        <div class="container-fluid" ng-app="SettingsApp" ng-controller="SettingsAppCtrl">
            <div class="card border-primary shadow mt-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <p class="fs-5 m-0">Settings</p>
                                            <nav aria-label="breadcrumb">
                                                <ol class="breadcrumb">
                                                    <li class="breadcrumb-item"><a href="<?php echo base_url("app/dashboard"); ?>">Dashboard</a></li>
                                                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('app/employee/registration'); ?>">HRM</a></li>
                                                    <li class="breadcrumb-item active">Employee Registration</li>
                                                </ol>
                                            </nav>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <?php $this->load->view("Partials/IconBarsView"); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row gutter">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card border-warning shadow">
                                <div class="card-header border-warning bg-light">
                                    <ul class="nav nav-tabs card-header-tabs">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">General Information</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Global Setting</button>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <div class="card border-dark shadow">
                                                <div class="card-header">
                                                    <h4>Settings</h4>
                                                </div>
                                                <div class="card-body">
                                                    <form class="bv-form">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <div class="row gutter">
                                                                        <div class="col-md-12"><label class="control-label">Lab Name</label>
                                                                            <input type="text" class="form-control" placeholder="Lab Name" name="LabName" ng-model="LabNameModel">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <div class="row gutter">
                                                                        <div class="col-md-12"><label class="control-label">Address</label>
                                                                            <input type="text" class="form-control" placeholder="Address" name="Address" ng-model="AddressModel">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <div class="row gutter">
                                                                        <div class="col-md-12"><label class="control-label">Phone No1</label>
                                                                            <input type="text" class="form-control" placeholder="Phone No 1" name="PhoneNo1" ng-model="PhoneNo1Model">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <div class="row gutter">
                                                                        <div class="col-md-12"><label class="control-label">Phone No2</label>
                                                                            <input type="text" class="form-control" placeholder="Phone No 2" name="PhoneNo2" ng-model="PhoneNo2Model">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <div class="row gutter">
                                                                        <div class="col-md-12"><label class="control-label">Tag Line</label>
                                                                            <input type="text" class="form-control" placeholder="Tag Line " name="TagLine" ng-model="TagLineModel">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <div class="row gutter">
                                                                        <div class="col-md-12"><label class="control-label">Email</label>
                                                                            <input type="text" class="form-control" placeholder="Email" name="Email" ng-model="EmailModel">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <div class="row gutter">
                                                                        <div class="col-md-12"><label class="control-label">Website</label>
                                                                            <input type="text" class="form-control" placeholder="Website" name="Website" ng-model="WebsiteModel">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <div class="row gutter">
                                                                        <div class="col-md-12"><label class="control-label">Regd No</label>
                                                                            <input type="text" class="form-control" placeholder="Regd No" name="Regd No" ng-model="RegdNoModel">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <div class="row gutter">
                                                                        <div class="col-md-12"><label class="control-label">Lab No</label>
                                                                            <input type="text" class="form-control" placeholder="Lab No" name="LabNo" ng-model="LabNoModel">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <div class="row gutter">
                                                                        <div class="col-md-12"><label class="control-label">Logo</label>
                                                                            <input type="file" class="form-control" file-input="files">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <div class="row gutter">
                                                                        <div class="col-md-12"><label class="control-label">Lab Technician Name</label>
                                                                            <input type="text" class="form-control" placeholder="Lab Technician Name" name="LabTechnicianName" ng-model="TechnicianNameModel">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <div class="row gutter">
                                                                        <div class="col-md-12"><label class="control-label">Lab Technician Qualifiation</label>
                                                                            <input type="text" class="form-control" placeholder="Lab Technician Qualifiation" name="Lab Technician Qualifiation" ng-model="TechnicianQualifiationModel">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label">Currency</label>
                                                                    <input type="text" class="form-control" placeholder="Enter currency symbol or text" ng-model="CurrencyModel">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label">Date Format</label>
                                                                    <select class="form-select" ng-model="DateFormatModel">
                                                                        <option value="">Please selet date format</option>
                                                                        <option value="1">DD-MM-YYYY</option>
                                                                        <option value="2">MM-DD-YYYY</option>
                                                                        <option value="3">YYYY-MM-DD</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>Report Without Header</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-text"><input type="checkbox" ng-true-value="'1'" ng-false-value="'0'" ng-model="IsPrintHeaderModel" style="height:15px;width:15px"></span>
                                                                        <input type="text" class="form-control" placeholder="check checkbox for report without header">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row gutter">
                                                                        <div class="col-md-12"><label class="control-label">Footer Note1</label>
                                                                            <input type="text" class="form-control" placeholder="Footer Note1" name="FooterNote1" ng-model="FooterNote1Model">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row gutter">
                                                                        <div class="col-md-12"><label class="control-label">Footer Note2</label>
                                                                            <input type="text" class="form-control" placeholder="Footer Note2" name="FooterNote2" ng-model="FooterNote2Model">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row gutter">
                                                                        <div class="col-md-12"><label class="control-label">Footer Note3</label>
                                                                            <input type="text" class="form-control" placeholder="Footer Note3" name="Footer Note3" ng-model="FooterNote3Model">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    </form>
                                                </div>
                                                <div class="card-footer">
                                                    <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-12"><button type="button" ng-click="saveSettings()" class="btn btn-warning shadow">Save</button></div>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="card border-dark shadow">
                                                        <div class="card-header">
                                                            Salary Slip Number Settings
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="input-group mb-3">
                                                                        <span class="input-group-text bg-danger border-danger  text-white"><input type="radio" name="SalarySlipSelection" ng-change="changeSlipNoType(0)" value="0" ng-model="SelectSlipModel"></span>
                                                                        <input type="text" class="form-control border-danger bg-light fw-bold text-danger" placeholder="Manual" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="input-group mb-3">
                                                                        <span class="input-group-text bg-warning border-warning  text-white"><input type="radio" name="SalarySlipSelection" value="1" ng-change="changeSlipNoType(1)" ng-model="SelectSlipModel" ng-checked="true"></span>
                                                                        <input type="text" class="form-control border-warning  fw-bold text-success" placeholder="Auto" readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                           
                                                            <div class="row">
                                                                <div class="col-md-8">
                                                                    <div class="input-group mb-3">
                                                                        <span class="input-group-text">Text</span>
                                                                        <input type="text" class="form-control  fw-bold text-success" placeholder="Enter Text" value="HR" ng-model="SlipTextModel">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <button class="btn btn-info border-primary rounded-0 shadow btn-sm" ng-click="slipAddText()">Add</button>
                                                                </div>
                                                            </div>
                                                           
                                                            <div class="row">
                                                                <div class="col-md-8">
                                                                    <div class="input-group mb-3">
                                                                        <span class="input-group-text">Current Year</span>
                                                                        <input type="text" class="form-control  fw-bold text-success" placeholder="Current Year" ng-model="SlipCurrentYearModel" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <button class="btn btn-info btn-sm border-primary rounded-0 shadow btn-block" ng-click="addSlipCurrentYear()">Add</button>
                                                                </div>
                                                            </div>
                                                           
                                                            <div class="row">
                                                                <div class="col-md-8">
                                                                    <div class="input-group mb-3">
                                                                        <span class="input-group-text">Starting No</span>
                                                                        <input type="text" class="form-control  fw-bold text-success" placeholder="Enter starting no" ng-model="SlipStartingNoModel"  >
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <button class="btn btn-info border-primary rounded-0 shadow btn-sm btn-block" ng-click="addSlipStartingNumber()">Add</button>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="input-group mb-3">
                                                                        <span class="input-group-text">Sample Slip No</span>
                                                                        <input type="text" class="form-control  fw-bold text-danger" placeholder="TEXT/YEAR/STARTING NO" ng-model="SalarySlipNoModel" value="HR/$YYYY$/$##$">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                           
                                                            <div class="row">
                                                                <div class="col-md-12 text-end">
                                                                    <button class="btn btn-primary" ng-click="saveGlobalSetting()">Save</button>
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
            </div>
        </div>

        <?php $this->load->view("Partials/FooterView"); ?>
        <?php $this->load->view("Partials/TestJs"); ?>
        <?php $this->load->view("Partials/JqueryUI"); ?>
        <?php $this->load->view("Partials/AngularJs"); ?>
        <?php $this->load->view("Partials/SweetAlertJs"); ?>
        <?php $this->load->view("Partials/CommonJs"); ?>
        <?php $this->load->view("Partials/SettingsJs"); ?>
    </body>
</html>