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
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody class="usr-tab-bod">
                    <?php foreach ($model as $restaurant) { ?>
                        <tr>
                            <td><?= $restaurant->getName() ?></td>
                            <td><?= $restaurant->getDescription() ?></td>
                            <td><?= $restaurant->getPrice() ?></td>
                            <td><?= $restaurant->getPriceChild() ?></td>
                            <td><?= $restaurant->getSeats() ?></td>
                            <td><?= $restaurant->getStars() ?></td>
                            <td><?= $restaurant->getLocationId() ?></td>
                            <td><?php foreach ($restaurant->getRestaurantCuisines() as $cuisine) {
                                    echo $cuisine->getCuisineName() . ' ';
                                } ?>
                            <td><?= $restaurant->getAccessibility() ?></td>
                            <td><a href="/admin/restaurants/update/<?= $restaurant->getId() ?>" class="btn btn-warning">Update</a></td>
                            <td><a href="/admin/restaurants/delete/<?= $restaurant->getId() ?>" class="btn btn-danger">Delete</a></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <button class="btn btn-success"><a href="newrestaurant" class="text-light">New Restaurant</a></button>
            </div>
        </div>
    </div>
</div>
