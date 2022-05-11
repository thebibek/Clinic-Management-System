<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>

    <body>
        <?php $this->load->view('Partials/NavbarView'); ?>
        <div class="container-fluid" ng-app="NationalityApp" ng-controller="NationalityAppCtrl">
            <div class="card card shadow border-primary mt-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p class="fs-5 m-0">Nationality</p>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url("app/dashboard"); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Nationality</li>
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
                            <div class="card border-warning shadow" ng-show="ListPanel">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button class="btn btn-warning btn-sm shadow"><img src="<?php echo base_url("assets/img/icons/nationality2.png"); ?>"></button>
                                            <strong> Manage Nationality</strong>
                                        </div>
                                        <div class="col-md-6">
                                            <button class="btn btn-outline-dark rounded-0 btn-sm shadow float-end" ng-click="showAddPanel()" type="button"><img src="<?php echo base_url("assets/img/icons/add2.png"); ?>"> Add Nationality</button>
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
                                                        <th>Nationality</th>
                                                        <th>Short Name</th>
                                                        <th class="border-end-0">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $count = 1;
                                                    if (isset($nationalities)) {
                                                        if (!empty($nationalities)) {
                                                            foreach ($nationalities as $v) {
                                                                ?>
                                                                <tr>
                                                                    <td class="border-start-0 text-center">
                                                                        <button class="btn btn-info shadow btn-sm">
                                                                            <img src="<?php echo base_url("assets/img/icons/nationality.png"); ?>">
                                                                        </button>
                                                                    </td>
                                                                    <td><?php echo $v['Nationality']; ?></td>
                                                                    <td><?php echo $v['ShortName']; ?></td>
                                                                    <td class="border-end-0">
                                                                        <?php
                                                                        if ($this->aauth->is_admin() || $this->aauth->is_allowed('Delete')) {
                                                                            ?>
                                                                            <a href="#" ng-click="deleteNationality(<?php echo $v['ID']; ?>)"><img src="<?php echo base_url("assets/img/delete.png"); ?>"></a>
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
                                                                            <a href="#" ng-click="editNationality(<?php echo $v['ID']; ?>)"><img src="<?php echo base_url("assets/img/edit.png"); ?>"></a>
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
                    <div class="row gutter">
                        <div class="col-md-12">
                            <div class="card border-warning shadow" ng-show="AddPanel">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button class="btn btn-warning btn-sm shadow"><img src="<?php echo base_url("assets/img/icons/add2.png"); ?>"></button>
                                            <strong> &nbsp;Add Nationality</strong>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <button ng-click="reset()" class="btn btn-outline-dark btn-sm rounded-0 float-end" type="button"><img src="<?php echo base_url("assets/img/icons/close1.png"); ?>"></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label"><strong>Nationality</strong><span class="text-bold text-18 text-red">*</span></label>
                                                        <input class="form-control input-sm" type="text" name="Nationality" ng-model="NationalityModel" placeholder="Enter Nationality">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label"><strong>Short Name</strong></label>
                                                        <input class="form-control input-sm" type="text" name="ShortName" ng-model="ShortNameModel" placeholder="Enter Short Name">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-primary" ng-show="SaveBtn" ng-click="saveNationality()" type="button"> Save</button>
                                    <button class="btn btn-warning" ng-show="UpdateBtn" ng-click="updateNationality()" type="button"> Update</button>
                                    <a href="<?php echo base_url('app/nationality'); ?>" class="btn btn-danger"> Close</a>
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
        <?php $this->load->view("Partials/NationalityJs"); ?>
    </body>
</html>