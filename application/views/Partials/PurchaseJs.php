<script>
    var app = angular.module('ItemInwardApp', []);
    app.controller('ItemInwardAppCtrl', function ($scope, $http, $window, $filter) {
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };

        //initial valuue 
        $scope.PurchaseBillID = "";
        $scope.AddPanel = false;
        $scope.ListPanel = true;
        $scope.SaveBtn = true;
        $scope.purchaseitems = [];
        $scope.InwardDateModel = '<?php echo date('Y-m-d') ?>';
        $scope.ItemType = "";
        $scope.ItemName = "";
        $scope.BillAmountModel = '0.00';
        $scope.QuantityModel = '0';



        function showVendor() {
            var Data = $.param({
                'TableName': 'vendor'
            });

            $http.post('<?php echo base_url('api/v1/app/master'); ?>', Data, config).then(function (response) {
                $scope.vendors = response.data.result;
            });
        }

        showVendor();

        function showItemType() {
            var Data = $.param({
                'TableName': 'itemtype'
            });

            $http.post('<?php echo base_url('api/v1/app/master') ?>', Data, config).then(function (response) {

                $scope.itemtypes = response.data.result;

            });
        }

        showItemType();


        function showPurchaseBills() {
            $http.get('<?php echo base_url('app/purchase/bills/provide'); ?>').then(function (response) {
                if (response.data.status == 1) {
                    $scope.bills = response.data.result;
                } else {
                    swal("Network Error !! Pls try again.");
                }
            });
        }

        showPurchaseBills();

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
            if($scope.QuantityModel.length == 0){
                $scope.QuantityModel = '0';
            }
            
            if ($scope.PurchaseRateModel.length == 0) {
                $scope.TotalAmountModel = '0.00';
                return false;
            }
            var $total = parseFloat($scope.PurchaseRateModel) * parseInt($scope.QuantityModel);
            $scope.TotalAmountModel = $total.toFixed(2);
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

            var $Data = $.param({
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


            $http.post('<?php echo base_url("app/validate/purchase/item"); ?>', $Data, config).then(function (response) {
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
                        'Description': $scope.DescriptionModel,
                        'Rate': $scope.PurchaseRateModel,
                        'Quantity': $scope.QuantityModel,
                        'Total': $scope.TotalAmountModel,
                        'CreatedAt': '<?php echo date('Y-m-d'); ?>',
                        'UpdatedAt': '<?php echo date('Y-m-d'); ?>'
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
                total += parseFloat(key.Total);
            });

            return total.toFixed(2);

        }


        $scope.removeItem = function (x1) {
            $scope.purchaseitems.splice(x1, 1);
            $scope.BillAmountModel = $scope.subTotal();
        }



        $scope.searchPurchaseBill = function () {
            var $Data = $.param({
                'PurchaseBill': $scope.sBillNoModel,

            });

            $http.post('<?php echo base_url("app/search/purchase/bill") ?>', $Data, config).then(function (response) {
                $scope.bills = response.data.result;
            });
        }

        $scope.showAddPanel = function () {
            $scope.AddPanel = true;
            $scope.ListPanel = false;
        }

        $scope.reset = function () {
            $window.location = '<?php echo base_url('app/item/inward');?>';
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

        $scope.editPurchase = function (ID) {
            $scope.ListPanel = false;
            $scope.AddPanel = true;
            $scope.SaveBtn = false;
            $scope.UpdateBtn = true;
            $scope.PurchaseBillID = ID;

            var $Data = $.param({
                "PurchaseBillID": ID
            });

            $http.post('<?php echo base_url('app/edit/purchase/bill'); ?>', $Data, config).then(function (response) {
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
                    $scope.InwardDateModel = response.data.rs1.PurchaseDate;
                    $scope.BillNoModel = response.data.rs1.BillNo;
                    $scope.VendorModel = response.data.rs1.VendorID;
                    $scope.purchaseitems = response.data.rs2;
                    $scope.BillAmountModel = response.data.TotalAmt;
                }


            });
        };


        $scope.updatePurchaseItems = function () {
            var $Data = $.param({
                'InwardDate': $scope.InwardDateModel,
                'BillNo': $scope.BillNoModel,
                'Vendor': $scope.VendorModel,
                'BillAmount': $scope.BillAmountModel,
                'PurchaseItems': $scope.purchaseitems,
                'BillID': $scope.PurchaseBillID

            });

            $http.post('<?php echo base_url('app/update/purchase/items'); ?>', $Data, config).then(function (response) {
                if (response.data.status == 0) {
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

                            window.location.href = '<?php echo base_url("app/item/inward"); ?>';
                        }
                    });
                }

                if (response.data.status == -1) {
                    swal('Could not save,please try again.');
                }
            });
        }

        $scope.savePurchaseItems = function () {
            var $Data = $.param({
                'InwardDate': $scope.InwardDateModel,
                'BillNo': $scope.BillNoModel,
                'Vendor': $scope.VendorModel,
                'BillAmount': $scope.BillAmountModel,
                'PurchaseItems': $scope.purchaseitems,

            });

            $http.post('<?php echo base_url('app/purchase/items/save'); ?>', $Data, config).then(function (response) {
                if (response.data.status == 0) {
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

                            window.location.href = '<?php echo base_url("app/item/inward"); ?>';
                        }
                    });
                }

                if (response.data.status == -1) {
                    swal('Could not save,please try again.');
                }
            });
        }

        //delete purchase bill
        $scope.deletePurchaseBill = function (ID) {

            var $Data = $.param({
                'BillID': ID
            });
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover !",
                icon: "warning",
                buttons: true,
                dangerMode: true
            }).then((willDelete) => {
                if (willDelete) {
                    $http.post('<?php echo base_url('app/delete/purchase/bill'); ?>', $Data, config).then(function (response) {
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

                                    window.location.href = '<?php echo base_url("app/item/inward"); ?>';
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