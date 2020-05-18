'use strict';

var app = angular.module('App', ['ngSanitize', 'ngAnimate', 'ngRoute', 'ui.bootstrap', 'angucomplete-alt', 'ui.bootstrap.datetimepicker', 'ui.dateTimeInput', 'angular.filter','moment-picker']);

// app.config(['weeklySchedulerLocaleServiceProvider', function (localeServiceProvider) {
//     localeServiceProvider.configure({
//       doys: {'es-es': 4},
//       lang: {'es-es': {month: 'Mes', weekNb: 'número de la semana', addNew: 'Añadir'}},
//       localeLocationPattern: 'https://code.angularjs.org/1.5.8/i18n/angular-locale_{{locale}}.js'
//     });
//   }])

// var dataURLToBlob = function (dataURL) {
//     var BASE64_MARKER = ';base64,';
//     if (dataURL.indexOf(BASE64_MARKER) == -1) {
//         var parts = dataURL.split(',');
//         var contentType = parts[0].split(':')[1];
//         var raw = parts[1];

//         return new Blob([raw], { type: contentType });
//     }

//     var parts = dataURL.split(BASE64_MARKER);
//     var contentType = parts[0].split(':')[1];
//     var raw = window.atob(parts[1]);
//     var rawLength = raw.length;

//     var uInt8Array = new Uint8Array(rawLength);

//     for (var i = 0; i < rawLength; ++i) {
//         uInt8Array[i] = raw.charCodeAt(i);
//     }

//     return new Blob([uInt8Array], { type: contentType });
// }

app.config(function($routeProvider, $locationProvider) {
    $locationProvider.html5Mode(true);
    $locationProvider.hashPrefix('');
    $routeProvider.when('/login', {templateUrl: 'template/login.php',
            controller : "loginController", reloadOnSearch: true})

    $routeProvider.when('/home', {templateUrl: 'template/home.php',
            controller : "homeController", reloadOnSearch: true})

        .when('/carpool/:id', {templateUrl: 'template/carpool.php',
            controller : "carPoolController", reloadOnSearch: true})

        .when('/vehicle', {templateUrl: 'template/vehicle.php',
            controller : "vehicleController", reloadOnSearch: true})

        .when('/vehicle/:id', {templateUrl: 'template/vehicle.php',
            controller : "vehicleController", reloadOnSearch: true})

        .when('/vehicles', {templateUrl: 'template/vehicles.php',
            controller : "vehicleController", reloadOnSearch: true})

        .when('/hex/:hex', {templateUrl: 'template/password.php',
            controller : "loginController", reloadOnSearch: true})

        .when('/new_password', {templateUrl: 'template/new_password.php',
            controller : "loginController", reloadOnSearch: true})

        .when('/reset_password/:hex', {templateUrl: 'template/reset_password.php',
            controller : "loginController", reloadOnSearch: true})

        .when('/search', {templateUrl: 'template/search.php',
            controller : "searchController", reloadOnSearch: true})

        .otherwise({
            redirectTo: '/login'
        });
});


