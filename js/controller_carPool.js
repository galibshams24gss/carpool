app.controller('carPoolController', ['$scope', '$location', '$uibModal', '$log', 'entePool', '$routeParams', function ($scope, $location, $modal, $log, entePool, $routeParams) {
    var input1 = document.getElementById('address');
    var autocomplete1 = new google.maps.places.Autocomplete(input1);

    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 11
    });
    
    autocomplete1.addListener('place_changed', function () {
        var place1 = autocomplete1.getPlace();
        $scope.location.address = place1.formatted_address;
        $scope.location.place_id = place1.place_id;
        $scope.location.Latitude = place1.geometry.location.lat();
        $scope.location.Longitude = place1.geometry.location.lng();
        // No need to assign address value back to $scope.company.address
        //  $scope.company.address = address.businessAddress;

        if (!place1.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert("No details available for input: '" + place.name + "'");
            return;
        }

        // If the place has a geometry, then present it on a map.
        if (place1.geometry.viewport) {
            map.fitBounds(place1.geometry.viewport);
        } else {
            map.setCenter(place1.geometry.location);
        }
        map.setZoom(11);
        marker.setPosition(place1.geometry.location);
        marker.setVisible(true);
    });

    $scope.getLocation = function(){
        var url = locationObj + "?id=" + $routeParams.id;
        entePool.getDataConfigCall(url, function (result) {
            if(result !== 'error'){
                if (result.status === 'failed') {
                    $scope.dlgAlert(result.message, result.status);
                } else {
                    $scope.location = result.data;
                    $scope.map(result.data.lat, result.data.lon, result.data.pool_name);
                }
            }
        });
    }

    $scope.addNewUser = function (email) {
        $scope.loader = true;
        var postData = { id: $routeParams.id, email : email}
        var url = addSuperUserObj;
        if($routeParams.id == 'new'){
            url = addSuperUserNewObj;
        }
        entePool.postDataConfigCall(url, postData, function (result) {
            $scope.loader = false;
            if(result !== 'error'){
                if (result.status === 'failed') {
                    $scope.dlgAlert(result.message, result.status);
                } else {
                    if($routeParams.id == 'new'){
                        if(!($scope.location.super_user instanceof Array) || $scope.location.super_user == undefined ){
                            $scope.location.super_user = [];
                        }
                        $scope.location.super_user.push(result.data);
                    } else {
                        $scope.location.super_user = result.data.super_user;
                    }
                    // $scope.dlgAlert(result.message, result.status);
                }
            }
        });
    };

    $scope.removeUser = function (user_id, index) {
        if($routeParams.id == 'new'){
            $scope.location.super_user.splice(index, 1); 
        } else {
            $scope.removeEditUser(user_id);
        }
    };

    $scope.removeEditUser = function (user_id) {        
        var postData = { id: $routeParams.id, user_id : user_id}
        entePool.postDataConfigCall(removeSuperUserObj, postData, function (result) {
            if(result !== 'error'){
                if (result.status === 'failed') {
                    $scope.dlgAlert(result.message, result.status);
                } else {
                    // console.log(result)
                    $scope.location.super_user = result.data.super_user;
                    $scope.dlgAlert(result.message, result.status);
                }
            }
        });
    };

    $scope.map = function(lat, lon, title){
        var initialLocation = new google.maps.LatLng(lat, lon);
        map.setCenter(initialLocation);
        marker = new google.maps.Marker({
            position: initialLocation,
            map: map,
            title: title
        });
    }    

    $scope.submitForm = function(postData){
        $scope.loader = true;
        entePool.postDataConfigCall(processLocationObj, postData, function (result) {
            $scope.loader = false;
            if(result !== 'error'){
                // console.log(result)
                if (result.status === 'failed') {
                    $scope.dlgAlert(result.message, result.status);
                } else {
                    if ($routeParams.id == 'new'){
                        $scope.dlgAlert(result.message, result.status, '/home');
                    } else {
                        $scope.dlgAlert(result.message, result.status);
                    }
                }
            }
        });
    }

    $scope.getVehicle = function(){
        var url = getVehiclesObj + "?id=" + $routeParams.id;
        entePool.getDataConfigCall(url, function (result) {
            if(result !== 'error'){
                if (result.status === 'failed') {
                    $scope.dlgAlert(result.message, result.status);
                } else {
                    $scope.vehicleLists = result.data;
                }
            }
        });
    }
    if ($routeParams.id !== 'new'){
        $scope.getLocation();
        $scope.getVehicle();
        $scope.newLocation = false;
    } else {        
        $scope.map(-33.8688, 151.2093, 'Sydney');
        $scope.location = {};
        $scope.newLocation = true;
    }
    
    $scope.getAllVehicle = function(){
        var url = getAllVehicleObj;
        entePool.getDataConfigCall(url, function (result) {
            if(result !== 'error'){
                if (result.status === 'failed') {
                    $scope.dlgAlert(result.message, result.status);
                } else {
                    vehicleAllLists = result.data;
                }
            }
        });
    }
    $scope.getAllVehicle();
    
    $scope.processVehicle = function(data){
        var url = getAllVehicleObj;
        var postData = {id:$routeParams.id, car_id:data.id}
        entePool.postDataConfigCall(processVehiclePoolObj, postData, function (result) {
            $scope.loader = false;
            // console.log(result)
            if(result !== 'error'){
                if (result.status === 'failed') {
                    $scope.dlgAlert(result.message, result.status);
                } else {
                    if(data.setting == 'again'){
                        $scope.dlgAddVehicle();
                    } else {                        
                        $scope.dlgAlert(result.message, result.status);
                    }
                    $scope.getVehicle();
                }
            }
        });
    }
    
    $scope.removeVehicle = function(vehicleId){
        var url = removeVehicleObj + "?id=" + $routeParams.id + "&car_id=" + vehicleId;
        entePool.getDataConfigCall(url, function (result) {
            $scope.loader = false;
            // console.log(result)
            if(result !== 'error'){
                if (result.status === 'failed') {
                    $scope.dlgAlert(result.message, result.status);
                } else {
                    $scope.dlgAlert(result.message, result.status);
                    $scope.getVehicle();
                }
            }
        });
    }


    $scope.dlgAddVehicle = function () {
        $ctrl.items = {vehicleAllLists};
        if ($routeParams.id !== 'new'){
            var locationId = $routeParams.id;
        }

        var modalInstance = $modal.open({
          animation: $ctrl.animationsEnabled,
          component: 'modalAddVehicleComponent',
          resolve: {
            items: function () {
              return $ctrl.items;
            }
          }
        });

        modalInstance.result.then(function (returnedData) {
            $scope.processVehicle(returnedData)
        }, function () {
          $log.info('modal-component dismissed at: ' + new Date());
        });
    };



    $scope.dlgAlert = function (messsage, header, redirect, url) {
        $ctrl.items = {'name':header,'message':messsage, 'redirect':redirect};
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