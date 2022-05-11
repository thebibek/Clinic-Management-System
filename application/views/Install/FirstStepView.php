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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card shadow rounded-0  border-warning">
                                <div class="card-header shadow bg-warning rounded-0 border-warning">
                                    <h4 class="text-light">Patho Care Installation Wizard</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="list-group rounded-0">
                                                <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                                                    Requirements
                                                </a>
                                                <a href="#" class="list-group-item list-group-item-action">Database</a>
                                                <a href="#" class="list-group-item list-group-item-action">Install</a>
                                                <a href="#" class="list-group-item list-group-item-action">Finish</a>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="list-group rounded-0">
                                                <li class="list-group-item">

                                                    <span class="tra-type">PHP 5.6+ (Recomended PHP7) </span> 
                                                    <span class="fw-bold ms-3">
                                                        <?php
                                                        if (isset($phpversion)) {
                                                            echo $phpversion;
                                                        }
                                                        ?>
                                                    </span>    
                                                </li>
                                                <li class="list-group-item">
                                                    <span class="tra-type">MySQLi Extension</span> 
                                                    <span class="fw-bold ms-3">
                                                        <?php
                                                        if (isset($mysqli)) {
                                                            echo $mysqli;
                                                        }
                                                        ?>
                                                    </span>
                                                </li>
                                                <li class="list-group-item">
                                                    <span class="tra-type">GD PHP Extension</span> 
                                                    <span class="fw-bold ms-3">
                                                        <?php
                                                        if (isset($gd)) {
                                                            echo $gd;
                                                        }
                                                        ?> 
                                                    </span>
                                                </li>
                                                <li class="list-group-item">
                                                    <span class="tra-type">CURL PHP Extension</span> 
                                                    <span class="fw-bold ms-3">
                                                        <?php
                                                        if (isset($curl)) {
                                                            echo $curl;
                                                        }
                                                        ?>
                                                    </span>    
                                                </li>
                                                <li class="list-group-item">
                                                    <span class="tra-type">MB String PHP Extension</span> 
                                                    <span class="fw-bold ms-3">
                                                        <?php
                                                        if (isset($mbstring)) {
                                                            echo $mbstring;
                                                        }
                                                        ?>
                                                    </span>
                                                </li>
                                                <li class="list-group-item">
                                                    <span class="tra-type">Zip Extension</span> 
                                                    <span class="fw-bold ms-3"> 
                                                        <?php
                                                        if (isset($zip)) {
                                                            echo $zip;
                                                        }
                                                        ?> 
                                                    </span>   
                                                </li>
                                                <li class="list-group-item">
                                                    <span class="tra-type">config.php Writable</span> 
                                                    <span class="fw-bold ms-3"> 
                                                        <?php
                                                        if (isset($config)) {
                                                            echo $config;
                                                        }
                                                        ?> 
                                                    </span>   
                                                </li>
                                                <li class="list-group-item">
                                                    <span class="tra-type">database.php Writable</span> 
                                                    <span class="fw-bold ms-3">    
                                                        <?php
                                                        if (isset($database)) {
                                                            echo $database;
                                                        }
                                                        ?>
                                                    </span>    
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <p class="text-end">
                                                <?php
                                                if (isset($status) && $status == 0) {
                                                    echo $errormsg;
                                                }
                                                ?>
                                            </p>
                                        </div>    
                                        <div class="col-md-4">
                                            <div class="text-end">
                                                <a href="<?php echo base_url(); ?>" class="btn btn-secondary">Back</a>
                                                <a href="<?php echo base_url("install/database"); ?>" class="btn btn-primary"><span class="circless animate" style="height: 123.281px; width: 123.281px; top: -37.6405px; left: 22.2032px;"></span>Next</a>
                                            </div>
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