<script>
    var app = angular.module('LeaveApplicationApp', []);
    app.controller('LeaveApplicationAppCtrl', function ($scope, $http, $window, $filter) {
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };

        //initial valuue 

        $scope.AddPanel = false;
        $scope.ListPanel = true;
        $scope.EmployeeID = "";
        $scope.DayCount = "1";
        $scope.LeaveFromModel = '<?php echo date('Y-m-d'); ?>';
        $scope.IsPaid = "";
        $scope.items = [];
        $scope.ApplicationForModel = 1;
        $scope.LeaveForModel = 1;
        $scope.LeaveToModel = '0000-00-00';
        $scope.LeaveApplicationDateModel = '<?php echo date('Y-m-d'); ?>';
        $scope.RemarkModel = "NA";
        $scope.IsSundayIncluded = "1";
        $scope.SaveBtn = true;

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

        function showLeaveType() {
            var $Data = $.param({
                'TableName': 'leavetype'
            });

            $http.post('<?php echo base_url('api/v1/app/master'); ?>', $Data, config).then(function (response) {
                $scope.leavetypes = response.data.result;
            });
        }
        
        function showEmpAssignedLeave($empId,$deptId){
            var $Data = $.param({
                'EmployeeID': $empId,
                
            });
            
            $http.post('<?php echo base_url('app/provide/assigned/employee/leave');?>',$Data,config).then(function(response){
                if(response.data.status == 1){
                    $scope.items = response.data.result;
                }
                
            });
        }

        showDepartments();
        showDesignation();
        showLeaveType();


        $scope.showAddPanel = function (EmployeeID, EmployeeCode, FirstName, LastName, DepartmentID) {
            $scope.EmployeeID = EmployeeID;
            $scope.DepartmentID = DepartmentID;
            $scope.ECodeModel = EmployeeCode;
            $scope.ENameModel = FirstName + ' ' + LastName;
            $scope.AddPanel = true;
            $scope.ListPanel = false;
            showEmpAssignedLeave(EmployeeID,DepartmentID);
        }

        $scope.reset = function () {
            $scope.AddPanel = false;
            $scope.EditPanel = false;
            $scope.ListPanel = true;
        }

        $scope.searchEmployee = function () {
            $scope.Spinner1 = true;
            $scope.employees = "";
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
                    $scope.Spinner1 = false;
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

        $scope.changeLeaveFor = function () {
            if ($scope.LeaveForModel == 1) {
                $scope.LeaveToInput = false;
                $scope.DayCount = 1;
            }

            if ($scope.LeaveForModel == 2) {
                $scope.LeaveToInput = true;
                $scope.LeaveToModel = "";
                $scope.DayCount = 0;
            }

            if ($scope.LeaveForModel == 3) {
                $scope.LeaveToInput = false;
                $scope.LeaveToModel = "0000-00-00";
                $scope.DayCount = 0.5;
            }
        }

        $scope.changeLeaveType = function () {

            $scope.LeaveType = $scope.LeaveTypeModel.LeaveType;
            $scope.LeaveTypeID = $scope.LeaveTypeModel.ID;

            var $Data = $.param({
                'LeaveTypeID': $scope.LeaveTypeModel.ID
            });

            $http.post('<?php echo base_url('app/provide/single/leave/type'); ?>', $Data, config).then(function (response) {
                if (response.data.status === 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true,
                        closeOnClickOutside: false
                    }).then((ok) => {
                        if (ok) {
                            $window.location.href = '<?php echo base_url('app/leave/application'); ?>';
                        }
                    });
                }

                if (response.data.status === 1) {
                    $scope.IsPaid = response.data.result.Status;
                }

                if (response.data.status === -1) {
                    swal("Network Error,Please Try Again", {
                        icon: "warning",
                        closeOnClickOutside: false
                    }).then((ok) => {
                        if (ok) {

                            $window.location.href = '<?php echo base_url('app/leave/application'); ?>';

                        }
                    });
                }


            });
        }

        $scope.changeLeaveToDate = function () {
            var $Data = $.param({
                'LeaveFrom': $scope.LeaveFromModel,
                'LeaveTo': $scope.LeaveToModel
            });

            $http.post('<?php echo base_url('app/provide/leave/count'); ?>', $Data, config).then(function (response) {
                if (response.data.status === 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true,
                        closeOnClickOutside: false
                    });

                    $scope.LeaveToModel = "";
                    $scope.DayCount = 0;

                }

                if (response.data.status === 1) {
                    $scope.DayCount = response.data.result;
                }
            });
        }

       

        $scope.addLeave = function () {
          
            
            var $d1 = {
                'ApplicationDate': $scope.LeaveApplicationDateModel,
                'ApplicationFor': $scope.ApplicationForModel,
                'LeaveFor': $scope.LeaveForModel,
                'LeaveFrom': $scope.LeaveFromModel,
                'LeaveTo': $scope.LeaveToModel,
                'LeaveType': $scope.LeaveType,
                'LeaveTypeID': $scope.LeaveTypeID,
                'Status': $scope.IsPaid,
                'DayCount': $scope.DayCount,
                'Remarks': $scope.RemarkModel,
                'IsSunday': $scope.IsSundayIncluded
            };
            
            

            let $index1 = $scope.items.findIndex(record => record.LeaveFrom == $d1.LeaveFrom);
            let $index2 = $scope.items.findIndex(record => record.LeaveTo == $d1.LeaveTo);

            if (typeof $scope.LeaveTypeModel === 'undefined' || $scope.LeaveTypeModel.length === 0) {
                swal("Please Select Leave Type !!");
                return false;
            }

            if ($scope.LeaveForModel == 1) {

                if ($index1 === -1) {
                    //

                } else {
                    swal("Leave date is already added");
                    return false;
                }
            }


            if ($scope.LeaveForModel == 2) {
                if (typeof $scope.LeaveToModel === 'undefined' || $scope.LeaveToModel.length === 0) {
                    swal("Please Enter Leave To Field !!");
                    return false;
                }

                if ($scope.LeaveFromModel == $scope.LeaveToModel) {
                    swal("From and To can not be equal !!");
                    return false;
                }

                if ($index1 === -1) {
                    //nothing to do

                } else {
                    swal("Leave date is already added");
                    return false;
                }

                if ($index2 === -1) {
                    //
                } else {
                    swal("Leave date is already added");
                    return false;
                }
            }

            if ($scope.LeaveForModel == 3) {
                if ($index1 === -1) {
                    //nothing to do

                } else {
                    swal("Leave date is already added");
                    return false;
                }
            }


            $scope.items.push($d1);
            $scope.SaveBtn = true;


        }

        $scope.removeItem = function (x1) {
            $scope.items.splice(x1, 1);
            if ($scope.items.length == 0) {
                $scope.SaveBtn = false;
            }
        }

        $scope.saveLeave = function () {
            var $Data = $.param({
                'EmployeeID': $scope.EmployeeID,
                'DepartmentID': $scope.DepartmentID,
                'Items': $scope.items,
            });

            $http.post('<?php echo base_url('app/save/employee/leave/taken'); ?>', $Data, config).then(function (response) {
                if (response.data.status === 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true,
                        closeOnClickOutside: false
                    });
                }

                if (response.data.status === 1) {
                    swal("Records saved successfully !!", {
                        icon: "success",
                        closeOnClickOutside: false
                    }).then((ok) => {
                        if (ok) {

                            $window.location.href = '<?php echo base_url('app/leave/application'); ?>';

                        }
                    });
                }
            });
        }

    });
</script>