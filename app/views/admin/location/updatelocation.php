<?php
include_once __DIR__ . '/../admin-header.php';
?>
<h1>Update <?php echo $location->getName(); ?></h1>
<form action="/admin/locations/update/<?php echo $location->getId(); ?>" method="post" class="form-horizontal">
    <fieldset>
        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="name">Name</label>
            <div class="col-md-4">
                <input id="name" name="name"
                       type="text" class="form-control input-md"
                       required="" value="<?php echo $location->getName() ?>">
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="city">City</label>
            <div class="col-md-4">
                <input id="city" name="city"
                       type="text" class="form-control input-md"
                       required="" value="<?php echo $location->getCity() ?>">
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="address">Address</label>
            <div class="col-md-4">
                <input id="address" name="address"
                       type="text" class="form-control input-md"
                       required="" value="<?php echo $location->getAddress() ?>">
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="stage">Stage</label>
            <div class="col-md-4">
                <input id="stage" name="stage"
                       type="text" class="form-control input-md"
                       required="" value="<?php echo $location->getStage() ?>">
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="seats">Seats</label>
            <div class="col-md-4">
                <input id="seats" name="seats"
                       type="text" class="form-control input-md"
                       required="" value="<?php echo $location->getSeats() ?>">
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
