<script>
    var app = angular.module('SearchReportApp', []);
    app.controller('SearchReportAppCtrl', function ($scope, $http, $window, $filter) {
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };


        $scope.getReports = function () {

            if (typeof $scope.MRNoModel === 'undefined' || $scope.MRNoModel.length === 0) {
                swal("Please Enter MRNo !!");
                return false;
            }

            var Data = $.param({
                "MRNo": $scope.MRNoModel
            });

            $http.post("<?php echo base_url("app/patient/receipt/reports"); ?>", Data, config).then(function (response) {
                if (response.data.status == 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true

                    });
                }

                if (response.data.status == 1) {
                    $scope.reports = response.data.result;
                }

                if (response.data.status == -1) {
                    swal('Could not delete,please try again.');
                }
            });


        }




    });



</script>