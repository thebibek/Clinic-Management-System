<script>
    var app = angular.module('PendingReportApp', []);
    app.controller('PendingReportAppCtrl', function ($scope, $http, $window, $filter) {
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };

        var modal1 = angular.element('#ClearDuesModal');
        $scope.ReceiptNo = "";

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
                }

                if (response.data.status == -1) {
                    swal("Please try again");
                }

            });
        });

        //delete report
        $scope.deleteReport = function (ReceiptID) {
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

                                    window.location.href = '<?php echo base_url("app/pending/report"); ?>';
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