<script>
    var app = angular.module('BillApp', []);
    app.controller('BillAppCtrl', function ($scope, $http, $window, $filter) {
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };

        var modal1 = angular.element('#ClearDuesModal');
        $scope.ReceiptNo = "";
        $scope.ReceiptID = "";
        $scope.TestID = "";
        $scope.Charge = 0;
        $scope.tests = [];
        $scope.SubTotalModel = '0.00';
        $scope.DiscountModel = '0.00';
        $scope.NetAmountModel = '0.00';
        $scope.PaidModel = '0.00';
        $scope.DueModel = '0.00';
        $scope.PayBackModel = '0.00';

        $scope.BillListingPanel = true;

        //saving the doctor
        $scope.saveDoctor = function () {
            var DataDoctor = $.param({
                "DoctorName": $scope.DoctorModel,
                "MobileNo": $scope.MobileNoModel,
                "Hospital": $scope.HospitalModel

            });

            $http.post('<?php echo base_url('app/save/doctor'); ?>', DataDoctor, config).then(function (response) {
                if (response.data.status === 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true

                    });
                }

                if (response.data.status === 1) {
                    swal("Records Saved successfully !!", {
                        icon: "success",
                        closeOnClickOutside: false
                    }).then((ok) => {
                        if (ok) {

                            $window.location.href = '<?php echo base_url('app/doctor'); ?>';

                        }
                    });
                }

                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        };

        $scope.clearDues = function (ReceiptNo) {

            $scope.ReceiptNo = ReceiptNo;
            var DataReceipt = $.param({
                'ReceiptNo': ReceiptNo
            });

            $http.post('<?php echo base_url('app/single/receipt/data'); ?>', DataReceipt, config).then(function (response) {
                if (response.data.status === 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true

                    });
                }

                if (response.data.status === 1) {
                    $scope.PaidAmountModel = response.data.result.PaidAmount;
                    $scope.NetAmountModel = response.data.result.NetAmount;
                    $scope.DuesAmountModel = response.data.result.DueAmount;
                    $("#PaidAmount").val($scope.PaidAmountModel);
                    $("#NetAmount").val($scope.NetAmountModel);
                    $("#DuesAmount").val($scope.DuesAmountModel);

                    modal1.modal({backdrop: 'static', keyboard: false}, 'show');


                }

                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });

        }

        $("#SaveDues").click(function () {
            $scope.PayAmountModel = $("#PayAmount").val();
            var Data = $.param({
                "ReceiptNo": $scope.ReceiptNo,
                "PaidAmount": $scope.PaidAmountModel,
                "DuesAmount": $scope.DuesAmountModel,
                "PayAmount": $scope.PayAmountModel,
            });

            $http.post("<?php echo base_url("app/save/due/fee"); ?>", Data, config).then(function (response) {
                if (response.data.status === 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true

                    });

                }

                if (response.data.status == 1) {
                    swal("Due amount updated successfully");
                    $window.location.href = '<?php echo base_url("app/bills"); ?>';
                }

                if (response.data.status == -1) {
                    swal("Please try again");
                }


            });

        });


        $scope.deleteBill = function (ReceiptID) {
            var DataID = $.param({
                'ReceiptID': ReceiptID
            });
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover !",
                icon: "warning",
                buttons: true,
                dangerMode: true
            }).then((willDelete) => {
                if (willDelete) {
                    $http.post('<?php echo base_url('app/delete/receipt'); ?>', DataID, config).then(function (response) {
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

                                    window.location.href = '<?php echo base_url("app/doctor"); ?>';
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
        }

        //fetching test with search of test no or test name

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

        //add test to test list for billing
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
                var $due = parseFloat($scope.NetAmountModel) - parseFloat($scope.PaidModel);
                $scope.DueModel = $due.toFixed(2);
            }
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
                swal("Discount amount can not be greater than total amount !!");
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
            $scope.PaidModel = $netAmount.toFixed(2);

        };

        //remove test from test list
        $scope.removeTest = function (x1) {
            $scope.DiscountModel = '0.00';
            $scope.DueModel = '0.00';
            $scope.tests.splice(x1, 1);

            $scope.sum = function () {
                var total = 0;
                angular.forEach($scope.tests, function (key, value) {
                    total += parseFloat(key.Charges);
                });
                return total;
            };
            var $sum = $scope.sum();
            
            $scope.SubTotalModel = $sum.toFixed(2);
            $scope.NetAmountModel = $sum.toFixed(2);
            $scope.PaidModel = $sum.toFixed(2);
        };


        //edit the bill

        $scope.editBill = function (ReceiptID) {
            $scope.EditPanel = true;
            $scope.BillListingPanel = false;
            $scope.ReceiptID = ReceiptID;
            var DataReceipt = $.param({
                'ReceiptID': ReceiptID
            });

            $http.post('<?php echo base_url('app/edit/bill'); ?>', DataReceipt, config).then(function (response) {
                if (response.data.status === 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true

                    });
                }

                if (response.data.status === 1) {
                    $scope.ReceiptNo = response.data.rs2.ReceiptNo;
                    $scope.ReceiptID = response.data.rs2.ReceiptID;
                    $scope.DoctorNameModel = response.data.rs2.Salutation + ' ' +
                                             response.data.rs2.DrFirstName + ' ' +
                                             response.data.rs2.DrLastName;
                    $scope.DoctorMobileNoModel = response.data.rs2.DoctorMobileNo;
                    $scope.MRNoModel = response.data.rs2.MRNo;
                    $scope.PatientNameModel = response.data.rs2.PFirstName + ' ' + response.data.rs2.PLastName;
                    $scope.AgeModel = response.data.rs2.Age;
                    $scope.GenderModel = response.data.rs2.Gender;
                    $scope.PatientMobileNoModel = response.data.rs2.PatientMobileNo;
                    $scope.PatientAddressModel = response.data.rs2.Address;
                    $scope.ReceiptNoModel = response.data.rs2.ReceiptNo;
                    $scope.ReceiptDateModel = response.data.rs2.ReceiptDate;
                    $scope.SubTotalModel = response.data.rs2.TotalAmount;
                    $scope.DiscountModel = response.data.rs2.Discount;
                    $scope.NetAmountModel = response.data.rs2.NetAmount;
                    $scope.PaidModel = response.data.rs2.PaidAmount;
                    $scope.DueModel = response.data.rs2.DueAmount;
                    $scope.tests = response.data.rs1;
                }

                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        }

        $scope.updateBill = function () {

            //flag =1 print and save the bill
            //flag =0 only save the bill
            var $discount = parseFloat($scope.DiscountModel);
            $discount = $discount.toFixed(2);

            var $paidAmt = parseFloat($scope.PaidModel);
            $paidAmt = $paidAmt.toFixed(2);

            var DataBill = $.param({
                'ReceiptNo': $scope.ReceiptNo,
                'ReceiptID': $scope.ReceiptID,
                'tests': $scope.tests,
                'TotalAmount': $scope.SubTotalModel,
                'DueAmount': $scope.DueModel,
                'Discount': $discount,
                'NetAmount': $scope.NetAmountModel,
                'PaidAmount': $paidAmt,

            });

            $http.post('<?php echo base_url('app/update/bill'); ?>', DataBill, config).then(function (response) {
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

                            window.location.href = '<?php echo base_url("app/bills"); ?>';
                        }
                    });
                }
                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        };
        
        $scope.generateReport = function (ID) {
            $window.location.href = "<?php echo base_url("app/report/pending/"); ?>" + ID;
        }
    });

</script>