<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>    

    <body>

        <div class="container-fluid p-5">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">

                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <div class="row gutter">
                        <div class="col-md-12">
                            <div class="card shadow rounded-0  border-warning">
                                <div class="card-header shadow bg-warning rounded-0 border-warning">
                                   <h4 class="text-light">PathoCare Installation Wizard</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row gutter">
                                        <div class="col-md-5">
                                            <div class="list-group rounded-0">
                                                <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                                    Requirements
                                                </a>
                                                <a href="#" class="list-group-item list-group-item-action">Database</a>
                                                <a href="#" class="list-group-item list-group-item-action active">Install</a>
                                                <a href="#" class="list-group-item list-group-item-action">Finish</a>
                                            </div> 
                                        </div>
                                        <div class="col-md-7">
                                            <h3>Admin Details</h3>
                                            <?php echo $this->session->flashdata('error'); ?>
                                            <form method="post" action="<?php echo base_url('install/validate/setup'); ?>">
                                                <div class="form-group">
                                                    <label class="control-label">Email (Login ID)</label>
                                                    <input class="form-control input-sm" type="text" name="EmailId"  placeholder="Enter admin email id">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Password</label>
                                                    <input class="form-control input-sm" type="password" name="Password" placeholder="Enter password">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Confirm Password</label>
                                                    <input class="form-control input-sm" type="password" name="ConfirmPassword" placeholder="Enter confirm password">
                                                </div>

                                                <div class="text-end mt-3">
                                                    <a href="<?php echo base_url(); ?>" class="btn btn-secondary">Back</a>
                                                    <button type="submit"  class="btn btn-primary">Next</button>
                                                </div>
                                            </form>    
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row gutter">
                                        <div class="col-md-8">
                                            <p class="text-center">
                                                <?php
                                                if (isset($status) && $status == 0) {
                                                    echo $errormsg;
                                                }
                                                ?>
                                            </p>
                                        </div>    

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">

                </div>
            </div>
        </div>
        <?php $this->load->view("Partials/FooterView"); ?>
    </body>
</html>