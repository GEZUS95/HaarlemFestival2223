<?php
if (($_SESSION['user']['role_id'] == 2) || ($_SESSION['user']['role_id'] == 3)) {
    include __DIR__ . '/../admin/admin-header.php';
} else {
    include __DIR__ . '/../header.php';
}
?>

<h1>Login page</h1>
<form action="/user/resetpassword" method="post" class="form-horizontal">
    <fieldset>

        <?php if (($_SESSION['user']['role_id'] == 2) || ($_SESSION['user']['role_id'] == 3)) { ?>
        <!-- Password input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="oldpassword">Email</label>
            <div class="col-md-4">
                <input id="oldpassword" name="oldpassword" type="password" placeholder="Your old password" class="form-control input-md" required="">
                <span class="help-block">Please fill in your old password</span>
            </div>
        </div>
        <?php } ?>

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



