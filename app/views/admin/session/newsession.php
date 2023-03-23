<?php
include_once __DIR__ . '/../admin-header.php';
?>
<h1>Create New Session</h1>
<form action="/admin/newsession" method="post" class="form-horizontal">
    <fieldset>
        <!-- Selection input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="restaurant_id">Restaurant</label>
            <div class="col-md-4">
                <select id="restaurant_id" name="restaurant_id" class="form-control" required>
                    <?php foreach ($restaurants as $restaurant): ?>
                        <option value="<?php echo $restaurant->getId(); ?>">
                            <?php echo $restaurant->getName(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <!-- Datetime input for start time -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="start_time">Start Time</label>
            <div class="col-md-4">
                <input id="start_time" name="start_time" type="datetime-local" class="form-control input-md" required="">
            </div>
        </div>

        <!-- Datetime input for end time -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="end_time">End Time</label>
            <div class="col-md-4">
                <input id="end_time" name="end_time" type="datetime-local" class="form-control input-md" required="">
            </div>
        </div>

        <!-- Input for seats left -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="seats_left">Seats Left</label>
            <div class="col-md-4">
                <input id="seats_left" name="seats_left" type="number" class="form-control input-md" required="">
            </div>
        </div>

        <!-- Button -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="submit"></label>
            <div class="col-md-4">
                <button id="submit" name="submit" class="btn btn-primary">Create</button>
                <a href="/admin/sessions" class="btn btn-danger">Go back</a>
            </div>
        </div>
    </fieldset>
</form>
