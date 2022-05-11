<script>
    var app = angular.module('PurchaseManageApp', []);
    app.controller('PurchaseManageAppCtrl', function ($scope, $http, $window, $filter) {
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };

        //initial valuue 
        $scope.GroupID = "";
        $scope.AddPanel = false;
        $scope.ListPanel = true;
        $scope.SaveBtn = true;
        $scope.purchaseitems = [];
        $scope.PurchaseDateModel = '<?php echo date('Y-m-d'); ?>';
        $scope.ItemType = "";
        $scope.ItemName = "";
        $scope.BillAmountModel = '0.00';

        function showVendor() {
            var Data = $.param({
                'TableName': 'vendor'
            });

            $http.post('<?php echo base_url('api/v1/app/master'); ?>', Data, config).then(function (response) {
                $scope.vendors = response.data.result;
            });
        }
        showVendor();

        function showPurchaseBills() {
            $scope.Spinner1 = true;
            $scope.bills = "";
            $http.get('<?php echo base_url('app/purchase/bills/provide'); ?>').then(function (response) {
                if (response.data.status == 1) {
                    $scope.bills = response.data.result;
                    $scope.Spinner1 = false;
                } else {
                    swal("Network Error !! Pls try again.");
                }
            });
        }

        showPurchaseBills();


        $scope.searchPurchaseBills = function () {
            $scope.Spinner1 = true;
            $scope.bills = "";
            
            var Data = $.param({
                'PurchaseDate': $scope.PurchaseDateModel,
                'BillNo': $scope.BillNoModel,
                'VendorID': $scope.VendorModel
            });

            $http.post('<?php echo base_url('app/filter/puchase/bill') ?>', Data, config).then(function (response) {
                if (response.data.status === 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true

                    });
                }

                if (response.data.status === 1) {
                    $scope.bills = response.data.result;
                    $scope.Spinner1 = false;
                }

                if (response.data.status === -1) {
                    swal("Network error !!");
                }
            });
        }

        $scope.getItemNames = function () {
            var itemTypeId = $scope.ItemTypeModel.ID;
            //alert(itemTypeId);

            var Data = $.param({
                'ItemTypeID': itemTypeId
            });

            $http.post('<?php echo base_url("app/itemtype/itemname/provide"); ?>', Data, config).then(function (response) {
                if (response.data.status === 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true

                    });
                }

                if (response.data.status === 1) {
                    $scope.itemnames = response.data.result;
                    $scope.ItemType = 0;
                }

                if (response.data.status === -1) {
                    $scope.itemnames = "";
                    swal("Network Error,pls try again !!");
                }
            });

        }

        $scope.changeItemName = function () {
            $scope.ItemName = 0;
        }


        $scope.updateTotal = function () {
            $scope.TotalAmountModel = parseInt($scope.PurchaseRateModel * $scope.QuantityModel);

        }



        $scope.addItem = function () {

            if ($scope.ItemType !== 0) {
                swal("Please Select Item Type");
                return false;
            }

            if ($scope.ItemName !== 0) {
                swal("Please Select Item Name");
                return false;
            }

            var Data = $.param({
                'InwardDate': $scope.InwardDateModel,
                'BillNo': $scope.BillNoModel,
                'Vendor': $scope.VendorModel,
                'ItemType': $scope.ItemTypeModel.ItemType,
                'ItemTypeID': $scope.ItemTypeModel.ID,
                'ItemName': $scope.ItemNameModel.ItemName,
                'ItemNameID': $scope.ItemNameModel.ID,
                'Desc': $scope.DescriptionModel,
                'Rate': $scope.PurchaseRateModel,
                'Quantity': $scope.QuantityModel,
                'Total': $scope.TotalAmountModel
            });


            $http.post('<?php echo base_url("app/validate/purchase/item"); ?>', Data, config).then(function (response) {
                if (response.data.status === 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true

                    });
                }

                if (response.data.status == 1) {

                    var itemRow = {
                        'ItemType': $scope.ItemTypeModel.ItemType,
                        'ItemName': $scope.ItemNameModel.ItemName,
                        'ItemTypeID': $scope.ItemTypeModel.ID,
                        'ItemNameID': $scope.ItemNameModel.ID,
                        'Desc': $scope.DescriptionModel,
                        'Rate': $scope.PurchaseRateModel,
                        'Quantity': $scope.QuantityModel,
                        'Total': $scope.TotalAmountModel
                    };

                    $scope.purchaseitems.push(itemRow);

                    $scope.DescriptionModel = "";
                    $scope.PurchaseRateModel = "";
                    $scope.QuantityModel = "";
                    $scope.TotalAmountModel = "";
                    $scope.BillAmountModel = $scope.subTotal();


                }
            });
        }

        $scope.subTotal = function () {
            var total = 0;
            angular.forEach($scope.purchaseitems, function (key, value) {
                total += parseInt(key.Total);
            });

            return total;

        }


        $scope.removeItem = function (x1) {
            $scope.purchaseitems.splice(x1, 1);
        }



        $scope.searchLedgerGroups = function () {
            var Data = $.param({
                'LedgerGroup': $scope.sLedgerGroupModel,
                'UnderGroupID': $scope.sUnderGroupModel
            });

            $http.post('<?php echo base_url("app/search/ledger/group") ?>', Data, config).then(function (response) {
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

        $scope.editGroup = function (ID) {
            $scope.ListPanel = false;
            $scope.SaveBtn = false;
            $scope.UpdateBtn = true;
            $scope.AddPanel = true;
            $scope.GroupID = ID;

            var DataEdit = $.param({
                "GroupID": ID
            });

            $http.post('<?php echo base_url('app/edit/ledger/under/group'); ?>', DataEdit, config).then(function (response) {
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
                    $scope.GroupModel = response.data.result.UnderGroup;
                    $scope.DescriptionModel = response.data.result.Description;
                    $scope.ActiveModel = response.data.result.IsActive;
                }


            });
        };

        $scope.savePurchaseItems = function () {
            var Data = $.param({
                'InwardDate': $scope.InwardDateModel,
                'BillNo': $scope.BillNoModel,
                'Vendor': $scope.VendorModel,
                'BillAmount': $scope.BillAmountModel,
                'PurchaseItems': $scope.purchaseitems,

            });

            $http.post('<?php echo base_url('app/purchase/items/save'); ?>', Data, config).then(function () {

            });
        }

        //delete category
        $scope.deleteGroup = function (ID) {

            var DataID = $.param({
                'GroupID': ID
            });
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover !",
                icon: "warning",
                buttons: true,
                dangerMode: true
            }).then((willDelete) => {
                if (willDelete) {
                    $http.post('<?php echo base_url('app/delete/ledger/under/group'); ?>', DataID, config).then(function (response) {
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

                                    window.location.href = '<?php echo base_url("app/ledger/under/group"); ?>';
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