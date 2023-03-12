<?php
include_once __DIR__ . '/../admin-header.php';
?>
<h1>Update <?php echo $restaurant->getName(); ?></h1>
<form action="/admin/restaurants/update/<?php echo $restaurant->getId(); ?>" method="post" class="form-horizontal">
    <fieldset>
        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="name">Name</label>
            <div class="col-md-4">
                <input id="name" name="name"
                       type="text" class="form-control input-md"
                       required="" value="<?php echo $restaurant->getName() ?>">
            </div>
        </div>
        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="description">Description</label>
            <div class="col-md-4">
                <input id="description" name="description"
                       type="text" class="form-control input-md"
                       required="" value="<?php echo $restaurant->getDescription() ?>">
            </div>
        </div>

        <!-- Number input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="stars">Stars</label>
            <div class="col-md-4">
                <input id="stars" name="stars"
                       type="number" class="form-control input-md"
                       required="" value="<?php echo $restaurant->getStars() ?>">
            </div>
        </div>

        <!-- Number input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="seats">Seats</label>
            <div class="col-md-4">
                <input id="seats" name="seats"
                       type="number" class="form-control input-md"
                       required="" value="<?php echo $restaurant->getSeats() ?>">
            </div>
        </div>

        <!-- Number input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="price">Price</label>
            <div class="col-md-4">
                <input id="price" name="price"
                       type="number" step="0.01" class="form-control input-md"
                       required="" value="<?php echo $restaurant->getPrice() ?>">
            </div>
        </div>

        <!-- Number input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="price_child">Price for children</label>
            <div class="col-md-4">
                <input id="price_child" name="price_child"
                       type="number" step="0.01" class="form-control input-md"
                       required="" value="<?php echo $restaurant->getPriceChild() ?>">
            </div>
        </div>

        <!-- Selection input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="location_id">Location</label>
            <div class="col-md-4">
                <select id="location_id" name="location_id" class="form-control">
                    <?php foreach ($locations as $location): ?>
                        <option value="<?php echo $location->getId(); ?>"
                            <?php if ($location->getId() === $restaurant->getLocationId()): ?>
                                selected
                            <?php endif; ?>
                        >
                            <?php echo $location->getCity(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <!-- Selection input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="cuisines">Cuisines</label>
            <div class="col-md-4">
                <select id="cuisines" name="cuisines[]" class="form-control" multiple>
                    <?php var_dump($cuisines); foreach ($cuisines as $cuisine): ?>
                        <option value="<?php echo $cuisine->getId(); ?>"
                            <?php foreach ($restaurant->getRestaurantCuisines() as $restaurantCuisine): ?>
                                <?php if ($cuisine->getId() === $restaurantCuisine->getId()): ?>
                                    selected
                                <?php endif; ?>
                            <?php endforeach; ?>
                        >
                            <?php echo $cuisine->getCuisineName(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>


        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="accessibility">Accessibility</label>
            <div class="col-md-4">
                <input id="accessibility" name="accessibility"
                       type="text" class="form-control input-md"
                       value="<?php echo $restaurant->getAccessibility() ?>">
            </div>
        </div>

        <!-- Button -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="submit"></label>
            <div class="col-md-4">
                <button id="submit" name="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </fieldset>
</form>

