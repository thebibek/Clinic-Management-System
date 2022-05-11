<script>
    var app = angular.module('DepartmentApp', []);
    app.controller('DepartmentAppCtrl', function ($scope, $http, $window, $filter) {
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };

        //initial valuue 
        $scope.UnitID = "";
        $scope.AddPanel = false;
        $scope.ListPanel = true;

        $scope.showAddPanel = function () {
            $scope.DepartmentModel = "";
            $scope.DescriptionModel = "";
            $scope.ActiveModel = 0;
            $scope.ListPanel = false;
            $scope.AddPanel = true;
            
            $scope.UpdateBtn = false;
            $scope.actionText = "Add New";
            $scope.SaveBtn = true;
        }

        $scope.reset = function () {
            $scope.AddPanel = false;

            $scope.ListPanel = true;
        }

        //saving the test description
        $scope.saveDepartment = function () {
            var DataDepartment = $.param({
                "Department": $scope.DepartmentModel,
                "Description": $scope.DescriptionModel,
                "IsActive": $scope.ActiveModel
            });

            $http.post('<?php echo base_url('app/department/save'); ?>', DataDepartment, config).then(function (response) {
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
                            $window.location.href = '<?php echo base_url('app/department'); ?>';
                        }
                    });
                }

                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        };

        $scope.editDepartment = function (ID) {
            $scope.ListPanel = false;
            $scope.AddPanel = true;
            $scope.actionText = "Update";
            $scope.SaveBtn = false;
            $scope.UpdateBtn = true;
            $scope.DepartmentID = ID;

            var $Data = $.param({
                "DepartmentID": ID
            });

            $http.post('<?php echo base_url('app/department/edit'); ?>', $Data, config).then(function (response) {
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
                    $scope.DepartmentModel = response.data.result.Department;
                    $scope.DescriptionModel = response.data.result.Description;
                    $scope.ActiveModel = response.data.result.IsActive;
                }


            });
        };

        $scope.updateDepartment = function () {
            var $Data = $.param({
                "Department": $scope.DepartmentModel,
                "Description": $scope.DescriptionModel,
                "DepartmentID": $scope.DepartmentID,
                "IsActive": $scope.ActiveModel

            });

            $http.post('<?php echo base_url('app/department/update'); ?>', $Data, config).then(function (response) {
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
                            $window.location.href = '<?php echo base_url('app/department'); ?>';
                        }
                    });
                }

                if (response.data.status == -2) {
                    swal("The department is already exist !!", {
                        icon: "warning",
                        closeOnClickOutside: false
                    }).then((ok) => {
                        if (ok) {

                            $window.location.href = '<?php echo base_url('app/department'); ?>';

                        }
                    });
                }

                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        };

        //delete category
        $scope.deleteDepartment = function (ID) {

            var DataID = $.param({
                'DepartmentID': ID
            });
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover !",
                icon: "warning",
                buttons: true,
                dangerMode: true
            }).then((willDelete) => {
                if (willDelete) {
                    $http.post('<?php echo base_url('app/delete/department'); ?>', DataID, config).then(function (response) {
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

                                    window.location.href = '<?php echo base_url("app/department"); ?>';
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