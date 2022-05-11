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
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="list-group rounded-0">
                                                <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                                    Requirements
                                                </a>
                                                <a href="#" class="list-group-item list-group-item-action">Database</a>
                                                <a href="#" class="list-group-item list-group-item-action">Install</a>
                                                <a href="#" class="list-group-item list-group-item-action active">Finish</a>
                                            </div> 
                                        </div>
                                        <div class="col-md-7">
                                            <h3>PathoCare Installed Successfully.</h3>
                                            <a href="<?php echo base_url(); ?>" class="btn btn-danger">Lunch The Application</a>
                                        </div>
                                    </div>
                                    <br>
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