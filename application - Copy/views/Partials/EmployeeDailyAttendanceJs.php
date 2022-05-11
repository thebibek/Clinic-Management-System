<script>
    var app = angular.module('EmployeeDailyAttendanceApp', []);
    app.controller('EmployeeDailyAttendanceAppCtrl', function($scope, $http, $window, $filter) {
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };

        //initial valuue 
       
        $scope.EmployeeID = "";
        $scope.color = "text-danger";
        $scope.AttendanceDateModel = '<?php echo date('Y-m-d');?>';
       

        function showDepartments() {
            var Data = $.param({
                'TableName': 'department'
            });

            $http.post('<?php echo base_url('api/v1/app/master') ?>', Data, config).then(function(response) {

                $scope.departments = response.data.result;

            });
        }

        showDepartments();

        $scope.searchEmployee = function() {
            $scope.Spinner1 = true;
            $scope.employees = "";
            var Data = $.param({
                'Department': $scope.DepartmentModel,
                'AttendanceDate':$scope.AttendanceDateModel
            });

            $http.post('<?php echo base_url("app/filter/department/employee"); ?>', Data, config).then(function(response) {
                if (response.data.status === 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true

                    });
                    $scope.Spinner1 = false; 
                }
                if (response.data.status === 1) {
                    $scope.Spinner1 = false; 
                    $scope.employees = response.data.result;
                }
                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        }

        $scope.changeAttendance = function($index){
            
            if($scope.employees[$index].Status == 1){
                $scope.employees[$index].Attendance = "A";
                $scope.employees[$index].color = "text-danger";
                
            }

            if($scope.employees[$index].Status == 0){
                $scope.employees[$index].Attendance = "P";
                $scope.employees[$index].color = "text-green";
                  
            }
        }

        $scope.saveAttendance = function(){
            var $Data = $.param({
                'AttendanceDate':$scope.AttendanceDateModel,
                'Department' : $scope.DepartmentModel,
                'items' : $scope.employees
            });

            $http.post('<?php echo base_url('app/save/employee/daily/attendance');?>',$Data,config).then(function(response){
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

                if(response.data.status === -1){    
                      swal("Network Error,Pls try again");  
                }
            });
        }
    });
</script>