<script>
    var app = angular.module('DoctorComissionApp', []);
    app.controller('DoctorComissionAppCtrl', function ($scope, $http, $window, $filter) {
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };
       
       $scope.CommissionListPanel = true;

       

        $scope.editCommssion = function (ID,DoctorName) {
            $scope.CommissionListPanel = false;
            $scope.CommissionEditPanel = true;
            $scope.CommissionID = ID;
            $scope.DoctorModel = DoctorName;

            var DataEdit = $.param({
                "CommissionID": ID
            });

            $http.post('<?php echo base_url('app/edit/doctor/commission'); ?>', DataEdit, config).then(function (response) {
                if (response.data.status === 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true

                    });
                }

                if (response.data.status == -1) {
                    swal("Network Error,pls try again !!");
                } else {
                    $scope.ReceiptNoModel = response.data.result.ReceiptNo;
                    $scope.CommissionAmountModel = response.data.result.CommisionAmount;
                    $scope.PayAmountModel = response.data.result.PayAmount;
                }


            });
        };

        $scope.updateDoctorCommision = function () {
            var Data = $.param({
                "PayAmount": $scope.PayAmountModel,
                "CommissionID": $scope.CommissionID
               
            });

            $http.post('<?php echo base_url('app/update/doctor/commision'); ?>', Data, config).then(function (response) {
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

                            $window.location.href = '<?php echo base_url('app/doctor/commision'); ?>';

                        }
                    });
                }



                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        };

        //delete group name 
        $scope.deleteCommssion = function (ID) {
            var DataID = $.param({
                'CommissionID': ID
            });
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover !",
                icon: "warning",
                buttons: true,
                dangerMode: true
            }).then((willDelete) => {
                if (willDelete) {
                    $http.post('<?php echo base_url('app/delete/doctor/commission'); ?>', DataID, config).then(function (response) {
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

                                    window.location.href = '<?php echo base_url("app/doctor/commision"); ?>';
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

        $scope.payCommission = function(ID,PayAmt){
            
            $payAmt = PayAmt.toFixed(2); 
            var DataID = $.param({
                'CommissionID':ID,
                'PayAmount':$payAmt
            });
            
            swal({
                title: "Are you sure?",
                text: "You want to pay now !",
                icon: "warning",
                buttons: true,
                dangerMode: true
            }).then((willpay) => {
                if (willpay) {
                    $http.post('<?php echo base_url('app/pay/doctor/commission'); ?>', DataID, config).then(function (response) {
                        if (response.data.status == 0) {
                            swal({
                                title: "There are some errors !!",
                                text: response.data.error,
                                icon: "warning",
                                dangerMode: true

                            });
                        }
                        if (response.data.status == 1) {
                            swal("Record updated successfully !!", {
                                icon: "success",
                                closeOnClickOutside: false
                            }).then((ok) => {
                                if (ok) {

                                    window.location.href = '<?php echo base_url("app/doctor/commision"); ?>';
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
    });

</script>