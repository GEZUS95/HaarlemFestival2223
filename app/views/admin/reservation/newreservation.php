<?php
include_once __DIR__ . '/../admin-header.php';
?>
<h1>Create New Reservation</h1>
<form action="/admin/newreservation" method="post" class="form-horizontal">
    <fieldset>
        <!-- Selection input for restaurant -->
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
        <!-- Selection input for session -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="session_id">Session</label>
            <div class="col-md-4">
                <select id="session_id" name="session_id" class="form-control" required>
                    <?php foreach ($sessions as $session): ?>
                        <option value="<?php echo $session->getId(); ?>">
                            <?php echo $session->getOptionLabel(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

            </div>
        </div>

        <!-- Input for remarks -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="remarks">Remarks</label>
            <div class="col-md-4">
                <input id="remarks" name="remarks" type="text" class="form-control input-md" value="none" required>
            </div>
        </div>

        <!-- Button -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="submit"></label>
            <div class="col-md-4">
                <button id="submit" name="submit" class="btn btn-primary">Create</button>
                <a href="/admin/reservations" class="btn btn-danger">Go back</a>
            </div>
        </div>
    </fieldset>
</form>
