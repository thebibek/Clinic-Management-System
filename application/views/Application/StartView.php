<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="shortcut icon" href="<?php echo base_url("assets/img/fav.png"); ?>">
        <title>Patho Care ,The complete medical lab managment solution</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap CSS -->
        <link href="<?php echo base_url("assets/css/bootstrap.css");?>" rel="stylesheet">
    </head>

    <body>
        <div class="container-fluid" ng-app="LoginApp" ng-controller="LoginAppCtrl">
            <div class="card bg-light rounded-0 p-4">
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <div class="card mb-3 p-5 bg-warning border-warning shadow" style="max-width:70%;">
                            <div class="row g-0">
                                <div class="col-md-6">
                                    <div class="card-body p-5">
                                        <img src="<?php echo base_url("assets/img/product.png"); ?>" alt="..." class="img-fluid">
                                        <div class="p2 text-end">
                                            <img src="<?php echo base_url("assets/img/lab.png"); ?>" alt="..." class="img-fluid" width="100" height="100">
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="card shadow  border-primary bg-primary">
                                        <div class="card-body p-5">
                                            <h5 class="fst-italic"><span class="text-info">Patho</span><span class="text-white">Care</span></h5>
                                            <br><br>
                                            <h5 class="card-title mb-3 text-white">Login</h5>
                                            <p class="card-text text-light mb-3">Enter your email and password to login dashboard.</p>
                                            <div class="form-floating mb-3">
                                                <input type="email" class="form-control bg-transparent border-white text-white" id="floatingInput"  ng-model="EmailModel" placeholder="Enter email">
                                                <label for="floatingInput" class="text-white">Email address</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="password" class="form-control bg-transparent border-white text-white" id="floatingPassword"  ng-model="PasswordModel" maxlength="8" placeholder="Enter Password">
                                                <label for="floatingPassword" class="text-white">Password</label>
                                            </div>
                                            <div class="d-grid gap-2">
                                                <button class="btn btn-info rounded-0 border-info text-light" ng-click="login()" type="button">Login</button>
                                            </div>
                                            
                                        </div>
                                    </div> 
                                    <p class="mt-3 fw-light text-decoration-underline  text-light fst-italic fs-5 text-end">The complete solution for medical lab</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <?php $this->load->view("Partials/FooterView"); ?>
            </div>
        </div>   

        <?php $this->load->view("Partials/AngularJs"); ?>
        <?php $this->load->view("Partials/SweetAlertJs"); ?>
        <?php $this->load->view("Partials/LoginJs"); ?>
    </body>
</html>