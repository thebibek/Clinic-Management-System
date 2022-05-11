<script>
    var app = angular.module('EmployeeManagerApp', []);

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

    app.controller('EmployeeManagerAppCtrl', function ($scope, $http, $window, $filter) {
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



        //initial valuue 
        $scope.categoryID = "";
        $scope.EditPanel = false;
        $scope.ListPanel = true;
        $scope.Spinner1 = false;
        $scope.ProfileModel = '<?php echo base_url("assets/img/default.png"); ?>';

        function showDepartments() {
            var Data = $.param({
                'TableName': 'department'
            });
            $http.post('<?php echo base_url('api/v1/app/master') ?>', Data, config).then(function (response) {
                $scope.departments = response.data.result;
            });
        }

        function showEmployees() {
            $scope.employees = "";
            $scope.Spinner1 = true;
            var $Data = $.param({
                'TableName': 'employee'
            });
            $http.post('<?php echo base_url('app/employee/provide') ?>', $Data, config).then(function (response) {
                $scope.employees = response.data.result;
                $scope.Spinner1 = false;
            });
        }

        function showDesignation() {
            var Data = $.param({
                'TableName': 'designation'
            });

            $http.post('<?php echo base_url('api/v1/app/master') ?>', Data, config).then(function (response) {
                $scope.designations = response.data.result;
            });
        }

        function showBloodGroup() {
            var $Data = $.param({
                'TableName': 'bloodgroup'
            });

            $http.post('<?php echo base_url('api/v1/app/master') ?>', $Data, config).then(function (response) {

                $scope.bloodgroups = response.data.result;

            });
        }

        function showNationality() {
            var $Data = $.param({
                'TableName': 'nationality'
            });

            $http.post('<?php echo base_url('api/v1/app/master') ?>', $Data, config).then(function (response) {

                $scope.nationalities = response.data.result;

            });
        }
        

        showNationality();
        showBloodGroup();
        showDepartments();
        showEmployees();
        showDesignation();



        $scope.reset = function () {
            $scope.AddPanel = false;
            $scope.EditPanel = false;
            $scope.ListPanel = true;
        }

        $scope.searchEmployee = function () {
            $scope.employees = "";
            $scope.Spinner1 = true;
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
                    $scope.Spinner1 = false;

                }
                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }



            });
        }

        //saving the test description
        $scope.saveItem = function () {
            var DataItem = $.param({
                "ItemType": $scope.ItemTypeModel,
                "ItemName": $scope.ItemNameModel,
                "Description": $scope.DescriptionModel,
                "OpeningBalance": $scope.OpeningModelModel,
                "ItemRate": $scope.RateModel,
                "IsActive": $scope.ActiveModel

            });

            $http.post('<?php echo base_url('app/item/save'); ?>', DataItem, config).then(function (response) {
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

                            $window.location.href = '<?php echo base_url('app/item/master'); ?>';

                        }
                    });
                }

                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        };

        $scope.editEmployee = function (ID) {
            $scope.ListPanel = false;
            $scope.EditPanel = true;
            $scope.EmployeeID = ID;

            var $Data = $.param({
                "EmployeeID": ID
            });

            $http.post('<?php echo base_url('app/provide/single/employee'); ?>', $Data, config).then(function (response) {
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
                    $scope.ResumeNoModel = response.data.result.ResumeNo;
                    $scope.EmployeeCodeModel = response.data.result.EmployeeCode;
                    $scope.SalutationModel = response.data.result.Salutation;
                    $scope.FirstNameModel = response.data.result.FirstName;
                    $scope.LastNameModel = response.data.result.LastName;
                    $scope.ShortNameModel = response.data.result.ShortName;
                    $scope.DateOfBirthModel = response.data.result.DateOfBirth;
                    $scope.FatherNameModel = response.data.result.FatherName;
                    $scope.MotherNameModel = response.data.result.MotherName;
                    $scope.JobTypeModel = response.data.result.JobType;
                    $scope.DepartmentModel = response.data.result.DepartmentID;
                    $scope.DesignationModel = response.data.result.DesignationID;
                    $scope.EmployeeTypeModel = response.data.result.EmployeeType;
                    $scope.JoiningDateModel = response.data.result.JoiningDate;
                    $scope.GenderModel = response.data.result.Gender;
                    $scope.MaritalStatusModel = response.data.result.MaritalStatus;
                    $scope.BankAccountModel = response.data.result.BankAccountNo;
                    $scope.BankNameModel = response.data.result.BankName;
                    $scope.ESINoModel = response.data.result.ESINo;
                    $scope.PFNoModel = response.data.result.PFNo;
                    $scope.PANNoModel = response.data.result.PANNo;
                    $scope.NationalityModel = response.data.result.Nationality;
                    $scope.BloodGroupModel = response.data.result.BloodGroupID;
                    $scope.IsCurrentEmployeeModel = response.data.result.CurrentEmployee;
                    $scope.AddressModel = response.data.result.Address;
                    $scope.StateProvinceModel = response.data.result.StateOrProvince;
                    $scope.CityModel = response.data.result.City;
                    $scope.PinzipModel = response.data.result.PinOrZip;
                    $scope.PhoneNumberModel = response.data.result.PhoneNumber;
                    $scope.EmailModel = response.data.result.Email;
                    $scope.ClinicModel = response.data.result.PrevClinicName;
                    $scope.JobNatureModel = response.data.result.JobNature;
                    $scope.ExAddressModel = response.data.result.PrevClinicAddress;
                    $scope.ExPhoneNoModel = response.data.result.PrevPhoneNo;
                    $scope.ExFromYearModel = response.data.result.FromYear;
                    $scope.ExToYearModel = response.data.result.ToYear;
                    $scope.WorkExperienceModel = response.data.result.Experience;
                    $scope.SalaryModel = response.data.result.Salary;
                    $scope.ExDepartmentModel = response.data.result.PrevDepartment;
                    $scope.ExDesignationModel = response.data.result.PreDesignation;
                    $scope.JobProfileModel = response.data.result.JobProfile;
                    $scope.QualificationModel = response.data.result.HighestQualification;
                    $scope.UniversityModel = response.data.result.University;
                    $scope.PassingYearModel = response.data.result.YearOfPassing;
                    $scope.GradeModel = response.data.result.GradeOrPercentage;
                    $scope.SubjectModel = response.data.result.Subject;
                    $scope.SpecializationModel = response.data.result.Specialization;
                    $scope.RemarksModel = response.data.result.Remarks;
                    $scope.ProfileModel = '<?php echo base_url('assets/uploads/') ?>' + response.data.result.ProfileUrl
                }


            });
        };

        $scope.updateEmployee = function () {
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
            $formData.append('EmployeeID', $scope.EmployeeID);




            $http.post('<?php echo base_url('app/update/employee'); ?>', $formData, $c1).then(function (response) {
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

                            $window.location.href = '<?php echo base_url('app/employee/search'); ?>';

                        }
                    });
                }

                if (response.data.status == -2) {
                    swal("The category is already exist !!", {
                        icon: "warning",
                        closeOnClickOutside: false
                    }).then((ok) => {
                        if (ok) {

                            $window.location.href = '<?php echo base_url('app/category'); ?>';

                        }
                    });
                }

                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        };

        //delete category
        $scope.deleteEmployee = function (ID) {

            var $Data = $.param({
                'EmployeeID': ID
            });
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover !",
                icon: "warning",
                buttons: true,
                dangerMode: true
            }).then((willDelete) => {
                if (willDelete) {
                    $http.post('<?php echo base_url('app/delete/employee'); ?>', $Data, config).then(function (response) {
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

                                    window.location.href = '<?php echo base_url("app/category"); ?>';
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