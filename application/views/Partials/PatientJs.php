<script>
    var app = angular.module('RegistrationApp', []);
    
    app.directive("fileInput", function ($parse) {
        return{
            link: function ($scope, element, attrs) {
                element.on("change", function (event) {
                    var files = event.target.files;
                    $parse(attrs.fileInput).assign($scope, element[0].files);
                    $scope.$apply();
                });
            }
        }
    });
    
    
    app.controller('RegistrationAppCtrl', function ($scope, $http, $window, $filter) {
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };
        
        var $c1 = {
            transformRequest: angular.identity,
            headers: {
                'Content-Type': undefined,
                'Process-Data': false
            }
        };
        
        $scope.DoctorID = "";
        $scope.AddPanel = false;
        $scope.ListPanel = true;
        $scope.MrNoModel = "<?php echo $mrNo; ?>";
        $scope.LoaderHolder = true;
        $scope.TextHolder = false;
        $scope.ActiveModel = 0;
        $scope.ProfileModel = '<?php echo base_url("assets/uploads/default.png"); ?>';


        $scope.showAddPanel = function () {
            $scope.ListPanel = false;
            $scope.AddPanel = true;
            $scope.SaveBtn = true;

        }

        $scope.reset = function () {
            $window.location.href = '<?php echo base_url('app/patient/registration'); ?>';
        }



        //get dept
        function getDept() {
            var DataDept = $.param({
                'TableName': 'department'
            });

            $http.post('<?php echo base_url('api/v1/app/master') ?>', DataDept, config).then(function (response) {

                $scope.departments = response.data;

            });
        }
        getDept();
        
        //blood group
        function getBloodGroup(){
            var $Data = $.param({
                'TableName': 'bloodgroup'
            });
            
            $http.post('<?php echo base_url('api/v1/app/master');?>',$Data,config).then(function(response){
                $scope.bloodgroups = response.data.result;
            });
        }
        getBloodGroup();

        //supply registered patient

        function getRegisteredPatient() {
            var DataPatient = $.param({
                'TableName': 'patient'
            });

            $http.post('<?php echo base_url('api/v1/app/master'); ?>', DataPatient, config).then(function (response) {
                if (response.data.status == 1) {
                    $scope.LoaderHolder = false;
                    $scope.patients = response.data.result;

                } else {
                    $scope.TextHolder = true;
                }

            });
        }
        getRegisteredPatient();


        //calculation age according to date of birth
        $scope.getAge = function () {
            var DataBirthDate = $.param({
                'BirthDate': $scope.DateOfBirthModel
            });

            $http.post('<?php echo base_url("api/v1/app/get/year/month/day"); ?>', DataBirthDate, config).then(function (response) {
                $scope.AgeModel = response.data.Year;

            });
        };

        //saving the doctor
        $scope.savePatient = function () {
            var $formData = new FormData();
            angular.forEach($scope.files,function(file){
                $formData.append('file',file);
            });
            $formData.append('FirstName',$scope.FirstNameModel);
            $formData.append('LastName',$scope.LastNameModel);
            $formData.append('MobileNo',$scope.MobileNoModel);
            $formData.append('Email',$scope.EmailModel);
            $formData.append('BloodGroup',$scope.BloodGroupModel);
            $formData.append('Gender',$scope.GenderModel);
            $formData.append('DateOfBirth',$scope.DateOfBirthModel);
            $formData.append('Age',$scope.AgeModel);
            $formData.append('Address',$scope.AddressModel);
            $formData.append('IsActive',$scope.ActiveModel);
            
           

            $http.post('<?php echo base_url('app/save/patient'); ?>', $formData, $c1).then(function (response) {
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
                            $window.location.href = '<?php echo base_url('app/patient/registration');?>';
                        }
                    });
                }

                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        };

        $scope.editPatient = function (PatientID) {
            $scope.ListPanel = false;
            $scope.AddPanel = true;
            $scope.SaveBtn = false;
            $scope.UpdateBtn = true;

            $scope.PatientID = PatientID;

            var $Data = $.param({
                "PatientID": PatientID
            });

            $http.post('<?php echo base_url('app/edit/patient'); ?>', $Data, config).then(function (response) {
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

                    $scope.MrNoModel = response.data.result.MRNo;
                    $scope.FirstNameModel = response.data.result.FirstName;
                    $scope.LastNameModel = response.data.result.LastName;
                    $scope.MobileNoModel = response.data.result.MobileNo;
                    $scope.EmailModel = response.data.result.Email;
                    $scope.BloodGroupModel = response.data.result.BloodGroupID;
                    $scope.GenderModel = response.data.result.Gender;
                    $scope.DateOfBirthModel = response.data.result.DateOfBirth;
                    $scope.AgeModel = response.data.result.Age;
                    $scope.AddressModel = response.data.result.Address;
                    $scope.ActiveModel = response.data.result.IsActive;
                    $scope.ProfileModel = '<?php echo base_url('assets/uploads/');?>' + response.data.result.Image;

                }


            });
        };

        $scope.updatePatient = function () {
            var $formData = new FormData();
            angular.forEach($scope.files,function(file){
                $formData.append('file',file);
            });
            $formData.append('PatientID',$scope.PatientID);
            $formData.append('FirstName',$scope.FirstNameModel);
            $formData.append('LastName',$scope.LastNameModel);
            $formData.append('MobileNo',$scope.MobileNoModel);
            $formData.append('Email',$scope.EmailModel);
            $formData.append('BloodGroup',$scope.BloodGroupModel);
            $formData.append('Gender',$scope.GenderModel);
            $formData.append('DateOfBirth',$scope.DateOfBirthModel);
            $formData.append('Age',$scope.AgeModel);
            $formData.append('Address',$scope.AddressModel);
            $formData.append('IsActive',$scope.ActiveModel);
        
           

            $http.post('<?php echo base_url('app/update/patient'); ?>', $formData, $c1).then(function (response) {
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

                            $window.location.href = '<?php echo base_url('app/patient/registration'); ?>';

                        }
                    });
                }



                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        };

        //delete doctor  
        $scope.deletePatient = function (ID) {
            var $Data = $.param({
                'PatientID': ID
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

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#PatientPhoto')
                        .attr('src', e.target.result)
                        .width(150)
                        .height(150);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

</script>