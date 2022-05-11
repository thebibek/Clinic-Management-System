<script>
    var app = angular.module('TestApp', []);
    app.controller('TestAppCtrl', function ($scope, $http, $window, $filter) {
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };

        //intialize
        $scope.TestID = "";
        $scope.TestPanel = false;
        $scope.TestListingPanel = true;
        $scope.AddTestBtn = true;
        $scope.UpdateBtn = false;

        //get group types 
        var DataCategory = $.param({
            "TableName": "category"
        });
        $http.post("<?php echo base_url("api/v1/app/master"); ?>", DataCategory, config).then(function (response) {
            $scope.categories = response.data.result;
        });

        $scope.reset = function () {
            $window.location.href = "<?php echo base_url("app/test"); ?>";
        }

        $scope.addTest = function () {
            $scope.TestListingPanel = false;
            $scope.TestPanel = true;
            $scope.AddTestBtn = false;
            $scope.SaveBtn = true;

        }


        //saving the test description
        $scope.saveTest = function () {
            var DataTest = $.param({
                'Description': $scope.DescriptionModel,
                'CategoryID': $scope.CategoryModel,
                'ReportHeading': $scope.ReportHeadModel,
                'Charge': $scope.ChargeModel,
                'CarryOut': $scope.CarryOutModel,
                'ReportTiming': $scope.ReportDeliveryModel,
                'TypeID': $scope.TypeModel,
                'IsActive': $scope.ActiveModel,
                'Remarks': $scope.RemarksModel

            });
            $http.post('<?php echo base_url('app/test/save'); ?>', DataTest, config).then(function (response) {
                if (response.data.status == 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true

                    });
                }
                if (response.data.status == 1) {
                    swal("Records Saved successfully !!", {
                        icon: "success",
                        closeOnClickOutside: false
                    }).then((ok) => {
                        if (ok) {

                            window.location.href = '<?php echo base_url("app/test"); ?>';
                        }
                    });
                }
                if (response.data.status == -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        };



        $scope.editTest = function (ID) {
            $scope.TestListingPanel = false;
            $scope.TestPanel = true;
            $scope.AddTestBtn = false;
            $scope.SaveBtn = false;
            $scope.UpdateBtn = true;

            $scope.TestID = ID;
            var DataID = $.param({
                'TestID': ID
            });
            $http.post('<?php echo base_url('app/test/edit'); ?>', DataID, config).then(function (response) {
                if (response.data.status == 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true

                    });
                }

                if (response.data.status == 1) {
                    $scope.DescriptionModel = response.data.result.Description;
                    $scope.CategoryModel = response.data.result.CategoryID;
                    $scope.ReportHeadModel = response.data.result.ReportHeading;
                    $scope.ChargeModel = response.data.result.Charge;
                    $scope.CarryOutModel = response.data.result.CarryOut;
                    $scope.ReportDeliveryModel = response.data.result.ReportTiming;
                    $scope.TypeModel = response.data.result.TypeID;
                    $scope.ActiveModel = response.data.result.IsActive;
                    $scope.RemarksModel = response.data.result.Remarks;
                }
            });
        };

        $scope.updateTest = function () {
            var DataTest = $.param({
                'TestID': $scope.TestID,
                'CategoryID': $scope.CategoryModel,
                'ReportHeading': $scope.ReportHeadModel,
                'Charge': $scope.ChargeModel,
                'CarryOut': $scope.CarryOutModel,
                'ReportTiming': $scope.ReportDeliveryModel,
                'TypeID': $scope.TypeModel,
                'IsActive': $scope.ActiveModel,
                'Remarks': $scope.RemarksModel

            });
            $http.post('<?php echo base_url('app/test/update'); ?>', DataTest, config).then(function (response) {
                if (response.data.status == 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true

                    });
                }



                if (response.data.status == 1) {
                    swal("Records updated successfully !!", {
                        icon: "success",
                        closeOnClickOutside: false
                    }).then((ok) => {
                        if (ok) {

                            window.location.href = '<?php echo base_url("app/test"); ?>';
                        }
                    });
                }

                if (response.data.status == -1) {
                    swal("Network Error,pls try again !!");
                }


            });
        };
        //delete group name 
        $scope.deleteTest = function (ID) {
            var DataID = $.param({
                'TestID': ID
            });
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover !",
                icon: "warning",
                buttons: true,
                dangerMode: true
            }).then((willDelete) => {
                if (willDelete) {
                    $http.post('<?php echo base_url('app/test/delete'); ?>', DataID, config).then(function (response) {
                        if (response.data.status == 0) {
                            swal({
                                title: "There are some errors !!",
                                text: response.data.error,
                                icon: "warning",
                                dangerMode: true

                            });
                        }
                        if (response.data.status == 1) {
                            swal("Record deleted successfully !!", {
                                icon: "success",
                                closeOnClickOutside: false
                            }).then((ok) => {
                                if (ok) {

                                    window.location.href = '<?php echo base_url("app/test"); ?>';
                                }
                            });
                        }

                        if (response.data.status == -1) {
                            swal('Could not delete,please try again.');
                        }

                    });
                } else {
                    swal("Your record  is safe!");
                }
            });
        };
    });

</script>