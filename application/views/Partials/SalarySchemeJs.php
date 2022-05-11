<script>
    var app = angular.module('SalarySchemeApp', []);
    app.controller('SalarySchemeAppCtrl', function ($scope, $http, $window, $filter) {
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };

        //initial value
        $scope.AddPanel = false;
        $scope.ListPanel = true;
        $scope.LoaderHolder = true;
        $scope.TextHolder = false;
        $scope.FormulaModel = "";
        $scope.BasedOnModel = "1";
        $scope.FormulaPanel = true;
        $scope.ListPanel = true;
        $scope.SchemeID = "";




        //scheme formulaes or amount
        $scope.items = [];




        $scope.showAddPanel = function () {
            $scope.ListPanel = false;
            $scope.AddPanel = true;
            $scope.SaveBtn = true;
            $scope.UpdateBtn = false;

        }

        $scope.reset = function () {
            $window.location.href = "<?php echo base_url('app/employee/salary/scheme'); ?>";
        }

        function getSalaryScheme() {
            $http.get('<?php echo base_url('app/salary/scheme/provide'); ?>').then(function (response) {
                if (response.data.status == 1) {
                    $scope.salaryschemes = response.data.result;
                }

                if (response.data.status == -1) {
                    swal("Network Error !");
                }
            });
        }
        getSalaryScheme();

        function getAllowances() {
            $http.get('<?php echo base_url('app/salary/allowances'); ?>').then(function (response) {
                if (response.data.status == -1) {
                    console.log('Records not found');
                } else {
                    $scope.allowances = response.data.result;
                }
            });
        }
        getAllowances();

        $scope.saveAllowance = function () {
            var Data = $.param({
                "Allowance": $scope.AllowanceModel,
                "Name": $scope.AllowanceNameModel,
                "Code": $scope.AllowanceCodeModel
            });

            $http.post('<?php echo base_url("app/salary/allowance/save"); ?>', Data, config).then(function (response) {
                if (response.data.status === 0) {
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

                            $window.location.href = '<?php echo base_url('app/employee/salary/scheme'); ?>';

                        }
                    });
                }

                if (response.data.status == -1) {
                    swal("Entry already exist !!");
                }


            });
        }



        $scope.getAllowanceName = function () {
            var Data = $.param({
                'AllowanceType': $scope.SchemeAllowanceModel
            });

            $http.post('<?php echo base_url('app/allowance/name'); ?>', Data, config).then(function (response) {
                if (response.data.status == 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true

                    });
                }

                if (response.data.status == 1) {
                    $scope.allowancesnames = response.data.result;
                }


            });
        }

        $scope.addBasicSalary = function () {
            $scope.FormulaModel = $scope.FormulaModel + $scope.BasicSalaryModel;
            $scope.BS = 'BS';
        }

        $scope.addOperator = function () {
            $scope.FormulaModel = $scope.FormulaModel + $scope.OperatorModel;
            $scope.Symbol = $scope.OperatorModel;
        }

        $scope.addValue = function () {
            $scope.FormulaModel = $scope.FormulaModel + $scope.FormulaValueModel;
            $scope.Value = $scope.FormulaValueModel;
        }

        $scope.removeFormula = function () {
            $scope.FormulaModel = "";
        }

        $scope.changeBasedUpon = function () {
            var $base = $scope.BasedOnModel;

            if ($base == 1) {
                $scope.AmountPanel = false;
                $scope.FormulaPanel = true;
            }

            if ($base == 2) {
                $scope.FormulaPanel = false;
                $scope.AmountPanel = true;
            }
        }

        $scope.addSchemeAmount = function () {
            if (typeof $scope.SchemeAllowanceModel === 'undefined' || $scope.SchemeAllowanceModel.length === 0) {
                swal("Please select Allowance/Deduction");
                return false;
            }

            if (typeof $scope.SchemeAllowanceNameModel === 'undefined' || $scope.SchemeAllowanceNameModel.length === 0) {
                swal("Please select Allowance Name");
                return false;
            }

            if (typeof $scope.AmountModel === 'undefined' || $scope.AmountModel.length === 0) {
                swal("Please Provide Amount");
                return false;
            }

            var d1 = {
                'AllowanceID': $scope.SchemeAllowanceNameModel.ID,
                'AllowanceName': $scope.SchemeAllowanceNameModel.Name,
                'AllowanceType': $scope.SchemeAllowanceModel,
                'SchemeBasedOn': $scope.BasedOnModel,
                'Amount': $scope.AmountModel,
                'Formula': 'NA',

                'BS': 'NA',
                'Symbol': 'NA',
                'Value': 0.00

            }

            let index = $scope.items.findIndex(record => record.AllowanceID === d1.AllowanceID)
            if (index === -1) {
                $scope.items.push(d1);
            } else {
                swal("It is already added");
            }
        }


        $scope.addSchemeFormula = function () {


            if (typeof $scope.SchemeAllowanceModel === 'undefined' || $scope.SchemeAllowanceModel.length === 0) {
                swal("Please select Allowance/Deduction");
                return false;
            }

            if (typeof $scope.SchemeAllowanceNameModel === 'undefined' || $scope.SchemeAllowanceNameModel.length === 0) {
                swal("Please select Allowance Name");
                return false;
            }

            if ($scope.BasedOnModel == 1) {

            }

            var d1 = {
                'AllowanceID': $scope.SchemeAllowanceNameModel.ID,
                'AllowanceName': $scope.SchemeAllowanceNameModel.Name,
                'AllowanceType': $scope.SchemeAllowanceModel,
                'SchemeBasedOn': $scope.BasedOnModel,
                'Amount': '0.00',
                'Formula': $scope.FormulaModel,
                'BS': $scope.BS,
                'Symbol': $scope.Symbol,
                'Value': $scope.Value

            }

            let index = $scope.items.findIndex(record => record.AllowanceID === d1.AllowanceID)
            if (index === -1) {
                $scope.items.push(d1);
            } else {
                swal("It is already added");
            }
        }

        $scope.removeItem = function (x1) {
            $scope.items.splice(x1, 1);
        }

        $scope.saveSalaryScheme = function () {
            if (!$scope.SchemeAllowanceNameModel) {
                swal("Please Select Allowance Name");
                return false;
            }

            var Data = $.param({
                'SchemeCode': $scope.SchemeCodeModel,
                'SchemeName': $scope.SchemeNameModel,
                'AllowanceType': $scope.SchemeAllowanceModel,
                'AllowanceName': $scope.SchemeAllowanceNameModel.ID,
                'SchemeItems': $scope.items

            });

            $http.post('<?php echo base_url('app/salary/scheme/save'); ?>', Data, config).then(function (response) {
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

                            $window.location.href = '<?php echo base_url('app/employee/salary/scheme'); ?>';

                        }
                    });
                }

                if (response.data.status === 2) {
                    swal("Please add atleast one scheme allowance.");
                }

                if (response.data.status === -1) {
                    swal("Network error ! Try Again.");
                }
            })
        }

        //delete salary scheme
        $scope.deleteSalaryScheme = function (ID) {
            var $Data = $.param({
                'SchemeID': ID
            });
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover !",
                icon: "warning",
                buttons: true,
                dangerMode: true
            }).then((willDelete) => {
                if (willDelete) {
                    $http.post('<?php echo base_url('app/delete/salary/scheme'); ?>', $Data, config).then(function (response) {
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
                                    window.location.href = '<?php echo base_url("app/employee/salary/scheme"); ?>';
                                }
                            });
                        }

                        if (response.data.status == -1) {
                            swal('Could not delete,The scheme may be in used,please try again.');
                        }

                    });
                } else {
                    swal("Your record  is safe!");
                }
            });
        };

        //edit salary scheme
        $scope.editSalaryScheme = function (ID) {
            $scope.ListPanel = false;
            $scope.AddPanel = true;
            $scope.SaveBtn = false;
            $scope.UpdateBtn = true;
            $scope.SchemeID = ID;

            var $Data = $.param({
                "SchemeID": ID
            });

            $http.post('<?php echo base_url('app/edit/salary/scheme'); ?>', $Data, config).then(function (response) {
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
                    $scope.SchemeCodeModel = response.data.rs1.SchemeCode;
                    $scope.SchemeNameModel = response.data.rs1.SchemeName;
                    $scope.items = response.data.rs2;
                }
            });
        };

        $scope.updateSalaryScheme = function () {
            if (!$scope.SchemeAllowanceNameModel) {
                swal("Please Select Allowance Name");
                return false;
            }

            var $Data = $.param({
                'SchemeCode': $scope.SchemeCodeModel,
                'SchemeName': $scope.SchemeNameModel,
                'AllowanceType': $scope.SchemeAllowanceModel,
                'AllowanceName': $scope.SchemeAllowanceNameModel.ID,
                'SchemeItems': $scope.items,
                'SchemeID': $scope.SchemeID
            });

            $http.post('<?php echo base_url('app/update/salary/scheme'); ?>', $Data, config).then(function (response) {
                if (response.data.status == 0) {
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
                            $window.location.href = '<?php echo base_url('app/employee/salary/scheme'); ?>';
                        }
                    });
                }

                if (response.data.status === 2) {
                    swal("Please add atleast one scheme allowance.");
                }

                if (response.data.status === -1) {
                    swal("Network error ! Try Again.");
                }
            })
        };
    });
</script>