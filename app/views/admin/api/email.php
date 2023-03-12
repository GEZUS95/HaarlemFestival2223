<?php
include_once __DIR__ . '/../admin-header.php';
?>

<h1 id="description">Email API keys</h1>

<form method="post" action="/admin/api/email/<?= $uuid ?>" class="form-horizontal">
    <div class="form-group">
        <label for="email" class="col-4 col-form-label">Email address</label>
        <div class="col-8">
            <input id="email"
                   name="email"
                   placeholder="Please fill in an email address who needs this API key"
                   type="text"
                   aria-describedby="descriptionHelpBlock"
                   class="form-control">
            <span id="descriptionHelpBlock" class="form-text text-muted">
                Please fill in an email address who needs this API key
            </span>
        </div>
    </div>
    <div class="form-group row">
        <div class="offset-4 col-8">
            <button name="submit" type="submit" class="btn btn-primary">Email API key</button>
        </div>
    </div>
</form>
