<script>
    var app = angular.module('ItemTypeApp', []);
    app.controller('ItemTypeAppCtrl', function ($scope, $http, $window, $filter) {
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };

        //initial valuue 
        $scope.ItemTypeID = "";
        $scope.AddPanel = false;
        $scope.ListPanel = true;

        function showItemType() {
            var DataCategory = $.param({
                'TableName': 'itemtype'
            });

            $http.post('<?php echo base_url('api/v1/app/master') ?>', DataCategory, config).then(function (response) {

                $scope.itemtypes = response.data.result;

            });
        }
        showItemType();

        $scope.showAddPanel = function () {
            $scope.AddPanel = true;
            $scope.SaveBtn = true;
            $scope.UpdateBtn = false;
            $scope.ListPanel = false;
        }

        $scope.reset = function () {
            $window.location = '<?php echo base_url('app/item/type');?>';
        }

        //saving the test description
        $scope.saveItemType = function () {
            var DataItemType = $.param({
                "ItemType": $scope.ItemTypeModel,
                "Description": $scope.DescriptionModel,
                "IsActive": $scope.ActiveModel

            });

            $http.post('<?php echo base_url('app/item/type/save'); ?>', DataItemType, config).then(function (response) {
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

                            $window.location.href = '<?php echo base_url('app/item/type'); ?>';

                        }
                    });
                }

                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        };

        //edit item type    

        $scope.editItemType = function (ID) {
            $scope.ListPanel = false;
            $scope.SaveBtn = false;
            $scope.AddPanel = true;
            $scope.UpdateBtn = true;

            $scope.ItemTypeID = ID;

            var $Data = $.param({
                "ItemTypeID": ID
            });

            $http.post('<?php echo base_url('app/edit/item/type'); ?>', $Data, config).then(function (response) {
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
                    $scope.ItemTypeModel = response.data.result.ItemType;
                    $scope.DescriptionModel = response.data.result.Description;
                    $scope.ActiveModel = response.data.result.IsActive;
                }


            });
        };


        $scope.updateItemType = function () {
            var $Data = $.param({
                "ItemType": $scope.ItemTypeModel,
                "Description": $scope.DescriptionModel,
                "IsActive": $scope.ActiveModel,
                "ItemTypeID": $scope.ItemTypeID
            });

            $http.post('<?php echo base_url('app/update/item/type'); ?>', $Data, config).then(function (response) {
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

                            $window.location.href = '<?php echo base_url('app/item/type'); ?>';

                        }
                    });
                }

                if (response.data.status == -2) {
                    swal("The category is already exist !!", {
                        icon: "warning",
                        closeOnClickOutside: false
                    }).then((ok) => {
                        if (ok) {

                            $window.location.href = '<?php echo base_url('app/item/type'); ?>';

                        }
                    });
                }

                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        };



        //delete item type
        $scope.deleteItemType = function (ID) {
            var $Data = $.param({
                'ItemTypeID': ID
            });
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover !",
                icon: "warning",
                buttons: true,
                dangerMode: true
            }).then((willDelete) => {
                if (willDelete) {
                    $http.post('<?php echo base_url('app/delete/item/type'); ?>', $Data, config).then(function (response) {
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
                                    window.location.href = '<?php echo base_url("app/item/type"); ?>';
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