<div class="loading" ng-show="loader">
    <div class="loader"></div>
</div>
<div class="wrapper container-fluid" id="main">
    <div class="row mb-2">
        <div class="col">
            <h3>Car Pool Fleet</h3>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col">
            <a class="btn btn-success" ng-href="{{baseUrl}}vehicle/new">Create New Vehicle</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table">
                <thead>
                <tr>
                    <th>
                        <a href="#" ng-click="sortType = 'rego'; sortReverse = !sortReverse">
                            Registration No.
                            <span ng-show="sortType == 'rego' && !sortReverse" class="fa fa-caret-down"></span>
                            <span ng-show="sortType == 'rego' && sortReverse" class="fa fa-caret-up"></span>
                        </a>
                    </th>
                    <th>
                        <a href="#" ng-click="sortType = 'make'; sortReverse = !sortReverse">
                            Make
                            <span ng-show="sortType == 'make' && !sortReverse" class="fa fa-caret-down"></span>
                            <span ng-show="sortType == 'make' && sortReverse" class="fa fa-caret-up"></span>
                        </a>
                    </th>
                    <th>
                        <a href="#" ng-click="sortType = 'type'; sortReverse = !sortReverse">
                            Type
                            <span ng-show="sortType == 'type' && !sortReverse" class="fa fa-caret-down"></span>
                            <span ng-show="sortType == 'type' && sortReverse" class="fa fa-caret-up"></span>
                        </a>
                    </th>
                    <th>
                        <a href="#" ng-click="sortType = 'car_status'; sortReverse = !sortReverse">
                            Current Status
                            <span ng-show="sortType == 'car_status' && !sortReverse" class="fa fa-caret-down"></span>
                            <span ng-show="sortType == 'car_status' && sortReverse" class="fa fa-caret-up"></span>
                        </a>
                    </th>
                    <th>
                        <a href="#" ng-click="sortType = 'vehicle_primary_location'; sortReverse = !sortReverse">
                            Primary Location
                            <span ng-show="sortType == 'vehicle_primary_location' && !sortReverse" class="fa fa-caret-down"></span>
                            <span ng-show="sortType == 'vehicle_primary_location' && sortReverse" class="fa fa-caret-up"></span>
                        </a>
                    </th>
                    <th>
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="vehicle in vehicleList | orderBy:sortType:sortReverse">
                    <td>{{vehicle.rego}}</td>
                    <td>{{vehicle.make}}</td>
                    <td>{{vehicle.type}}</td>
                    <td>{{vehicle.car_status}}</td>
                    <td>{{vehicle.vehicle_primary_location.address}}</td>
                    <td>
                        <a class="btn btn-outline-success" ng-href="{{baseUrl}}vehicle/{{vehicle.id}}">Edit</a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>