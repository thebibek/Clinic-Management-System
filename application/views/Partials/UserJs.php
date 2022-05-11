<script>

    var app = angular.module('UserApp', []);
    app.controller('UserAppCtrl', function ($scope, $http, $window, $filter) {
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };

        //default setting 
        $scope.SaveGroupBtn = true;
        $scope.SaveUserBtn = true;
        $scope.SavePermBtn = true;
        $scope.GroupID = 0;
        $scope.UserIdModel = 0;

        $scope.closeUser = function () {
            $window.location.href = '<?php echo base_url('app/user/management'); ?>';
        }

        $scope.closeGroup = function () {
            $window.location.href = '<?php echo base_url('app/user/management'); ?>';
        }

        $scope.getUserID = function (ID) {
            $scope.UserIdModel = ID;
        }

        function showGroups() {
            var DataGroup = $.param({
                'TableName': 'aauth_groups'
            });

            $http.post('<?php echo base_url('api/v1/app/master'); ?>', DataGroup, config).then(function (response) {
                $scope.groups = response.data.result;
            });
        }

        function showEmployees() {

            var $Data = $.param({
                'TableName': 'employee'
            });
            $http.post('<?php echo base_url('app/employee/provide') ?>', $Data, config).then(function (response) {
                $scope.employees = response.data.result;

            });
        }

        function showUsers() {
            var DataUser = $.param({
                'TableName': 'aauth_users'
            });

            $http.post('<?php echo base_url('app/users'); ?>', DataUser, config).then(function (response) {
                $scope.users = response.data;
            });
        }

        function showPermissions() {
            var DataPerm = $.param({
                'TableName': 'aauth_perms'
            });

            $http.post('<?php echo base_url('api/v1/app/master'); ?>', DataPerm, config).then(function (response) {
                $scope.permissions = response.data.result;
            });
        }
        
        function showLinkedUser(){
            var $Data = $.param({
                'method': 'post'
            });
            
            $http.post('<?php echo base_url('app/provide/linked/user');?>', $Data, config).then(function(response){
                $scope.linkedusers = response.data.result;
            });
        }

        showEmployees();
        showGroups();
        showUsers();
        showPermissions();
        showLinkedUser();

        //saving user group
        $scope.saveGroup = function () {
            var $Data = $.param({
                "Group": $scope.GroupNameModel,
                "GroupDefinition": $scope.GroupDefinitionModel
            });

            $http.post('<?php echo base_url('app/save/user/group'); ?>', $Data, config).then(function (response) {
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
                        $window.location = "<?php echo base_url('app/user/management'); ?>";
                    });
                }

                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        };

        $scope.saveUser = function () {
            var DataUser = $.param({
                "Email": $scope.EmailModel,
                "Password": $scope.PasswordModel,
                "UserName": $scope.UserNameModel
            });

            $http.post('<?php echo base_url('app/user/save'); ?>', DataUser, config).then(function (response) {
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
                        $scope.EmailModel = "";
                        $scope.PasswordModel = "";
                        showUsers();
                    });
                }

                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        }


        $scope.deleteUserGroup = function (ID) {
            var $Data = $.param({
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
                    $http.post('<?php echo base_url('app/delete/user/group'); ?>', $Data, config).then(function (response) {
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

                                    window.location.href = '<?php echo base_url("app/user/management"); ?>';
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
        }

        $scope.editGroup = function (ID) {
            $scope.SaveGroupBtn = false;
            $scope.UpdateGroupBtn = true;
            $scope.CloseGroupBtn = true;
            $scope.GroupID = ID;

            var DataEdit = $.param({
                "GroupID": ID
            });

            $http.post('<?php echo base_url('app/group/edit'); ?>', DataEdit, config).then(function (response) {
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
                    $scope.GroupNameModel = response.data.result.name;
                    $scope.GroupDefinitionModel = response.data.result.definition;
                }


            });
        };

        $scope.editUser = function (ID) {
            $scope.SaveUserBtn = false;
            $scope.UpdateUserBtn = true;
            $scope.CloseUserBtn = true;
            $scope.UserID = ID;

            var DataEdit = $.param({
                "UserID": ID
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
                    $scope.UserNameModel = response.data.result.username;

                }


            });
        };

        $scope.deleteUser = function (ID) {
            var $Data = $.param({
                'UserID': ID
            });
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover !",
                icon: "warning",
                buttons: true,
                dangerMode: true
            }).then((willDelete) => {
                if (willDelete) {
                    $http.post('<?php echo base_url('app/delete/user'); ?>', $Data, config).then(function (response) {
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

                                    window.location.href = '<?php echo base_url("app/user/management"); ?>';
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
        }

        $scope.updateUser = function () {
            var DataUser = $.param({
                "UserID": $scope.UserID,
                "Email": $scope.EmailModel,
                "Password": $scope.PasswordModel,
                "UserName": $scope.UserNameModel

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
                        window.location.href = '<?php echo base_url("app/user/management"); ?>';
                    });
                }

                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        }

        $("#AssignUser").click(function () {
            $scope.AssignGroupModel = $("#GroupID").val();

            var AssignGroupData = $.param({
                'GroupID': $scope.AssignGroupModel,
                'UserID': $scope.UserIdModel
            });

            $http.post('<?php echo base_url("app/assign/user"); ?>', AssignGroupData, config).then(function (response) {
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
                        window.location.href = '<?php echo base_url("app/user/management"); ?>';
                    });
                }

                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });

        });


        $scope.updateGroup = function () {
            var $Data = $.param({
                "GroupID": $scope.GroupID,
                "Group": $scope.GroupNameModel,
                "GroupDefinition": $scope.GroupDefinitionModel
            });

            $http.post('<?php echo base_url('app/group/update'); ?>', $Data, config).then(function (response) {
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
                            $window.location = "<?php echo base_url('app/user/management'); ?>";
                        }
                    });
                }



                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        };

        $scope.savePermission = function () {
            var DataPerm = $.param({
                'Permission': $scope.PermissionModel,
                'PermDef': $scope.PermDefModel
            });

            $http.post('<?php echo base_url('app/save/permission'); ?>', DataPerm, config).then(function (response) {
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
                        $scope.PermissionModel = "";
                        $scope.PermDefModel = "";
                        showPermissions();
                    });
                }

                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        }

        $scope.editPermission = function (ID) {

            $scope.PermissionID = ID;
            $scope.SavePermBtn = false;
            $scope.UpdatePermBtn = true;
            $scope.ClosePermBtn = true;

            var DataPerm = $.param({
                'PermissionID': ID
            });

            $http.post('<?php echo base_url('app/edit/permission'); ?>', DataPerm, config).then(function (response) {
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
                    $scope.PermissionModel = response.data.result.name;
                    $scope.PermDefModel = response.data.result.definition;

                }
            });

        }

        $scope.updatePermission = function () {
            var DataPerm = $.param({
                'PermissionID': $scope.PermissionID,
                'Permission': $scope.PermissionModel,
                'PermDef': $scope.PermDefModel
            });

            $http.post('<?php echo base_url('app/update/permission'); ?>', DataPerm, config).then(function (response) {
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
                            showPermissions();
                        }
                    });
                }

                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        }

        $scope.linkUser = function () {
            var $Data = $.param({
                'EmployeeID': $scope.EmployeeModel,
                'UserID': $scope.UserModel
            });

            $http.post('<?php echo base_url('app/link/user/to/employee'); ?>', $Data, config).then(function (response) {
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
                            $window.location = "<?php echo base_url('app/user/management'); ?>";
                        }
                    });
                }

                if (response.data.status === -1) {
                    swal("Network Error,pls try again !!");
                }
            });
        }
        
        $scope.unlinkUser = function($id,$empId){
            var $Data = $.param({
                'UserID': $id,
                'EmployeeID':$empId 
            });
            
            swal({
                title: "Are you sure?",
                text: "Once updated, you have to link employee once again !!",
                icon: "warning",
                buttons: true,
                dangerMode: true
            }).then((willDelete) => {
                if (willDelete) {
                    $http.post('<?php echo base_url('app/unlink/user'); ?>', $Data, config).then(function (response) {
                        if (response.data.status == 0) {
                            swal({
                                title: "There are some errors !!",
                                text: response.data.error,
                                icon: "warning",
                                dangerMode: true

                            });
                        }
                        if (response.data.status == 1) {
                            swal("Record updated successfully !!", {
                                icon: "success",
                                closeOnClickOutside: false
                            }).then((ok) => {
                                if (ok) {

                                    window.location.href = '<?php echo base_url("app/user/management"); ?>';
                                }
                            });
                        }

                        if (response.data.status == -1) {
                            swal('Could not updated,please try again.');
                        }

                    });
                } else {
                    swal("Your record  is safe!");
                }
            });
            
            
        }
    });

</script>