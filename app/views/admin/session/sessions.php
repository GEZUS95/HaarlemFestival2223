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
                        <th>Restaurant Name</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody class="usr-tab-bod">
                    <?php foreach ($model as $session) { ?>
                        <tr>
                            <td><?php
                                foreach ($restaurants as $restaurant) {
                                    if ($restaurant->getId() == $session->getRestaurantId()) {
                                        echo $restaurant->getName();
                                    }
                                }
                                ?></td>
                            <td><?=
                                // set datetime to string
                                $session->getStartTime()->format('Y-m-d H:i:s')
                                ?></td>
                            <td><?=
                                // set datetime to string
                                $session->getEndTime()->format('Y-m-d H:i:s')
                                ?></td>
                            <td><a href="/admin/sessions/update/<?= $session->getId() ?>" class="btn btn-warning">Update</a></td>
                            <td><a href="/admin/sessions/delete/<?= $session->getId() ?>" class="btn btn-danger">Delete</a></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <button class="btn btn-success"><a href="newsession" class="text-light">New Session</a></button>
            </div>
        </div>
    </div>
</div>

