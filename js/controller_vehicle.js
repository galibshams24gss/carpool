app.controller('vehicleController', ['$scope', '$location', '$uibModal', '$log', 'entePool', '$routeParams', '$timeout', function ($scope, $location, $modal, $log, entePool, $routeParams, $timeout) {
    $scope.vehicle_image = [];

    $scope.removeUser = function (user_id) {
        var postData = { id: $routeParams.id, user_id : user_id}
        // entePool.postDataConfigCall(removeSuperUserObj, postData, function (result) {
        //     if(result !== 'error'){
        //         if (result.status === 'failed') {
        //             $scope.dlgAlert(result.message, result.status);
        //         } else {
        //             console.log(result)
        //         }
        //     }
        // });
    };

    $scope.submitForm = function(postData){
        $scope.loader = true;
        if(postData.vehicle_primary_location.id !== undefined){
            postData.vehicle_primary_location = postData.vehicle_primary_location.id
        }

        entePool.postDataConfigCall(processVehicleObj, postData, function (result) {
            if(result !== 'error'){
                $scope.loader = false;
                // console.log(result)
                if (result.status === 'failed') {
                    $scope.dlgAlert(result.message, result.status);
                } else {
                    $scope.getLocation();
                    $scope.dlgAlert(result.message, result.status);
                }
            }
        });
    }

    $scope.getLocation = function(){
        entePool.getDataConfigCall(locationsObj, function (result) {
            if(result !== 'error'){
                if (result.status === 'failed') {
                    $scope.dlgAlert(result.message, result.status);
                } else {
                    $scope.locationLists = result.data;
                }
            }
        });
    }
    $scope.getLocation();

    $scope.featureList = [];

    $scope.getVehicle = function(){
        $scope.loader = true;
        var url = getVehicleObj + "?id=" + $routeParams.id;
        entePool.getDataConfigCall(url, function (result) {
            $scope.loader = false;
            if(result !== 'error'){
                if (result.status === 'failed') {
                    $scope.dlgAlert(result.message, result.status);
                } else {
                    $scope.vehicle = result.data;
                    if(!(result.data.vehicle_image instanceof Array)){
                        $scope.vehicle.vehicle_image = [];
                    }

                    // angular.forEach(result.data.vehicle_features, function(value, key) {
                    //     angular.forEach(value, function(value, key) {
                    //         if(key == 'feature'){
                    //             $scope.featureList.push(value)
                    //         }
                    //         console.log(value)
                    //     });

                    // });

                    // $scope.featureList

                    $scope.getFeature();
                }
            }
        });
    };
    if($routeParams.id !== null && $routeParams.id !== undefined && $routeParams.id !== ''){
        $scope.getVehicle();
    }

    $scope.getAllVehicle = function(){
        $scope.loader = true;
        entePool.getDataConfigCall(getAllVehicleObj, function (result) {
            $scope.loader = false;
            if(result !== 'error'){
                if (result.status === 'failed') {
                    $scope.dlgAlert(result.message, result.status);
                } else {
                    $scope.vehicleList = result.data;
                    $scope.getFeature();
                }
            }
        });
    };
    $scope.getAllVehicle();

    $scope.getFeature = function(){
        var url = getFeatureObj;
        entePool.getDataConfigCall(url, function (result) {
            // console.log(result)
            if(result !== 'error'){
                if (result.status === 'failed') {
                    $scope.dlgAlert(result.message, result.status);
                } else {
                    $scope.features = result.data;
                }
            }
        });
    }

    $scope.removeFeature = function(index){
        $scope.vehicle.vehicle_features.splice(index, 1);
    }

    $scope.addFeature = function(data){
        $scope.additionFeature = '';
        $scope.vehicle.vehicle_features.push(data);
    }





    // $scope.getFeature = function(){
    //     var url = getFeatureObj + "?id=" + $routeParams.id;
    //     entePool.getDataConfigCall(url, function (result) {
    //         console.log(result)
    //         if(result !== 'error'){
    //             if (result.status === 'failed') {
    //                 $scope.dlgAlert(result.message, result.status);
    //             } else {
    //                 $scope.vehicle = result.data;
    //             }
    //         }
    //     });
    // }
    // $scope.getFeature();








    $scope.showUploadImageModal = function (imageLoc) {
       // $scope.dlgUploadImage();
        $scope.imageLoc = imageLoc;
        $('#upload-image-modal').modal('show');
    };

    $scope.showImageFunction = function () {
        $scope.showImage = true;
    };

    $scope.submitformImage = function (image) {
        $scope.loader = true;
        $('#upload-image-modal').modal('hide');
        $scope.vehicle.vehicle_image[$scope.imageLoc]= { path: image };
        angular.forEach(
            angular.element("input[type='file']"),
            function (inputElem) {
                angular.element(inputElem).val(null);
            });
        $scope.showImage = false;
        $timeout(function () {
            $scope.loader = false;
        }, 10);
    };


    // $scope.dlgUploadImage = function (messsage, header) {
    //     $ctrl.items = {'name':header,'message':messsage};
    //     var modalInstance = $modal.open({
    //       animation: $ctrl.animationsEnabled,
    //       component: 'modalUploadComponent',
    //       resolve: {
    //         items: function () {
    //           return $ctrl.items;
    //         }
    //       }
    //     });

    //     modalInstance.result.then(function (selectedItem) {
    //       $ctrl.selected = selectedItem;
    //     }, function () {
    //       $log.info('modal-component dismissed at: ' + new Date());
    //     });
    // };






    $scope.dlgAlert = function (messsage, header) {
        $ctrl.items = {'name':header,'message':messsage};
        var modalInstance = $modal.open({
          animation: $ctrl.animationsEnabled,
          component: 'modalComponent',
          resolve: {
            items: function () {
              return $ctrl.items;
            }
          }
        });

        modalInstance.result.then(function (selectedItem) {
          $ctrl.selected = selectedItem;
        }, function () {
          $log.info('modal-component dismissed at: ' + new Date());
        });
    };
}]);