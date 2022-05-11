<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>

    <body>
        <?php $this->load->view('Partials/NavbarView'); ?>
        <div class="container-fluid" ng-app="BloodGroupApp" ng-controller="BloodGroupAppCtrl">
            <div class="card card shadow border-primary mt-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p class="fs-5 m-0">Blood Group</p>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Blood Group</li>
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
                        <div class="col-md-12">
                            <div class="card shadow border-warning" ng-show="ListPanel">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button class="btn btn-warning btn-sm shadow"><img src="<?php echo base_url("assets/img/icons/blood1.png"); ?>"></button>
                                            <strong> Blood Groups</strong>
                                        </div>
                                        <div class="col-md-6">
                                            <button class="btn btn-outline-dark shadow float-end rounded-0 btn-sm" ng-click="showAddPanel()" type="button"><img src="<?php echo base_url("assets/img/icons/add.png"); ?>"> Add Blood Group</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pad-0">
                                    <div class="scrollbar" id="style-7">
                                        <div class="force-overflow">
                                            <table class="table table-bordered border-warning table-striped mt-5 table-sm">
                                                <thead class="bg-warning">
                                                    <tr>
                                                        <th class="border-start-0 text-center">#</th>
                                                        <th>Blood Group Name</th>
                                                        <th>Description</th>
                                                        <th class="border-end-0">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $count = 1;
                                                    if (isset($bloodgroups)) {
                                                        if (!empty($bloodgroups)) {
                                                            foreach ($bloodgroups as $v) {
                                                                ?>
                                                                <tr>
                                                                    <td class="border-start-0 text-center">
                                                                        <button class="btn btn-success btn-sm">
                                                                            <img src="<?php echo base_url("assets/img/icons/blood.png"); ?>">
                                                                        </button>
                                                                    </td>
                                                                    <td><?php echo $v['BloodGroup']; ?></td>
                                                                    <td><?php echo $v['Description']; ?></td>
                                                                    <td class="border-end-0">
                                                                        <?php
                                                                        if ($this->aauth->is_admin() || $this->aauth->is_allowed('Delete')) {
                                                                            ?>
                                                                            <a href="#" ng-click="deleteBG(<?php echo $v['ID']; ?>)"><img src="<?php echo base_url("assets/img/delete.png"); ?>"></a>
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
                                                                            <a href="#" ng-click="editBG(<?php echo $v['ID']; ?>)"><img src="<?php echo base_url("assets/img/edit.png"); ?>"></a>
                                                                            <?php
                                                                        } else {
                                                                            ?>
                                                                            <a href="#"><img src="<?php echo base_url("assets/img/prohibit.png"); ?>"></a>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </td>
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card shadow border-warning" ng-show="AddPanel">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button class="btn btn-warning btn-sm"><img src="<?php echo base_url("assets/img/icons/category1.png"); ?>"></button>
                                            <strong> &nbsp;<span ng-bind="ActionText"></span> Blood Group</strong>
                                        </div>
                                        <div class="col-md-6">
                                            <button ng-click="reset()" class="btn btn-outline-dark float-end rounded-0 btn-sm" type="button"><img src="<?php echo base_url("assets/img/icons/close1.png"); ?>"></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label"><strong>Blood Group Name</strong><span class="text-bold text-18 text-red">*</span></label>
                                                        <input class="form-control input-sm" type="text" name="BloodGroup" ng-model="BloodGroupModel" placeholder="Enter Blood Group Name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label"><strong>Description</strong></label>
                                                        <input class="form-control input-sm" type="text" name="Description" ng-model="DescriptionModel" placeholder="Enter Description">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-primary " ng-show="SaveBtn" ng-click="saveBloodGroup()" type="button"><span class="icon-save"></span> Save</button>
                                    <button class="btn btn-warning " ng-show="UpdateBtn" ng-click="updateBloodGroup()" type="button"><span class="icon-save"></span> Update</button>
                                    <a href="<?php echo base_url('app/blood/group'); ?>" class="btn btn-danger"><span class="icon-update"></span> Close</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php $this->load->view("Partials/FooterView"); ?>
        <?php $this->load->view("Partials/JqueryUI"); ?>
        <?php $this->load->view("Partials/AngularJs"); ?>
        <?php $this->load->view("Partials/SweetAlertJs"); ?>
        <?php $this->load->view("Partials/BloodGroupJs"); ?>
    </body>
</html>