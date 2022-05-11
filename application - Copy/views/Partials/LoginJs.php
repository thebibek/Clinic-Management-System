<script>
    var app = angular.module('LoginApp', []);
    app.controller('LoginAppCtrl', function ($scope, $http, $window, $filter) {
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };

        //login

        $scope.login = function () {
            var Data = $.param({
                'Email': $scope.EmailModel,
                'Password': $scope.PasswordModel
            });

            $http.post("app/login", Data, config).then(function (response) {
                if (response.data.status === 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true

                    });
                }

                if (response.data.status === 1) {
                    if (response.data.status === 1) {
                        swal("Please wait....");
                        $window.location.href = '<?php echo base_url('app/dashboard'); ?>';

                    }
                }

                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        }
        
        $scope.loginSuperAdmin = function(){
           $scope.EmailModel = 'admin123@gmail.com';
           $scope.PasswordModel = '12345678';
        }
        
        $scope.loginPathologist = function(){
           $scope.EmailModel = 'pathologist@gmail.com';
           $scope.PasswordModel = '12345678';
        }
        
        $scope.loginReceiptionist = function(){
            $scope.EmailModel = 'receiptionist@gmail.com';
           $scope.PasswordModel = '12345678';
        }
    });

</script>