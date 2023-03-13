<?php
include_once __DIR__ . '/../header.php';
?>

<h1>Update <?php echo $user->getName(); ?></h1>
<form action="/user/update/<?php echo $user->getId(); ?>" method="post" class="form-horizontal">
    <fieldset>
        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="name">Name</label>
            <div class="col-md-4">
                <input id="name" name="name"
                       type="text" class="form-control input-md"
                       required="" value="<?php echo $user->getName() ?>">
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="email">Email</label>
            <div class="col-md-4">
                <input id="email" name="email"
                       type="text" class="form-control input-md"
                       required="" value="<?php echo $user->getEmail() ?>">
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="emailcheck">Email verify</label>
            <div class="col-md-4">
                <input id="emailcheck" name="emailcheck"
                       type="text" class="form-control input-md"
                       required="" value="<?php echo $user->getEmail() ?>">
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="created">Date of Registration</label>
            <div class="col-md-4">
                <input id="created" name="created"
                       type="text" class="form-control input-md"
                       value="<?php echo $user->getCreatedAt() ?>" readonly>
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

<?php
include_once __DIR__ . '/../footer.php'
?>

