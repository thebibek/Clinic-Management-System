<script>
    var app = angular.module('CategoryApp', []);
    app.controller('CategoryAppCtrl', function ($scope, $http, $window, $filter) {
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };

        //initial valuue 
        $scope.categoryID = "";
        $scope.AddPanel = false;
        $scope.CategoryListPanel = true;
        function showCategory() {
            var DataCategory = $.param({
                'TableName': 'category'
            });

            $http.post('<?php echo base_url('api/v1/app/master') ?>', DataCategory, config).then(function (response) {

                $scope.categories = response.data;

            });
        }
        showCategory();

        $scope.showAddPanel = function () {
            $scope.CategoryModel = "";
            $scope.ShortNameModel = "";
            $scope.AddPanel = true;
            $scope.CategoryListPanel = false;
        }

        $scope.reset = function () {
            $scope.AddPanel = false;
            $scope.EditPanel = false;
            $scope.CategoryListPanel = true;
        }

        //saving the test description
        $scope.saveCategory = function () {
            var DataCategory = $.param({
                "Category": $scope.CategoryModel,
                "ShortName": $scope.ShortNameModel

            });

            $http.post('<?php echo base_url('app/category/save'); ?>', DataCategory, config).then(function (response) {
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

                            $window.location.href = '<?php echo base_url('app/category'); ?>';

                        }
                    });
                }

                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        };

        $scope.editCategory = function (ID) {
            $scope.CategoryListPanel = false;
            $scope.AddPanel = false;
            $scope.EditPanel = true;
            $scope.categoryID = ID;

            var DataEdit = $.param({
                "CategoryID": ID
            });

            $http.post('<?php echo base_url('app/category/edit'); ?>', DataEdit, config).then(function (response) {
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
                    $scope.CategoryModel = response.data.result.Category;
                    $scope.ShortNameModel = response.data.result.ShortName;
                }


            });
        };

        $scope.updateCategory = function () {
            var DataCategory = $.param({
                "Category": $scope.CategoryModel,
                "ShortName": $scope.ShortNameModel,
                "CategoryID": $scope.categoryID
            });

            $http.post('<?php echo base_url('app/category/update'); ?>', DataCategory, config).then(function (response) {
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

                            $window.location.href = '<?php echo base_url('app/category'); ?>';

                        }
                    });
                }

                if (response.data.status == -2) {
                    swal("The category is already exist !!", {
                        icon: "warning",
                        closeOnClickOutside: false
                    }).then((ok) => {
                        if (ok) {

                            $window.location.href = '<?php echo base_url('app/category'); ?>';

                        }
                    });
                }

                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        };

        //delete category
        $scope.deleteCategory = function (ID) {
            var DataID = $.param({
                'CategoryID': ID
            });
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover !",
                icon: "warning",
                buttons: true,
                dangerMode: true
            }).then((willDelete) => {
                if (willDelete) {
                    $http.post('<?php echo base_url('app/delete/category'); ?>', DataID, config).then(function (response) {
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

                                    window.location.href = '<?php echo base_url("app/category"); ?>';
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