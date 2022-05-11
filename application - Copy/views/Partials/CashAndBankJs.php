<script>
    var app = angular.module('CashBankApp', []);
    app.controller('CashBankAppCtrl', function($scope, $http, $window, $filter) {
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };

        //initial value
        $scope.Debit = '0.00';
        $scope.Credit = '0.00';


        function getTrialBalance() {
            var $Data = $.param({
                'Submit': 'Post'
            });

            $http.post('<?php echo base_url('app/provide/account/cash/bank'); ?>', $Data, config).then(function(response) {
                if (response.data.status === 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true

                    });
                }

                if (response.data.status == 1) {
                    $scope.balances = response.data.result;
                    $scope.Debit = response.data.DrBalance+" "+"Dr";
                    $scope.Credit = response.data.CrBalance+" "+"Cr";
                }
                if (response.data.status == -1) {
                    swal('Could not delete,please try again.');
                }
            });
        }

        getTrialBalance();
    });
</script>