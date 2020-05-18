<div class="loading" ng-show="loader">
    <div class="loader"></div>
</div>
<div class="wrapper container-fluid" id="main">
    <div class="row mb-2">
        <div class="col">
            <h3>Search Entepool for a company car pool vehicle</h3>
        </div>
    </div>
    <div class="row">
        <!-- default form -->
        <div class="col-md-12" ng-if="isDefault">
            <div class="panel panel-default">
                <div class="panel-body search-term">
                    <fieldset class="form-group col-md-12">
                        <h4>Search Criteria</h4>
                    </fieldset>
                </div>
            </div>
            <div class="panel panel-default" ng-show="searchTermExist">
                <div class="panel-body search-term search-term-whole mb-4">
                    <span ng-repeat="item in searchTerm.location" class="item">{{item}} <a title="Remove" ng-click="deleteTerm('location', $index)" class="remove">×</a></span>
                    <span ng-repeat="item in searchTerm.type" class="item">{{item}} <a title="Remove" ng-click="deleteTerm('type', $index)" class="remove">×</a></span>
                    <span ng-repeat="item in searchTerm.transmission" class="item">{{item}} <a title="Remove" ng-click="deleteTerm('transmission', $index)" class="remove">×</a></span>
                    <span ng-repeat="item in searchTerm.seats" class="item">{{item}} <a title="Remove" ng-click="deleteTerm('seats', $index)" class="remove">×</a></span>
                    <span ng-repeat="item in searchTerm.size" class="item">{{item}} <a title="Remove" ng-click="deleteTerm('size', $index)" class="remove">×</a></span>
                    <span ng-repeat="item in searchTerm.fuel" class="item">{{item}} <a title="Remove" ng-click="deleteTerm('fuel', $index)" class="remove">×</a></span>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-body search-term">
                    <fieldset class="form-group col-md-12">
                        <label for="qr_sub">Location</label>
                        <select class="form-control" ng-model="location" ng-change="constructSearchTerm(location, 'location')">
                            <option ng-repeat="location in locationLists | orderBy : 'address'" ng-value="location.address">{{location.address}}</option>
                        </select>
                    </fieldset>
                    <fieldset class="form-group col-md-6 float-left">
                        <label for="qr_sub">Type</label>
                        <select class="form-control" ng-model="type" ng-change="constructSearchTerm(type, 'type')">
                            <option value="Hatch">Hatch</option>
                            <option value="Sedan">Sedan</option>
                            <option value="Wagon">Wagon</option>
                            <option value="SUV">SUV</option>
                            <option value="Van">Van</option>
                            <option value="Ute">Ute</option>
                            <option value="Truck">Truck</option>
                            <option value="Autonomous">Autonomous</option>
                        </select>
                    </fieldset>
                    <fieldset class="form-group col-md-6 float-left">
                        <label for="qr_sub">Transmission</label>
                        <select class="form-control" ng-model="transmission" ng-change="constructSearchTerm(transmission, 'transmission')">
                            <option value="Manual">Manual</option>
                            <option value="Automatic">Automatic</option>
                        </select>
                    </fieldset>
                    <fieldset class="form-group col-md-6 float-left">
                        <label for="qr_sub">Seats</label>
                        <select class="form-control" ng-model="seats" ng-change="constructSearchTerm(seats, 'seats')">
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="12+">12+</option>
                        </select>
                    </fieldset>
                    <fieldset class="form-group col-md-6 float-left">
                        <label for="qr_sub">Size</label>
                        <select class="form-control" ng-model="size" ng-change="constructSearchTerm(size, 'size')">
                            <!-- <option ng-repeat="sizeOption in sizeOptions | orderBy : 'text'" ng-value="sizeOption.value">{{sizeOption.text}}</option> -->
                            <option value="Small">Small</option>
                            <option value="Medium">Medium</option>
                            <option value="Large">Large</option>
                        </select>
                    </fieldset>
                    <fieldset class="form-group col-md-6 float-left">
                        <label for="qr_sub">Fuel Type</label>
                        <select class="form-control" ng-model="fuel" ng-change="constructSearchTerm(fuel, 'fuel')">
                            <option value="Petrol">Petrol</option>
                            <option value="Diesel">Diesel</option>
                            <option value="LPG">LPG</option>
                            <option value="Hybrid (Elec / Petrol)">Hybrid (Elec / Petrol)</option>
                            <option value="Hybrid (Elec / Diesel)">Hybrid (Elec / Diesel)</option>
                            <option value="Electric">Electric</option>
                        </select>
                    </fieldset>
                    <fieldset class="form-group col-md-12 float-left">
                        <h4>Vehicle Booking Type</h4>
                    </fieldset>
                    <fieldset class="form-group col-md-12 float-left">
                        <label for="qr_sub">Booking Type</label>
                        <select class="form-control" ng-model="booking_type">
                            <option value="">-- Please Select --</option>
                        </select>
                    </fieldset>
                    <fieldset class="form-group col-md-6 float-left">
                        <label for="qr_sub">Start Date</label>
                        <input class="form-control" type="text" ng-model="start_date">
                    </fieldset>
                    <fieldset class="form-group col-md-6 float-left">
                        <label for="qr_sub">End Date</label>
                        <input class="form-control" type="text" ng-model="end_date">
                    </fieldset>
                    <fieldset class="form-group col-md-6 float-left">
                        <button type="button" class="btn btn-primary" ng-click="searchResultFunction(searchTerm)" ng-disabled="disableSearchButton">Search</button>
                        <button type="button" class="btn btn-default" ng-click="clear()">Clear</button>
                    </fieldset>
                </div>
            </div>
        </div>
        <!-- end of default form -->
        <div class="col-md-4" ng-if="!isDefault">
            <div class="panel panel-default" ng-show="searchTermExist">
                <div class="panel-body search-term search-term-whole mb-4">
                    <h4>Search Criteria</h4>
                    <span ng-repeat="item in searchTerm.location" class="item">{{item}} <a title="Remove" ng-click="deleteTerm('location', $index)" class="remove">×</a></span>
                    <span ng-repeat="item in searchTerm.type" class="item">{{item}} <a title="Remove" ng-click="deleteTerm('type', $index)" class="remove">×</a></span>
                    <span ng-repeat="item in searchTerm.transmission" class="item">{{item}} <a title="Remove" ng-click="deleteTerm('transmission', $index)" class="remove">×</a></span>
                    <span ng-repeat="item in searchTerm.seats" class="item">{{item}} <a title="Remove" ng-click="deleteTerm('seats', $index)" class="remove">×</a></span>
                    <span ng-repeat="item in searchTerm.size" class="item">{{item}} <a title="Remove" ng-click="deleteTerm('size', $index)" class="remove">×</a></span>
                    <span ng-repeat="item in searchTerm.fuel" class="item">{{item}} <a title="Remove" ng-click="deleteTerm('fuel', $index)" class="remove">×</a></span>
                    <span ng-repeat="item in searchTerm.hbmtype" class="item">{{item}} <a title="Remove" ng-click="deleteTerm('hbmtype', $index)" class="remove">×</a></span>
                    <span ng-repeat="item in searchTerm.risk" class="item">{{item}} <a title="Remove" ng-click="deleteTerm('risk', $index)" class="remove">×</a></span>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-body search-term">
                    <p><label for="qr_sub">Location</label>
                    <select class="form-control" ng-model="location" ng-change="constructSearchTerm(location, 'location')">
                        <option ng-repeat="location in locationLists | orderBy : 'address'" ng-value="location.address">{{location.address}}</option>
                    </select>
                    </p>
                    <p><label for="qr_sub">Type</label>
                    <select class="form-control" ng-model="type" ng-change="constructSearchTerm(type, 'type')">
                        <!-- <option ng-repeat="facidOption in facidOptions | orderBy : 'text'" ng-value="facidOption.value">{{facidOption.text}}</option> -->
                        <option value="Hatch">Hatch</option>
                        <option value="Sedan">Sedan</option>
                        <option value="Wagon">Wagon</option>
                        <option value="SUV">SUV</option>
                        <option value="Van">Van</option>
                        <option value="Ute">Ute</option>
                        <option value="Truck">Truck</option>
                        <option value="Autonomous">Autonomous</option>
                    </select></p>

                     <p><label for="qr_sub">Transmission</label>
                    <select class="form-control" ng-model="transmission" ng-change="constructSearchTerm(transmission, 'transmission')">
                        <!-- <option ng-repeat="transmissionOption in transmissionOptions" ng-value="transmissionOption.value">{{transmissionOption.text}}</option> -->
                        <option value="Manual">Manual</option>
                        <option value="Automatic">Automatic</option>
                    </select></p>
                    <p><label for="qr_sub">Seats</label>
                    <select class="form-control" ng-model="seats" ng-change="constructSearchTerm(seats, 'seats')">
                        <!-- <option ng-repeat="seatsOption in seatsOptions | orderBy : 'text'" ng-value="seatsOption.value">{{seatsOption.text}}</option> -->
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="12+">12+</option>
                    </select></p>

                    <p><label for="qr_sub">Size</label>
                    <select class="form-control" ng-model="size" ng-change="constructSearchTerm(size, 'size')">
                        <!-- <option ng-repeat="sizeOption in sizeOptions | orderBy : 'text'" ng-value="sizeOption.value">{{sizeOption.text}}</option> -->
                        <option value="Small">Small</option>
                        <option value="Medium">Medium</option>
                        <option value="Large">Large</option>
                    </select></p>
                    <p><label for="qr_sub">Fuel Type</label>
                    <select class="form-control" ng-model="fuel" ng-change="constructSearchTerm(fuel, 'fuel')">
                        <option value="Petrol">Petrol</option>
                        <option value="Diesel">Diesel</option>
                        <option value="LPG">LPG</option>
                        <option value="Hybrid (Elec / Petrol)">Hybrid (Elec / Petrol)</option>
                        <option value="Hybrid (Elec / Diesel)">Hybrid (Elec / Diesel)</option>
                        <option value="Electric">Electric</option>
                    </select></p>
                </div>
            </div>
            <button type="button" class="btn btn-success" ng-click="searchResultFunction(searchTerm)" ng-disabled="disableSearchButton">Search</button>
            <button type="button" class="btn btn-default" ng-click="clear()">Clear</button>
        </div>

        <div class="col-md-8" ng-if="searchResultShow">
            <h4>Available Vehicles</h4>
            <div class="card w-100 mb-2 card-custom" ng-repeat="singleResult in searchResult">
                <div class="row">
                    <div class="col-md-5">
                        <div class="card-img-bottom">
                            <img width="100%" ng-if="singleResult.vehicle_image[0].path !== undefined && singleResult.vehicle_image[0].path !== null" src="{{singleResult.vehicle_image[0].path}}" />
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="card-block">
                            <h4 class="card-title">{{singleResult.address}}</h4>
                            {{singleResult.make}}, {{singleResult.model}}
                            <div class="row">
                                <div class="col-md-7">
                                    <table class="table border-0">
                                        <tr>
                                            <td class="border-0">Transmission</td>
                                            <td  class="border-0"><div class="b-gray-round">{{singleResult.transmission}}</div></td>
                                        </tr>
                                        <tr>
                                            <td  class="border-0">Seats</td><td  class="border-0"><div class="b-gray-round">{{singleResult.seats}}</div></td>
                                        </tr>
                                        <tr>
                                            <td  class="border-0">Size</td><td  class="border-0"><div class="b-gray-round">{{singleResult.size}}</div></td>
                                        </tr>
                                        <tr>
                                            <td  class="border-0">Fuel Type</td><td  class="border-0"><div class="b-gray-round">{{singleResult.fuel}}</div></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-5">
                                    <a class="btn btn-success color_white btn-booking-box mb-2">Book</a>
                                    <a href="/vehicle/{{singleResult.id}}" class="btn btn-secondary btn-booking-box" >View More Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8" style="margin-bottom: 20px;" ng-if="!searchResultShow&&!isDefault">
            <h4>Available Vehicles</h4>
            <div class="alert alert-warning">No result found</div>
        </div>
    </div>
</div>