<script>
    var app = angular.module('VendorApp', []);
    app.controller('VendorAppCtrl', function ($scope, $http, $window, $filter) {
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };

        //initial valuue 
        $scope.VendorID = "";
        $scope.AddPanel = false;
        $scope.ListPanel = true;


        function showLedgerGroup() {
            var DataGroup = $.param({
                'TableName': 'ledgergroup'
            });

            $http.post('<?php echo base_url('api/v1/app/master') ?>', DataGroup, config).then(function (response) {
                $scope.ledgergroups = response.data.result;
            });
        }
        showLedgerGroup();

        function showVendors() {
            var DataVendor = $.param({
                'TableName': 'vendor'
            });

            $http.post('<?php echo base_url('api/v1/app/master') ?>', DataVendor, config).then(function (response) {

                $scope.vendors = response.data.result;

            });
        }
        showVendors();

        $scope.showAddPanel = function () {
            $scope.SaveBtn = true;
            $scope.UpdateBtn = false;
            $scope.AddPanel = true;
            $scope.ListPanel = false;
        }

        $scope.reset = function () {
            $window.location = '<?php echo base_url('app/item/vendor');?>';
        }

        //saving the test description
        $scope.saveVendor = function () {
            var DataVendor = $.param({
                "Vendor": $scope.VendorModel,
                "Address": $scope.AddressModel,
                "ContactNo": $scope.ContactNoModel,
                "CompanyID": $scope.CompanyModel,
                "LedgerGroupID": $scope.LedgerGroupModel,
                "IsActive": $scope.ActiveModel

            });

            $http.post('<?php echo base_url('app/item/vendor/save'); ?>', DataVendor, config).then(function (response) {
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

                            $window.location.href = '<?php echo base_url('app/item/vendor'); ?>';

                        }
                    });
                }

                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        };

        $scope.editVendor = function (ID) {
            $scope.SaveBtn = false;
            $scope.UpdateBtn = true;
            $scope.ListPanel = false;
            $scope.AddPanel = true;
            $scope.VendorID = ID;
            var $Data = $.param({
                "VendorID": ID
            });

            $http.post('<?php echo base_url('app/edit/vendor'); ?>', $Data, config).then(function (response) {
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
                    $scope.VendorModel = response.data.result.Vendor;
                    $scope.AddressModel = response.data.result.Address;
                    $scope.ContactNoModel = response.data.result.ContactNo;
                    $scope.CompanyModel = response.data.result.CompanyID;
                    $scope.LedgerGroupModel = response.data.result.LedgerGroupID;
                    $scope.ActiveModel = response.data.result.IsActive;

                }
            });
        };

        $scope.updateVendor = function () {
            var $Data = $.param({
                "Vendor": $scope.VendorModel,
                "Address": $scope.AddressModel,
                "ContactNo": $scope.ContactNoModel,
                "CompanyID": $scope.CompanyModel,
                "LedgerGroupID": $scope.LedgerGroupModel,
                "IsActive": $scope.ActiveModel,
                "VendorID": $scope.VendorID
            });

            $http.post('<?php echo base_url('app/update/vendor'); ?>', $Data, config).then(function (response) {
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
                            $window.location.href = '<?php echo base_url('app/item/vendor'); ?>';
                        }
                    });
                }

                if (response.data.status == -2) {
                    swal("The vendor is already exist !!", {
                        icon: "warning",
                        closeOnClickOutside: false
                    }).then((ok) => {
                        if (ok) {
                            $window.location.href = '<?php echo base_url('app/item/vendor'); ?>';
                        }
                    });
                }
                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        };

        //delete category
        $scope.deleteVendor = function (ID) {
            var $Data = $.param({
                'VendorID': ID
            });
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover !",
                icon: "warning",
                buttons: true,
                dangerMode: true
            }).then((willDelete) => {
                if (willDelete) {
                    $http.post('<?php echo base_url('app/delete/vendor'); ?>', $Data, config).then(function (response) {
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

                                    window.location.href = '<?php echo base_url("app/item/vendor"); ?>';
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