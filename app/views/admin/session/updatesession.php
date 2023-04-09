<?php
include_once __DIR__ . '/../admin-header.php';
?>
<h1>Update <?php echo $session->getId(); ?></h1>
<form action="/admin/sessions/update/<?php echo $session->getId(); ?>" method="post" class="form-horizontal">
    <fieldset>
        <!-- Selection input-->
        <!-- Selection input load in all restaurants-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="restaurant_id">Restaurant</label>
            <div class="col-md-4">
                <select id="restaurant_id" name="restaurant_id" class="form-control" required>
                    <?php foreach ($restaurants as $restaurant): ?>
                        <option value="<?php echo $restaurant->getId(); ?>"
                            <?php if ($restaurant->getId() === $session->getRestaurantId()): ?>
                                selected
                            <?php endif; ?>
                        >
                            <?php echo $restaurant->getName(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <!-- Selection input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="program_id">Program</label>
            <div class="col-md-4">
                <select id="program_id" name="program_id" class="form-control" required>
                    <?php foreach ($programs as $program): ?>
                        <option value="<?php echo $program->getId(); ?>"
                            <?php if ($program->getId() === $session->getProgramId()): ?>
                                selected
                            <?php endif; ?>
                        >
                            <?php echo $program->getTitle(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <!-- DateTime input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="start_time">Start time</label>
            <div class="col-md-4">
                <input id="start_time" name="start_time"
                       type="datetime-local" class="form-control input-md"
                       required="" value="<?php echo $session->getStartTime()->format('Y-m-d\TH:i'); ?>">
            </div>
        </div>
        <!-- DateTime input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="end_time">End time</label>
            <div class="col-md-4">
                <input id="end_time" name="end_time"
                       type="datetime-local" class="form-control input-md"
                       required="" value="<?php echo $session->getEndTime()->format('Y-m-d\TH:i'); ?>">
            </div>
        </div>

        <!-- Input for seats left -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="seats_left">Seats Left</label>
            <div class="col-md-4">
                <input id="seats_left" name="seats_left" type="number" class="form-control input-md" required="" value="<?php echo $session->getSeatsLeft(); ?>">
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



