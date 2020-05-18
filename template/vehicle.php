<div class="loading" ng-show="loader">
    <div class="loader"></div>
</div>
<div class="wrapper container-fluid" id="main">
    <form id="vehicleForm" name="vehicleForm" class="row form" ng-submit="submitForm(vehicle)" validate>
        <div class="fixed-top section-top">
            <div class="container background-white">
                <div class="row mb-2 col-md-12">
                    <div class="col">
                        <fieldset>
                            <a class="btn btn-secondary w-100px" href="/vehicles">Back</a>
                            <button class="btn btn-success color_white w-100px" type="submit" ng-if="!loader">Save</button>
                            <button ng-if="loader" class="btn btn-primary color_white w-100px" disabled>Processing ...</button>
                        </fieldset>
                    </div>
                </div>
                <div class="row mb-2 col-md-12">
                    <div class="col">
                        <a name="detail"></a><h3>{{vehicle.make}} {{vehicle.rego}}</h3>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="w-100 bar-group" role="group" aria-label="Basic example">
                        <div class="bar-block col-md-3">
                            <div class="w-100 bar-top">
                                <a href="/vehicle/{{vehicle.id}}#detail">Vehicle Details</a>
                            </div>
                        </div>
                        <div class="bar-block col-md-3">
                            <div class="w-100 bar-top">
                                <a href="/vehicle/{{vehicle.id}}#booking">Booking Products</a>
                            </div>
                        </div>
                        <div class="bar-block col-md-3">
                            <div class="w-100 bar-top">
                                <a href="/vehicle/{{vehicle.id}}#dash">Vehicle Dashboard</a>
                            </div>
                        </div>
                        <div class="bar-block col-md-3">
                            <div class="w-100 bar-top">
                                <a href="/vehicle/{{vehicle.id}}#history">Vehicle History</a>
                            </div>
                        </div>
                    </div>
                    <div class="w-100 long-bar"></div>
                    <div class="w-25 long-bar long-bar-active"></div>
                </div>
            </div>
        </div>
        <div class="col-md-12 p-w-60" style="padding-top: 180px;">
            <h4>Vehicle Status</h4>
        </div>
        <fieldset class="form-group col-md-6 p-w-60">
            <label>Booking Status</label>
            <input type="text" ng-model="vehicle.booking_status" class="form-control" placeholder="Booking Status" id="status" name="status" disabled />
        </fieldset>
        <fieldset class="form-group col-md-6 p-w-60">
            <label>Set Status</label>
            <select class="form-control" required name="car_status" id="car_status" ng-model="vehicle.car_status">
                <option value="">Please Select</option>
                <option value="Available">Available</option>
                <option value="Maintenance">Maintenance</option>
                <option value="Sold">Sold</option>
                <option value="Not in circulation">Not in circulation</option>
            </select>
            <span ng-if="(vehicleForm.car_status.$touched && vehicleForm.car_status.$invalid) || (workplaceFormSubmitted && vehicleForm.car_status.$invalid)" class="error">Set Status is required.</span>
        </fieldset>
        <div class="col-md-12 p-w-60">
            <h4>Vehicle Details</h4>
        </div>
        <fieldset class="form-group col-md-6 p-w-60">
            <label>Registration Number: *</label>
            <input type="text" ng-model="vehicle.rego" class="form-control" placeholder="Registration Number" id="rego" name="rego" required />
            <span ng-if="(vehicleForm.rego.$touched && vehicleForm.rego.$invalid) || (workplaceFormSubmitted && vehicleForm.rego.$invalid)" class="error">Registration Number is required.</span>
        </fieldset>
        <fieldset class="form-group col-md-6 p-w-60">
            <label>Vehicle Primary Location: *</label><span style="display:none">{{vehicle.vehicle_primary_location.id}}</span>
            <select class="form-control" required name="vehicle_primary_location" id="vehicle_primary_location" ng-model="vehicle.vehicle_primary_location">
                <option value="">Please Select</option>
                <option ng-repeat="loc in locationLists" value="{{loc.id}}" ng-selected="vehicle.vehicle_primary_location.id == loc.id">{{loc.address}}</option>
            </select>
            <span ng-if="(vehicleForm.vehicle_primary_location.$touched && vehicleForm.vehicle_primary_location.$invalid) || (workplaceFormSubmitted && vehicleForm.vehicle_primary_location.$invalid)" class="error">Car Pool vehicle Name is required.</span>
        </fieldset>

        <fieldset class="form-group col-md-6 p-w-60">
            <label>Make: *</label>
            <input type="text" ng-model="vehicle.make" class="form-control" placeholder="Make" id="make" name="make" required />
            <span ng-if="(vehicleForm.make.$touched && vehicleForm.make.$invalid) || (workplaceFormSubmitted && vehicleForm.make.$invalid)" class="error">Make is required.</span>
        </fieldset>
        <fieldset class="form-group col-md-6 p-w-60">
            <label>Model: *</label>
            <input type="text" ng-model="vehicle.model" class="form-control" placeholder="Model" id="model" name="model" required />
            <span ng-if="(vehicleForm.model.$touched && vehicleForm.model.$invalid) || (workplaceFormSubmitted && vehicleForm.model.$invalid)" class="error">Model is required.</span>
        </fieldset>

        <fieldset class="form-group col-md-6 p-w-60">
            <label>Vehicle Type: *</label>
            <select class="form-control" required name="type" id="type" ng-model="vehicle.type">
                <option value="">Please Select</option>
                <option value="Hatch">Hatch</option>
                <option value="Sedan">Sedan</option>
                <option value="Wagon">Wagon</option>
                <option value="SUV">SUV</option>
                <option value="Van">Van</option>
                <option value="Ute">Ute</option>
                <option value="Truck">Truck</option>
                <option value="Autonomous">Autonomous</option>
            </select>
            <span ng-if="(vehicleForm.type.$touched && vehicleForm.type.$invalid) || (workplaceFormSubmitted && vehicleForm.type.$invalid)" class="error">Vehicle Type is required.</span>
        </fieldset>



        <fieldset class="form-group col-md-6 p-w-60">
            <label>Vehicle Size: *</label>
            <select class="form-control" required name="size" id="size" ng-model="vehicle.size">
                <option value="">Please Select</option>
                <option value="Small">Small</option>
                <option value="Medium">Medium</option>
                <option value="Large">Large</option>
            </select>
            <span ng-if="(vehicleForm.size.$touched && vehicleForm.size.$invalid) || (workplaceFormSubmitted && vehicleForm.size.$invalid)" class="error">Vehicle Size is required.</span>
        </fieldset>

        <fieldset class="form-group col-md-6 p-w-60">
            <label>Fuel: *</label>
            <select class="form-control" required name="fuel" id="fuel" ng-model="vehicle.fuel">
                <option value="">Please Select</option>
                <option value="Petrol">Petrol</option>
                <option value="Deisel">Deisel</option>
                <option value="LPG">LPG</option>
                <option value="Hybrid (Elec / Petrol)">Hybrid (Elec / Petrol)</option>
                <option value="Hybrid (Elec / Deisel)">Hybrid (Elec / Deisel)</option>
                <option value="Electric">Electric</option>
            </select>
            <span ng-if="(vehicleForm.fuel.$touched && vehicleForm.fuel.$invalid) || (workplaceFormSubmitted && vehicleForm.fuel.$invalid)" class="error">Fuel is required.</span>
        </fieldset>
        <fieldset class="form-group col-md-6 p-w-60">
            <label>Transmission: *</label>
            <select class="form-control" required name="transmission" id="transmission" ng-model="vehicle.transmission">
                <option value="">Please Select</option>
                <option value="Manual">Manual</option>
                <option value="Automatic">Automatic</option>
            </select>
            <span ng-if="(vehicleForm.transmission.$touched && vehicleForm.transmission.$invalid) || (workplaceFormSubmitted && vehicleForm.transmission.$invalid)" class="error">Transmission is required.</span>
        </fieldset>

        <fieldset class="form-group col-md-9 p-w-60">
            <label>Seats: *</label>
            <select class="form-control" required name="seats" id="seats" ng-model="vehicle.seats">
                <option value="">Please Select</option>
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
            <span ng-if="(vehicleForm.seats.$touched && vehicleForm.seats.$invalid) || (workplaceFormSubmitted && vehicleForm.seats.$invalid)" class="error">Seats is required.</span>
        </fieldset>

        <fieldset class="form-group col-md-9 p-w-60">
            <label>Licence Restrictions: *</label>
            <select class="form-control" required name="licence_retrictions" id="licence_retrictions" ng-model="vehicle.licence_retrictions">
                <option value="">Please Select</option>
                <option value="Standard NSW full drivers licence">Standard NSW full drivers licence</option>
                <option value="Heavy vehicle licence">Heavy vehicle licence</option>
            </select>
            <span ng-if="(vehicleForm.licence_retrictions.$touched && vehicleForm.licence_retrictions.$invalid) || (workplaceFormSubmitted && vehicleForm.licence_retrictions.$invalid)" class="error">Licence restrictions is required.</span>
        </fieldset>

        <fieldset class="form-group col-md-9 p-w-60">
            <label>Entepool Beacon ID: *</label>
            <input type="text" ng-model="vehicle.entepool_beacon_id" class="form-control" placeholder="Entepool Beacon ID" id="entepool_beacon_id" name="entepool_beacon_id" required />
            <span ng-if="(vehicleForm.entepool_beacon_id.$touched && vehicleForm.entepool_beacon_id.$invalid) || (workplaceFormSubmitted && vehicleForm.entepool_beacon_id.$invalid)" class="error">Entepool Beacon ID is required.</span>
        </fieldset>

        <div class="form-group col-lg-4 p-w-60">
            <label>Vehicle Primary Photographs: *</label>
            <div ng-hide="vehicle.vehicle_image[0].path">
                <button class="btn-image" ng-click="showUploadImageModal(0)" type="button">+</button>
            </div>
            <div ng-show="vehicle.vehicle_image[0].path">
                <img src="{{vehicle.vehicle_image[0].path}}" height="120" ng-click="showUploadImageModal(0)" />
            </div>
        </div>
        <div class="form-group col-md-4 p-w-60">
            <label>Vehicle Secondary Photographs:</label>
            <div ng-hide="vehicle.vehicle_image[1].path">
                <button class="btn-image" ng-click="showUploadImageModal(1)" type="button">+</button>
            </div>
            <div ng-show="vehicle.vehicle_image[1].path">
                <img src="{{vehicle.vehicle_image[1].path}}" height="120" ng-click="showUploadImageModal(1)" />
            </div>
        </div>
        <div class="form-group col-md-4 p-w-60">
            <label>&nbsp;</label>
            <div ng-hide="vehicle.vehicle_image[2].path">
                <button class="btn-image" ng-click="showUploadImageModal(2)" type="button">+</button>
            </div>
            <div ng-show="vehicle.vehicle_image[2].path">
                <img src="{{vehicle.vehicle_image[2].path}}" height="120" ng-click="showUploadImageModal(2)" />
            </div>
        </div>

        <div class="col-md-12 p-w-60">
            <h4>Additional details</h4>
        </div>
        <fieldset class="form-group col-md-12 p-w-60">
            <label>Additional Information: *</label>
            <textarea ng-model="vehicle.additional_information" name="vehicle.additional_information" rows="3" class="form-control"></textarea>
            <span ng-if="(vehicleForm.additional_information.$touched && vehicleForm.additional_information.$invalid) || (workplaceFormSubmitted && vehicleForm.additional_information.$invalid)" class="error">Additional detailsis required.</span>
        </fieldset>

        <fieldset class="form-group col-sm-9 p-w-60">
            <label>Additional Features:</label>
            <input type="text" ng-model="additionFeature" uib-typeahead="feature as feature.feature for feature in features | filter:{feature:$viewValue} | limitTo:8" class="form-control" placeholder="Additional Features" id="feature" name="feature" autocomplete="off" />
            <table class="table">
                <tbody>
                <tr ng-repeat="feature in vehicle.vehicle_features">
                    <td ng-if="feature.feature">{{feature.feature}}</td>
                    <td ng-if="!feature.feature">{{feature}}</td>
                    <td><a href="" ng-click="removeFeature($index)"><i class="material-icons">highlight_off</i></a></td>
                </tr>
                </tbody>
            </table>
            <div class="col-sm-12" style="margin-top: 20px; margin-bottom: 20px;" ng-if="vehicle.vehicle_features.length === 0">
                <div class="alert alert-warning">No result found</div>
            </div>
        </fieldset>

        <fieldset class="form-group col-sm-3 p-w-60">
            <label>&nbsp;</label>
            <button class="btn btn-success" type="button" ng-click="addFeature(additionFeature)" ng-disabled="!additionFeature">Add</button>
        </fieldset>
        <fieldset class="form-group col-md-9 p-w-60">
            <label>Kilometres: *</label>
            <input type="text" ng-model="vehicle.kilometres" class="form-control" placeholder="Kilometres" id="kilometres" name="kilometres" required />
            <span ng-if="(vehicleForm.kilometres.$touched && vehicleForm.kilometres.$invalid) || (workplaceFormSubmitted && vehicleForm.kilometres.$invalid)" class="error">Kilometres is required.</span>
        </fieldset>

        <!--  <div class="col-md-12">
             <h4>Cost Centre</h4>
         </div>
         <fieldset class="form-group col-md-9">
             <label>Select Cost Centre: *</label>
             <select class="form-control" required name="cost_centre" id="cost_centre" ng-model="vehicle.cost_centre">
                 <option value="">Please Select</option>
             </select>
             <span ng-if="(vehicleForm.cost_centre.$touched && vehicleForm.cost_centre.$invalid) || (workplaceFormSubmitted && vehicleForm.cost_centre.$invalid)" class="error">Cost Centre is required.</span>
         </fieldset> -->

        <fieldset class="form-group col-md-12 p-w-60">
            <button class="btn btn-success" type="submit" ng-if="!loader">Submit</button>
            <button ng-if="loader" class="btn btn-primary" disabled>Processing ...</button>
        </fieldset>
    </form>
    <div class="row p-w-60">
        <div class="col">
            <a name="booking"></a><h3>Booking Products</h3>
        </div>
    </div>
    <div class="row p-w-60">
        <div class="col">
            <a name="dash"></a><h3>Vehicle Dashboard</h3>
        </div>
    </div>
    <div class="row p-w-60">
        <div class="col">
            <a name="history"></a><h3>Vehicle History</h3>
        </div>
    </div>
</div>

<div class="modal fade" id="upload-image-modal" tabindex="-1" role="dialog" aria-labelledby="uploadImageLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadImageLabel">Upload Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="form.formImage" id="form-image">
                    <div class="row">
                        <div class="col">
                            <input type="file" class="form-control" id="fileImage" name="fileImage" ng-model="formImageData.fileImage" img-upload onchange="angular.element(this).scope().showImageFunction()">
                            <img ng-src="{{image}}" height="100" width="100" ng-if="showImage"/>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" ng-click="submitformImage(image)" ng-disabled="form.formImage.$invalid">Save changes</button>
            </div>
        </div>
    </div>
</div>
