app.controller('homeController', ['$scope', '$location', '$uibModal', '$log', 'entePool', function ($scope, $location, $modal, $log, entePool) {

    $scope.sortReverse = true;

    $scope.getLocation = function(){
        $scope.loader = true;
        entePool.getDataConfigCall(locationsObj, function (result) {
            $scope.loader = false;
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