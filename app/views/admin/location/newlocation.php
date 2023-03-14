<?php
include_once __DIR__ . '/../admin-header.php';
?>
<h1>Create New Location</h1>
<form action="/admin/newlocation" method="post" class="form-horizontal">
    <fieldset>
        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="name">Name</label>
            <div class="col-md-4">
                <input id="name" name="name"
                       type="text" class="form-control input-md"
                       required="">
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="city">City</label>
            <div class="col-md-4">
                <input id="city" name="city"
                       type="text" class="form-control input-md"
                       required="">
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="address">Address</label>
            <div class="col-md-4">
                <input id="address" name="address"
                       type="text" class="form-control input-md"
                       required="">
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="stage">Stage</label>
            <div class="col-md-4">
                <input id="stage" name="stage"
                       type="text" class="form-control input-md"
                       required="">
            </div>
        </div>

        <!-- Number input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="seats">Seats</label>
            <div class="col-md-4">
                <input id="seats" name="seats"
                       max="100000" min="1"
                       type="number" class="form-control input-md"
                       required="">
            </div>
        </div>

        <!-- Button -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="submit"></label>
            <div class="col-md-4">
                <button id="submit" name="submit" class="btn btn-primary">Create</button>
                <a href="/admin/locations" class="btn btn-danger">Go back</a>
            </div>
        </div>
    </fieldset>
</form>
