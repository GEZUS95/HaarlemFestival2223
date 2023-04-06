<?php
include_once __DIR__ . '/../admin-header.php';
?>
<h1>Update Program Item <?php echo $programItem->getTitle(); ?></h1>
<form action="/admin/updateprogramitem/<?php echo $programItemId ?>" method="post" class="form-horizontal">
    <fieldset>
        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="title">Title</label>
            <div class="col-md-4">
                <input id="title" name="title"
                       type="text" class="form-control input-md"
                       required="" value="<?php echo $programItem->getTitle(); ?>">
            </div>
        </div>
        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="start_time">Start Time</label>
            <div class="col-md-4">
                <input id="start_time" name="start_time"
                       type="datetime-local" class="form-control input-md"
                       required="" value="<?php echo $programItem->getStartTime(); ?>">
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="end_time">End Time</label>
            <div class="col-md-4">
                <input id="end_time" name="end_time"
                       type="datetime-local" class="form-control input-md"
                       required="" value="<?php echo $programItem->getEndTime(); ?>"
            </div>
        </div>

        <!-- Number input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="price">Price</label>
            <div class="col-md-4">
                <input id="price" name="price"
                       max="100000" min="1"
                       type="number" step="0.01" class="form-control input-md"
                       required="" value="<?php echo $programItem->getPrice(); ?>"
            </div>
        </div>

        <!-- Number input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="seats_left">Seats Left</label>
            <div class="col-md-4">
                <input id="seats_left" name="seats_left"
                       max="100000" min="1"
                       type="number" class="form-control input-md"
                       required="" value="<?php echo $programItem->getSeatsLeft(); ?>"
            </div>
        </div>

        <!-- Selection input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="location_id">Location</label>
            <div class="col-md-4">
                <select id="location_id" name="location_id" class="form-control" required>
                    <?php foreach ($locations as $location): ?>
                        <option value="<?php echo $location->getId(); ?>">
                            <?php echo $location->getName(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <!-- Selection input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="artist_id">Artist</label>
            <div class="col-md-4">
                <select id="artist_id" name="artist_id" class="form-control" required>
                    <?php foreach ($artists as $artist): ?>
                        <option value="<?php echo $artist->getId(); ?>">
                            <?php echo $artist->getName(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <!-- Selection input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="special_guest_id">Special Guest</label>
            <div class="col-md-4">
                <select id="special_guest_id" name="special_guest_id" class="form-control" required>
                    <?php foreach ($artists as $artist): ?>
                        <option value="<?php echo $artist->getId(); ?>">
                            <?php echo $artist->getName(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <!-- Button -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="submit"></label>
            <div class="col-md-4">
                <button id="submit" name="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </fieldset>
</form>
