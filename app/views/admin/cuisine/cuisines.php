<?php
include_once __DIR__ . '../../admin-header.php';
?>
<div class="col-12">
    <div class="row">
        <div class="p-3 py-5">
            <button class="btn btn-info" onclick="location.reload();">
                Refresh Page
            </button>
            <a href="/admin/newcuisine" class="btn btn-success">New Cuisine</a>
            <h4 class="text-dark">Cuisines</h4>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead class="usr-tab-head">
                    <tr class="text-dark">
                        <th>Name</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody class="usr-tab-bod">
                    <?php foreach ($model as $cuisine) { ?>
                        <tr>
                            <td><?= $cuisine->getCuisineName() ?></td>
                            <td><a href="/admin/updatecuisine/<?= $cuisine->getId() ?>" class="btn btn-warning">Update</a></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <button class="btn btn-success"><a href="newcuisine" class="text-light">New Cuisine</a></button>
            </div>
        </div>
    </div>
</div>
