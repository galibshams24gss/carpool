<div class="loading" ng-show="loader">
    <div class="loader"></div>
</div>
<div class="wrapper container-fluid" id="main">
    <form id="locationForm" name="locationForm" class="form" ng-submit="submitForm(location, locationForm)" validate>
    <div class="fixed-top section-top">
        <div class="container background-white">
            <div class="row mb-2">
                <div class="col">
                    <fieldset>
                        <a class="btn btn-secondary w-100px" href="/home">Back</a>
                        <button class="btn btn-success color_white w-100px" type="submit" ng-if="!loader" ng-disabled="locationForm.$invalid">Save</button>
                        <button ng-if="loader" class="btn btn-primary color_white w-100px" disabled>Processing ...</button>
                    </fieldset>
                </div>
            </div>
            <div class="row mb-2" ng-if="!newLocation">
                <div class="col">
                    <h3>{{location.pool_name}}</h3>
                </div>
            </div>
            <div class="row mb-4" ng-if="!newLocation">
                <div class="w-100 bar-group" role="group" aria-label="Basic example">
                    <div class="bar-block col-md-3">
                        <div class="w-100 bar-top">
                            <a href="/carpool/{{location.id}}#loc">Location Details</a>
                        </div>
                    </div>
                    <div class="bar-block col-md-3">
                        <div class="w-100 bar-top">
                            <a href="/carpool/{{location.id}}#dash">Dashboard</a>
                        </div>
                    </div>
                    <div class="bar-block col-md-3">
                        <div class="w-100 bar-top">
                            <a href="/carpool/{{location.id}}#pool">Pool Vehicles</a>
                        </div>
                    </div>
                    <div class="bar-block col-md-3">
                        <div class="w-100 bar-top">
                            <a href="/carpool/{{location.id}}#group">Location User Groups</a>
                        </div>
                    </div>
                </div>
                <div class="w-100 long-bar"></div>
                <div class="w-25 long-bar long-bar-active"></div>
            </div>
        </div>
    </div>
    <div class="row" style="padding-top: 165px;" ng-if="!newLocation"></div>
    <div class="row mb-4" ng-if="newLocation" style="padding-top: 70px;">
        <div class="col">
            <h3>Create Car Pool Location</h3>
        </div>
    </div>
    <div class="row mb-2 p-w-60">
        <div class="col">
            <a name="loc"></a><h4>Car Pool Location</h4>
                <fieldset class="form-group col-xs-7">
                    <label>Car Pool Location Name</label>
                    <input type="text" ng-model="location.pool_name" class="form-control" placeholder="Car Pool Location Name" id="pool_name" name="pool_name" required />
                    <span ng-if="(locationForm.pool_name.$touched && locationForm.pool_name.$invalid) || (workplaceFormSubmitted && locationForm.pool_name.$invalid)" class="error">Car Pool Location Name is required.</span>
                </fieldset>
                <fieldset class="form-group col-xs-7">
                    <label>Location Address</label>
                    <input type="text" ng-model="location.address" class="form-control" placeholder="Location Address" id="address" name="address" required />
                    <span ng-if="(locationForm.address.$touched && locationForm.address.$invalid) || (workplaceFormSubmitted && locationForm.address.$invalid)" class="error">Location Address is required.</span>
                    <div id="map" style="height: 500px; width:100%;margin-top: 20px;" ng-show="location.address"></div>
                </fieldset>
                <fieldset class="form-group col-xs-12">
                    <label for="Access Information">Access Information</label>
                    <textarea type="text" ng-model="location.access_information" class="form-control" id="access_information" name="access_information" required rows="5"></textarea>
                    <span ng-if="(locationForm.access_information.$touched && locationForm.access_information.$invalid) || (workplaceFormSubmitted && locationForm.access_information.$invalid)" class="error">Licence Primary Contact is required.</span>
                </fieldset>

                <div class="row form-section">
                    <div class="w-100">
                        <div class="panel-questions">
                            <h4>Location Super Users</h4>
                            <label>Email Address</label>
                            <div ng-if="(locationForm.email.$touched && locationForm.email.$invalid) || (workplaceFormSubmitted && locationForm.email.$invalid)" class="error">Check Email address.</div>
                            <input type="email" ng-model="email" class="form-control" placeholder="Email" id="email" name="email" />
                            <button type="button" class="btn btn-outline-success pointer" ng-click="addNewUser(email)" ng-disabled="!email">Add</button><br /><br />
                            <table class="table" ng-if="location.super_user">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Contact no</th>
                                        <th>Roles</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="super_user in location.super_user | orderBy:sortType:sortReverse">
                                        <td>{{super_user.first_name}} {{super_user.surname}}</td>
                                        <td>{{super_user.contact_number}}</td>
                                        <td>{{super_user.role_name}}</td>
                                        <td><a class="removeBtn" href="" ng-click="removeUser(super_user.user_id, $index)"><i class="material-icons">highlight_off</i></a></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="col-sm-12" style="margin-top: 20px; margin-bottom: 20px;" ng-if="location.super_user.length === 0">
                                <div class="alert alert-warning">No result found</div>
                            </div>
                        </div>
                    </div>
                </div>

                <fieldset>
                    <button class="btn btn-success" type="submit" ng-if="!loader" ng-disabled="locationForm.$invalid">Save</button>
                    <button ng-if="loader" class="btn btn-primary" disabled>Processing ...</button>
                </fieldset>
        </div>
    </div>
    </form>
    <div class="row mb-2 p-w-60" ng-if="!newLocation">
        <div class="col">
            <a name="dash"></a><h4>Dashboard</h4>
        </div>
    </div>
    <div class="row mb-2 p-w-60" ng-if="!newLocation">
        <div class="col">
            <a name="pool"></a><h4>Car Pool Vehicles</h4>
        </div>
    </div>
   <div class="row mb-2 p-w-60" ng-if="!newLocation">
        <div class="col-7">
            <label>Search Rego</label>
            <input type="text" class="form-control" id="search_location" name="search_location" ng-model="search.rego" placeholder="Search">
        </div>
        <div class="col-5 text-right">
            <label>&nbsp;</label>
            <button class="btn btn-success" type="button" ng-click="dlgAddVehicle()">Add</button>
        </div>
    </div>
   <div class="row mb-2 p-w-60" ng-if="!newLocation">
        <div class="col">
            <table class="table">
                <thead>
                <tr>
                    <th></th>
                    <th>
                        <a href="#" ng-click="sortType = 'rego'; sortReverse = !sortReverse">
                            Registration no
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
                        <a href="#" ng-click="sortType = 'status'; sortReverse = !sortReverse">
                            Current status
                            <span ng-show="sortType == 'status' && !sortReverse" class="fa fa-caret-down"></span>
                            <span ng-show="sortType == 'status' && sortReverse" class="fa fa-caret-up"></span>
                        </a>
                    </th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="vehicle in vehicleLists | filter:search | orderBy:sortType:sortReverse">
                        <td><a class="removeBtn" href="" ng-click="removeVehicle(vehicle.id)"><i class="material-icons">highlight_off</i></a></td>
                        <td>{{vehicle.rego}}</td>
                        <td>{{vehicle.make}}</td>
                        <td>{{vehicle.type}}</td>
                        <td>{{vehicle.car_status}}</td>
                        <td>
                            <a class="btn btn-outline-success" ng-href="/vehicle/{{vehicle.id}}">View</a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="col-sm-12" style="margin-top: 20px; margin-bottom: 20px;" ng-if="vehicleLists.length === 0">
                <div class="alert alert-warning">No result found</div>
            </div>
        </div>
    </div>
    <div class="row mb-2 p-w-60" ng-if="!newLocation">
        <div class="col">
            <a name="group"></a><h4>Location User Groups</h4>
        </div>
    </div>
</div>