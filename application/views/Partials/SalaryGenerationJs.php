<script>
    var app = angular.module('SalaryGenerationApp', []);
    app.controller('SalaryGenerationAppCtrl', function ($scope, $http, $window, $filter) {
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };

        //initial valuue 

        $scope.AddPanel = false;
        $scope.ListPanel = true;
        $scope.EmployeeID = "";
        $scope.EmployeeSalarySchemeID = "";
        $scope.TotalAllowanceModel = '0.00';
        $scope.TotalDeductionModel = '0.00';
        $scope.TotalContributionModel = '0.00';
        $scope.SlipNoModel = "";
        $scope.DaysAbsentModel = '0';
        $scope.AdvanceModel = '0.00';

        function showDepartments() {
            var Data = $.param({
                'TableName': 'department'
            });

            $http.post('<?php echo base_url('api/v1/app/master') ?>', Data, config).then(function (response) {

                $scope.departments = response.data.result;

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

        function showSalaryScheme() {
            var Data = $.param({
                'TableName': 'salaryscheme'
            });

            $http.post('<?php echo base_url('api/v1/app/master'); ?>', Data, config).then(function (response) {
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

        $scope.showAddPanel = function (EmployeeID) {
            $scope.EmployeeID = EmployeeID;
            var $Data = $.param({
                'EmployeeID': $scope.EmployeeID
            });

            $http.post('<?php echo base_url("app/provide/single/employee"); ?>', $Data, config).then(function (response) {
                if (response.data.status == 1) {
                    $scope.EmployeeNameModel = response.data.result.Salutation + " " + response.data.result.FirstName + " " + response.data.result.LastName;
                    $scope.DepartmentModel = response.data.result.DepartmentID;

                    $scope.DesignationModel = response.data.result.DesignationID;
                    $scope.EmployeeCodeModel = response.data.result.EmployeeCode;

                    $scope.FatherNameModel = response.data.result.FatherName;
                    $scope.BirthDateModel = response.data.result.DateOfBirth;
                    $scope.JoiningDateModel = response.data.result.JoiningDate;
                    $scope.EmailModel = response.data.result.Email;
                    $scope.MobileNoModel = response.data.result.PhoneNumber;
                    //$scope.PaymentModeModel = response.data.result.PaymentMode;
                    $scope.ESINoModel = response.data.result.ESINo;
                    $scope.BankAcNoModel = response.data.result.BankAccountNo;
                    $scope.BankNameModel = response.data.result.BankName;
                    $scope.PANNoModel = response.data.result.PANNo;
                    $scope.PFNoModel = response.data.result.PFNo;

                    if (response.data.result.EmployeeType == 1) {
                        $scope.EmployeeTypeModel = "PERMANENT";
                    }

                    if (response.data.result.EmployeeType == 2) {
                        $scope.EmployeeTypeModel = "CONTRACT";
                    }

                    if (response.data.result.JobType == 1) {
                        $scope.JobTypeModel = "PERMANENT";
                    }

                    if (response.data.result.JobType == 2) {
                        $scope.JobTypeModel = "TEMPRORARY";
                    }

                    provideEmployeeSalarySlip($scope.EmployeeID);
                    showEmployeeSalaryScheme();
                }

                if (response.data.status == -1) {
                    swal("Network Error !! Please try again");
                }
            });



            $scope.AddPanel = true;
            $scope.ListPanel = false;


        }

        $scope.reset = function () {
            $scope.AddPanel = false;
            $scope.EditPanel = false;
            $scope.ListPanel = true;
        }

        $scope.searchEmployee = function () {
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

            $http.post('<?php echo base_url("app/employee/filter/result"); ?>', Data, config).then(function (response) {
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


        //getting employee salary slip 
        function provideEmployeeSalarySlip(EmployeeID) {
            var $Data = $.param({
                'EmployeeID': EmployeeID
            });

            $http.post('<?php echo base_url('app/provide/employee/salary/slip'); ?>', $Data, config).then(function (response) {
                if (response.data.status === 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true,
                        closeOnClickOutside: false
                    }).then((ok) => {
                        if (ok) {
                            $window.location.href = '<?php echo base_url('app/salary/generation'); ?>';
                        }
                    });
                }

                if (response.data.status == 1) {
                    $scope.SalarySlipModel = response.data.slip;
                    $scope.SlipNoModel = response.data.SlipNo;
                }

                if (response.data.status == -1) {
                    swal("Network Error, Please Refresh Page");
                }
            });
        }




        function showEmployeeSalaryScheme() {
            var Data2 = $.param({
                "EmployeeID": $scope.EmployeeID
            });

            $http.post('<?php echo base_url("app/provide/employee/salary/scheme"); ?>', Data2, config).then(function (response) {
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

                if (response.data.status === 1) {
                    $scope.employeeschemes = response.data.result;
                }
            });
        }



        $scope.getSalaryScheme = function () {
            $scope.SalaryMonthModel = $("#SalaryMonthYear").val();
            var $Data = $.param({
                'EmployeeID': $scope.EmployeeID,
                'SalaryMonth': $scope.SalaryMonthModel
            });

            $http.post('<?php echo base_url('app/provide/employee/month/salary/scheme'); ?>', $Data, config).then(function (response) {
                if (response.data.status === 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true,
                        closeOnClickOutside: false
                    }).then((ok) => {
                        if (ok) {
                            $window.location.href = '<?php echo base_url('app/salary/generation'); ?>';
                        }
                    });
                }

                if (response.data.status === 1) {
                    $scope.SalarySchemeModel = response.data.result.SchemeName;
                    $scope.BasicSalaryModel = response.data.result.BasicSalary;
                    $scope.SalarySchemeID = response.data.result.SalarySchemeID;

                    //getting allowance
                    getAssignedSchemeAllowance($scope.SalarySchemeID);
                    getAssignedSchemeDeduction($scope.SalarySchemeID);
                    getAssignedSchemeContribution($scope.SalarySchemeID);
                    getDaysAbsent($scope.EmployeeID, $scope.SalaryMonthModel);
                    getEmpAdvance($scope.EmployeeID);
                }

                if (response.data.status === -1) {
                    swal("Network Error !! Pls try again.");
                }
            });
        }

        //getting assigned scheme allowance(Salary Allowance) 
        function getAssignedSchemeAllowance(id) {
            var $Data = $.param({
                'SalarySchemeID': id,
                'AllowanceType': 'A'
            });

            $http.post('<?php echo base_url('app/provide/assigned/scheme/allowance'); ?>', $Data, config).then(function (response) {
                if (response.data.status === 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true,
                        closeOnClickOutside: false
                    }).then((ok) => {
                        if (ok) {
                            $window.location.href = '<?php echo base_url('app/salary/generation'); ?>';
                        }
                    });
                }

                if (response.data.status === 1) {
                    $scope.assignedSchemeAllowances = response.data.rs.result;
                    $scope.TotalAllowanceModel = response.data.rs.SumAllowance;
                    
                }

                if (response.data.status === -1) {
                    $scope.ms1 = 'No Records !!';
                }

            });
        }


        function getAssignedSchemeDeduction(id) {
            var $Data = $.param({
                'SalarySchemeID': id,
                'AllowanceType': 'D'
            });

            $http.post('<?php echo base_url('app/provide/assigned/scheme/deduction'); ?>', $Data, config).then(function (response) {
                if (response.data.status === 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true,
                        closeOnClickOutside: false
                    }).then((ok) => {
                        if (ok) {
                            $window.location.href = '<?php echo base_url('app/salary/generation'); ?>';
                        }
                    });
                }

                if (response.data.status === 1) {
                    $scope.assignedSchemeDeductions = response.data.rs.result;
                    $scope.TotalDeductionModel = response.data.rs.SumDeduction;
                    //console.log($scope.assignedSchemeAllowances); 
                }

                if (response.data.status === -1) {
                    $scope.ms2 = 'No Records !!';
                }

            });
        }

        function getAssignedSchemeContribution(id) {
            var $Data = $.param({
                'SalarySchemeID': id,
                'AllowanceType': 'C'
            });

            $http.post('<?php echo base_url('app/provide/assigned/scheme/contribution'); ?>', $Data, config).then(function (response) {
                if (response.data.status === 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true,
                        closeOnClickOutside: false
                    }).then((ok) => {
                        if (ok) {
                            $window.location.href = '<?php echo base_url('app/salary/generation'); ?>';
                        }
                    });
                }

                if (response.data.status === 1) {
                    $scope.assignedSchemeContributions = response.data.rs.result;
                    $scope.TotalContributionModel = response.data.rs.SumContribution;
                    //console.log($scope.assignedSchemeAllowances); 
                }

                if (response.data.status === -1) {
                    $scope.ms3 = 'No Records !!';
                }
            });
        }

        function getDaysAbsent($empId, $salaryMonth) {
            var $Data = $.param({
                'EmployeeID': $empId,
                'SalaryMonth': $salaryMonth
            });

            $http.post('<?php echo base_url('provide/employee/absent/days'); ?>', $Data, config).then(function (response) {
                if (response.data.status === 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true,
                        closeOnClickOutside: false
                    }).then((ok) => {
                        if (ok) {
                            $window.location.href = '<?php echo base_url('app/salary/generation'); ?>';
                        }
                    });
                }

                if (response.data.status === 1) {
                    $scope.DaysAbsentModel = response.data.result;

                }

                if (response.data.status === -1) {
                    $scope.ms4 = 'No Records !!';
                }
            });
        }

        function getEmpAdvance($empId) {
            var $Data = $.param({
                'EmployeeID': $empId
            });

            $http.post('<?php echo base_url('provide/advance/taken'); ?>', $Data, config).then(function (response) {
                if (response.data.status === 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true,
                        closeOnClickOutside: false
                    }).then((ok) => {
                        if (ok) {
                            $window.location.href = '<?php echo base_url('app/salary/generation'); ?>';
                        }
                    });
                }

                if (response.data.status === 1) {
                    $scope.AdvanceModel = response.data.result.AdvanceBalance;

                }

                if (response.data.status === -1) {
                    $scope.ms4 = 'No Records !!';
                }
            });
        }

        $scope.changeAllowance = function () {
            var $total = 0.00;

            angular.forEach($scope.assignedSchemeAllowances, function (key, value) {
                if (key.Allowance.length === 0) {
                    key.Allowance = 0.00;
                }

                $total += parseFloat(key.Allowance);

            });

            $total = $total.toFixed(2);
            $scope.TotalAllowanceModel = $total;

        }

        $scope.changeContribution = function () {
            var $total = 0.00;


            angular.forEach($scope.assignedSchemeContributions, function (key, value) {
                if (key.Contribution.length === 0) {
                    key.Contribution = 0.00;
                }
                $total += parseFloat(key.Contribution);
            });
            $total = $total.toFixed(2);
            $scope.TotalContributionModel = $total;
        }

        $scope.changeDeduction = function () {
            var $total = 0.00;

            angular.forEach($scope.assignedSchemeDeductions, function (key, value) {
                if (key.Deduction.length === 0) {
                    key.Deduction = 0.00;
                }
                $total += parseFloat(key.Deduction);
            });

            $total = $total.toFixed(2);
            $scope.TotalDeductionModel = $total;
        }

        $scope.saveSalary = function () {
            var $Data = $.param({
                'EmployeeID': $scope.EmployeeID,
                'SlipSerialNo': $scope.SlipNoModel,
                'SlipNo': $scope.SalarySlipModel,
                'SalaryGeneratedDate': $scope.SalaryDateModel,
                'SalaryMonth': $scope.SalaryMonthModel,
                'Attendance': 0,
                'BasicSalary': $scope.BasicSalaryModel,
                'TotalAllowance': $scope.TotalAllowanceModel,
                'TotalDeduction': $scope.TotalDeductionModel,
                'TotalContribution': $scope.TotalContributionModel,
                'AbsentDays': $scope.DaysAbsentModel,
                'AdvanceAmt': $scope.AdvanceModel
            });

            $http.post('<?php echo base_url('app/save/employee/salary'); ?>', $Data, config).then(function (response) {
                if (response.data.status === 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true,
                        closeOnClickOutside: false
                    }).then((ok) => {
                        if (ok) {
                            $window.location.href = '<?php echo base_url('app/salary/generation'); ?>';
                        }
                    });
                }

                if (response.data.status === -2) {
                    swal("Net salary can not be 0 !!", {
                        icon: "success",
                        closeOnClickOutside: false
                    }).then((ok) => {
                        if (ok) {

                            $window.location.href = '<?php echo base_url('app/salary/generation'); ?>';

                        }
                    });
                }

                if (response.data.status === 1) {
                    swal("Records saved successfully !!", {
                        icon: "success",
                        closeOnClickOutside: false
                    }).then((ok) => {
                        if (ok) {

                            $window.location.href = '<?php echo base_url('app/salary/generation'); ?>';

                        }
                    });
                }

                if (response.data.status === -1) {
                    swal("Network Error, Or The salary is already generated for the month !!", {
                        icon: "warning",
                        closeOnClickOutside: false
                    }).then((ok) => {
                        if (ok) {

                            $window.location.href = '<?php echo base_url('app/salary/generation'); ?>';

                        }
                    });
                }
            });
        }
    });
</script>