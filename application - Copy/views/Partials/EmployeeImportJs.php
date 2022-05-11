<script>
    var app = angular.module('EmployeeImportApp', []);
    app.controller('EmployeeImportAppCtrl', function ($scope, $http, $window, $filter) {
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };

        function showEmployees() {
            var $Data = $.param({
                'TableName': 'employee'
            });
            $http.post('<?php echo base_url('app/employee/provide') ?>', $Data, config).then(function (response) {
                $scope.employees = response.data.result;
            });
        }

        showEmployees();
    });

</script>