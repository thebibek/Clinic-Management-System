<script>
    var app = angular.module('FillAttendanceApp', []);
    app.controller('FillAttendanceAppCtrl', function ($scope, $http, $window, $filter) {
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };

        //initial valuue 

        $scope.EmployeeID = "";
        $scope.color = "text-danger";
        $scope.AttendanceMonthModel = '<?php echo date('Y-m-d'); ?>';


        function showDepartments() {
            var Data = $.param({
                'TableName': 'department'
            });

            $http.post('<?php echo base_url('api/v1/app/master') ?>', Data, config).then(function (response) {
                $scope.departments = response.data.result;
            });
        }

        showDepartments();

        $scope.searchEmployee = function () {
            $scope.Spinner1 = true;
            $scope.empattends = "";
            $scope.AttendanceMonthModel = $("#AttendanceMonthYear").val();
            var Data = $.param({
                'Department': $scope.DepartmentModel,
                'AttendanceDate': $scope.AttendanceMonthModel
            });

            $http.post('<?php echo base_url("app/fill/department/employee/attendance"); ?>', Data, config).then(function (response) {
                if (response.data.status === 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true

                    });
                }
                if (response.data.status === 1) {
                    $scope.Spinner1 = false;
                    $scope.empattends = response.data.result;

                }
                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        }

        $scope.changeAttendance = function ($index) {

            if ($scope.employees[$index].Status == 1) {
                $scope.employees[$index].Attendance = "A";
                $scope.employees[$index].color = "text-danger";

            }

            if ($scope.employees[$index].Status == 0) {
                $scope.employees[$index].Attendance = "P";
                $scope.employees[$index].color = "text-green";

            }
        }

        $scope.saveAttendance = function () {

            $scope.AttendanceMonthModel = $("#AttendanceMonthYear").val();
            var $Data = $.param({
                'YearMonth': $scope.AttendanceMonthModel,
                'Department': $scope.DepartmentModel,
                'items': $scope.empattends
            });

            $http.post('<?php echo base_url('app/save/employee/fill/attendance'); ?>', $Data, config).then(function (response) {
                if (response.data.status == 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true

                    });
                }

                if (response.data.status === 1) {
                    swal("Records saved successfully !!", {
                        icon: "success",
                        closeOnClickOutside: false
                    }).then((ok) => {
                        if (ok) {

                            $window.location.href = '<?php echo base_url('app/employee/daily/attendance'); ?>';

                        }
                    });
                }

                if (response.data.status === -1) {
                    swal("Network Error,Pls try again");
                }
            });
        }
    });
</script>