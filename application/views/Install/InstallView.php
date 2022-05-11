<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>

    <body>
        <div class="container p-5">
            <div class="card border-warning shadow rounded-0">
                <div class="card-header shadow">
                    <span class="fs-5 text-danger fw-bold"><img src="<?php echo base_url("assets/img/logo.png"); ?>" width="40" height="40"> PathoCare</span>
                </div>
                <div class="card-body">
                    <div class="card mb-3 p-5 shadow rounded-pill">
                        <div class="row g-0">
                            <div class="col-md-4 text-center">
                                <img src="<?php echo base_url("assets/img/lab.png"); ?>" alt="..." width="100" height="100">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title fs-4 fw-bold"><span class="text-danger">Patho</span> <span class="text-success">Care</span>,The complete medical lab solution</h5>
                                    <p class="text-success fs-6 m-0">Power your business</p> 
                                    <p class="text-success fs-6 m-0">with PathoCare</p>
                                    <p class="text-success fs-5 m-0 text-danger">Medical lab management software</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 text-end">
                                <a  href="<?php echo base_url("install/require"); ?>" class="btn btn-warning btn-lg rounded-pill text-light fs-4">Install Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </body>
</html>