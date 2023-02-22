<?php
include __DIR__ . '/../admin-header.php';
?>

<h1>Create User</h1>
<form action="/admin/users/create" method="post" class="form-horizontal">
    <fieldset>
        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="name">Name</label>
            <div class="col-md-4">
                <input id="name" name="name" type="text" placeholder="Name" class="form-control input-md"
                       required="">
                <span class="help-block">please fill in a user name</span>
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="email">Email</label>
            <div class="col-md-4">
                <input id="email" name="email" type="text" placeholder="Email" class="form-control input-md"
                       required="">
                <span class="help-block">please fill in a user email</span>
            </div>
        </div>

        <!-- Password input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="password">Password</label>
            <div class="col-md-4">
                <input id="password" name="password" type="password" placeholder="Password"
                       class="form-control input-md" required="">
                <span class="help-block">please fill in a password, it is your own responsibility that it is safe!</span>
            </div>
        </div>

        <!-- Select Basic -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="role">Role</label>
            <div class="col-md-4">
                <select id="role" name="role" class="form-control">
                    <?php
                    foreach ($roles as $role){
                    ?>
                    <option value='<?php echo $role->getId(); ?>'><?php echo $role->getName(); ?></option>
                    <?php }  ?>
                </select>
            </div>
        </div>

        <!-- Button -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="submit"></label>
            <div class="col-md-4">
                <button id="submit" name="submit" class="btn btn-primary">Create User</button>
            </div>
        </div>
    </fieldset>
</form>
