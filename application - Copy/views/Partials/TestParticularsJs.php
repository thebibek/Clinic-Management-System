<script>
    var app = angular.module('TestApp', []);
    app.controller('TestAppCtrl', function ($scope, $http, $window, $filter) {
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };

        $scope.TestParticularsID = 0;
        $scope.TestID = 0;

        //get group types 
        var DataCategory = $.param({
            "TableName": "category"
        });

        $http.post("<?php echo base_url("api/v1/app/master"); ?>", DataCategory, config).then(function (response) {
            $scope.categories = response.data;
        });

        //panel
        $scope.TestParticularsPanel = false;
        $scope.AddParticularsBtn = true;

        //btn
        $scope.SaveBtn = true;

        $scope.showTestParticularsPanel = function () {
            $scope.TestParticularsPanel = true;
            $scope.AddParticularsBtn = false;
        };

        $scope.closeTestParticularsPanel = function () {
            $scope.TestParticularsPanel = false;
        };



        //saving the test particulars
        $scope.saveTestParticulars = function () {
            var DataParticulars = $.param({
                'TestID': $scope.TestNoModel,
                'TestParticulars': $scope.TestParticularsModel,
                'Units': $scope.UnitsModel,
                'MaleValue': $scope.MaleValueModel,
                'FemaleValue': $scope.FemaleValueModel,
                'PartHeading': $scope.PartHeadingModel,
                'IsActive': $scope.ActiveModel


            });
            $http.post('<?php echo base_url('app/test/particulars/save'); ?>', DataParticulars, config).then(function (response) {
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

                            supplyTestParticulars();
                            $scope.TestParticularsModel = "";
                            $scope.UnitsModel = "";
                            $scope.MaleValueModel = "";
                            $scope.FemaleValueModel = "";
                            $scope.PartHeadingModel = "";
                            $scope.ActiveModel = 0;
                        }
                    });
                }
                if (response.data.status == -1) {
                    swal("Network Error,pls try again !!");
                }
            });



        };

        $scope.editTest = function (ID) {


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


        //edit particulars
        $scope.editParticulars = function (ID) {

            $scope.SaveBtn = false;
            $scope.TestParticularsPanel = true;
            $scope.UpdateBtn = true;
            $scope.AddParticularsBtn = false;
            $scope.TestParticularsID = ID;

            var DataID = $.param({
                'ID': ID
            });

            $http.post('<?php echo base_url('app/particulars/edit'); ?>', DataID, config).then(function (response) {
                if (response.data.status == 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true

                    });
                }

                if (response.data.status == 1) {
                    $scope.TestParticularsModel = response.data.result.TestParticulars;
                    $scope.UnitsModel = response.data.result.Units;
                    $scope.MaleValueModel = response.data.result.MaleValue;
                    $scope.FemaleValueModel = response.data.result.FemaleValue;
                    $scope.PartHeadingModel = response.data.result.PartHeading;
                    $scope.ActiveModel = response.data.result.IsActive;
                }
            });
        };

        $scope.updateTestParticulars = function () {
            var DataTest = $.param({
                'TestParticularsID': $scope.TestParticularsID,
                'TestParticulars': $scope.TestParticularsModel,
                'Units': $scope.UnitsModel,
                'MaleValue': $scope.MaleValueModel,
                'FemaleValue': $scope.FemaleValueModel,
                'PartHeading': $scope.PartHeadingModel,
                'IsActive': $scope.ActiveModel

            });
            $http.post('<?php echo base_url('app/testparticulars/update'); ?>', DataTest, config).then(function (response) {
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

                            supplyTestParticulars();
                            $scope.TestParticularsModel = "";
                            $scope.UnitsModel = "";
                            $scope.MaleValueModel = "";
                            $scope.FemaleValueModel = "";
                            $scope.PartHeadingModel = "";
                            $scope.ActiveModel = 0;
                        }
                    });
                }

                if (response.data.status == -1) {
                    swal("Network Error,pls try again !!");
                }


            });

        };


        //delete particulars
        $scope.deleteParticulars = function (ID) {

            var DataID = $.param({
                'ParticularsID': ID
            });
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover !",
                icon: "warning",
                buttons: true,
                dangerMode: true
            }).then((willDelete) => {
                if (willDelete) {
                    $http.post('<?php echo base_url('app/particulars/delete'); ?>', DataID, config).then(function (response) {
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

                                    window.location.href = '<?php echo base_url("app/test/particulars"); ?>';
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


        function supplyTestParticulars() {
            var DataTestNo = $.param({
                TestID: $scope.TestNoModel
            });

            $http.post('<?php echo base_url("app/test/particulars/fetch"); ?>', DataTestNo, config).then(function (response) {
                if (response.data.status == 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true

                    });
                } else if (response.data.status == -1) {
                    swal("data not found please add test particulars !!");
                    $scope.particulars = "";
                } else {
                    $scope.particulars = response.data.result;
                    console.log($scope.particulars);

                }
            }).catch(function (response) {

            });
        }

        $scope.fetchTestParticulars = function () {
            if (typeof $scope.TestNoModel === 'undefined' || $scope.TestNoModel.length === 0) {
                swal("Please Enter TestNo !!");
            } else {

                supplyTestParticulars();
            }
        };

        $(document).on('click', '.test-row', function () {
            var ID = $(this).data("id");
            var Description = $(this).data("description");
            var ReportHeading = $(this).data("heading");
            var input = $("#testNo");
                input.val(ID);
                input.trigger('input');

            $("#TestDescription").val(Description);
            $("#ReportHeading").val(ReportHeading);
        });


    });

</script>