<script>
    var app = angular.module('DoctorApp', []);
    app.controller('DoctorAppCtrl', function ($scope, $http, $window, $filter) {
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };
        $scope.DoctorID = -1;
        $scope.AddPanel = false;
        $scope.ListPanel = true;
        
        

        $scope.showAddPanel = function () {
            $scope.ListPanel = false;
            $scope.AddPanel = true;
            $scope.SaveBtn = true;

        }
        
        $scope.reset = function (){
            $window.location.href = '<?php echo base_url('app/doctor'); ?>';
        }
        
        

        //fetch doctors list
        function getDept() {
            var DataDept = $.param({
                'TableName': 'department'
            });

            $http.post('<?php echo base_url('api/v1/app/master') ?>', DataDept, config).then(function (response) {

                $scope.departments = response.data.result;

            });
        }
        getDept();

        //saving the doctor
        $scope.saveDoctor = function () {
            var DataDoctor = $.param({
                "Salutation": $scope.SalutationModel,
                "FirstName": $scope.FirstNameModel,
                "LastName": $scope.LastNameModel,
                "MobileNo": $scope.MobileNoModel,
                "Email": $scope.EmailModel,
                "Designation": $scope.DesignationModel,
                "Department": $scope.DepartmentModel,
                "Specialist": $scope.SpecialistModel,
                "Qualification": $scope.QualificationModel,
                "Address": $scope.AddressModel,
                "Hospital": $scope.HospitalModel,
                "Commision": $scope.ComissionModel,
                "IsActive": $scope.ActiveModel


            });

            $http.post('<?php echo base_url('app/save/doctor'); ?>', DataDoctor, config).then(function (response) {
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

                            $window.location.href = '<?php echo base_url('app/doctor'); ?>';

                        }
                    });
                }

                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        };

        $scope.editDoctor = function (DoctorID) {
            $scope.ListPanel = false;
            $scope.AddPanel = true;
            $scope.SaveBtn = false;
            $scope.UpdateBtn = true;

            $scope.DoctorID = DoctorID;

            var DataEdit = $.param({
                "DoctorID": DoctorID
            });

            $http.post('<?php echo base_url('app/edit/doctor'); ?>', DataEdit, config).then(function (response) {
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

                    $scope.SalutationModel = response.data.result.Salutation;
                    $scope.FirstNameModel = response.data.result.FirstName;
                    $scope.LastNameModel = response.data.result.LastName;
                    $scope.MobileNoModel = response.data.result.MobileNo;
                    $scope.EmailModel = response.data.result.Email;
                    $scope.DesignationModel = response.data.result.Designation;
                    $scope.DepartmentModel = response.data.result.DepartmentID;
                    $scope.SpecialistModel = response.data.result.Specialist;
                    $scope.QualificationModel = response.data.result.Qualification;
                    $scope.AddressModel = response.data.result.Address;
                    $scope.HospitalModel = response.data.result.Hospital;
                    $scope.ComissionModel = response.data.result.Commision;
                    $scope.ActiveModel = response.data.result.IsActive;
                }


            });
        };

        $scope.updateDoctor = function () {
            var DataDoctor = $.param({
                "DoctorID" : $scope.DoctorID,
                "Salutation": $scope.SalutationModel,
                "FirstName": $scope.FirstNameModel,
                "LastName": $scope.LastNameModel,
                "MobileNo": $scope.MobileNoModel,
                "Email": $scope.EmailModel,
                "Designation": $scope.DesignationModel,
                "Department": $scope.DepartmentModel,
                "Specialist": $scope.SpecialistModel,
                "Qualification": $scope.QualificationModel,
                "Address": $scope.AddressModel,
                "Hospital": $scope.HospitalModel,
                "Commision": $scope.ComissionModel,
                "IsActive": $scope.ActiveModel


            });

            $http.post('<?php echo base_url('app/update/doctor'); ?>', DataDoctor, config).then(function (response) {
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

                            $window.location.href = '<?php echo base_url('app/doctor'); ?>';

                        }
                    });
                }



                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        };

        //delete doctor  
        $scope.deleteDoctor = function (ID) {
            var DataID = $.param({
                'DoctorID': ID
            });
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover !",
                icon: "warning",
                buttons: true,
                dangerMode: true
            }).then((willDelete) => {
                if (willDelete) {
                    $http.post('<?php echo base_url('app/delete/doctor'); ?>', DataID, config).then(function (response) {
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

                                    window.location.href = '<?php echo base_url("app/doctor"); ?>';
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