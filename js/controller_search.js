app.controller('searchController', ['$scope', '$http', '$uibModal', '$location', '$window', '$timeout', '$filter', 'entePool', function($scope, $http, $modal, $location, $window, $timeout, $filter, entePool) {

    $scope.isDefault = true;
    $scope.searchResultShow = false;
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
    };
    $scope.getLocation();

    $scope.clear = function(){
        $scope.searchTerm = {location:[],type:[],transmission:[],seats:[],size:[],fuel:[]};
        $scope.searchTermExist = false;
        $scope.searchResultShow = false;
        $scope.isDefault = true;
    };

    // $scope.loader = true;
    $scope.exporting = false;
    $scope.sortBy = "risk_order";
    $scope.filteredTodos = [];
    $scope.currentPage = 1;
    $scope.itemsPerPage = 25;
    $scope.searchTermExist = false;
    $scope.export = "Export to PDF";

    $scope.disableSearchButton = true;

    $scope.searchResultFunction = function(result){
        $scope.loader = true;
        entePool.postDataConfigCall(searchObject, result, function(data) {
            $scope.currentPage = 1;
            $scope.searchResult = data.data;
            $scope.totalItems = data.data.length;
            $scope.loader = false;
            $scope.isDefault = false;
            if($scope.totalItems !== 0){
                $scope.searchResultShow = true;
            }
        });
    };

    $scope.sortFunction =  function(result, orderby){
        $scope.searchResult = $filter('orderBy')(result, orderby);
        // $scope.$digest();
    };

    $scope.factypeOptions = [];
    $scope.facidOptions = [];
    $scope.seatsOptions = [];
    $scope.sizeOptions = [];
    $scope.transmissionOptions = [];
    $scope.hbm_fuel_typeOptions = [];
    $scope.hbm_typeOptions = [];
    $scope.riskOptions = [];
    $scope.searchTerm = {location:[],type:[],transmission:[],seats:[],size:[],fuel:[]};

    $scope.deleteTerm = function(object, index){
        // $scope.searchTerm.push({value: result, text: result})
        if(object === 'location'){
            $scope.searchTerm.location.splice(index,1);
        }
        if(object === 'type'){
            $scope.searchTerm.type.splice(index,1);
        }
        if(object === 'transmission'){
            $scope.searchTerm.transmission.splice(index,1);
        }
        if(object === 'seats'){
            $scope.searchTerm.seats.splice(index,1);
        }
        if(object === 'size'){
            $scope.searchTerm.size.splice(index,1);
        }
        if(object === 'fuel'){
            $scope.searchTerm.fuel_type.splice(index,1);
        }

        if(
            $scope.searchTerm.location.length === 0 &&
            $scope.searchTerm.type.length === 0 &&
            $scope.searchTerm.transmission.length === 0 &&
            $scope.searchTerm.seats.length === 0 &&
            $scope.searchTerm.size.length === 0 &&
            $scope.searchTerm.fuel.length === 0
            ){
            $scope.disableSearchButton = true;
        }
    };

    $scope.constructSearchTerm = function(result, object){
        // $scope.searchTerm.push({value: result, text: result})
        if(object === 'location'){
            $scope.searchTerm.location.push(result);
            $scope.location = '';
        }
        if(object === 'type'){
            $scope.searchTerm.type.push(result);
            $scope.type = '';
        }
        if(object === 'transmission'){
            $scope.searchTerm.transmission.push(result);
            $scope.transmission = '';
        }
        if(object === 'seats'){
            $scope.searchTerm.seats.push(result);
            $scope.seats = '';
        }
        if(object === 'size'){
            $scope.searchTerm.size.push(result);
            $scope.size = '';
        }
        if(object === 'fuel'){
            $scope.searchTerm.fuel.push(result);
            $scope.fuel = '';
        }
        $scope.searchTermExist = true;
        $scope.disableSearchButton = false;
    }
        
    // $http.get(searchObject)
    //     .success(function(data) {
    //         $timeout(function(){
    //             for(var i = 0; i < data.location.length; i++){
    //               $scope.factypeOptions.push({value: data.location[i].value, text: data.location[i].value})
    //             }
    //             for(var i = 0; i < data.type.length; i++){
    //               $scope.facidOptions.push({value: data.type[i].value, text: data.type[i].value})
    //             }
    //             for(var i = 0; i < data.seats.length; i++){
    //               $scope.seatsOptions.push({value: data.seats[i].value, text: data.seats[i].value})
    //             }
    //             for(var i = 0; i < data.size.length; i++){
    //               $scope.sizeOptions.push({value: data.size[i].value, text: data.size[i].value})
    //             }
    //             for(var i = 0; i < data.transmission.length; i++){
    //               $scope.transmissionOptions.push({value: data.transmission[i].name, text: data.transmission[i].name})
    //             }
    //             for(var i = 0; i < data.hbm_fuel_type.length; i++){
    //               $scope.hbm_fuel_typeOptions.push({value: data.hbm_fuel_type[i].name, text: data.hbm_fuel_type[i].name})
    //             }
    //             for(var i = 0; i < data.hbm_type.length; i++){
    //               $scope.hbm_typeOptions.push({value: data.hbm_type[i].name, text: data.hbm_type[i].name})
    //             }
    //             for(var i = 0; i < data.risk.length; i++){
    //               $scope.riskOptions.push({value: data.risk[i].name, text: data.risk[i].name})
    //             }
    //             $scope.loader = false;
    //         }, 0)
    //     });

}]);