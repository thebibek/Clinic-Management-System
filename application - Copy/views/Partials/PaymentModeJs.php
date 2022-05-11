<script>
    var app = angular.module('PaymentModeApp', []);
    app.controller('PaymentModeAppCtrl', function ($scope, $http, $window, $filter) {
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };

        //initial valuue 
        $scope.PaymentModeID = "";
        $scope.AddPanel = false;
        $scope.ListPanel = true;
        $scope.ActionText = 'Add';


        $scope.showAddPanel = function () {
            $scope.PaymentModeModel = "";
            $scope.DescriptionModel = "";
            $scope.ActionText = 'Add';
            $scope.SaveBtn = true;
            $scope.AddPanel = true;
            $scope.ListPanel = false;
        }

        $scope.reset = function () {
            $scope.AddPanel = false;
            $scope.SaveBtn = true;
            $scope.UpdateBtn = false;
            $scope.ListPanel = true;
        }

        //saving the blood group, description
        $scope.savePaymentMode = function () {
            var $Data = $.param({
                "PaymentMode": $scope.PaymentModeModel,
                "Description": $scope.DescriptionModel

            });

            $http.post('<?php echo base_url('app/save/payment/mode'); ?>', $Data, config).then(function (response) {
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

                            $window.location.href = '<?php echo base_url('app/payment/mode'); ?>';

                        }
                    });
                }

                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        };

        $scope.editPM = function (ID) {
            $scope.ActionText = 'Update';
            $scope.ListPanel = false;
            $scope.SaveBtn = false;
            $scope.UpdateBtn = true;
            $scope.AddPanel = true;

            $scope.PaymentModeID = ID;

            var $Data = $.param({
                "PaymentModeID": ID
            });

            $http.post('<?php echo base_url('app/edit/payment/mode'); ?>', $Data, config).then(function (response) {
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
                    $scope.PaymentModeModel = response.data.result.PaymentMode;
                    $scope.DescriptionModel = response.data.result.Description;
                }


            });
        };

        $scope.updatePaymentMode = function () {
            var $Data = $.param({
                "PaymentMode": $scope.PaymentModeModel,
                "Description": $scope.DescriptionModel,
                "PaymentModeID": $scope.PaymentModeID
            });

            $http.post('<?php echo base_url('app/update/payment/mode'); ?>', $Data, config).then(function (response) {
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

                            $window.location.href = '<?php echo base_url('app/payment/mode'); ?>';

                        }
                    });
                }

                if (response.data.status == -2) {
                    swal("The payment mode is already exist !!", {
                        icon: "warning",
                        closeOnClickOutside: false
                    }).then((ok) => {
                        if (ok) {

                            $window.location.href = '<?php echo base_url('app/payment/mode'); ?>';

                        }
                    });
                }

                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        };

        //delete category
        $scope.deletePM = function (ID) {
            var $Data = $.param({
                'PaymentModeID': ID
            });
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover !",
                icon: "warning",
                buttons: true,
                dangerMode: true
            }).then((willDelete) => {
                if (willDelete) {
                    $http.post('<?php echo base_url('app/delete/payment/mode'); ?>', $Data, config).then(function (response) {
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

                                    window.location.href = '<?php echo base_url("app/payment/mode"); ?>';
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