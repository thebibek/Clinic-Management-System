<script>
    var app = angular.module('PurchaseReportApp', []);
    app.controller('PurchaseReportAppCtrl', function ($scope, $http, $window, $filter) {
        var config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };
        $scope.FromDateModel = '<?php echo date('Y-m-d');?>';
        $scope.ToDateModel = '<?php echo date('Y-m-d');?>';
        
        
        $scope.getReport = function(){
            var Data = $.param({
                'FromDate': $scope.FromDateModel,
                'ToDate':$scope.ToDateModel
            });
            
            $http.post('<?php echo base_url("app/purchase/report/generate");?>',Data,config).then(function(response){
                if (response.data.status === 0) {
                    swal({
                        title: "There are some errors !!",
                        text: response.data.error,
                        icon: "warning",
                        dangerMode: true

                    });
                }else{
                    $("#ReportPanel").removeClass('height2');
                    $("#ReportHtml").html(response.data);
                }
                
                
            });
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