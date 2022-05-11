<script>
    var app = angular.module('SettingsApp', []);

    app.directive("fileInput", function ($parse) {
        return{
            link: function ($scope, element, attrs) {
                element.on("change", function (event) {
                    var files = event.target.files;
                    $parse(attrs.fileInput).assign($scope,element[0].files);
                    $scope.$apply();
                });
            }
        }
    });



    app.controller('SettingsAppCtrl', function ($scope, $http, $window, $filter) {
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

        $scope.SlipCurrentYearModel = "$YYYY$";
        $scope.CurrentYearModel = "0000";
        $scope.SlipStartingNoModel = "$##$";
        $scope.SlipTextModel = "HR";
        $scope.SalarySlipNoModel = $scope.SlipTextModel + "/" + $scope.SlipCurrentYearModel + "/" + $scope.SlipStartingNoModel;
        $scope.SelectSlipModel = 1;
        //get settings 
        var DataSettings = $.param({
            "TableName": "settings"
        });


        $http.post("<?php echo base_url("api/v1/app/master"); ?>", DataSettings, config).then(function (response) {

            $scope.LabNameModel = response.data.result[0].LabName;
            $scope.AddressModel = response.data.result[0].Address;
            $scope.PhoneNo1Model = response.data.result[0].PhoneNo1;
            $scope.PhoneNo2Model = response.data.result[0].PhoneNo2;
            $scope.TagLineModel = response.data.result[0].TagLine;
            $scope.EmailModel = response.data.result[0].Email;
            $scope.WebsiteModel = response.data.result[0].Website;
            $scope.RegdNoModel = response.data.result[0].RegdNo;
            $scope.LabNoModel = response.data.result[0].LabNo;
            $scope.LogoModel = response.data.result[0].LogoUrl;
            $scope.TechnicianNameModel = response.data.result[0].TechnicianName;
            $scope.TechnicianQualifiationModel = response.data.result[0].TechnicianQualification;
            $scope.CurrencyModel = response.data.result[0].Currency;
            $scope.IsPrintHeaderModel = response.data.result[0].IsPrintReportHeader;
            $scope.FooterNote1Model = response.data.result[0].FooterNote1;
            $scope.FooterNote2Model = response.data.result[0].FooterNote2;
            $scope.FooterNote3Model = response.data.result[0].FooterNote3;
        });

        //saving the doctor
        $scope.saveSettings = function () {
            var $formData = new FormData();
            angular.forEach($scope.files, function (file) {
                $formData.append('file', file);
            });
            $formData.append('LabName', $scope.LabNameModel);
            $formData.append('Address', $scope.AddressModel);
            $formData.append('PhoneNo1', $scope.PhoneNo1Model);
            $formData.append('PhoneNo2', $scope.PhoneNo2Model);
            $formData.append('TagLine', $scope.TagLineModel);
            $formData.append('Email', $scope.EmailModel);
            $formData.append('Website', $scope.WebsiteModel);
            $formData.append('RegdNo', $scope.RegdNoModel);
            $formData.append('LabNo', $scope.LabNoModel);
            $formData.append('TechnicianName', $scope.TechnicianNameModel);
            $formData.append('TechnicianQualifiation', $scope.TechnicianQualifiationModel);
            $formData.append('IsPrintHeader', $scope.IsPrintHeaderModel);
            $formData.append('Currency', $scope.CurrencyModel);
            $formData.append('DateFormat', $scope.DateFormatModel);
            $formData.append('FooterNote1', $scope.FooterNote1Model);
            $formData.append('FooterNote2', $scope.FooterNote2Model);
            $formData.append('FooterNote3', $scope.FooterNote3Model);



            $http.post('<?php echo base_url('app/settings/save'); ?>', $formData, $c1).then(function (response) {
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

                            $window.location.href = '<?php echo base_url('app/settings'); ?>';
                        }
                    });
                }

                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        };



        //add text to salary slip format
        $scope.slipAddText = function () {
            if (typeof $scope.SlipTextModel === 'undefined' || $scope.SlipTextModel.length === "") {
                swal("Please Enter Text !!");
                return false;
            }


            if (alpha($scope.SlipTextModel)) {
                $scope.SalarySlipNoModel = $scope.SlipTextModel;
            } else {
                swal("Only Alphabets Allow !!");
                return false
            }
        }

        $scope.addSlipCurrentYear = function () {
            $scope.SalarySlipNoModel = $scope.SalarySlipNoModel + "/" + $scope.SlipCurrentYearModel
            $scope.CurrentYearModel = '<?php echo date('Y'); ?>';
        }

        $scope.addSlipStartingNumber = function () {
            if (typeof $scope.SlipStartingNoModel === 'undefined' || $scope.SlipStartingNoModel.length === 0) {
                swal("Please Enter Starting Number !!");
                return false;
            }

            if (numeric($scope.SlipStartingNoModel)) {
                $scope.SalarySlipNoModel = $scope.SalarySlipNoModel + "/$##$";
            } else {
                swal("Please Enter Numeric Value !!");
                return false;
            }
        }

        $scope.saveGlobalSetting = function () {
            var $Data = $.param({
                "SalarySlipType": $scope.SelectSlipModel,
                "SalarySlipText": $scope.SlipTextModel,
                "SalarySlipCurrentYear": $scope.CurrentYearModel,
                "SalarySlipStartingNum": $scope.SlipStartingNoModel
            });

            $http.post('<?php echo base_url('app/save/global/setting'); ?>', $Data, config).then(function (response) {
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

                            $window.location.href = '<?php echo base_url('app/settings'); ?>';
                        }
                    });
                }



                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        }

        $scope.editDoctor = function (ID) {
            $scope.AddPanel = false;
            $scope.EditPanel = true;
            $scope.DoctorID = ID;
            var DataEdit = $.param({
                "DoctorID": ID
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
                    $scope.DoctorModel = response.data.result.DoctorName;
                    $scope.MobileNoModel = response.data.result.MobileNo;
                    $scope.HospitalModel = response.data.result.Hospital;
                }


            });
        };
        $scope.updateDoctor = function () {
            var DataDoctor = $.param({
                "DoctorName": $scope.DoctorModel,
                "MobileNo": $scope.MobileNoModel,
                "Hospital": $scope.HospitalModel,
                "DoctorID": $scope.DoctorID
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
        //delete group name 
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