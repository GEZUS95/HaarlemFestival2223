<?php
include_once __DIR__ . '/../admin-header.php';
?>
<h1>Update <?php echo $program->getTitle(); ?></h1>
<form action="/admin/updateprogram/<?php echo $programId ?>" method="post" class="form-horizontal">
    <fieldset>
        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="title">Title</label>
            <div class="col-md-4">
                <input id="title" name="title"
                       type="text" class="form-control input-md"
                       required="" value="<?php echo $program->getTitle() ?>">
            </div>
        </div>

        <!-- Number input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="price">Price</label>
            <div class="col-md-4">
                <input id="price" name="price"
                       max="100000" min="1"
                       type="number" step="0.01" class="form-control input-md"
                       required="" value="<?php echo $program->getPrice() ?>">
            </div>
        </div>

        <!-- DateTime input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="start_time">Start time</label>
            <div class="col-md-4">
                <input id="start_time" name="start_time"
                       type="datetime-local" class="form-control input-md"
                       required="" value="<?php echo $program->getStartTime() ?>">
            </div>
        </div>

        <!-- DateTime input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="end_time">End time</label>
            <div class="col-md-4">
                <input id="end_time" name="end_time"
                       type="datetime-local" class="form-control input-md"
                       required="" value="<?php echo $program->getEndTime() ?>">
            </div>
        </div>

        <!-- Button -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="submit"></label>
            <div class="col-md-4">
                <button id="submit" name="submit" class="btn btn-primary">Update</button>
                <a href="/admin/programs/<?php echo $eventId ?>" class="btn btn-danger">Go back</a>
            </div>
        </div>
    </fieldset>
</form>