app.controller('mainController', ['$rootScope', '$scope', '$location', '$uibModal', '$log', 'entePool', function ($rootScope, $scope, $location, $modal, $log, entePool) {
    $scope.logOut = function(){
        entePool.getDataConfigCall(logoutObj, function (result) {
            if(result !== 'error'){
                if (result.status === 'failed') {
                    $scope.dlgAlert(result.message, result.status);
                } else {
                    $location.path('/login');
                    sessionStorage.clear();
                }
            }
        });
    };

    $rootScope.$on('$routeChangeSuccess', function () {
        $scope.userLogin = (sessionStorage.getItem('token') !== null && sessionStorage.getItem('token') !== undefined && sessionStorage.getItem('token') !== '');
        $scope.isAdmin = ((sessionStorage.getItem('role') !== null && sessionStorage.getItem('role') !== undefined && sessionStorage.getItem('role') !== '')&&(sessionStorage.getItem('role') === 'Company Admin'));
    });

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

// app.component('modalUploadComponent', {
//   templateUrl: '/template/dlgUploadImage.html',
//   bindings: {
//     resolve: '<',
//     close: '&',
//     dismiss: '&'
//   },
//   controller: function () {
//     var $ctrl = this;

//     $ctrl.$onInit = function () {
//       $ctrl.items = $ctrl.resolve.items;
//       $ctrl.selected = {
//         item: $ctrl.items[0]
//       };
//     };

//     $ctrl.submitformImage = function () {
//       $ctrl.close({$value: '$ctrl.selected.item'});
//     };

//     $ctrl.cancel = function () {
//       $ctrl.dismiss({$value: 'cancel'});
//     };
//   }
// });



app.component('modalAddVehicleComponent', {
  templateUrl: '/template/dlgAddVehicle.html',
  bindings: {
    resolve: '<',
    close: '&',
    dismiss: '&'
  },
  controller: function () {
    var $ctrl = this;

    $ctrl.$onInit = function () {
        // console.log($ctrl.resolve.items.vehicleAllLists)
      $ctrl.vehicleLists = $ctrl.resolve.items.vehicleAllLists;
      // $ctrl.selected = {
      //   item: $ctrl.items[0]
      // };
    };

    $ctrl.searchRego = function (data) {
        // console.log(data)
      $ctrl.rego = data;
      $ctrl.details = true;
    };

    $ctrl.assignVehicle = function (data, setting) {
        data.setting = setting;
        // debugger
        $ctrl.close({$value: data});
    };

    $ctrl.cancel = function () {
      $ctrl.dismiss({$value: 'cancel'});
    };
  }
});

app.component('modalComponent', {
  templateUrl: '/template/dlgAlert.html',
  bindings: {
    resolve: '<',
    close: '&',
    dismiss: '&'
  },
  controller: function () {
    var $ctrl = this;

    $ctrl.$onInit = function () {
      $ctrl.items = $ctrl.resolve.items;
      $ctrl.selected = {
        item: $ctrl.items[0]
      };
    };

    $ctrl.ok = function () {
      $ctrl.close({$value: '$ctrl.selected.item'});
    };

    $ctrl.cancel = function () {
      $ctrl.dismiss({$value: 'cancel'});
    };
  }
});

app.directive('imgUpload', ['$rootScope', function (rootScope) {
    return {
        restrict: 'A',
        link: function (scope, elem, attrs) {
            var canvas = document.createElement("canvas");
            var extensions = 'jpeg ,jpg, png, gif';
            elem.on('change', function () {
                // var filesSelected = elem[0].files[0];

                // if (filesSelected.length > 0) {  
                var file = elem[0].files[0];

                if (file.type.match('image.*')) {
                    var reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = function (e) {
                        var image = new Image();
                        image.onload = function (imageEvent) {

                            // Resize the image using canvas  
                            var canvas = document.createElement('canvas'),
                                max_size = 500,// TODO : max size for a pic  
                                width = image.width,
                                height = image.height;
                            if (width > height) {
                                if (width > max_size) {
                                    height *= max_size / width;
                                    width = max_size;
                                }
                            } else {
                                if (height > max_size) {
                                    width *= max_size / height;
                                    height = max_size;
                                }
                            }
                            canvas.width = width;
                            canvas.height = height;
                            canvas.getContext('2d').drawImage(image, 0, 0, width, height);

                            //Getting base64 string;  
                            var dataUrl = canvas.toDataURL('image/jpeg');

                            //Getting blob data  
                            // RESIZED_IMAGE = dataURLToBlob(dataUrl);
                            scope.image = dataUrl;
                            scope.imageName = elem[0].files[0].name;
                            scope.$apply();
                        }
                        image.src = e.target.result;
                        // scope.image = e.target.result;  
                    }
                    // }  
                };
            });
        }
    }
}]);

