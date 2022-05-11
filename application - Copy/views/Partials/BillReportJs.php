<script>
    var app = angular.module('PatientReportApp', []);
    app.controller('PatientReportAppCtrl', function ($scope, $http, $window, $filter) {
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };

        $scope.MonthNo = "";

        $scope.getReport = function () {
            var type = $scope.ReportModel;
            var $Data = "";
            var $date = "";
            if (type == 1) {
                $scope.MonthNo = $scope.MonthModel;
                $Data = $.param({
                    'Month': $scope.MonthModel
                });

                $http.post('<?php echo base_url("app/month/bill/report"); ?>', $Data, config).then(function (response) {
                    $("#ReportPanel").removeClass('height2');
                    $("#ReportHtml").html(response.data);
                });
            }



            if (type == 2) {
                $date = $scope.DateModel;
                $Data = $.param({
                    'Date': $date
                });

                $http.post('<?php echo base_url('app/date/wise/collection'); ?>', $Data, config).then(function (response) {
                    if (response.data.status === 0) {
                        swal({
                            title: "There are some errors !!",
                            text: response.data.error,
                            icon: "warning",
                            dangerMode: true

                        });
                    } else {
                        $("#ReportPanel").removeClass('height2');
                        $("#ReportHtml").html(response.data);
                    }

                });

            }

        }

        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            document.body.innerHTML = printContents;

            window.print();


        }

        $scope.getPdf = function () {
            printDiv('ReportHtml');
        }

        //saving the test description
        $scope.saveCategory = function () {
            var DataCategory = $.param({
                "Category": $scope.CategoryModel,
                "ShortName": $scope.ShortNameModel,

            });

            $http.post('<?php echo base_url('app/category/save'); ?>', DataCategory, config).then(function (response) {
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

                            $window.location.href = '<?php echo base_url('app/category'); ?>';

                        }
                    });
                }

                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        };
    });

</script>