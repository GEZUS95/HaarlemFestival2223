<?php
include_once __DIR__ . '/../header.php';
?>

    <h1>Register page</h1>
    <form action="/register" method="post" class="form-horizontal">
        <fieldset>
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="name">Name</label>
                <div class="col-md-4">
                    <input id="name"
                           name="name"
                           type="text"
                           placeholder="Your name"
                           class="form-control input-md"
                           required="">
                    <span class="help-block">please fill in your name</span>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="email">Email</label>
                <div class="col-md-4">
                    <input id="email"
                           name="email"
                           type="text"
                           placeholder="Your email"
                           class="form-control input-md"
                           required="">
                    <span class="help-block">please fill in your email</span>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="emailVerify">Email verify</label>
                <div class="col-md-4">
                    <input id="emailVerify"
                           name="emailVerify"
                           type="text"
                           placeholder="Email verification"
                           class="form-control input-md"
                           required="">
                    <span class="help-block">Please fill in your email to verify your email</span>
                </div>
            </div>

            <!-- Password input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="password">Password</label>
                <div class="col-md-4">
                    <input id="password"
                           name="password"
                           type="password"
                           placeholder="Password"
                           class="form-control input-md"
                           required="">
                    <span class="help-block">
                        please fill in a password, it is your own responsibility that it is safe!
                    </span>
                </div>
            </div>

            <!-- Password input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="passwordVerify">Password verify</label>
                <div class="col-md-4">
                    <input id="passwordVerify"
                           name="passwordVerify"
                           type="password"
                           placeholder="Password verification"
                           class="form-control input-md"
                           required="">
                    <span class="help-block">please fill your password to verify your password</span>
                </div>
            </div>

            <div class="g-recaptcha" data-sitekey="6LeibwMlAAAAAMPjepfBuOkxpJoTxkuulIZxsmun"></div>

            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="submit"></label>
                <div class="col-md-4">
                    <button id="submit" name="submit" class="btn btn-primary">Register</button>
                </div>
            </div>
        </fieldset>
    </form>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php
include_once __DIR__ . '/../footer.php';
?>
