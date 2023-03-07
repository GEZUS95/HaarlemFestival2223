<?php
include_once __DIR__ . '../../admin-header.php';
?>
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
            <form action="updaterestaurant" method="post">
                <h1 class="h3 mb-3 fw-normal text-dark">Update Restaurant</h1>
                <div class="form-floating">
                    <label for="restaurantName" class="form-label">Restaurant Name</label>
                    <input type="text" name="restaurantName" class="form-control" placeholder="Restaurant Name" value="<?= $model->getName() ?>" required autofocus>
                </div>
                <div class="form-floating">
                    <label for="restaurantDescription" class="form-label">Restaurant Description</label>
                    <input type="text" name="restaurantDescription" class="form-control" placeholder="Restaurant Description" value="<?= $model->getDescription() ?>" required>
                </div>
                <div class="form-floating">
                    <label for="restaurantStars" class="form-label">Restaurant Stars</label>
                    <input type="number" name="restaurantStars" class="form-control" placeholder="Restaurant Stars" value="<?= $model->getStars() ?>" required>
                </div>
                <div class="form-floating">
                    <label for="restaurantSeats" class="form-label">Restaurant Seats</label>
                    <input type="number" name="restaurantSeats" class="form-control" placeholder="Restaurant Seats" value="<?= $model->getSeats() ?>" required>
                </div>
                <div class="form-floating">
                    <label for="restaurantPrice" class="form-label">Restaurant Price</label>
                    <input type="number" name="restaurantPrice" class="form-control" placeholder="Restaurant Price" value="<?= $model->getPrice() ?>" required>
                </div>
                <div class="form-floating">
                    <label for="restaurantPriceChild" class="form-label">Restaurant Child Price</label>
                    <input type="number" name="restaurantPriceChild" class="form-control" placeholder="Restaurant Child Price" value="<?= $model->getPriceChild() ?>" required>
                </div>
                <div class="form-floating">
                    <label for="restaurantAccessibility" class="form-label">Restaurant Accessibility</label>
                    <input type="text" name="restaurantAccessibility" class="form-control" placeholder="Restaurant Accessibility" value="<?= $model->getAccessibility() ?>" required>
                </div>
                <div class="form-floating">
                    <label for="restaurantCuisines" class="form-label">Restaurant Cuisines</label>
                    <input type="text" name="restaurantCuisines" class="form-control" placeholder="Restaurant Cuisines" value="<?= $model->getCuisines() ?>" required>
                </div>
                <div class="form-floating">
                    <label for="restaurantLocation" class="form-label">Restaurant Location</label>
                    <input type="text" name="restaurantLocation" class="form-control" placeholder="Restaurant Location" value="<?= $model->getLocation() ?>" required>
                    <a onclick="/admin/restaurants" class="btn btn-success">Add Restaurant</a>
                    <a href="javascript:history.back()" class="btn btn-danger">Go Back</a>
            </form>
        </div>
        <div class="col-2"></div>
<?php
                                        foreach ($allCuisines as $cuisine) {
                                            // use if in_array to check if the cuisine is in the restaurant cuisines
                                            if (in_array($cuisine['id'], $restaurant['cuisines'])) {
                                                ?>
                                                <option value='<?php echo $cuisine['id']; ?>' selected><?php echo $cuisine['cuisine_name']; ?></option>
                                            <?php } else { ?>
                                                <option value='<?php echo $cuisine['id']; ?>'><?php echo $cuisine['cuisine_name']; ?></option>
                                            <?php }
                                        } ?>