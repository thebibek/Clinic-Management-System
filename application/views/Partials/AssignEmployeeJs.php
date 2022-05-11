<script>
    var app = angular.module('AssignEmployeeApp', []);
    app.controller('AssignEmployeeAppCtrl', function ($scope, $http, $window, $filter) {
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };

        //initial value
        $scope.AddPanel = false;
        $scope.ListPanel = true;
        $scope.EmployeeID = "";
        $scope.TotalLeaveModel = "00";

        //scheme formulaes or amount
        $scope.items = [];

        $scope.showAddPanel = function () {
            $scope.ListPanel = false;
            $scope.AddPanel = true;
            $scope.SaveBtn = true;

        }

        function showEmployee() {
            $http.get('<?php echo base_url('app/employee/provide'); ?>').then(function (response) {
                if (response.data.status == 1) {
                    $scope.employees = response.data.result;
                }

                if (response.data.result == -1) {
                    swal('Network Error !!');
                }
            });
        }

        showEmployee();

        $scope.assignLeave = function (EmployeeID) {
            $scope.EmployeeID = EmployeeID;
            var $Data = $.param({
                'EmployeeID': EmployeeID
            });

            $http.post('<?php echo base_url('app/provide/employee/leaves'); ?>', $Data, config).then(function (response) {
                if (response.data.status === 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true

                    });
                }

                if (response.data.status === 1) {
                    $scope.leaves = response.data.result;
                    $scope.TotalLeaveModel = response.data.TotalLeave;
                }
            });
        }

        $scope.saveEmployeeLeaves = function () {
            var $Data = $.param({
                'EmployeeID': $scope.EmployeeID,
                'items': $scope.leaves
            });

            $http.post('<?php echo base_url('app/save/employee/leaves'); ?>', $Data, config).then(function (response) {
                if (response.data.status === 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true

                    });
                }

                if (response.data.status == 1) {
                    swal("Record Saved Successfully !!", {
                        icon: "success",
                        closeOnClickOutside: false
                    }).then((ok) => {
                        if (ok) {

                            window.location.href = '<?php echo base_url("app/assign/employee/leave"); ?>';
                        }
                    });
                }

                if (response.data.status == -1) {
                    swal('Network Error,please try again.');
                }


            });
        }

        $scope.totalLeave = function () {
            var $total = 0;
            angular.forEach($scope.leaves, function (key, value) {
                if (key.NoOfLeave.length === 0) {
                    key.NoOfLeave = 0;
                }
                $total += parseInt(key.NoOfLeave);
            });
            return $total;
        }

        $scope.calTotalLeave = function () {
            $scope.TotalLeaveModel = $scope.totalLeave();
        }

    });
</script>