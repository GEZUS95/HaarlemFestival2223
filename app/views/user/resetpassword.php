<?php
    include __DIR__ . '/../header.php';
?>

<h1>Reset password page</h1>
<form action="/resetpassword/<?php echo $uuid; ?>" method="post" class="form-horizontal">
    <fieldset>
        <!-- Password input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="newpassword">New Password</label>
            <div class="col-md-4">
                <input id="newpassword" name="newpassword" type="password" placeholder="Your new password" class="form-control input-md" required="">
                <span class="help-block">Please fill in your new password</span>
            </div>
        </div>

        <!-- Password input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="newpasswordcheck">New Password verify</label>
            <div class="col-md-4">
                <input id="newpasswordcheck" name="newpasswordcheck" type="password" placeholder="Verify new password" class="form-control input-md" required="">
                <span class="help-block">Please fill in your new password to verify</span>
            </div>
        </div>

        <!-- Button -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="submit"></label>
            <div class="col-md-4">
                <button id="submit" name="submit" class="btn btn-primary">Reset Password</button>
            </div>
        </div>
    </fieldset>
</form>


<?php
include __DIR__ . '/../footer.php'
?>



