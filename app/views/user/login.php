<?php
include_once __DIR__ . '/../header.php';
?>

<h1>Login page</h1>
<div class="card">
    <div class="card-body">
        <form action="/login" method="post" class="form-horizontal">
            <fieldset>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="Email">Email</label>
                    <div class="col-md-4">
                        <input id="Email" name="Email" type="text" placeholder="youremail@provider.com"
                               class="form-control input-md" required="">
                        <span class="help-block">Please fill in your email address you are registered with</span>
                    </div>
                </div>

                <!-- Password input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="password">Password</label>
                    <div class="col-md-4">
                        <input id="password" name="password" type="password" placeholder="Your password"
                               class="form-control input-md" required="">
                        <span class="help-block">Please fill in your password</span>
                    </div>
                </div>
                <!-- Button -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="submit"></label>
                    <div class="col-md-4">
                        <button id="submit" name="submit" class="btn btn-primary">Login</button>
                    </div>
                </div>
                <a href="/register">Not yet registered?</a> &emsp; <a href="/resetpassword">Password forgotten?</a>
            </fieldset>
        </form>
    </div>
</div>

<?php
include_once __DIR__ . '/../footer.php';
?>
