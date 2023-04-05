<?php
include_once __DIR__ . '/../admin-header.php';
?>
<h1>Create New Cuisine</h1>
<form action="/admin/newcuisine" method="post" class="form-horizontal">
    <fieldset>
        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="cuisinename">Cuisine Name</label>
            <div class="col-md-4">
                <input id="cuisinename" name="cuisinename"
                       type="text" class="form-control input-md"
                       required="">
            </div>
        </div>


        <!-- Button -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="submit"></label>
            <div class="col-md-4">
                <button id="submit" name="submit" class="btn btn-primary">Create</button>
                <a href="/admin/cuisines" class="btn btn-danger">Go back</a>
            </div>
        </div>
    </fieldset>
</form>
