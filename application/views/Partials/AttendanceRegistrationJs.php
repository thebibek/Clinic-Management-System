<script>
    var app = angular.module('AttendanceRegdApp', []);
    app.controller('AttendanceRegdAppCtrl', function($scope, $http, $window, $filter) {
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };

    
        function showAttendanceRegistration() {
            $http.get('<?php echo base_url('app/employee/attendance/registration');?>').then(function(response){
                if(response.data.status == 1){
                    $scope.attendanceregistrations = response.data.result;

                }

                if(response.data.status == -1){
                    console.log('Records not found');
                }
            });
        }
        showAttendanceRegistration();

        $scope.showAddPanel = function() {
            $scope.AddPanel = true;
            $scope.ListPanel = false;
        }

        $scope.reset = function() {
            $scope.AddPanel = false;
            $scope.EditPanel = false;
            $scope.CategoryListPanel = true;
        }

        //saving the test description
        $scope.saveDesignation = function() {
            var Data = $.param({
                "Designation": $scope.DesignationModel,
                "Description": $scope.DescriptionModel,

            });

            $http.post('<?php echo base_url('app/employee/designation/save'); ?>', Data, config).then(function(response) {
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

                            $window.location.href = '<?php echo base_url('app/employee/designation'); ?>';

                        }
                    });
                }

                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        };

        $scope.editDesignation = function(ID) {
            $scope.ListPanel = false;
            $scope.AddPanel = true;
            $scope.DesignationID = ID;
            $scope.SaveBtn = false;
            $scope.UpdateBtn = true;

            var Data = $.param({
                "DesignationID": ID
            });

            $http.post('<?php echo base_url('app/employee/designation/edit'); ?>', Data, config).then(function(response) {
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
                    $scope.DesignationModel = response.data.result.Designation;
                    $scope.DescriptionModel = response.data.result.Description;
                }


            });
        };

        $scope.updateDesignation = function() {
            var Data = $.param({
                "Designation": $scope.DesignationModel,
                "Description": $scope.DescriptionModel,
                "DesignationID": $scope.DesignationID
            });

            $http.post('<?php echo base_url('app/employee/designation/update'); ?>', Data, config).then(function(response) {
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

                            $window.location.href = '<?php echo base_url('app/employee/designation'); ?>';

                        }
                    });
                }

                if (response.data.status == -2) {
                    swal("The designation is already exist !!", {
                        icon: "warning",
                        closeOnClickOutside: false
                    }).then((ok) => {
                        if (ok) {

                            $window.location.href = '<?php echo base_url('app/employee/designation'); ?>';

                        }
                    });
                }

                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        };

        //delete category
        $scope.deleteDesignation = function(ID) {
           
            var Data = $.param({
                'DesignationID': ID
            });
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover !",
                icon: "warning",
                buttons: true,
                dangerMode: true
            }).then((willDelete) => {
                if (willDelete) {
                    $http.post('<?php echo base_url('app/delete/designation'); ?>', Data, config).then(function(response) {
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

                                    window.location.href = '<?php echo base_url("app/employee/designation"); ?>';
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