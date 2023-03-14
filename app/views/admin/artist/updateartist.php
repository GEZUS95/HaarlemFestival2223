<?php
include_once __DIR__ . '/../admin-header.php';
?>
<h1>Update <?php echo $artist->getName(); ?></h1>
<form action="/admin/artists/update/<?php echo $artist->getId(); ?>" method="post" class="form-horizontal">
    <fieldset>
        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="name">Name</label>
            <div class="col-md-4">
                <input id="name" name="name"
                       type="text" class="form-control input-md"
                       required="" value="<?php echo $artist->getName() ?>">
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="description">Description</label>
            <div class="col-md-4">
                <input id="description" name="description"
                       type="text" class="form-control input-md"
                       required="" value="<?php echo $artist->getDescription() ?>">
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
