<div class="loading" ng-show="loader">
    <div class="loader"></div>
</div>
<div class="container" id="mainView">
    <form id="login_form" name="login_form" ng-submit="login()" validate>

    <div class="row justify-content-md-center">
        <div class="col-md-8">
            <div class="containBox clearfix text-center">
                <h3>Log in</h3>
            </div>
        </div>
    </div>
    <div class="row justify-content-md-center">
        <div class="col-md-8">
            <div class="containBox clearfix">
                <fieldset class="form-group">
                    <label for="username">Email *</label>
                    <input type="email" name="email" id="email" placeholder="Please enter your email address" ng-model="email" class="form-control sq-form-field" required />
                    <span ng-show="login_form.email.$touched && login_form.email.$invalid" class="error"><small>Email is not registered, please review or register</small></span>
                </fieldset>
                <fieldset class="form-group">
                    <label for="password">Password *</label>
                    <input type="password" name="password" id="password" ng-model="password" placeholder="Please enter your password" class="form-control sq-form-field" required />
                    <span ng-show="login_form.password.$touched && login_form.password.$invalid" class="error"><small>Password is incorrect, please check and try again</small></span>
                </fieldset>
            </div>
        </div>
    </div>
    <div class="row justify-content-md-center">
        <div class="col-md-8">
            <div class="containBox clearfix">
                <p>
                    <a href="./new_password" class="" style="color:#28a745;text-decoration: underline;">Forgotten Password? Click here to reset</a>
                </p>
            </div>
        </div>
    </div>
    <div class="row justify-content-md-center">
        <div class="col-md-3">
            <div class="containBox clearfix text-center">
                <p>
                    <button class="btn btn-success" type="submit" ng-hide="processing" ng-disabled="login_form.$invalid">Log in</button>
                    <button ng-show="processing" class="btn btn-primary" disabled>Processing ...</button>
                </p>
            </div>
        </div>
    </div>
    </form>
</div>
<script>
    function loginhash_report(form, password) {

        // Create a new element input, this will be our hashed password field.
        var p = document.createElement("input");

        // Add the new element to our form.
        form.appendChild(p);
        p.name = "p";
        p.type = "hidden";
        p.value = hex_sha512(password.value);

        // Make sure the plaintext password doesn't get sent.
        password.value = "";

        // Finally submit the form.
        form.submit();

    }
</script>