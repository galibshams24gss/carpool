<div class="loading" ng-show="loader">
    <div class="loader"></div>
</div>
<div class="container" id="mainView">
    <form name="request_password" id="request_password" ng-submit="requestPassword(pass)">
        <div class="row justify-content-md-center mt-4">
            <div class="col-md-8">
                <div class="containBox clearfix text-center">
                    <h3>Request New Password</h3>
                </div>
            </div>
        </div>
        <div class="row justify-content-md-center">
            <div class="col-md-8">
                <div class="containBox clearfix">
                    <fieldset class="form-group">
                        <label for="username">Email *</label>
                        <span ng-show="request_password.email.$touched && request_password.email.$invalid" class="error">Please enter a valid email address</span>
                        <input class="form-control" type="email" placeholder="Please enter your email address" name="email" id="email" ng-model="pass.email" required />
                    </fieldset>
                </div>
            </div>
        </div>
        <div class="row justify-content-md-center">
            <div class="col-md-8">
                <div class="containBox clearfix text-center">
                    <p>
                        <button class="btn btn-success" type="submit" ng-if="!loader" ng-disabled="request_password.resetEmail.$invalid">Reset</button>
                        <button ng-if="loader" class="btn btn-primary" disabled>Processing ...</button>
                    </p>
                </div>
            </div>
        </div>
    </form>
</div>