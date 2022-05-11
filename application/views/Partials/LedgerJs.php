<script>
    var app = angular.module('LedgerApp', []);
    app.controller('LedgerAppCtrl', function ($scope, $http, $window, $filter) {
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };

        //initial valuue 
        $scope.LedgerID = "";
        $scope.AddPanel = false;
        $scope.ListPanel = true;
        $scope.SaveBtn = true;

        function showGroup() {
            var DataGroup = $.param({
                'TableName': 'ledgergroup'
            });
            $http.post('<?php echo base_url('api/v1/app/master'); ?>', DataGroup, config).then(function (response) {
                $scope.ledgergroups = response.data.result;
            });
        }
        showGroup();

        function getLedgers() {
            $scope.Spinner1 = true;
            $http.get('<?php echo base_url('app/provide/ledger'); ?>').then(function (response) {
                $scope.ledgers = response.data.result;
                $scope.Spinner1 = false;
                
            });
        }
        getLedgers();

        $scope.searchLedgers = function () {
            $scope.Spinner1 = true;
            $scope.ledgers = "";
            var Data = $.param({
                'Ledger': $scope.aLedgerNameModel,
                'LedgerGroup': $scope.aLedgerGroupModel
            });

            $http.post('<?php echo base_url("app/filter/account/ledger") ?>', Data, config).then(function (response) {
                $scope.ledgers = response.data.result;
                $scope.Spinner1 = false;
            });
        }

        $scope.showAddPanel = function () {
            $scope.AddPanel = true;
            $scope.ListPanel = false;
        }

        $scope.reset = function () {
            $window.location = '<?php echo base_url('app/ledger');?>';
        }

        //saving the test description
        $scope.saveLedger = function () {
            var DataLedger = $.param({
                "Ledger": $scope.LedgerModel,
                "LedgerAlias": $scope.LedgerAliasModel,
                "CompanyID": $scope.CompanyModel,
                "LedgerGroupID": $scope.LedgerGroupModel,
                "Remarks": $scope.RemarksModel,
                "TB": $scope.TBModel,
                "PL": $scope.PLModel,
                "BS": $scope.BSModel

            });

            $http.post('<?php echo base_url('app/ledger/save'); ?>', DataLedger, config).then(function (response) {
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

                            $window.location.href = '<?php echo base_url('app/ledger'); ?>';

                        }
                    });
                }

                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        };

        //delete ledger
        $scope.deleteLedger = function (ID) {

            var $Data = $.param({
                'LedgerID': ID
            });
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover !",
                icon: "warning",
                buttons: true,
                dangerMode: true
            }).then((willDelete) => {
                if (willDelete) {
                    $http.post('<?php echo base_url('app/delete/ledger'); ?>', $Data, config).then(function (response) {
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

                                    window.location.href = '<?php echo base_url("app/ledger"); ?>';
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

        $scope.editLedger = function (ID) {
            $scope.ListPanel = false;
            $scope.SaveBtn = false;
            $scope.UpdateBtn = true;
            $scope.AddPanel = true;
            $scope.LedgerID = ID;

            var $Data = $.param({
                "LedgerID": ID
            });

            $http.post('<?php echo base_url('app/edit/ledger'); ?>', $Data, config).then(function (response) {
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
                    $scope.LedgerModel = response.data.result.Ledger;
                    $scope.LedgerAliasModel = response.data.result.LedgerAlias;
                    $scope.CompanyModel = response.data.result.CompanyID;
                    $scope.LedgerGroupModel = response.data.result.LedgerGroupID;
                    $scope.TBModel = response.data.result.TB;
                    $scope.PLModel = response.data.result.PL;
                    $scope.BSModel = response.data.result.BS;
                    $scope.RemarksModel = response.data.result.Remarks;
                }

            });
        };

        $scope.updateLedger = function () {
            var $Data = $.param({
                "LedgerID": $scope.LedgerID,
                "Ledger": $scope.LedgerModel,
                "LedgerAlias": $scope.LedgerAliasModel,
                "CompanyID": $scope.CompanyModel,
                "LedgerGroupID": $scope.LedgerGroupModel,
                "Remarks": $scope.RemarksModel,
                "TB": $scope.TBModel,
                "PL": $scope.PLModel,
                "BS": $scope.BSModel
            });

            $http.post('<?php echo base_url('app/update/ledger'); ?>', $Data, config).then(function (response) {
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

                            $window.location.href = '<?php echo base_url('app/ledger'); ?>';

                        }
                    });
                }

                if (response.data.status == -2) {
                    swal("The ledger group is already exist !!", {
                        icon: "warning",
                        closeOnClickOutside: false
                    }).then((ok) => {
                        if (ok) {

                            $window.location.href = '<?php echo base_url('app/ledger'); ?>';

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