<?php
include_once __DIR__ . '/../admin-header.php';
?>
<h1 id="description">Download Orders</h1>

<form method="post" action="/admin/orders/csv">
    <div class="form-group row">
        <label class="col-4 col-form-label">Options</label>
        <div class="col-8">
            <div class="form-check">
                <input name="id" id="id" type="checkbox" class="form-check-input" value="id" aria-describedby="optionsHelpBlock" checked="checked">
                <label for="id" class="form-check-label">Order ID</label>
            </div>
            <div class="form-check">
                <input name="user_id" id="user_id" type="checkbox" class="form-check-input" value="user_id" aria-describedby="optionsHelpBlock" checked="checked">
                <label for="user_id" class="form-check-label">User ID</label>
            </div>
            <div class="form-check">
                <input name="share_uuid" id="share_uuid" type="checkbox" class="form-check-input" value="share_id" aria-describedby="optionsHelpBlock" checked="checked">
                <label for="share_uuid" class="form-check-label">Share ID</label>
            </div>
            <div class="form-check">
                <input name="status" id="status" type="checkbox" aria-describedby="optionsHelpBlock" class="form-check-input" value="status" checked="checked">
                <label for="status" class="form-check-label">Status</label>
            </div>
            <div class="form-check">
                <input name="payed_at" id="payed_at" type="checkbox" aria-describedby="optionsHelpBlock" class="form-check-input" value="payed_at" checked="checked">
                <label for="payed_at" class="form-check-label">Payed At</label>
            </div>
            <div class="form-check">
                <input name="total" id="total" type="checkbox" aria-describedby="optionsHelpBlock" class="form-check-input" value="total" checked="checked">
                <label for="total" class="form-check-label">Total Price</label>
            </div>
            <span id="optionsHelpBlock" class="form-text text-muted">Select the options you prefer to see in the CSV file</span>
        </div>
    </div>
    <div class="form-group row">
        <div class="offset-4 col-8">
            <button name="submit" type="submit" class="btn btn-primary">Generate CSV</button>
        </div>
    </div>
</form>
