<script>
    var app = angular.module('SecurityDepositApp', []);
    app.controller('SecurityDepositAppCtrl', function ($scope, $http, $window, $filter) {
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };

        //initial valuue 

        $scope.AddPanel = false;
        $scope.ListPanel = true;
        $scope.EmployeeID = "";
        $scope.PayTypeModel = "1";
        $scope.PaymentMode = "0";
        $scope.BankModel = "0";
        $scope.RefNoModel = "0";

        $scope.TotalAmountModel = "0.00";
        $scope.AmountPaidModel = "0.00";
        $scope.AmountDueModel = "0.00";

        $scope.label = "Employees";
        $scope.EmployeeCode = "XX-XXXXXXXX-XX";
        $scope.EmpName = "XXXXXXXXX";
        $scope.TotalDue = "0.00";


        function showPaymentMode() {
            var Data = $.param({
                'TableName': 'paymentmode'
            });

            $http.post('<?php echo base_url('api/v1/app/master') ?>', Data, config).then(function (response) {

                $scope.paymentmodes = response.data.result;

            });
        }
        
        function showBank() {
            var $Data = $.param({
                'TableName': 'ledger'
            });

            $http.post('<?php echo base_url('api/app/provide/bank/ledger') ?>', $Data, config).then(function (response) {
                $scope.banks = response.data.result;
            });
        }

        showPaymentMode();
        showBank();

        $scope.showAddPanel = function (EmployeeID, DepartmentID) {
            $scope.EmployeeID = EmployeeID;
            $scope.DepartmentID = DepartmentID;
            $scope.label = 'Security Deposit';
            $scope.AddPanel = true;
            $scope.ListPanel = false;
        }

        $scope.reset = function () {
            $scope.AddPanel = false;
            $scope.EditPanel = false;
            $scope.ListPanel = true;
        }

        $scope.searchEmployee = function () {
            var Data = $.param({
                "EmployeeCode": $scope.EmployeeCodeModel,
                "EmployeeName": $scope.EmployeeNameModel,
                "FatherName": $scope.FatherModel,
                "Department": $scope.DepartmentModel,
                "Designation": $scope.DesignationModel,
                "JoiningDate": $scope.JoiningDateModel,
                "BirthDate": $scope.BirthDateModel,
                "CurrentEmployee": $scope.CurrentEmployeeModel
            });

            $http.post('<?php echo base_url("app/employee/filter/result"); ?>', Data, config).then(function (response) {
                if (response.data.status === 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true

                    });
                }
                if (response.data.status === 1) {
                    $scope.employees = response.data.result;
                }
                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        }

        function showEmployee() {
            $http.get('<?php echo base_url('app/employee/provide'); ?>').then(function (response) {
                if (response.data.status == 1) {
                    $scope.employees = response.data.result;
                }

                if (response.data.result == -1) {
                    swal('Network Error !!');
                }
            });
        }

        showEmployee();

        

        $scope.changeTotalAmt = function () {
            if (typeof $scope.TotalAmountModel === 'undefined' || $scope.TotalAmountModel.length === 0) {
                var $totalAmt = 0.00;
                $scope.TotalAmountModel = $totalAmt.toFixed(2);
            }


            var $dueAmt = parseFloat($scope.TotalAmountModel) - parseFloat($scope.AmountPaidModel);
            $scope.AmountDueModel = $dueAmt.toFixed(2);
        }

        $scope.changeAmtPaid = function () {
            var $totalAmt = parseFloat($scope.TotalAmountModel);
            var $paidAmt = parseFloat($scope.AmountPaidModel);
            if ($totalAmt < $paidAmt) {
                swal("Total amount can't be less than paid amount");
                $scope.AmountPaidModel = 0.00;
                return false;
            }

            if (typeof $scope.AmountPaidModel === 'undefined' || $scope.AmountPaidModel.length === 0) {
                var $paidAmt = 0.00;
                $scope.AmountPaidModel = $paidAmt.toFixed(2);
            }

            var $dueAmt = parseFloat($scope.TotalAmountModel) - parseFloat($scope.AmountPaidModel);
            $scope.AmountDueModel = $dueAmt.toFixed(2);
        }

        $scope.saveSecurityDeposit = function () {
            var $Data = $.param({
                'EmployeeID': $scope.EmployeeID,
                'SecurityDepositDate': $scope.SecurityDepositDateModel,
                'TotalAmount': $scope.TotalAmountModel,
                'AmountPaid': $scope.AmountPaidModel,
                'AmountDue': $scope.AmountDueModel,
                'Remark': $scope.RemarkModel,
                'PayType': $scope.PayTypeModel,
                'PaymentMode': $scope.PaymentModeModel,
                'Bank': $scope.BankModel,
                'RefNo': $scope.RefNoModel
            });

            $http.post("<?php echo base_url('app/save/employee/security'); ?>", $Data, config).then(function (response) {
                if (response.data.status === 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true

                    });
                }

                if (response.data.status == 1) {
                    swal("Record saved successfully !!", {
                        icon: "success",
                        closeOnClickOutside: false
                    }).then((ok) => {
                        if (ok) {

                            window.location.href = '<?php echo base_url("app/employee/security/deposit"); ?>';
                        }
                    });
                }
                if (response.data.status == -1) {
                    swal('Network Error,please try again.');
                }

            });
        }

        $scope.deleteSecurityDeposit = function (ID) {
            var $Data = $.param({
                'SecurityDepositID': ID,
                'EmployeeID': $scope.EmployeeID
            });
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover !",
                icon: "warning",
                buttons: true,
                dangerMode: true
            }).then((willDelete) => {
                if (willDelete) {
                    $http.post('<?php echo base_url('app/delete/security/deposit'); ?>', $Data, config).then(function (response) {
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

                                    window.location.href = '<?php echo base_url("app/employee/security/deposit"); ?>';
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


        $scope.showSecurityDeposits = function ($EmployeeID, $Salutation, $FirstName, $LastName, $EmpCode) {
            $scope.SecurityDepositPanel = true;
            $scope.ListPanel = false;
            $scope.EmployeeCode = $EmpCode;
            $scope.EmpName = $Salutation + ' ' + $FirstName + ' ' + $LastName;
            $scope.EmployeeID = $EmployeeID;

            var $Data = $.param({
                'EmployeeID': $EmployeeID
            });

            $http.post('<?php echo base_url('app/provide/employee/security/deposits'); ?>', $Data, config).then(function (response) {
                if (response.data.status === 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true

                    });
                }

                if (response.data.status == 1) {
                    $scope.securitydeposits = response.data.result;
                    $scope.TotalDue = response.data.TotalDue;
                }
                if (response.data.status == -1) {
                    swal('Network Error,please try again.');
                }
            });
        }

    });
</script>