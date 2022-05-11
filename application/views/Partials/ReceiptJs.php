<script>
    var app = angular.module('ReceiptApp', []);
    app.controller('ReceiptAppCtrl', function ($scope, $http, $window, $filter) {
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };

        //initial value 				
        $scope.ReceiptNoModel = <?php
        if (isset($receiptNo)) {
            echo $receiptNo;
        }
        ?>;

        $scope.ReceiptDateModel = $filter("date")(Date.now(), 'dd-MM-yyyy');
        $scope.CategoryID = "";
        $scope.DoctorID = "";
        $scope.PatientID = "";
        $scope.DoctorCommision = 0;
        $scope.TestID = "";
        $scope.Charge = 0;
        $scope.tests = [];
        $scope.SubTotalModel = '0.00';
        $scope.DiscountModel = '0.00';
        $scope.NetAmountModel = '0.00';
        $scope.PaidModel = '0.00';
        $scope.DueModel = '0.00';
        $scope.PayBackModel = '0.00';


        //default showing btns - receipt save btn
        $scope.SaveBtn = true;

        //get patient
        $scope.getPatient = function () {
            var Data = $.param({
                "MRNo": $scope.MRNoModel
            });

            $http.post("<?php echo base_url("app/get/single/patient"); ?>", Data, config).then(function (response) {
                if (response.data.status === 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true

                    });
                }

                if (response.data.status === 1) {
                    var name = response.data.result.FirstName + " " + response.data.result.LastName;
                    $scope.PatientNameModel = name;
                    $scope.PatientID = response.data.result.ID;
                    $scope.AgeModel = response.data.result.Age;
                    $scope.GenderModel = response.data.result.Gender;
                    $scope.PatientMobileNoModel = response.data.result.MobileNo;
                }

                if (response.data.status == -1) {
                    swal("Network error ,try again !!");
                }
            });
        }


        //get group types 
        var DataCategory = $.param({
            "TableName": "category"
        });

        $http.post("<?php echo base_url("api/v1/app/master"); ?>", DataCategory, config).then(function (response) {

        });



        $scope.editTest = function (ID) {

            $scope.TestID = ID;
            var DataID = $.param({
                'TestID': ID
            });
            $http.post('<?php echo base_url('app/test/edit'); ?>', DataID, config).then(function (response) {
                if (response.data.status === 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true

                    });
                }

                if (response.data.status === 1) {
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
                if (response.data.status === 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true

                    });
                }



                if (response.data.status === 1) {
                    swal("Records updated successfully !!", {
                        icon: "success",
                        closeOnClickOutside: false
                    }).then((ok) => {
                        if (ok) {

                            window.location.href = '<?php echo base_url("app/test"); ?>';
                        }
                    });
                }

                if (response.data.status === -1) {
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
                        if (response.data.status === 0) {
                            swal({
                                title: "There are some errors !!",
                                text: response.data.error,
                                icon: "warning",
                                dangerMode: true

                            });
                        }
                        if (response.data.status === 1) {
                            swal("Record deleted successfully !!", {
                                icon: "success",
                                closeOnClickOutside: false
                            }).then((ok) => {
                                if (ok) {

                                    window.location.href = '<?php echo base_url("app/test"); ?>';
                                }
                            });
                        }

                        if (response.data.status === -1) {
                            swal('Could not delete,please try again.');
                        }

                    });

                } else {
                    swal("Your record  is safe!");
                }
            });
        };

        //fetching test	with search of test no or test name

        $("#TestAutoSearch").autocomplete({
            source: "<?php echo base_url("api/v1/app/test"); ?>",
            select: function (event, ui) {
                event.preventDefault();

                $("#TestAutoSearch").val(ui.item.value);
                $scope.TestDescription = ui.item.Description;
                $scope.Charge = ui.item.Charge;
                $scope.TestNo = ui.item.id;
                $scope.CategoryID = ui.item.CategoryID;
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
                'TestDescription': $scope.TestDescription,
                'Charges': $scope.Charge,
                'CategoryID': $scope.CategoryID

            };


            let index = $scope.tests.findIndex(record => record.TestDescription === d1.TestDescription);
            if (index === -1) {
                $scope.tests.push(d1);

                //total amount
                $scope.subTotal = function () {
                    var total = parseFloat('0.00');


                    angular.forEach($scope.tests, function (key, value) {
                        total += parseFloat(key.Charges);
                    });
                    return total;
                };

                $scope.TestModel = "";
                var x1 = $window.document.getElementById('TestAutoSearch');
                x1.focus();
                var $total = $scope.subTotal();
                $total = $total.toFixed(2);
                $scope.SubTotalModel = $total;
                $scope.NetAmountModel = $total;
                $scope.PaidModel = $total;


            } else {
                $scope.TestModel = "";
                swal("It is already added");
            }

        };

        $scope.removeTest = function (x1) {
            $scope.DiscountModel = 0;

            $scope.tests.splice(x1, 1);


            $scope.sum = function () {
                var total = parseFloat('0.00');
                angular.forEach($scope.tests, function (key, value) {
                    total += parseFloat(key.Charges);
                });
                return total;
            };

            var $sum = $scope.sum();
            $sum = $sum.toFixed(2);

            $scope.SubTotalModel = $sum;
            $scope.NetAmountModel = $sum;
            $scope.PaidModel = $sum;
        };

        $scope.discount = function () {

            if ($scope.DiscountModel.length == 0) {
                $scope.DiscountModel = 0;
            }


            if ($scope.DiscountModel.length > 1 && $scope.DiscountModel == 0) {
                $scope.DiscountModel = 0;
            } else {
                $scope.DiscountModel = $scope.DiscountModel;
            }

            if (parseFloat($scope.DiscountModel) > parseFloat($scope.SubTotalModel)) {
                swal("Discount amount can not be greater than total amount");
                $scope.DiscountModel = 0;
                $scope.NetAmountModel = $scope.SubTotalModel;
                $scope.PaidModel = $scope.SubTotalModel;
                $scope.DueModel = 0;
                $scope.PayBackModel = 0;

                return false;
            }
            $scope.PaidModel = '0.00';
            $scope.DueModel = '0.00';
            $scope.PayBackModel = '0.00';
            var $netAmount = parseFloat($scope.SubTotalModel) - parseFloat($scope.DiscountModel);
            $scope.NetAmountModel = $netAmount.toFixed(2);
            $scope.PaidModel = $netAmount;

        };

        $scope.payment = function () {

            if ($scope.PaidModel.length == 0) {
                $scope.PaidModel = 0;
            }

            if ($scope.PaidModel.length > 1 && $scope.PaidModel == 0) {
                $scope.PaidModel = 0;
            } else {
                $scope.PaidModel = $scope.PaidModel;
            }



            if (parseFloat($scope.PaidModel) > parseFloat($scope.NetAmountModel)) {
                var $payBack = parseFloat($scope.PaidModel) - parseFloat($scope.NetAmountModel);
                $scope.PayBackModel = $payBack.toFixed(2);
                $scope.DueModel = '0.00';
            } else {
                $scope.PayBackModel = '0.00';
                var $due = parseFloat($scope.NetAmountModel)  - parseFloat($scope.PaidModel);
                $scope.DueModel = $due.toFixed(2);
            }
        };

        $scope.saveBill = function (flag) {

            //flag =1 print and save the bill
            //flag =0 only save the bill
            var $discount = parseFloat($scope.DiscountModel);
            $discount = $discount.toFixed(2);

            var $paidAmt = parseFloat($scope.PaidModel);
            $paidAmt = $paidAmt.toFixed(2);

            var DataBill = $.param({
                'ReceiptNo': $scope.ReceiptNoModel,
                'DoctorID': $scope.DoctorID,
                'DoctorCommision': $scope.DoctorCommision,
                'PatientName': $scope.PatientNameModel,
                'PatientID': $scope.PatientID,
                'tests': $scope.tests,
                'TotalAmount': $scope.SubTotalModel,
                'DueAmount': $scope.DueModel,
                'Discount': $discount,
                'NetAmount': $scope.NetAmountModel,
                'PaidAmount': $paidAmt,
                'flag': flag
            });
            
            $http.post('<?php echo base_url('app/bill/save'); ?>', DataBill, config).then(function (response) {
                if (response.data.status === 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true

                    });
                }
                if (response.data.status === 1) {
                    //printing the bill
                    if (response.data.print == 1) {
                        window.open('<?php echo base_url("app/print/bill/"); ?>' + response.data.receiptno, '_blank');
                        window.location.href = '<?php echo base_url("app/receipt"); ?>';
                    } else {
                        swal("Records Saved successfully !!", {
                            icon: "success",
                            closeOnClickOutside: false
                        }).then((ok) => {
                            if (ok) {
                                window.location.href = '<?php echo base_url("app/receipt"); ?>';
                            }
                        });
                    }
                }
                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        };

        $("table.doctor-list").delegate("tr.test-row", "click", function () {
            $scope.DoctorID = $(this).data('id');
            $scope.DoctorCommision = $(this).data('commision');
            console.log($scope.DoctorID);
            $("#DoctorName").val($(this).data('name'));
            $("#DrMobileNo").val($(this).data('mobile'));
            $("#myModal").modal('hide');

        });

        $scope.generateReport = function (ID) {
            $window.location.href = "<?php echo base_url("app/report/pending/"); ?>" + ID;
        }
    });

    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }



</script>