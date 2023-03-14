<?php
include_once __DIR__ . '../../admin-header.php';
?>
<div class="col-12">
    <div class="row">
        <div class="p-3 py-5">
            <button class="btn btn-info" onclick="location.reload();">
                Refresh Page
            </button>
            <a href="/admin/newlocation" class="btn btn-success">New Location</a>
            <h4 class="text-dark">Locations</h4>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead class="usr-tab-head">
                    <tr class="text-dark">
                        <th>Name</th>
                        <th>City</th>
                        <th>Address</th>
                        <th>Stage</th>
                        <th>Seats</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody class="usr-tab-bod">
                    <?php foreach ($model as $location) { ?>
                        <tr>
                            <td><?= $location->getName() ?></td>
                            <td><?= $location->getCity() ?></td>
                            <td><?= $location->getAddress() ?></td>
                            <td><?= $location->getStage() ?></td>
                            <td><?= $location->getSeats() ?></td>
                            <td><a href="/admin/locations/update/<?= $location->getId() ?>" class="btn btn-warning">Update</a></td>
                            <td><a href="/admin/locations/delete/<?= $location->getId() ?>" class="btn btn-danger">Delete</a></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <button class="btn btn-success"><a href="newlocation" class="text-light">New Location</a></button>
            </div>
        </div>
    </div>
</div>
