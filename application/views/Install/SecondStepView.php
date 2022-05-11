<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>    

    <body>
        <div class="container-fluid p-5">
            <div class="row gutter">
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <div class="row ">
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
                                                <a href="#" class="list-group-item list-group-item-action active">Database</a>
                                                <a href="#" class="list-group-item list-group-item-action">Install</a>
                                                <a href="#" class="list-group-item list-group-item-action">Finish</a>
                                            </div> 
                                        </div>
                                        <div class="col-md-7">
                                            <?php echo $this->session->flashdata('error'); ?>
                                            <form method="post" action="<?php echo base_url('install/validate/database'); ?>">
                                                <div class="form-group">
                                                    <label class="control-label">MySql Host</label>
                                                    <input class="form-control input-sm" type="text" name="Host"  placeholder="Enter mysql host name">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Database Name</label>
                                                    <input class="form-control input-sm" type="text" name="Database" placeholder="Enter database name">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">User Name</label>
                                                    <input class="form-control input-sm" type="text" name="UserName" placeholder="Enter database user name">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Password</label>
                                                    <input class="form-control input-sm" type="password" name="Password" placeholder="Enter database password">
                                                </div>

                                                <div class="text-end mt-3">
                                                    <a href="<?php echo base_url(); ?>" class="btn btn-secondary">Back</a>
                                                    <button type="submit"  class="btn btn-primary">Next</button>
                                                </div>
                                            </form> 
                                            
                                            <p class="text-danger mt-2">Note :  This wizard will take longer time.don't hit back button.</p>
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