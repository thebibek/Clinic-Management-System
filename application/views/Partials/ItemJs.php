<script>
    var app = angular.module('ItemApp', []);
    app.controller('ItemAppCtrl', function ($scope, $http, $window, $filter) {
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };

        //initial valuue 
        $scope.ItemID = "";
        $scope.AddPanel = false;
        $scope.ListPanel = true;
        function showItemType() {
            var $Data = $.param({
                'TableName': 'itemtype'
            });

            $http.post('<?php echo base_url('api/v1/app/master') ?>', $Data, config).then(function (response) {
                $scope.itemtypes = response.data.result;
            });
        }
        function showItem() {
            var Data = $.param({
                'TableName': 'item'
            });

            $http.post('<?php echo base_url('api/v1/app/master') ?>', Data, config).then(function (response) {

                $scope.items = response.data.result;

            });
        }

        showItemType();
        showItem();

        $scope.showAddPanel = function () {
            $scope.SaveBtn = true;
            $scope.UpdateBtn = false;
            $scope.AddPanel = true;
            $scope.ListPanel = false;
        }

        $scope.reset = function () {
            $window.location = '<?php echo base_url('app/item/master');?>';
        }

        //saving the test description
        $scope.saveItem = function () {
            var DataItem = $.param({
                "ItemType": $scope.ItemTypeModel,
                "ItemName": $scope.ItemNameModel,
                "Description": $scope.DescriptionModel,
                "OpeningBalance": $scope.OpeningModelModel,
                "ItemRate": $scope.RateModel,
                "IsActive": $scope.ActiveModel

            });

            $http.post('<?php echo base_url('app/item/save'); ?>', DataItem, config).then(function (response) {
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

                            $window.location.href = '<?php echo base_url('app/item/master'); ?>';

                        }
                    });
                }

                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        };

        $scope.editItem = function (ID) {
            $scope.ListPanel = false;
            $scope.AddPanel = true;
            $scope.SaveBtn = false;
            $scope.UpdateBtn = true;

            $scope.ItemID = ID;

            var $Data = $.param({
                "ItemID": ID
            });

            $http.post('<?php echo base_url('app/edit/item'); ?>', $Data, config).then(function (response) {
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
                    $scope.ItemTypeModel = response.data.result.ItemTypeID;
                    $scope.ItemNameModel = response.data.result.ItemName;
                    $scope.DescriptionModel = response.data.result.Description;
                    $scope.OpeningModelModel = response.data.result.OpeningBalance;
                    $scope.RateModel = response.data.result.Rate;
                    $scope.ActiveModel = response.data.result.IsActive;
                }


            });
        };

        $scope.updateItem = function () {
            var $Data = $.param({
                "ItemType": $scope.ItemTypeModel,
                "ItemName": $scope.ItemNameModel,
                "Description": $scope.DescriptionModel,
                "OpeningBalance": $scope.OpeningModelModel,
                "ItemRate": $scope.RateModel,
                "IsActive": $scope.ActiveModel,
                "ItemID": $scope.ItemID
            });

            $http.post('<?php echo base_url('app/update/item'); ?>', $Data, config).then(function (response) {
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

                            $window.location.href = '<?php echo base_url('app/item/master'); ?>';

                        }
                    });
                }

                if (response.data.status == -2) {
                    swal("The item is already exist !!", {
                        icon: "warning",
                        closeOnClickOutside: false
                    }).then((ok) => {
                        if (ok) {

                            $window.location.href = '<?php echo base_url('app/item/master'); ?>';

                        }
                    });
                }

                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        };

        //delete category
        $scope.deleteItem = function (ID) {
            var $Data = $.param({
                'ItemID': ID
            });
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover !",
                icon: "warning",
                buttons: true,
                dangerMode: true
            }).then((willDelete) => {
                if (willDelete) {
                    $http.post('<?php echo base_url('app/delete/item'); ?>', $Data, config).then(function (response) {
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

                                    window.location.href = '<?php echo base_url("app/item/master"); ?>';
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