<script>
    var app = angular.module('SalaryPaymentApp', []);
    app.controller('SalaryPaymentAppCtrl', function ($scope, $http, $window, $filter) {
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };

        //initial value
        function showPaymentMode() {
            var $Data = $.param({
                'TableName': 'paymentmode'
            });

            $http.post('<?php echo base_url('api/v1/app/master') ?>', $Data, config).then(function (response) {
                $scope.pmodes = response.data.result;
            });
        }
        
        function showBanks(){
            var $Data = $.param({
                'TableName': 'ledger'
            });
            
            $http.post('<?php echo base_url('api/app/provide/bank/ledger');?>', $Data, config).then(function(response){
                $scope.banks = response.data.result;
            });
        }
        
        showPaymentMode();
        showBanks();

        $scope.searchEmployeSalary = function () {
            $scope.salaries = "";
            $scope.Spinner1 = true;
            $scope.SalaryMonthModel = $("#SalaryMonthYear").val();
            var $Data = $.param({
                'EmpCode': $scope.EmployeeCodeModel,
                'SalaryMonth': $scope.SalaryMonthModel
            });

            $http.post('<?php echo base_url('app/filter/employee/salary'); ?>', $Data, config).then(function (response) {
                if (response.data.status == 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true

                    });
                    $scope.Spinner1 = false;
                }

                if (response.data.status == 1) {
                    $scope.Spinner1 = false;
                    $scope.salaries = response.data.result;
                }

                if (response.data.status === -1) {
                    swal("Network error,Please try again !!", {
                        icon: "success",
                        closeOnClickOutside: false
                    }).then((ok) => {
                        if (ok) {

                            $window.location.href = '<?php echo base_url('app/salary/slip/payment'); ?>';

                        }
                    });
                }




            });
        }


        $scope.makePayment = function () {
            $Data = $.param({
                'PaymentDate': $scope.PaymentDateModel,
                'items': $scope.salaries
            });

            $http.post('<?php echo base_url('app/make/employee/salary/payment'); ?>', $Data, config).then(function (response) {
                if (response.data.status == 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true

                    });
                }

                if (response.data.status === 1) {
                    swal("Records saved successfully !!", {
                        icon: "success",
                        closeOnClickOutside: false
                    }).then((ok) => {
                        if (ok) {

                            $window.location.href = '<?php echo base_url('app/salary/slip/payment'); ?>';

                        }
                    });
                }


            });
        }

        $scope.printPaySlip = function () {
            $window.location = '<?php echo base_url('app/salary/slip/print'); ?>';
        }

        $scope.addSchemeFormula = function () {
            if (typeof $scope.SchemeAllowanceModel === 'undefined' || $scope.SchemeAllowanceModel.length === 0) {
                swal("Please select Allowance/Deduction");
                return false;
            }

            if (typeof $scope.SchemeAllowanceNameModel === 'undefined' || $scope.SchemeAllowanceNameModel.length === 0) {
                swal("Please select Allowance Name");
                return false;
            }

            var d1 = {
                'AllowanceID': $scope.SchemeAllowanceNameModel.ID,
                'AllowanceName': $scope.SchemeAllowanceNameModel.Name,
                'AllowanceType': $scope.SchemeAllowanceModel,
                'SchemeBasedOn': $scope.BasedOnModel,
                'Amount': '0.00',
                'Formula': $scope.FormulaModel,

            }

            let index = $scope.items.findIndex(record => record.AllowanceID === d1.AllowanceID)
            if (index === -1) {
                $scope.items.push(d1);
            } else {
                swal("It is already added");
            }
        }

        $scope.removeItem = function (x1) {
            $scope.items.splice(x1, 1);
        }

        $scope.saveSalaryScheme = function () {
            if (!$scope.SchemeAllowanceNameModel) {
                swal("Please Select Allowance Name");
                return false;
            }

            var Data = $.param({
                'SchemeCode': $scope.SchemeCodeModel,
                'SchemeName': $scope.SchemeNameModel,
                'AllowanceType': $scope.SchemeAllowanceModel,
                'AllowanceName': $scope.SchemeAllowanceNameModel.ID,
                'SchemeItems': $scope.items

            });

            $http.post('<?php echo base_url('app/salary/scheme/save'); ?>', Data, config).then(function (response) {
                if (response.data.status == 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true

                    });
                }

                if (response.data.status === 1) {
                    swal("Records saved successfully !!", {
                        icon: "success",
                        closeOnClickOutside: false
                    }).then((ok) => {
                        if (ok) {

                            $window.location.href = '<?php echo base_url('app/employee/salary/scheme'); ?>';

                        }
                    });
                }

                if (response.data.status === 2) {
                    swal("Please add atleast one scheme allowance.");
                }

                if (response.data.status === -1) {
                    swal("Network error ! Try Again.");
                }
            })
        }
        
        $scope.deleteSalary = function(ID){
            var $Data = $.param({
                'SalaryID': ID
            });
            
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover !",
                icon: "warning",
                buttons: true,
                dangerMode: true
            }).then((willDelete) => {
                if (willDelete) {
                    $http.post('<?php echo base_url('app/delete/employee/salary'); ?>', $Data, config).then(function (response) {
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

                                    window.location.href = '<?php echo base_url("app/salary/slip/payment"); ?>';
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