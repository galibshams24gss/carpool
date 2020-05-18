<div class="loading" ng-show="loader">
    <div class="loader"></div>
</div>
<div class="container" id="mainView">
    <form name="reset_password" id="reset_password" ng-submit="resetPassword(pass)">
        <div class="row justify-content-md-center mt-4">
            <div class="col-md-8">
                <div class="containBox clearfix text-center">
                    <h3>Reset Password</h3>
                </div>
            </div>
        </div>
        <div class="row justify-content-md-center">
            <div class="col-md-8">
                <div class="containBox clearfix">
                    <fieldset class="form-group">
                        <label for="username">Password *</label>
                        <span ng-show="reset_password.password.$invalid && reset_password.password.$touched" class="error">Password must be at least 6 characters with 1 capital and 1 number</span>
                        <input class="form-control" type="password" placeholder="Please enter your new password" name="password" id="password" ng-model="pass.password" required ng-pattern="/^(?=.*[a-z])(?=.*\d)(?=.*[A-Z]).{6,}$/" />
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="username">Re-enter Password *</label>
                        <span ng-show="reset_password.confirm_password.$touched && (reset_password.password.$viewValue !== reset_password.confirm_password.$viewValue || reset_password.confirm_password.$invalid)" class="error">Password do not match</span>
                        <input class="form-control" type="password" placeholder="Re-enter new password" name="confirm_password" id="confirm_password" ng-model="pass.confirm_password" required />
                    </fieldset>
                </div>
            </div>
        </div>
        <div class="row justify-content-md-center">
            <div class="col-md-8">
                <div class="containBox clearfix text-center">
                    <p>
                        <button class="btn btn-success" type="submit" ng-if="!loader" ng-disabled="reset_password.password.$invalid || reset_password.confirm_password.$invalid || (reset_password.password.$viewValue !== reset_password.confirm_password.$viewValue)">Reset</button>
                        <button ng-if="loader" class="btn btn-primary" disabled>Processing ...</button>
                    </p>
                </div>
            </div>
        </div>
    </form>
</div>