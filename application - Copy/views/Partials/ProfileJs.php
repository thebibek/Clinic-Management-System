<script>

    var app = angular.module('ProfileApp', []);
    app.controller('ProfileAppCtrl', function ($scope, $http, $window, $filter) {
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };
        editUser();

        function editUser() {
            $scope.UserID = <?php echo $this->session->userdata('id'); ?>;

            var DataEdit = $.param({
                "UserID": $scope.UserID
            });

            $http.post('<?php echo base_url('app/user/edit'); ?>', DataEdit, config).then(function (response) {
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
                    $scope.EmailModel = response.data.result.email;
                    $scope.NameModel = response.data.result.username;
                }


            });
        }


        $scope.updateUser = function () {
            var DataUser = $.param({
                "UserID": $scope.UserID,
                "Email": $scope.EmailModel,
                "UserName": $scope.NameModel,
                "Password": $scope.PasswordModel
            });

            $http.post('<?php echo base_url('app/user/update'); ?>', DataUser, config).then(function (response) {
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
                        $window.location.href = "<?php echo base_url('app/dashboard'); ?>";
                    });
                }

                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        }



    });

</script>