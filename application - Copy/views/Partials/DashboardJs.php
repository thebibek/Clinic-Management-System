<script>
    var app = angular.module('DashboardApp', []);
    app.controller('DashboardAppCtrl', function ($scope, $http, $window, $filter) {
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };

        //initial valuue 
        $scope.ReportCountModel = '0';
        $scope.TodayModel = '<?php echo date('l'); ?>';
        $scope.CurrentDateModel = '<?php echo date('dS M Y'); ?>';
        $scope.CashInHandModel = '0.00';
        $scope.ProfitModel = '0.00';
        $scope.IncomeModel = '0.00';
        $scope.ExpenseModel = '0.00';
        $scope.PatientCountModel = '0';

        function todayVisits() {
            $scope.Spinner1 = true;
            var $Data = $.param({
                'Submit': 'Post'
            });

            $http.post('<?php echo base_url('api/provide/today/patient/visits'); ?>', $Data, config).then(function (response) {
                if (response.data.status == 1) {
                    $scope.Spinner1 = false;
                    $scope.Error1Model = false;
                    $scope.todayvisits = response.data.result;
                    $scope.PatientCountModel = response.data.count;
                }

                if (response.data.status == -1) {
                    $scope.Error1Model = true;
                    $scope.error1 = 'No Records Found';
                }

            });
        }

        function provideTodayCompletedReport() {
            $scope.Spinner1 = true;
            var $Data = $.param({
                'Submit': 'POST'
            });

            $http.post('<?php echo base_url('app/provide/today/completed/report'); ?>', $Data, config).then(function (response) {
                if (response.data.status == 1) {
                    $scope.Spinner1 = false;
                    $scope.Error2Model = false;
                    $scope.completedreports = response.data.result;
                    $scope.ReportCountModel = response.data.count;
                }

                if (response.data.status == -1) {
                    $scope.Spinner1 = false;
                    $scope.Error2Model = true;
                    $scope.error2 = 'No Records Found';
                }
            });
        }


        function provideIncome() {
            var $Data = $.param({
                'Submit': 'POST'
            });

            $http.post('<?php echo base_url('api/provide/account/profit/loss'); ?>', $Data, config).then(function (response) {
                if (response.data.status == 1) {
                    $scope.IncomeModel = response.data.CrBalance;
                    $scope.ExpenseModel = response.data.DrBalance;
                    $scope.ProfitModel = response.data.NetProfit;
                } else {
                    $scope.ProfitModel = '0.00';
                    $scope.IncomeModel = '0.00';
                    $scope.ExpenseModel = '0.00';
                }
            });
        }

        function provideCashInHand() {
            var $Data = $.param({
                'Submit': 'POST'
            });

            $http.post('<?php echo base_url('app/account/provide/cash/in/hand'); ?>', $Data, config).then(function (response) {
                if (response.data.status == 1) {
                    $scope.CashInHandModel = response.data.cash;
                }
            });
        }

        function provideTodaysTestInvoice() {
            $scope.Spinner3 = true;
            var $Data = $.param({
                'Submit': 'POST'
            });

            $http.post('<?php echo base_url('app/provide/today/test/invoice'); ?>', $Data, config).then(function (response) {
                if (response.data.status == 1) {
                    $scope.Error3Model = false;
                    $scope.Spinner3 = false;
                    $scope.invoices = response.data.result;
                }

                if (response.data.status == -1) {
                    $scope.error3 = 'No Records Found';
                    $scope.Error3Model = true;
                    $scope.Spinner3 = false;

                }
            });
        }

        function provideEmployeeTodaysStatus() {
            var $Data = $.param({
                'Submit': 'POST'
            });

            $http.post('<?php echo base_url('app/provide/employee/today/status'); ?>', $Data, config).then(function (response) {
                if (response.data.status == 1) {
                    $scope.Error4Model = false;
                    $scope.Spinner4 = false;
                    $scope.attendances = response.data.result;
                }

                if (response.data.status == -1) {
                    $scope.error4 = 'No Records Found';
                    $scope.Error4Model = true;
                    $scope.Spinner4 = false;

                }
            });
        }

        todayVisits();
        provideTodayCompletedReport();
        provideIncome();
        provideCashInHand();
        provideTodaysTestInvoice();
        provideEmployeeTodaysStatus();

        //next day patient visit
        $scope.nextDay = function () {
            var $Data = $.param({
                'CurrentDate': $scope.CurrentDateModel
            });

            $http.post('<?php echo base_url('app/provide/next/day/patient/visit'); ?>', $Data, config).then(function (response) {
                if (response.data.status == 1) {
                    $scope.Spinner1 = false;
                    $scope.Error1Model = false;
                    $scope.todayvisits = response.data.result;
                    $scope.PatientCountModel = response.data.count;
                    $scope.CurrentDateModel = response.data.CurrentDate;
                }

                if (response.data.status == -1) {
                    $scope.todayvisits = "";
                    $scope.Error1Model = true;
                    $scope.CurrentDateModel = response.data.CurrentDate;
                    $scope.error1 = 'No Records Found';
                }
            });
        }

        //previous day visit
        $scope.previousDay = function () {
            var $Data = $.param({
                'CurrentDate': $scope.CurrentDateModel
            });

            $http.post('<?php echo base_url('app/provide/previous/day/patient/visit'); ?>', $Data, config).then(function (response) {
                if (response.data.status == 1) {
                    $scope.Spinner1 = false;
                    $scope.Error1Model = false;
                    $scope.todayvisits = response.data.result;
                    $scope.PatientCountModel = response.data.count;
                    $scope.CurrentDateModel = response.data.CurrentDate;
                }

                if (response.data.status == -1) {
                    $scope.todayvisits = "";
                    $scope.Error1Model = true;
                    $scope.CurrentDateModel = response.data.CurrentDate;
                    $scope.error1 = 'No Records Found';
                }
            });
        }

    });
</script>