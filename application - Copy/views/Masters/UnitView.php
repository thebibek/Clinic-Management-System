<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>
    <body>
        <?php $this->load->view('Partials/NavbarView'); ?>
        <div class="container-fluid"  ng-app="UnitApp" ng-controller="UnitAppCtrl">
            <div class="card shadow border-primary mt-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <p class="fs-5 m-0">Units</p>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Dashboard</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Units</li>
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
                <div class="card-body">
                    <div class="row" >
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card shadow border-warning" ng-show="ListPanel">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button class="btn btn-warning btn-sm shadow"><img src="<?php echo base_url("assets/img/icons/list.png"); ?>"></button> <strong>Manage Units</strong>
                                        </div>
                                        <div class="col-md-6">
                                            <button class="btn btn-outline-dark btn-sm rounded-0 float-end" ng-click="showAddPanel()" type="button"><img src="<?php echo base_url("assets/img/icons/add.png"); ?>"> Add Unit</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-0" >
                                    <div class="scrollbar" id="style-7">
                                        <div class="force-overflow">
                                            <table class="table table-bordered border-warning table-striped mt-5 table-sm">
                                                <thead class="bg-warning">
                                                    <tr>
                                                        <th class="border-start-0 text-center">#</th>
                                                        <th>Unit</th>
                                                        <th>Description</th>
                                                        <th class="border-end-0">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $count = 1;
                                                    if (isset($units)) {
                                                        if (!empty($units)) {
                                                            foreach ($units as $unit) {
                                                                ?>
                                                                <tr>
                                                                    <td class="border-start-0 text-center">
                                                                        <button class="btn btn-info btn-sm">
                                                                            <img src="<?php echo base_url("assets/img/icons/unit1.png"); ?>">
                                                                        </button>
                                                                    </td>
                                                                    <td><?php echo $unit['Unit']; ?></td>
                                                                    <td><?php echo $unit['Description']; ?></td>

                                                                    <td class="border-end-0">
                                                                        <?php
                                                                        if ($this->aauth->is_admin() || $this->aauth->is_allowed('Delete')) {
                                                                            ?>
                                                                            <a href="#" ng-click="deleteUnit(<?php echo $unit['ID']; ?>)"><img src="<?php echo base_url("assets/img/delete.png"); ?>"></a>
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
                                                                            <a href="#" ng-click="editUnit(<?php echo $unit['ID']; ?>)"><img src="<?php echo base_url("assets/img/edit.png"); ?>"></a>
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
                                            <button class="btn btn-warning btn-sm"><img src="<?php echo base_url("assets/img/icons/unit1.png"); ?>"></button>
                                            <strong> {{actionText}} Unit</strong>
                                        </div>
                                        <div class="col-md-6">
                                            <button ng-click="reset()" class="btn btn-outline-danger btn-sm float-end" type="button"><img src="<?php echo base_url("assets/img/icons/close1.png"); ?>"></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group mb-2">
                                                        <label class="control-label"><strong>Unit</strong><span class="text-bold text-18 text-red">*</span></label>
                                                        <input class="form-control" type="text" name="Unit" ng-model="UnitModel" placeholder="Please Enter Unit">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label"><strong>Short Description</strong></label>
                                                        <input class="form-control" type="text" name="ShortDescription" ng-model="ShortDescriptionModel" placeholder="Enter Short Description">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button class="btn btn-primary" ng-show="SaveBtn" ng-click="saveUnit()" type="button"><span class="icon-save"></span> Save</button>
                                            <button class="btn btn-success" ng-show="UpdateBtn" ng-click="updateUnit()" type="button"><span class="icon-save"></span> Update</button>
                                            <a href="<?php echo base_url('app/unit'); ?>" class="btn btn-danger"><span class="icon-update"></span> Close</a>
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
        <?php $this->load->view("Partials/UnitJs"); ?>
    </body>
</html>