<?php
include_once __DIR__ . '/admin-header.php';
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
                        <th>Id</th>
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
                            <form function="restauranttable" method="post">
                                <td><input name="id-restaurant" class="idcol" type="number" value="<?= $restaurant['id'] ?>" readonly></td>
                                <td><input name="name-restaurant" class="namecol" type="text" value="<?= $restaurant['name'] ?>"></td>
                                <td><input name="description-restaurant" class="descriptioncol" type="text" value="<?= $restaurant['description'] ?>"></td>
                                <td><input name="price-restaurant" class="pricecol" type="number" max="10000" value="<?= $restaurant['price'] ?>"></td>
                                <td><input name="price-child-restaurant" class="pricechildcol" type="number" max="10000" value="<?= $restaurant['price_child'] ?>"></td>
                                <td><input name="seats-restaurant" class="seatscol" type="number" max="100000" value="<?= $restaurant['seats'] ?>"></td>
                                <td><input name="stars-restaurant" class="starscol" type="number" max="5" value="<?= $restaurant['stars'] ?>"></td>
                                <td><input name="location-id-restaurant" class="locationidcol" type="number" max="2000000000" value="<?= $restaurant['location_id'] ?>"></td>
                                <td>
                                    <select name="cuisines-restaurant[]" class="cuisinescol" multiple>
                                        <?php foreach ($restaurant['cuisines'] as $cuisine) { ;?>
                                            <option value="<?= $cuisine['id'] ?>" <?php if (in_array($cuisine['id'], $restaurant['cuisines'])) echo 'selected' ?>>
                                                <?= $cuisine['cuisine_name'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td><input name="accessibility-restaurant" class="accessibilitycol" type="text" value="<?= $restaurant['accessibility'] ?>"></td> <!-- doesn't work yet -->
                                <td><button class="btn btn-success text-light" name="save-restaurant" type="submit">Save</button></td>
                                <td><button class="btn btn-danger text-light" name="del-restaurant" type="submit">Delete</button></td>
                            </form>
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

