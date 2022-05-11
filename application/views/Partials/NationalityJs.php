<script>
    var app = angular.module('NationalityApp', []);
    app.controller('NationalityAppCtrl', function ($scope, $http, $window, $filter) {
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };

        //initial valuue 
        $scope.NationalityID = "";
        $scope.AddPanel = false;
        $scope.ListPanel = true;

        function showNationality() {
            var $Data = $.param({
                'TableName': 'nationality'
            });

            $http.post('<?php echo base_url('api/v1/app/master') ?>', $Data, config).then(function (response) {

                $scope.nationalities = response.data.result;

            });
        }
        showNationality();

        $scope.showAddPanel = function () {
            $scope.NationalityModel = "";
            $scope.ShortNameModel = "";
            $scope.SaveBtn = true;
            $scope.UpdateBtn = false;
            $scope.AddPanel = true;
            $scope.ListPanel = false;
        }

        $scope.reset = function () {
            $window.location = '<?php echo base_url('app/nationality');?>';
        }

        //saving the test description
        $scope.saveNationality = function () {
            var $Data = $.param({
                "Nationality": $scope.NationalityModel,
                "ShortName": $scope.ShortNameModel
            });

            $http.post('<?php echo base_url('app/save/nationality'); ?>', $Data, config).then(function (response) {
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
                            $window.location.href = '<?php echo base_url('app/nationality'); ?>';
                        }
                    });
                }

                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        };

        $scope.editNationality = function (ID) {
            $scope.ListPanel = false;
            $scope.SaveBtn = false;
            $scope.UpdateBtn = true;
            $scope.AddPanel = true;
            $scope.NationalityID = ID;

            var $Data = $.param({
                "NationalityID": ID
            });

            $http.post('<?php echo base_url('app/edit/nationality'); ?>', $Data, config).then(function (response) {
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
                    $scope.NationalityModel = response.data.result.Nationality;
                    $scope.ShortNameModel = response.data.result.ShortName;
                }


            });
        };

        $scope.updateNationality = function () {
            var $Data = $.param({
                "Nationality": $scope.NationalityModel,
                "ShortName": $scope.ShortNameModel,
                "NationalityID": $scope.NationalityID
            });

            $http.post('<?php echo base_url('app/update/nationality'); ?>', $Data, config).then(function (response) {
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

                            $window.location.href = '<?php echo base_url('app/nationality'); ?>';

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

        //delete nationality
        $scope.deleteNationality = function (ID) {
            var $Data = $.param({
                'NationalityID': ID
            });
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover !",
                icon: "warning",
                buttons: true,
                dangerMode: true
            }).then((willDelete) => {
                if (willDelete) {
                    $http.post('<?php echo base_url('app/delete/nationality'); ?>', $Data, config).then(function (response) {
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

                                    window.location.href = '<?php echo base_url("app/nationality"); ?>';
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