<script>
    var app = angular.module('ReportApp', ["checklist-model"]);
    app.controller('ReportAppCtrl', function ($scope, $http, $window, $filter) {
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };

        <?php
        if (isset($receiptNo)) {
            ?>
                    $scope.ReceiptNoModel = <?php echo $receiptNo; ?>
            <?php
        }
        ?>

        //initial value 				
        $scope.ResultModel = {};
        $scope.PatientID = "";
        $scope.TestID = "";
        $scope.Charge = 0;
        $scope.tests = [];
        $scope.SubTotalModel = 0;
        $scope.DiscountModel = 0;
        $scope.NetAmountModel = 0;
        $scope.PaidModel = 0;
        $scope.DueModel = 0;
        $scope.PayBackModel = 0;
        //$scope.ResultModel[key]['Result'] = 0;



        //get group types 
        var DataCategory = $.param({
            "TableName": "category"
        });

        $http.post("<?php echo base_url("api/v1/app/master"); ?>", DataCategory, config).then(function (response) {
            $scope.categories = response.data;
        });



        $scope.getTests = function () {
            if (typeof $scope.ReceiptNoModel === 'undefined' || $scope.ReceiptNoModel.length === 0) {
                swal("Please Enter Receipt No !!");
                return false;
            }

            var DataReceipt = $.param({
                "ReceiptNo": $scope.ReceiptNoModel

            });


            $http.post("<?php echo base_url("app/report/patient"); ?>", DataReceipt, config).then(function (response) {
                if (response.data.status === 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true

                    });
                } else if (response.data.status === -1) {
                    swal("data not found !!");
                } else {
                    $scope.PatientID = response.data.result[0].PatientID;
                    $scope.MRNoModel = response.data.result[0].MRNo;
                    $scope.PatientNameModel = response.data.result[0].FirstName + ' ' + response.data.result[0].LastName;
                    $scope.ContactNoModel = response.data.result[0].MobileNo;
                    $scope.DueAmountModel = response.data.result[0].DueAmount;

                }
            });


            getReceiptTest();


        };

        function getReceiptTest() {
            var DataReceipt = $.param({
                "ReceiptNo": $scope.ReceiptNoModel

            });

            $http.post("<?php echo base_url("app/report/tests"); ?>", DataReceipt, config).then(function (response) {
                if (response.data.status === 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true

                    });
                } else if (response.data.status === -1) {
                    $scope.particulars = {};
                    $scope.tests = {};
                    swal("data not found !!");
                } else {
                    $scope.tests = response.data.result;


                }


            });


        }

        $scope.getTestParticulars = function (testNo, categoryId) {
            $scope.particulars = {};
            $scope.ResultModel = {};
            var DataTest = $.param({
                "TestID": testNo,
                "ReceiptNo": $scope.ReceiptNoModel

            });

            //get test id
            $scope.TestID = testNo;
            $scope.CategoryID = categoryId;

            $http.post("<?php echo base_url("app/report/test/particulars"); ?>", DataTest, config).then(function (response) {
                if (response.data.status == 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true

                    });
                } else if (response.data.status == -1) {

                    swal("data not found !!");
                } else {
                    $scope.particulars = response.data.result;
                    console.log($scope.particulars);

                }


            });
        };

        //save result
        $scope.savePathoResult = function () {
            var DataResult = $.param({
                "Results": $scope.ResultModel,
                "ReceiptNo": $scope.ReceiptNoModel,
                "TestID": $scope.TestID,
                "PatientID": $scope.PatientID,
                "CategoryID": $scope.CategoryID
            });
            $http.post("<?php echo base_url("app/save/test/result"); ?>", DataResult, config).then(function (response) {
                if (response.data.status == 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true

                    });
                }

                if (response.data.status == 1) {
                    getReceiptTest();
                    swal("Records saved successfully");
                }

                if (response.data.status == -1) {
                    swal("Please try again");
                }
                $scope.particulars = {};
                $scope.ResultModel = {};


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

        }

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

        //fetching test	
        $("#TestAutoSearch").autocomplete({
            source: "<?php echo base_url("api/v1/app/test"); ?>",
            select: function (event, ui) {
                event.preventDefault();

                $("#TestAutoSearch").val(ui.item.value);
                $scope.TestDescription = ui.item.Description;
                $scope.Charge = ui.item.Charge;
                $scope.TestNo = ui.item.id;



            }
        });
        $("#TestAutoSearch").autocomplete("option", "appendTo", "#SearchTestPanel");
        $scope.addTest = function () {
            if (typeof $scope.TestDescription === 'undefined' || $scope.TestDescription.length === 0) {
                swal("Please Enter TestNo or TestName !!");
                return false;
            }

            var d1 = {
                'TestNo': $scope.TestNo,
                'Description': $scope.TestDescription,
                'Charge': $scope.Charge,

            };


            let index = $scope.tests.findIndex(record => record.Description === d1.Description);
            if (index == -1) {
                $scope.tests.push(d1);

                //total amount
                $scope.subTotal = function () {
                    var total = 0;


                    angular.forEach($scope.tests, function (key, value) {
                        total += parseInt(key.Charge);
                    });
                    return total;
                };

                $scope.TestModel = "";
                var x1 = $window.document.getElementById('TestAutoSearch');
                x1.focus();
                $scope.SubTotalModel = $scope.subTotal();
                $scope.NetAmountModel = $scope.subTotal();

            } else {
                $scope.TestModel = "";
                swal("It is already added");
            }

        };

        $scope.removeTest = function (x1) {
            $scope.tests.splice(x1, 1);
            $scope.sum = function () {
                var total = 0;
                angular.forEach($scope.tests, function (key, value) {
                    total += parseInt(key.Charge);
                });
                return total;
            };
            $scope.SubTotalModel = $scope.sum();
        };

        $scope.discount = function () {

            if ($scope.DiscountModel > $scope.SubTotalModel) {
                swal("Discount amount can not be greater than total amount");
                $scope.DiscountModel = 0;
                $scope.NetAmountModel = $scope.SubTotalModel;
                $scope.PaidModel = 0;
                $scope.DueModel = 0;
                $scope.PayBackModel = 0;

                return false;
            }
            $scope.PaidModel = 0;
            $scope.DueModel = 0;
            $scope.PayBackModel = 0;
            $scope.NetAmountModel = $scope.SubTotalModel - $scope.DiscountModel;

        }

        $scope.payment = function () {
            if ($scope.PaidModel > $scope.NetAmountModel) {
                $scope.PayBackModel = $scope.PaidModel - $scope.NetAmountModel;
                $scope.DueModel = 0;
            } else {
                $scope.PayBackModel = 0;
                $scope.DueModel = $scope.NetAmountModel - $scope.PaidModel;
            }
        }

        $scope.saveBill = function () {

            var DataTest = $.param({
                'ReceiptNo': $scope.ReceiptNoModel,
                'PatientName': $scope.PatientNameModel,
                'Age': $scope.AgeModel,
                'MobileNo': $scope.PatientMobileNoModel,
                'Gender': $scope.GenderModel,
                'Adddress': $scope.PatientAddressModel,
                'tests': $scope.tests,
                'TotalAmount': $scope.SubTotalModel,
                'DueAmount': $scope.DueModel,
                'Discount': $scope.DiscountModel,
                'NetAmount': $scope.NetAmountModel,
                'PaidAmount': $scope.PaidModel,

            });
            $http.post('<?php echo base_url('app/bill/save'); ?>', DataTest, config).then(function (response) {
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

                            window.location.href = '<?php echo base_url("app/receipt"); ?>';
                        }
                    });
                }
                if (response.data.status == -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        }




        $scope.generateReport = function (ID) {
            window.location.href = "<?php echo base_url('app/report/pending/'); ?>" + ID;
        }
    });

</script>