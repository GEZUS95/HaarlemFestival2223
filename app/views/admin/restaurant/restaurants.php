<?php
include_once __DIR__ . '../../admin-header.php';
?>
<div class="col-12">
    <div class="row">
        <div class="p-3 py-5">
            <button class="btn btn-info" onclick="location.reload();">
                Refresh Page
            </button>
            <a href="/admin/newrestaurant" class="btn btn-success">New Restaurant</a>
            <h4 class="text-dark">Restaurants</h4>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead class="usr-tab-head">
                    <tr class="text-dark">
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Child Price</th>
                        <th>Seats</th>
                        <th>Stars</th>
                        <th>Location Id</th>
                        <th>Cuisines</th>
                        <th>Accessibility</th>
                        <th>Save</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody class="usr-tab-bod">
                    <?php foreach ($model as $restaurant) { ?>
                        <tr>
                            <td><?= $restaurant['name'] ?></td>
                            <td><?= $restaurant['description'] ?></td>
                            <td><?= $restaurant['price'] ?></td>
                            <td><?= $restaurant['price_child'] ?></td>
                            <td><?= $restaurant['seats'] ?></td>
                            <td><?= $restaurant['stars'] ?></td>
                            <td><?= $restaurant['location_id'] ?></td>
                            <td><?php foreach ($restaurant['cuisines'] as $cuisine) {
                                    echo $cuisine['cuisine_name'] . ' ';
                                } ?>
                            <td><?= $restaurant['accessibility'] ?></td>
                            <td><a href="/admin/restaurants/update/<?= $restaurant['id'] ?>" class="btn btn-warning">Update</a></td>
                            <td><button class="btn btn-danger text-light" name="del-restaurant" type="submit">Delete</button></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <button class="btn btn-success"><a href="newrestaurant" class="text-light">New Restaurant</a></button>
                <div class="alert alert-danger" role="alert"><?= $error ?></div>
                <div class="alert alert-success" role="alert"><?= $confirmation ?></div>
            </div>
        </div>
    </div>
</div>

