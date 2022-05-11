<script>
    var app = angular.module('LedgerVoucherApp', []);
    app.controller('LedgerVoucherAppCtrl', function ($scope, $http, $window, $filter) {
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };

        //initial value
        $scope.Debit = '0.00';
        $scope.Credit = '0.00';


        function showGroup() {
            var DataGroup = $.param({
                'TableName': 'ledgergroup'
            });

            $http.post('<?php echo base_url('api/v1/app/master'); ?>', DataGroup, config).then(function (response) {

                $scope.ledgergroups = response.data.result;

            });
        }
        showGroup();

        $scope.provideLedger = function () {

            var $Data = $.param({
                'LedgerGroupID': $scope.LedgerGroupModel
            });

            $http.post('<?php echo base_url('app/provide/group/ledgers'); ?>', $Data, config).then(function (response) {
                if (response.data.status === 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true

                    });
                }

                if (response.data.status == 1) {
                    $scope.ledgers = response.data.result;
                }
            });
        }

        $scope.searchLedgerVoucher = function () {
            var $Data = $.param({
                'FromDate': $scope.FromDateModel,
                'ToDate': $scope.ToDateModel,
                'VoucherNo': $scope.VoucherNoModel,
                'LedgerGroup': $scope.LedgerGroupModel,
                'Ledger': $scope.LedgerModel,
            });

            $http.post('<?php echo base_url('app/filter/ledger/vouchers'); ?>', $Data, config).then(function (response) {
                if (response.data.status === 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true

                    });
                }

                if (response.data.status == 1) {
                    $scope.vouchers = response.data.result;
                    $scope.Debit = response.data.DrBalance;
                    $scope.Credit = response.data.CrBalance;
                }

                if (response.data.status == -1) {
                    swal('Network Error,please try again.');
                }
            });
        }

        //delete category
        $scope.deleteVoucher = function (VNo) {
            var $Data = $.param({
                'VNo': VNo
            });
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover !",
                icon: "warning",
                buttons: true,
                dangerMode: true
            }).then((willDelete) => {
                if (willDelete) {
                    $http.post('<?php echo base_url('app/delete/ledger/voucher'); ?>', $Data, config).then(function (response) {
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

                                    window.location.href = '<?php echo base_url("app/account/delete/voucher"); ?>';
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