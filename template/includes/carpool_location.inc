<div class="col">
    <h4>Car Pool Location</h4>
    <form id="locationForm" name="locationForm" class="form" ng-submit="submitForm(location, locationForm)" validate>
        <fieldset class="form-group col-xs-7">
            <label>Car Pool Location Name</label>
            <input type="text" ng-model="location.pool_name" class="form-control" placeholder="Car Pool Location Name" id="pool_name" name="pool_name" required />
            <span ng-if="(locationForm.pool_name.$touched && locationForm.pool_name.$invalid) || (workplaceFormSubmitted && locationForm.pool_name.$invalid)" class="error">Car Pool Location Name is required.</span>
        </fieldset>
        <fieldset class="form-group col-xs-7">
            <label>Location Address</label>
            <input type="text" ng-model="location.address" class="form-control" placeholder="Location Address" id="address" name="address" required />
            <span ng-if="(locationForm.address.$touched && locationForm.address.$invalid) || (workplaceFormSubmitted && locationForm.address.$invalid)" class="error">Location Address is required.</span>
        </fieldset>

        <fieldset class="form-group">
            <label>Geo Location (If pin is incorrect)</label>
            <input type="text" class="form-control" ng-model="location.geolocation" placeholder="Geo Location" id="geolocation" name="geolocation" required />
            <span ng-if="(locationForm.geolocation.$touched && locationForm.geolocation.$invalid) || (workplaceFormSubmitted && locationForm.geolocation.$invalid)" class="error">Geo Location is required.</span>

            <div id="map" style="height: 500px; width:100%;"></div>
        </fieldset>

        <fieldset class="form-group col-xs-12">
            <label for="workplaceDescription">Access Information</label>
            <textarea type="text" ng-model="location.description" class="form-control" id="workplaceDescription" name="workplaceDescription" required rows="5"></textarea>
            <span ng-if="(locationForm.workplaceDescription.$touched && locationForm.workplaceDescription.$invalid) || (workplaceFormSubmitted && locationForm.workplaceDescription.$invalid)" class="error">Licence Primary Contact is required.</span>
        </fieldset>
        <fieldset>
            <button class="btn btn-success" type="submit" ng-if="!loader" ng-disabled="locationForm.$invalid">Submit</button>
            <button ng-if="loader" class="btn btn-primary" disabled>Processing ...</button>
        </fieldset>
    </form>
</div>