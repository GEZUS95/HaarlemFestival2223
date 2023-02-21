<?php
include __DIR__ . '/../admin-header.php';
?>

    <h1>Update <?php echo $user->getName(); ?></h1>
    <form action="/admin/users/<?php echo $user->getId(); ?>" method="post" class="form-horizontal">
        <fieldset>
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="name">Name</label>
                <div class="col-md-4">
                    <input id="name" name="name" type="text" class="form-control input-md" required="" value="<?php echo $user->getName()?>">
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="emailVerify">Email</label>
                <div class="col-md-4">
                    <input id="email" name="email" type="text" class="form-control input-md" required="" value="<?php echo $user->getEmail()?>">
                </div>
            </div>

            <!-- Select Basic -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="role">Role</label>
                <div class="col-md-4">
                    <select id="role" name="role" class="form-control">
<!--                        todo: load roles from db and for loop them here-->
                        <option value="1">Option one</option>
                        <option value="2">Option two</option>
                    </select>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="emailVerify">Date of Registration</label>
                <div class="col-md-4">
                    <input id="created" name="created" type="text" class="form-control input-md" value="<?php echo $user->getCreatedAt()?>" readonly>
                </div>
            </div>

            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="submit"></label>
                <div class="col-md-4">
                    <button id="submit" name="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </fieldset>
    </form>
