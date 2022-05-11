<script>
    var app = angular.module('LedgerGroupApp', []);
    app.controller('LedgerGroupAppCtrl', function ($scope, $http, $window, $filter) {
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };

        //initial valuue 
        $scope.LedgerGroupID = "";
        $scope.AddPanel = false;
        $scope.ListPanel = true;
        $scope.SaveBtn = true;

        function showGroup() {
            var DataGroup = $.param({
                'TableName': 'undergroup'
            });

            $http.post('<?php echo base_url('api/v1/app/master') ?>', DataGroup, config).then(function (response) {

                $scope.groups = response.data.result;

            });
        }
        showGroup();



        function getLedgerGroups() {
            $http.get('<?php echo base_url('app/get/ledger/groups') ?>').then(function (response) {
                $scope.ledgergroups = response.data.result;
            });
        }
        getLedgerGroups();
        
        $scope.searchLedgerGroups = function(){
            var Data = $.param({
                'LedgerGroup':$scope.sLedgerGroupModel,
                'UnderGroupID':$scope.sUnderGroupModel
            });
            
            $http.post('<?php echo base_url("app/search/ledger/group")?>', Data, config).then(function(response){
                $scope.ledgergroups = response.data.result;
            });
        }

        $scope.showAddPanel = function () {
            $scope.AddPanel = true;
            $scope.ListPanel = false;
        }

        $scope.reset = function () {
            $scope.AddPanel = false;
            $scope.ListPanel = true;
        }

        //saving the test description
        $scope.saveLedgerGroup = function () {
            var DataLedgerGroup = $.param({
                "LedgerGroup": $scope.LedgerGroupModel,
                "UnderGroup": $scope.UnderGroupModel,
                "Remarks": $scope.RemarksModel,
                "TB": $scope.TBModel,
                "PL": $scope.PLModel,
                "BS": $scope.BSModel

            });

            $http.post('<?php echo base_url('app/ledger/group/save'); ?>', DataLedgerGroup, config).then(function (response) {
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

                            $window.location.href = '<?php echo base_url('app/ledger/group'); ?>';

                        }
                    });
                }

                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        };

        $scope.editLedgerGroup = function (ID) {
            $scope.ListPanel = false;
            $scope.SaveBtn = false;
            $scope.UpdateBtn = true;
            $scope.AddPanel = true;
            $scope.LedgerGroupID = ID;

            var DataEdit = $.param({
                "LedgerGroupID": ID
            });

            $http.post('<?php echo base_url('app/edit/ledger/group'); ?>', DataEdit, config).then(function (response) {
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
                    $scope.LedgerGroupModel = response.data.result.LedgerGroup;
                    $scope.UnderGroupModel = response.data.result.UnderGroupID;
                    $scope.RemarksModel = response.data.result.Remarks;
                    $scope.TBModel= response.data.result.TrialBalance;
                    $scope.PLModel = response.data.result.ProfitLoss;
                    $scope.BSModel = response.data.result.BalanceSheet;
                   
                    
                }


            });
        };

        $scope.updateLedgerGroup = function () {
            var DataGroup = $.param({
                "LedgerGroupID": $scope.LedgerGroupID,
                "LedgerGroup": $scope.LedgerGroupModel,
                "UnderGroup": $scope.UnderGroupModel,
                "Remarks": $scope.RemarksModel,
                "TB": $scope.TBModel,
                "PL": $scope.PLModel,
                "BS": $scope.BSModel
            });

            $http.post('<?php echo base_url('app/update/ledger/group'); ?>', DataGroup, config).then(function (response) {
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

                            $window.location.href = '<?php echo base_url('app/ledger/group'); ?>';

                        }
                    });
                }

                if (response.data.status == -2) {
                    swal("The ledger group is already exist !!", {
                        icon: "warning",
                        closeOnClickOutside: false
                    }).then((ok) => {
                        if (ok) {

                            $window.location.href = '<?php echo base_url('app/ledger/group'); ?>';

                        }
                    });
                }

                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        };

        //delete ledger group
        $scope.deleteLedgerGroup = function (ID) {
           
            var $Data = $.param({
                'LedgerGroupID': ID
            });
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover !",
                icon: "warning",
                buttons: true,
                dangerMode: true
            }).then((willDelete) => {
                if (willDelete) {
                    $http.post('<?php echo base_url('app/delete/ledger/group'); ?>', $Data, config).then(function (response) {
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

                                    window.location.href = '<?php echo base_url("app/ledger/group"); ?>';
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