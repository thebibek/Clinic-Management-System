<script>
    var app = angular.module('GroupApp', []);
    app.controller('GroupAppCtrl', function ($scope, $http, $window, $filter) {
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };
        
        //initial valuue 
        $scope.GroupID = "";
        $scope.AddPanel = false;
        $scope.ListPanel = true;
        $scope.SaveBtn = true;
        function showGroup() {
            var DataGroup = $.param({
                'TableName': 'undergroup'
            });

            $http.post('<?php echo base_url('api/v1/app/master') ?>', DataGroup, config).then(function (response) {

                $scope.groups = response.data.result;

            });
        }
        showGroup();
        
        $scope.showAddPanel = function(){
            $scope.GroupModel = "";
            $scope.DescriptionModel = "";
            $scope.ActiveModel = 0;
            $scope.AddPanel = true;
            $scope.ListPanel = false;
        }
        
        $scope.reset = function(){
            $scope.AddPanel = false;
            $scope.ListPanel = true;
        }

        //saving the test description
        $scope.saveGroup = function () {
            var DataGroup = $.param({
                "Group": $scope.GroupModel,
                "Description": $scope.DescriptionModel,
                "IsActive":$scope.ActiveModel

            });

            $http.post('<?php echo base_url('app/group/save'); ?>', DataGroup, config).then(function (response) {
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

                            $window.location.href = '<?php echo base_url('app/ledger/under/group'); ?>';

                        }
                    });
                }

                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        };

        $scope.editGroup = function (ID) {
            $scope.ListPanel = false;
            $scope.SaveBtn = false;
            $scope.UpdateBtn = true;
            $scope.AddPanel = true;
            $scope.GroupID = ID;

            var DataEdit = $.param({
                "GroupID": ID
            });

            $http.post('<?php echo base_url('app/edit/ledger/under/group'); ?>', DataEdit, config).then(function (response) {
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
                    $scope.GroupModel = response.data.result.UnderGroup;
                    $scope.DescriptionModel = response.data.result.Description;
                    $scope.ActiveModel = response.data.result.IsActive;
                }


            });
        };

        $scope.updateGroup = function () {
            var DataGroup = $.param({
                "GroupID": $scope.GroupID,
                "Group": $scope.GroupModel,
                "Description": $scope.DescriptionModel,
                "IsActive": $scope.ActiveModel
            });

            $http.post('<?php echo base_url('app/update/ledger/under/group'); ?>', DataGroup, config).then(function (response) {
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

                            $window.location.href = '<?php echo base_url('app/ledger/under/group'); ?>';

                        }
                    });
                }

                if (response.data.status == -2) {
                    swal("The category is already exist !!", {
                        icon: "warning",
                        closeOnClickOutside: false
                    }).then((ok) => {
                        if (ok) {

                            $window.location.href = '<?php echo base_url('app/ledger/under/group'); ?>';

                        }
                    });
                }

                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        };
        
         //delete category
        $scope.deleteGroup = function (ID) {
        
            var DataID = $.param({
                'GroupID': ID
            });
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover !",
                icon: "warning",
                buttons: true,
                dangerMode: true
            }).then((willDelete) => {
                if (willDelete) {
                    $http.post('<?php echo base_url('app/delete/ledger/under/group'); ?>', DataID, config).then(function (response) {
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

                                    window.location.href = '<?php echo base_url("app/ledger/under/group"); ?>';
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