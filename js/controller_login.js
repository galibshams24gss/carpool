app.controller('loginController', ['$scope', '$uibModal', '$log', '$document', '$location', 'entePool', '$routeParams', 
function ($scope, $modal, $log, $document, $location, entePool, $routeParams) {

    $scope.login = function () {
        $scope.processing = true;
        $scope.loader = true;

        var sendPassword = hex_sha512($scope.password);
        var postData = '{"email":"' + $scope.email + '", "password":"' + sendPassword + '"}';

        entePool.postDataCall(loginObj, postData, function (result) {
            if(result !== 'error'){
                if (result.status !== undefined && result.status !== null) {
                    $scope.processing = false;
                    $scope.loader = false;
                    if (result.status === 'failed') {
                        $scope.dlgAlert(result.message, result.status);
                    } else {
                        sessionStorage.setItem("ip", result.ip);
                        sessionStorage.setItem("token", result.token);
                        sessionStorage.setItem("user_id", result.user_id);
                        sessionStorage.setItem("role", result.roles[0]);
                        sessionStorage.setItem("company_name", result.company_name);
                        sessionStorage.setItem("name", result.firstname);
                        $location.path('/home');
                    }
                }
            }
        });
    };

    var $ctrl = this;

    $scope.requestPassword = function (pass) {
        $scope.loader = true;
        entePool.postDataCall(requestNewPasswordObj, pass, function (result) {
            if(result !== 'error'){
                if (result.status !== undefined && result.status !== null) {
                    $scope.loader = false;
                    if (result.status === 'failed') {
                        $scope.dlgAlert(result.message, result.status);
                    } else {
                        $scope.dlgAlert(result.message, result.status, '/login');
                    }
                }
            }
        });
    };

    $scope.resetPassword = function (pass) {
        var newPassword = hex_sha512(pass.password);
        var postData = '{"password":"' + newPassword + '", "hex":"' + $routeParams.hex + '"}';
        $scope.loader = true;
        entePool.postDataCall(resetPasswordObj, postData, function (result) {
            if(result !== 'error'){
                if (result.status !== undefined && result.status !== null) {
                    $scope.loader = false;
                    if (result.status === 'failed') {
                        $scope.dlgAlert(result.message, result.status, '/login');
                    } else {
                        $scope.dlgAlert(result.message, result.status, '/login');
                    }
                }
            }
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
        })

        modalInstance.result.then(function (selectedItem) {
          $ctrl.selected = selectedItem;
        }, function () {
          $log.info('modal-component dismissed at: ' + new Date());
        });
      };

}]);