<?php
include_once __DIR__ . '/../admin-header.php';
?>

<h1 id="description">Create API keys</h1>

<form method="post" action="/admin/api/create" class="form-horizontal">
    <div class="form-group">
        <label for="description" class="col-4 col-form-label">Description</label>
        <div class="col-8">
            <input id="description"
                   name="description"
                   placeholder="Please fill in a description who is using this key"
                   type="text"
                   aria-describedby="descriptionHelpBlock"
                   class="form-control">
            <span id="descriptionHelpBlock" class="form-text text-muted">
                Please fill in a description who is using this key
            </span>
        </div>
    </div>
    <div class="form-group row">
        <div class="offset-4 col-8">
            <button name="submit" type="submit" class="btn btn-primary">Create API key</button>
        </div>
    </div>
</form>
