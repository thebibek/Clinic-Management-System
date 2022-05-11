<script>
    var app = angular.module('EmployeeRegistrationApp', []);

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

    app.controller('EmployeeRegistrationCtrl', function ($scope, $http, $window, $filter) {
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
        $scope.MrNoModel = "";
        $scope.LoaderHolder = true;
        $scope.TextHolder = false;

        $scope.showAddPanel = function () {
            $scope.ListPanel = false;
            $scope.AddPanel = true;
            $scope.SaveBtn = true;

        }

        $scope.reset = function () {
            $window.location.href = '<?php echo base_url('app/patient/registration'); ?>';
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

        function showDesignation() {
            var Data = $.param({
                'TableName': 'designation'
            });

            $http.post('<?php echo base_url('api/v1/app/master') ?>', Data, config).then(function (response) {

                $scope.designations = response.data.result;

            });
        }
        showDesignation();

        function showBloodGroup() {
            var $Data = $.param({
                'TableName': 'bloodgroup'
            });

            $http.post('<?php echo base_url('api/v1/app/master') ?>', $Data, config).then(function (response) {

                $scope.bloodgroups = response.data.result;

            });
        }
        showBloodGroup();
        
        function showNationality() {
            var $Data = $.param({
                'TableName': 'nationality'
            });

            $http.post('<?php echo base_url('api/v1/app/master') ?>', $Data, config).then(function (response) {

                $scope.nationalities = response.data.result;

            });
        }
        showNationality();


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

        $scope.getExperience = function () {
            var Data = $.param({
                "FromYear": $scope.ExFromYearModel,
                "ToYear": $scope.ExToYearModel
            });

            $http.post('<?php echo base_url("app/employee/experience/years"); ?>', Data, config).then(function (response) {
                $scope.WorkExperienceModel = response.data;
            });
        }

        //saving the employee
        $scope.saveEmployee = function () {

            var $formData = new FormData();
            angular.forEach($scope.files, function (file) {
                $formData.append('file', file);
            });

            $formData.append('ResumeNo', $scope.ResumeNoModel);
            $formData.append('EmployeeCode', $scope.EmployeeCodeModel);
            $formData.append('Salutation', $scope.SalutationModel);
            $formData.append('FirstName', $scope.FirstNameModel);
            $formData.append('LastName', $scope.LastNameModel);
            $formData.append('ShortName', $scope.ShortNameModel);
            $formData.append('DateOfBirth', $scope.DateOfBirthModel);
            $formData.append('FatherName', $scope.FatherNameModel);
            $formData.append('MotherName', $scope.MotherNameModel);
            $formData.append('JobType', $scope.JobTypeModel);
            $formData.append('Department', $scope.DepartmentModel);
            $formData.append('Designation', $scope.DesignationModel);
            $formData.append('EmployeeType', $scope.EmployeeTypeModel);
            $formData.append('JoiningDate', $scope.JoiningDateModel);
            $formData.append('Gender', $scope.GenderModel);
            $formData.append('MaritalStatus', $scope.MaritalStatusModel);
            $formData.append('BankAccountNo', $scope.BankAccountModel);
            $formData.append('BankName', $scope.BankNameModel);
            $formData.append('ESINo', $scope.ESINoModel);
            $formData.append('PFNo', $scope.PFNoModel);
            $formData.append('PANNo', $scope.PANNoModel);
            $formData.append('Nationality', $scope.NationalityModel);
            $formData.append('BloodGroup', $scope.BloodGroupModel);
            $formData.append('CurrentEmployee', $scope.IsCurrentEmployeeModel);
            $formData.append('Address', $scope.AddressModel);
            $formData.append('StateOrProvince', $scope.StateProvinceModel);
            $formData.append('City', $scope.CityModel);
            $formData.append('PinOrZip', $scope.PinzipModel);
            $formData.append('PhoneNumber', $scope.PhoneNumberModel);
            $formData.append('Email', $scope.EmailModel);
            $formData.append('PrevClinicName', $scope.ClinicModel);
            $formData.append('JobNature', $scope.JobNatureModel);
            $formData.append('PrevClinicAddress', $scope.ExAddressModel);
            $formData.append('PrevPhoneNo', $scope.ExPhoneNoModel);
            $formData.append('FromYear', $scope.ExFromYearModel);
            $formData.append('ToYear', $scope.ExToYearModel);
            $formData.append('Experience', $scope.WorkExperienceModel);
            $formData.append('Salary', $scope.SalaryModel);
            $formData.append('PrevDepartment', $scope.ExDepartmentModel);
            $formData.append('PreDesignation', $scope.ExDesignationModel);
            $formData.append('JobProfile', $scope.JobProfileModel);
            $formData.append('HighestQualification', $scope.QualificationModel);
            $formData.append('University', $scope.UniversityModel);
            $formData.append('YearOfPassing', $scope.PassingYearModel);
            $formData.append('GradeOrPercentage', $scope.GradeModel);
            $formData.append('Subject', $scope.SubjectModel);
            $formData.append('Specialization', $scope.SpecializationModel);
            $formData.append('Remarks', $scope.RemarksModel);



            $http.post('<?php echo base_url('app/save/employee'); ?>', $formData, $c1).then(function (response) {
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
                            $window.location.href = '<?php echo base_url('app/employee/search'); ?>';
                        }
                    });
                }

                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
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