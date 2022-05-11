<script>
    var app = angular.module('BloodGroupApp', []);
    app.controller('BloodGroupAppCtrl', function ($scope, $http, $window, $filter) {
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };
        
        //initial valuue 
        $scope.BloodGroupID = "";
        $scope.AddPanel = false;
        $scope.ListPanel = true;
        $scope.ActionText = 'Add';
       
        
        $scope.showAddPanel = function(){
            $scope.BloodGroupModel = "";
            $scope.DescriptionModel = "";
            $scope.ActionText = 'Add';
            $scope.SaveBtn = true;
            $scope.AddPanel = true;
            $scope.ListPanel = false;
        }
        
        $scope.reset = function(){
            $scope.AddPanel = false;
            $scope.SaveBtn = true;
            $scope.UpdateBtn = false;
            $scope.ListPanel = true;
        }

        //saving the blood group, description
        $scope.saveBloodGroup = function () {
            var $Data = $.param({
                "BloodGroup": $scope.BloodGroupModel,
                "Description": $scope.DescriptionModel

            });

            $http.post('<?php echo base_url('app/save/blood/group'); ?>', $Data, config).then(function (response) {
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

                            $window.location.href = '<?php echo base_url('app/blood/group'); ?>';

                        }
                    });
                }

                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        };

        $scope.editBG = function (ID) {
            $scope.ActionText = 'Update';
            $scope.ListPanel = false;
            $scope.ActionText = 'Update';
            $scope.SaveBtn = false;
            $scope.UpdateBtn = true;
            $scope.AddPanel = true;
       
            $scope.BloodGroupID = ID;

            var $Data = $.param({
                "BloodGroupID": ID
            });

            $http.post('<?php echo base_url('app/edit/blood/group'); ?>', $Data, config).then(function (response) {
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
                    $scope.BloodGroupModel = response.data.result.BloodGroup;
                    $scope.DescriptionModel = response.data.result.Description;
                }


            });
        };

        $scope.updateBloodGroup = function () {
            var $Data = $.param({
                "BloodGroup": $scope.BloodGroupModel,
                "Description": $scope.DescriptionModel,
                "BloodGroupID": $scope.BloodGroupID
            });

            $http.post('<?php echo base_url('app/update/blood/group'); ?>', $Data, config).then(function (response) {
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

                            $window.location.href = '<?php echo base_url('app/blood/group'); ?>';

                        }
                    });
                }

                if (response.data.status == -2) {
                    swal("The blood group is already exist !!", {
                        icon: "warning",
                        closeOnClickOutside: false
                    }).then((ok) => {
                        if (ok) {

                            $window.location.href = '<?php echo base_url('app/blood/group'); ?>';

                        }
                    });
                }

                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        };
        
         //delete category
        $scope.deleteBG = function (ID) {
            var $Data = $.param({
                'BloodGroupID': ID
            });
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover !",
                icon: "warning",
                buttons: true,
                dangerMode: true
            }).then((willDelete) => {
                if (willDelete) {
                    $http.post('<?php echo base_url('app/delete/blood/group'); ?>', $Data, config).then(function (response) {
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

                                    window.location.href = '<?php echo base_url("app/blood/group"); ?>';
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