<?php
include_once __DIR__ . '../../admin-header.php';
?>
<div class="col-12">
    <div class="row">
        <div class="p-3 py-5">
            <button class="btn btn-info" onclick="location.reload();">
                Refresh Page
            </button>
            <a href="/admin/newartist" class="btn btn-success">New Artist</a>
            <h4 class="text-dark">Artists</h4>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead class="usr-tab-head">
                    <tr class="text-dark">
                        <th>Name</th>
                        <th>Description</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody class="usr-tab-bod">
                    <?php foreach ($model as $artist) { ?>
                        <tr>
                            <td><?= $artist->getName() ?></td>
                            <td><?= $artist->getDescription() ?></td>
                            <td><a href="/admin/artists/update/<?= $artist->getId() ?>" class="btn btn-warning">Update</a></td>
                            <td><a href="/admin/artists/delete/<?= $artist->getId() ?>" class="btn btn-danger">Delete</a></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <button class="btn btn-success"><a href="newartist" class="text-light">New Artist</a></button>
            </div>
        </div>
    </div>
</div>
