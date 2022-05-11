<script>
    var app = angular.module('AssignLeaveApp', []);
    app.controller('AssignLeaveAppCtrl', function ($scope, $http, $window, $filter) {
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };

        //initial valuue 

        $scope.AddPanel = false;
        $scope.ListPanel = true;
        $scope.EmployeeID = "";
        $scope.ErrorPlaceHolder = "";


        function showLeaveType() {
            var $Data = $.param({
                'TableName': 'leavetype'
            });

            $http.post('<?php echo base_url('api/v1/app/master'); ?>', $Data, config).then(function (response) {
                $scope.leavetypes = response.data.result;
            });
        }


        function showDesignation() {
            var Data = $.param({
                'TableName': 'designation'
            });

            $http.post('<?php echo base_url('api/v1/app/master'); ?>', Data, config).then(function (response) {
                $scope.designations = response.data.result;
            });
        }

        function showAssignedLeave() {
            var Data = $.param({
                'TableName': 'assignedleave'
            });

            $http.post('<?php echo base_url('api/provide/assigned/leave'); ?>', Data, config).then(function (response) {
                $scope.assignedleaves = response.data.result;
            });
        }

        showDesignation();
        showLeaveType();
        showAssignedLeave();

        $scope.showAddPanel = function (EmployeeID) {
            $scope.AddPanel = true;
            $scope.ListPanel = false;
        }

        $scope.reset = function () {
            $scope.AddPanel = false;
            $scope.EditPanel = false;
            $scope.ListPanel = true;
        }

        $scope.saveAssignedLeave = function () {
            var $Data = $.param({
                'Designation': $scope.DesignationModel,
                'LeaveType': $scope.LeaveTypeModel,
                'LeaveNo': $scope.LeaveNoModel
            });

            $http.post('<?php echo base_url("app/save/assign/leave"); ?>', $Data, config).then(function (response) {
                if (response.data.status === 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true,
                        closeOnClickOutside: false
                    }).then((ok) => {
                        if (ok) {
                            $window.location.href = '<?php echo base_url('app/assign/leave'); ?>';
                        }
                    });
                }

                if (response.data.status === 1) {
                    swal("Records saved successfully !!", {
                        icon: "success",
                        closeOnClickOutside: false
                    }).then((ok) => {
                        if (ok) {

                            $window.location.href = '<?php echo base_url('app/assign/leave'); ?>';

                        }
                    });
                }

                if (response.data.status === -1) {
                    swal("Network Error Or It Is Already Exist !! Try Again ", {
                        icon: "warning",
                        closeOnClickOutside: false
                    }).then((ok) => {
                        if (ok) {

                            $window.location.href = '<?php echo base_url('app/assign/leave'); ?>';

                        }
                    });
                }


            });
        }

        $scope.searchAssignedLeave = function () {
            $scope.assignedleaves = "";
            $scope.ErrorPlaceHolder = "";
            $scope.Spinner1 = true;
            var $Data = $.param({
                'Designation': $scope.DesignationModel,
                'LeaveType': $scope.LeaveTypeModel,
            });

            $http.post('<?php echo base_url('app/search/assigned/leave'); ?>', $Data, config).then(function (response) {
                if (response.data.status === 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true,
                        closeOnClickOutside: false
                    }).then((ok) => {
                        if (ok) {
                            $window.location.href = '<?php echo base_url('app/assign/leave'); ?>';
                        }
                    });
                }

                if (response.data.status === 1) {
                    $scope.Spinner1 = false;
                    $scope.assignedleaves = response.data.result;
                }

                if (response.data.status === -1) {
                    $scope.Spinner1 = false;
                    $scope.ErrorPlaceHolder = "No Records Found";

                }
            });
        }

        $scope.deleteAssignedLeave = function (ID) {

            var $Data = $.param({
                'ID': ID
            });

            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover !",
                icon: "warning",
                buttons: true,
                dangerMode: true
            }).then((willDelete) => {
                if (willDelete) {
                    $http.post('<?php echo base_url('app/delete/assigned/leave'); ?>', $Data, config).then(function (response) {
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

                                    window.location.href = '<?php echo base_url("app/assign/leave"); ?>';
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


        }


    });
</script>