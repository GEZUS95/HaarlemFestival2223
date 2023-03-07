<?php
include_once __DIR__ . '../../admin-header.php';
?>
<div class="col-12">
    <div class="row">
        <div class="p-3 py-5">
            <button class="btn btn-info" onclick="location.reload();">
                Refresh Page
            </button>
            <a href="/admin/newsession" class="btn btn-success">New Session</a>
            <h4 class="text-dark">Sessions</h4>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead class="usr-tab-head">
                    <tr class="text-dark">
                        <th>Id</th>
                        <th>Restaurant Id</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Save</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody class="usr-tab-bod">
                    <?php foreach ($model as $session) { ?>
                        <tr>
                            <form function="sessiontable" method="post">
                                <td><input name="id-session" class="idcol" type="number" value="<?= $session['id'] ?>" readonly></td>
                                <td><input name="restaurant-id-session" class="restaurantidcol" type="number" value="<?= $session['restaurant_id'] ?>"></td>
                                <td><input name="start-time-session" class="starttimecol" type="datetime-local" value="<?= $session['start_time'] ?>"></td>
                                <td><input name="end-time-session" class="endtimecol" type="datetime-local" value="<?= $session['end_time'] ?>"></td>
                                <td><button class="btn btn-success text-light" name="save-session" type="submit">Save</button></td>
                                <td><button class="btn btn-danger text-light" name="del-session" type="submit">Delete</button></td>
                            </form>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <button class="btn btn-success"><a href="newsession" class="text-light">New Session</a></button>
                <div class="alert alert-danger" role="alert"><?= $error ?></div>
                <div class="alert alert-success" role="alert"><?= $confirmation ?></div>
            </div>
        </div>
    </div>
</div>

