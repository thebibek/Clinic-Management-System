<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>

    <body>
        <?php $this->load->view("Partials/NavbarView"); ?>
        <div class="container-fluid">
            <div class="card border-primary shadow mt-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p class="fs-5 m-0">Test Categories</p>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url("app/dashboard"); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('app/user/management'); ?>">Settings</a></li>
                                    <li class="breadcrumb-item active">Assign Permission</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <?php $this->load->view("Partials/IconBarsView"); ?>
                        </div>
                    </div>
                    
                </div>
                <div class="card-body">
                    <div class="row gutter">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card border-warning shadow">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button class="btn btn-warning btn-sm"><img src="<?php echo base_url("assets/img/icons/permission.png"); ?>"></button>
                                            <strong> &nbsp;Assign Permission</strong>
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-success"><?php echo $user->email; ?></a>    
                                                <a href="<?php echo base_url('app/user/management'); ?>" class="btn btn-danger">Close</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <form action="<?php echo base_url("app/assign/perm"); ?>" method="post">
                                                <input type="hidden"  name="UserID" value="<?php echo isset($userId) ? $userId : 0; ?>">    
                                                <table  class="table table-bordered border-warning">
                                                    <?php
                                                    if (isset($perms)) {
                                                        if (!empty($perms)) {
                                                            foreach ($perms as $p) {
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $p->name; ?></td>
                                                                    <td>
                                                                        <?php
                                                                        if (array_search($p->id, $assignedPerm) === false) {
                                                                            echo '<input type="checkbox" name="data[]" value="' . $p->id . '"  >';
                                                                        } else {
                                                                            echo '<input type="checkbox" name="data[]" value="' . $p->id . '" checked="checked">';
                                                                        }
                                                                        ?>

                                                                    </td>
                                                                </tr>

                                                                <?php
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <button type="submit" id="AssignUser" class="btn btn-primary">Save</button>
                                                            <a href="<?php echo base_url('app/user/management'); ?>"  class="btn btn-danger">Close</a>
                                                        </td>
                                                        <td>--</td>
                                                    </tr>                
                                                </table>
                                            </form>     
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->load->view("Partials/Footerview"); ?>
    </body>
</html>