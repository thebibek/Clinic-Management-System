<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>
    
    <body>
        <?php $this->load->view('Partials/NavbarView'); ?>
        <div class="container-fluid" ng-app="CategoryApp" ng-controller="CategoryAppCtrl">
            <div class="card shadow border-primary mt-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p class="fs-5 m-0">Test Categories</p>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Category</li>
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
                            <div class="card shadow border-warning" ng-show="CategoryListPanel">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button class="btn btn-warning btn-sm shadow"><img src="<?php echo base_url("assets/img/icons/list.png"); ?>"></button>
                                            <strong> Manage Categories</strong>
                                        </div>
                                        <div class="col-md-6">
                                            <button class="btn btn-outline-dark btn-sm rounded-0 float-end" ng-click="showAddPanel()" type="button"><img src="<?php echo base_url("assets/img/icons/add.png"); ?>"> Add Category</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="scrollbar" id="style-7">
                                        <div class="force-overflow">
                                            <table class="table table-bordered border-warning table-striped mt-5 table-sm">
                                                <thead>
                                                    <tr class="bg-warning">
                                                        <th class="border-start-0 text-center">#</th>
                                                        <th>Category</th>
                                                        <th>Short Name</th>
                                                        <th class="border-end-0">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $count = 1;
                                                    if (isset($categories)) {
                                                        if ($categories !== FALSE) {
                                                            foreach ($categories as $category) {
                                                                ?>
                                                                <tr>
                                                                    <td class="border-start-0 text-center">
                                                                        <button class="btn btn-success btn-sm">
                                                                            <img src="<?php echo base_url("assets/img/icons/category1.png"); ?>">
                                                                        </button>
                                                                    </td>
                                                                    <td><?php echo $category['Category']; ?></td>
                                                                    <td><?php echo $category['ShortName']; ?></td>
                                                                    <td class="border-end-0">
                                                                        <?php
                                                                        if ($this->aauth->is_admin() || $this->aauth->is_allowed('Delete')) {
                                                                            ?>
                                                                            <a href="#" ng-click="deleteCategory(<?php echo $category['ID']; ?>)"><img src="<?php echo base_url("assets/img/delete.png"); ?>"></a>
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
                                                                            <a href="#" ng-click="editCategory(<?php echo $category['ID']; ?>)"><img src="<?php echo base_url("assets/img/edit.png"); ?>"></a>
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
                                            <button class="btn btn-warning btn-sm shadow"><img src="<?php echo base_url("assets/img/icons/category1.png"); ?>"></button>
                                            <strong> &nbsp;Add New Category</strong>
                                        </div>
                                        <div class="col-md-6">
                                            <button ng-click="reset()" class="btn btn-outline-dark rounded-0 float-end btn-sm" type="button"><img src="<?php echo base_url("assets/img/icons/close1.png"); ?>"></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label"><strong>Category</strong><span class="text-bold text-18 text-red">*</span></label>
                                                        <input class="form-control input-sm" type="text" name="Category" ng-model="CategoryModel" placeholder="Enter Category">
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
                                    <button class="btn btn-primary" ng-click="saveCategory()" type="button"> Save</button>
                                    <a href="<?php echo base_url('app/category'); ?>" class="btn btn-danger "> Close</a>
                                </div>
                            </div>
                            <div class="card border-dark shadow" ng-show="EditPanel">
                                <div class="card-header">
                                    <span><img src="<?php echo base_url("assets/img/icons/add2.png"); ?>"><strong>Update Category</strong></span>
                                    <button ng-click="reset()" class="btn btn-danger rounded-0 shadow btn-sm float-end" type="button">X</button>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label"><strong>Category</strong><span class="text-bold text-18 text-red">*</span></label>
                                                <input class="form-control input-sm" type="text" name="Category" ng-model="CategoryModel" placeholder="Enter Category">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label"><strong>Short Name</strong></label>
                                                <input class="form-control input-sm" type="text" name="ShortName" ng-model="ShortNameModel" placeholder="Enter Short Name">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="btn-box">
                                                <button class="btn btn-warning shadow" ng-click="updateCategory()" type="button"><span class="icon-save"></span> Update</button>
                                                <a href="<?php echo base_url('app/category'); ?>" class="btn btn-danger shadow"><span class="icon-update"></span> Close</a>
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
        <?php $this->load->view("Partials/CategoryJs"); ?>
    </body>
</html>