<script>
    var app = angular.module('VoucherApp', []);
    app.controller('VoucherAppCtrl', function($scope, $http, $window, $filter) {
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
        $scope.VoucherTypeModel = "";



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

        $scope.searchLedgers = function() {
            var Data = $.param({
                'Ledger': $scope.aLedgerNameModel,
                'LedgerGroup': $scope.aLedgerGroupModel
            });

            $http.post('<?php echo base_url("app/filter/account/ledger") ?>', Data, config).then(function(response) {
                $scope.ledgergroups = response.data.result;
            });
        }

        $scope.showAddPanel = function() {
            $scope.AddPanel = true;
            $scope.ListPanel = false;
        }

        $scope.reset = function() {
            $window.location = '<?php echo base_url('app/account/voucher/entry');?>';
        }

        //getting ledger for debit
        $scope.paymentEntry = function() {
            $scope.VoucherTypeModel = 2;
            $scope.CreditSide = false;
            $scope.DebitSide = true;
            getPaymentDebitLedger();
        }


        //getting ledger for contra entry
        $scope.contraEntry = function() {
            $scope.VoucherTypeModel = 1;
            var $Data = $.param({
                'Submit': 'Post'
            });

            $http.post('<?php echo base_url('app/account/contra/ledger'); ?>', $Data, config).then(function(response) {
                if (response.data.status === 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true

                    });
                }

                if (response.data.status === 1) {
                    $scope.ledgeraccounts = response.data.result;
                }

                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }


            });
        }

        $scope.debitEntry = function(ledgerID, Ledger) {
            $scope.CreditSide = true;
            $scope.DebitSide = false;

            if (typeof $scope.VoucherDateModel == 'undefined' || $scope.VoucherDateModel.length === 0) {
                swal("Please enter voucher date !!");
                return false;
            }
            if (typeof $scope.CompanyModel == 'undefined' || $scope.CompanyModel.length === 0) {
                swal("Please enter company !!");
                return false;
            }
            if (typeof $scope.AmountModel == 'undefined' || $scope.AmountModel.length === 0) {
                swal("Please enter voucher amount !!");
                return false;
            }

            if ($scope.VoucherTypeModel == 2) {
                getPaymentCreditLedger();
            }

            if ($scope.VoucherTypeModel == 3) {
                getReceiptCreditLedger();
            }

            if ($scope.VoucherTypeModel == 4) {
                getJournalLedger();
            }
            


            var $data = {
                'LedgerID': ledgerID,
                'color': 'text-danger',
                'EntryType': 'Dr',
                'Date': $scope.VoucherDateModel,
                'Particulars': Ledger,
                'Debit': $scope.AmountModel,
                'Credit': '0.00',

            };

            $scope.items.push($data);

        }

        //
        function getPaymentCreditLedger() {
            var $Data = $.param({
                'Submit': 'Post'
            });
            $http.post('<?php echo base_url('app/provide/account/payment/credit/ledger'); ?>', $Data, config).then(function(response) {
                if (response.data.status === 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true

                    });
                    return false;
                }

                if (response.data.status === 1) {
                    $scope.ledgeraccounts = response.data.result;
                }

                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                    return false;
                }
            });
        }

        function getPaymentDebitLedger() {
            var $Data = $.param({
                'Submit': 'Post'
            });
            $http.post('<?php echo base_url('app/provide/account/payment/debit/ledger'); ?>', $Data, config).then(function(response) {
                if (response.data.status === 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true

                    });
                }

                if (response.data.status === 1) {
                    $scope.ledgeraccounts = response.data.result;
                }

                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        }

        $scope.creditEntry = function(ledgerID, Ledger) {
            var $data = {
                'LedgerID': ledgerID,
                'color': 'text-success',
                'EntryType': 'Cr',
                'Date': $scope.VoucherDateModel,
                'Particulars': Ledger,
                'Debit': '0.00',
                'Credit': $scope.AmountModel,

            };
            $scope.items.push($data);
        }

        $scope.removeItem = function(x1) {
            $scope.items.splice(x1, 1);

            if ($scope.items.length === 0) {
                if ($scope.VoucherTypeModel == 2) {
                    getPaymentDebitLedger();
                }

                if($scope.VoucherTypeModel == 4){
                    getJournalLedger();
                }




                $scope.CreditSide = false;
                $scope.DebitSide = true;

            }
        }

        //receipt voucher entry

        $scope.receiptEntry = function() {
            $scope.VoucherTypeModel = 3;
            $scope.CreditSide = false;
            $scope.DebitSide = true;
            getReceiptDebitLedger();
        }

        function getReceiptDebitLedger() {
            var $Data = $.param({
                'Submit': 'Post'
            });
            $http.post('<?php echo base_url('app/provide/account/receipt/debit/ledger'); ?>', $Data, config).then(function(response) {
                if (response.data.status === 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true

                    });
                }

                if (response.data.status === 1) {
                    $scope.ledgeraccounts = response.data.result;
                }

                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        }

        function getReceiptCreditLedger() {
            var $Data = $.param({
                'Submit': 'Post'
            });
            $http.post('<?php echo base_url('app/provide/account/receipt/credit/ledger'); ?>', $Data, config).then(function(response) {
                if (response.data.status === 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true

                    });
                    return false;
                }

                if (response.data.status === 1) {
                    $scope.ledgeraccounts = response.data.result;
                }

                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                    return false;
                }
            });
        }

        //journal voucher entry

        $scope.journalEntry = function() {
            $scope.VoucherTypeModel = 4;
            $scope.CreditSide = false;
            $scope.DebitSide = true;
            getJournalLedger();
        }

        function getJournalLedger() {
            var $Data = $.param({
                'Submit': 'Post'
            });
            $http.post('<?php echo base_url('app/provide/account/journal/ledger'); ?>', $Data, config).then(function(response) {
                if (response.data.status === 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true

                    });
                }

                if (response.data.status === 1) {
                    $scope.ledgeraccounts = response.data.result;
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
                    swal("Records Saved successfully !!", {
                        icon: "success",
                        closeOnClickOutside: false
                    }).then((ok) => {
                        if (ok) {

                            $window.location.href = '<?php echo base_url('app/account/voucher/entry'); ?>';

                        }
                    });
                }

                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        };
    });
</script>