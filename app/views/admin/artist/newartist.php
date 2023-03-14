<?php
include_once __DIR__ . '/../admin-header.php';
?>
<h1>Create New Artist</h1>
<form action="/admin/newartist" method="post" class="form-horizontal">
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
            <label class="col-md-4 control-label" for="description">Description</label>
            <div class="col-md-4">
                <input id="description" name="description"
                       type="text" class="form-control input-md"
                       required="">
            </div>
        </div>

        <!-- Button -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="submit"></label>
            <div class="col-md-4">
                <button id="submit" name="submit" class="btn btn-primary">Create</button>
                <a href="/admin/artists" class="btn btn-danger">Go back</a>
            </div>
        </div>
    </fieldset>
</form>
