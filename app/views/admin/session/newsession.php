<?php
include_once __DIR__ . '../../admin-header.php';
?>
<div class="row">
    <div class="col-2"></div>
    <div class="col-8">
        <form action="newsession" method="post">
            <h1 class="h3 mb-3 fw-normal text-dark">New Session</h1>
            <!-- load in selection box of all restaurants and send the id of restaurant when added -->

        <div class="form-floating">
            <label for="startTime" class="form-label">Start Time</label>
            <input type="text" name="startTime" class="form-control" placeholder="Start Time" required>
        </div>
        <div class="form-floating">
            <label for="endTime" class="form-label">End Time</label>
            <input type="text" name="endTime" class="form-control" placeholder="End Time" required>
        </div>
            <a onclick="location.reload();" class="btn btn-success">Add Restaurant</a>
            <a href="javascript:history.back()" class="btn btn-danger">Go Back</a>
        </form>
</div>
<div class="col-2"></div>




