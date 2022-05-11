<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view("Partials/MainCss"); ?>
    </head>

    <body>
        <?php $this->load->view("Partials/TopHeader"); ?>
        <?php $this->load->view("Partials/NavbarView"); ?>
        <div class="dashboard-wrapper">
            <div class="container-fluid">
                <div class="top-bar clearfix">
                    <div class="row gutter">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="page-title pull-right">
                                <a href="<?php echo base_url("app/hostel"); ?>" class="btn  bg-maroon"><span class="icon-format_list_bulleted"></span>&nbsp;&nbsp; View List</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="panel">
                            <div class="panel-heading">
                                <h4>New Hostel</h4>
                            </div>
                            <div class="panel-body">
                                <form id="movieForm" method="post">
                                    <div class="form-group">
                                        <div class="row gutter">
                                            <div class="col-md-4">
                                                <label class="control-label">Movie title</label>
                                                <input type="text" class="form-control" name="title">
                                            </div>
                                            <div class="col-md-4 selectContainer">
                                                <label class="control-label">Genre</label>
                                                <select class="form-control" name="genre">
                                                    <option value="comedy">Comedy</option>
                                                    <option value="action">Action</option>
                                                    <option value="horror">Horror</option>
                                                    <option value="romance">Love</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="control-label">Movie title</label>
                                                <input type="text" class="form-control" name="title">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row gutter">
                                            <div class="col-md-6">
                                                <label class="control-label">Address</label>
                                                <textarea class="form-control" name="Address"></textarea>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="control-label">Movie title</label>
                                                <input type="text" class="form-control" name="title">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row gutter">
                                            <div class="col-md-3">
                                                <label class="control-label">Movie title</label>
                                                <input type="text" class="form-control" name="title">
                                            </div>
                                            <div class="col-md-3 selectContainer">
                                                <label class="control-label">Genre</label>
                                                <select class="form-control" name="genre">
                                                    <option value="comedy">Comedy</option>
                                                    <option value="action">Action</option>
                                                    <option value="horror">Horror</option>
                                                    <option value="romance">Love</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="control-label">Movie title</label>
                                                <input type="text" class="form-control" name="title">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="control-label">Movie title</label>
                                                <input type="text" class="form-control" name="title">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->load->view("Partials/FooterView"); ?>
        <script src="<?php echo base_url("assets/js/scrollup/jquery.scrollUp.js"); ?>"></script>
        <script src="<?php echo base_url("assets/js/custom.js"); ?>"></script>
    </body>
</html>