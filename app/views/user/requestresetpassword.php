<?php
include __DIR__ . '/../header.php';
?>

<h1>Request reset of password</h1>
<form action="/resetpassword" method="post" class="form-horizontal">
    <fieldset>
        <!-- Password input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="email">Your email</label>
            <div class="col-md-4">
                <input id="email" name="email" type="email" placeholder="Your email that is know with us" class="form-control input-md" required="">
                <span class="help-block">Please fill in your email</span>
            </div>
        </div>

        <!-- Button -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="submit"></label>
            <div class="col-md-4">
                <button id="submit" name="submit" class="btn btn-primary">Request Reset</button>
            </div>
        </div>
    </fieldset>
</form>


<?php
include __DIR__ . '/../footer.php'
?>
