<script>
    var app = angular.module('UnitApp', []);
    app.controller('UnitAppCtrl', function ($scope, $http, $window, $filter) {
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };
        
        //initial valuue 
        $scope.UnitID = "";
        $scope.AddPanel = false;
		$scope.ListPanel = true;
		
		
        
        
        
        $scope.showAddPanel = function(){
			$scope.ListPanel = false;
            $scope.AddPanel = true;
			$scope.UnitModel = "";
			$scope.ShortDescriptionModel = "";
			$scope.UpdateBtn = false;
			$scope.actionText = "Add New";
			$scope.SaveBtn = true;
        }
        
        $scope.reset = function(){
            $scope.AddPanel = false;
            
            $scope.ListPanel = true;
        }

        //saving the test description
        $scope.saveUnit = function () {
            var DataCategory = $.param({
                "Unit": $scope.UnitModel,
                "ShortDescription": $scope.ShortDescriptionModel,

            });

            $http.post('<?php echo base_url('app/unit/save'); ?>', DataCategory, config).then(function (response) {
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

                            $window.location.href = '<?php echo base_url('app/unit'); ?>';

                        }
                    });
                }

                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        };

        $scope.editUnit = function (ID) {
            $scope.ListPanel = false;
            $scope.AddPanel = true;
			$scope.actionText = "Update";
			$scope.SaveBtn = false;
			$scope.UpdateBtn = true;
			
            $scope.UnitID = ID;

            var DataEdit = $.param({
                "UnitID": ID
            });

            $http.post('<?php echo base_url('app/unit/edit'); ?>', DataEdit, config).then(function (response) {
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
                    $scope.UnitModel = response.data.result.Unit;
                    $scope.ShortDescriptionModel = response.data.result.Description;
                }


            });
        };

        $scope.updateUnit = function () {
            var DataUnit = $.param({
                "Unit": $scope.UnitModel,
                "Description": $scope.ShortDescriptionModel,
                "UnitID": $scope.UnitID
            });

            $http.post('<?php echo base_url('app/unit/update'); ?>', DataUnit, config).then(function (response) {
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

                            $window.location.href = '<?php echo base_url('app/unit'); ?>';

                        }
                    });
                }

                if (response.data.status == -2) {
                    swal("The unit is already exist !!", {
                        icon: "warning",
                        closeOnClickOutside: false
                    }).then((ok) => {
                        if (ok) {

                            $window.location.href = '<?php echo base_url('app/unit'); ?>';

                        }
                    });
                }

                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        };
        
         //delete category
        $scope.deleteUnit = function (ID) {
			
            var DataID = $.param({
                'UnitID': ID
            });
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover !",
                icon: "warning",
                buttons: true,
                dangerMode: true
            }).then((willDelete) => {
                if (willDelete) {
                    $http.post('<?php echo base_url('app/delete/unit'); ?>', DataID, config).then(function (response) {
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

                                    window.location.href = '<?php echo base_url("app/unit"); ?>';
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