<script>
    var app = angular.module('DayBookApp', []);
    app.controller('DayBookAppCtrl', function($scope, $http, $window, $filter) {
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };

        //initial valuue 
        $scope.GroupID = "";
        $scope.LedgerID = "";
        $scope.SaveBtn = true;
        $scope.items = [];
        $scope.DebitSide = true;
        $scope.VoucherTypeModel = 1;
        $scope.Debit = "0.00";
        $scope.Credit = "0.00";



        function showCompany() {
            var $Data = $.param({
                'TableName': 'settings'
            });

            $http.post('<?php echo base_url('api/v1/app/master'); ?>', $Data, config).then(function(response) {

                $scope.companies = response.data.result;

            });
        }

        function showGroup() {
            var DataGroup = $.param({
                'TableName': 'ledgergroup'
            });

            $http.post('<?php echo base_url('api/v1/app/master'); ?>', DataGroup, config).then(function(response) {

                $scope.ledgergroups = response.data.result;

            });
        }
        showGroup();
        showCompany();



        function getLedgers() {
            $http.get('<?php echo base_url('app/provide/ledger'); ?>').then(function(response) {
                $scope.ledgers = response.data.result;
            });
        }
        getLedgers();



        $scope.showAddPanel = function() {
            $scope.AddPanel = true;
            $scope.ListPanel = false;
        }

        $scope.reset = function() {
            $scope.AddPanel = false;
            $scope.ListPanel = true;
        }

        $scope.searchVoucher = function() {
            var $Data = $.param({
                'VoucherType': $scope.VoucherTypeModel,
                'FromDate': $scope.FromDateModel,
                'ToDate': $scope.ToDateModel,
                'LedgerGroup': $scope.LedgerGroupModel,
                'Ledger': $scope.LedgerModel
            });

           
                $http.post('<?php echo base_url('app/provide/day/book/vouchers'); ?>', $Data, config).then(function(response) {
                    if (response.data.status === 0) {
                        swal({
                            title: "There are some errors !!",
                            text: response.data.error,
                            icon: "warning",
                            dangerMode: true

                        });
                    }

                    if (response.data.status === 1) {
                        $scope.vouchers = response.data.result;
                        $scope.Debit = response.data.Debit;
                        $scope.Credit = response.data.Credit;
                    }

                    if (response.data.status === -1) {
                        swal("Network Error,pls try again !!");
                    }



                });
            

            
        }






        //saving the test description
        $scope.saveVoucher = function() {
            var $Data = $.param({
                "Comment": $scope.CommentsModel,
                "VoucherType": $scope.VoucherTypeModel,
                "Items": $scope.items
            });

            $http.post('<?php echo base_url('app/post/account/ledger'); ?>', $Data, config).then(function(response) {
                if (response.data.status === 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true

                    });
                }

                if (response.data.status === 1) {
                    $scope.vouchers = response.data.result;
                }

                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        };
    });
</script>