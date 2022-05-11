<script>
    var app = angular.module('EmployeeSalarySchemeApp', []);
    app.controller('EmployeeSalarySchemeAppCtrl', function($scope, $http, $window, $filter) {
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };

        //initial valuue 
        $scope.categoryID = "";
        $scope.AddPanel = false;
        $scope.ListPanel = true;
        $scope.EmployeeID = "";

        function showDepartments() {
            var Data = $.param({
                'TableName': 'department'
            });

            $http.post('<?php echo base_url('api/v1/app/master') ?>', Data, config).then(function(response) {

                $scope.departments = response.data.result;

            });
        }

        function showDesignation() {
            var Data = $.param({
                'TableName': 'designation'
            });

            $http.post('<?php echo base_url('api/v1/app/master'); ?>', Data, config).then(function(response) {
                $scope.designations = response.data.result;
            });
        }

        function showSalaryScheme() {
            var Data = $.param({
                'TableName': 'salaryscheme'
            });

            $http.post('<?php echo base_url('api/v1/app/master'); ?>', Data, config).then(function(response) {
                if (response.data.status == 1) {
                    $scope.salaryschemes = response.data.result;
                }

                if (response.data.status == -1) {
                    console.log("No Records Found !!");
                }

            });
        }

        showDepartments();
        showDesignation();
        showSalaryScheme();

        $scope.showAddPanel = function(EmployeeID) {
            $scope.EmployeeID = EmployeeID;
            var Data = $.param({
                'EmployeeID': $scope.EmployeeID
            });

            $http.post('<?php echo base_url("app/provide/single/employee"); ?>', Data, config).then(function(response) {
                if (response.data.status == 1) {
                    $scope.SEmployeeNameModel = response.data.result.Salutation + " " + response.data.result.FirstName + " " + response.data.result.LastName;
                    $scope.SDepartmentModel = response.data.result.DepartmentID;
                    
                    $scope.SDesignationModel = response.data.result.DesignationID;
                    $scope.SEmployeeCodeModel = response.data.result.EmployeeCode;

                    if (response.data.result.EmployeeType == 1) {
                        $scope.SEmployeeTypeModel = "PERMANENT";
                    }

                    if (response.data.result.EmployeeType == 2) {
                        $scope.SEmployeeTypeModel = "CONTRACT";
                    }

                    if (response.data.result.JobType == 1) {
                        $scope.SJobTypeModel = "PERMANENT";
                    }

                    if (response.data.result.JobType == 2) {
                        $scope.SJobTypeModel = "TEMPRORARY";
                    }


                    showEmployeeSalaryScheme();
                }

                if (response.data.status == -1) {
                    swal("Network Error !! Please try again");
                }
            });



            $scope.AddPanel = true;
            $scope.ListPanel = false;


        }

        $scope.reset = function() {
            $scope.AddPanel = false;
            $scope.EditPanel = false;
            $scope.ListPanel = true;
        }

        $scope.searchEmployee = function() {
            var Data = $.param({
                "EmployeeCode": $scope.EmployeeCodeModel,
                "EmployeeName": $scope.EmployeeNameModel,
                "FatherName": $scope.FatherModel,
                "Department": $scope.DepartmentModel,
                "Designation": $scope.DesignationModel,
                "JoiningDate": $scope.JoiningDateModel,
                "BirthDate": $scope.BirthDateModel,
                "CurrentEmployee": $scope.CurrentEmployeeModel
            });

            $http.post('<?php echo base_url("app/employee/filter/result"); ?>', Data, config).then(function(response) {
                if (response.data.status === 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true

                    });
                }
                if (response.data.status === 1) {
                    $scope.employees = response.data.result;
                }
                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }



            });
        }

        function showEmployee() {


            $http.get('<?php echo base_url('app/employee/provide'); ?>').then(function(response) {
                if (response.data.status == 1) {
                    $scope.employees = response.data.result;
                }

                if (response.data.result == -1) {
                    swal('Network Error !!');
                }
            });
        }

        showEmployee();

       


        $scope.saveEmployeeSalaryScheme = function() {
            $scope.SalaryMonthYearModel = $("#SalaryMonthYear").val();
            var Data1 = $.param({
                "EmployeeID": $scope.EmployeeID,
                "SalarySchemeID": $scope.SalarySchemeModel,
                "SalaryMonth": $scope.SalaryMonthYearModel,
                "BasicSalary": $scope.BasicSalaryModel
            });

            $http.post('<?php echo base_url("app/save/employee/salary/scheme");?>',Data1,config).then(function(response){
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
                            showEmployeeSalaryScheme();
                        }
                    });
                }

                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }


            });
        }

        function showEmployeeSalaryScheme(){
            var Data2 = $.param({
                "EmployeeID" : $scope.EmployeeID
            });

            $http.post('<?php echo base_url("app/provide/employee/salary/scheme");?>',Data2,config).then(function(response){
                if (response.data.status === 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true,
                        closeOnClickOutside: false
                    }).then((ok) => {
                        if (ok) {
                            $window.location.href = '<?php echo base_url('app/add/employee/salary/scheme'); ?>';
                        }
                    });
                }

                if(response.data.status === 1){
                    $scope.employeeschemes = response.data.result;
                }
            });
        }

        $scope.deleteEmployeeScheme = function($ID){
            var $Data = $.param({
                'SalarySchemeID': $ID
            });

            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover !",
                icon: "warning",
                buttons: true,
                dangerMode: true
            }).then((willDelete) => {
                if (willDelete) {
                    $http.post('<?php echo base_url("app/delete/employee/salary/scheme");?>', $Data, config).then(function (response) {
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

                                    showEmployeeSalaryScheme();
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