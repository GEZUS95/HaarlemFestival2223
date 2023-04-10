<?php
include_once __DIR__ . '/../admin-header.php';
?>
<h1>Create New Restaurant</h1>
<form action="/admin/newrestaurant" method="post" class="form-horizontal">
    <fieldset>
        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="name">Name</label>
            <div class="col-md-4">
                <input id="name" name="name"
                       type="text" class="form-control input-md"
                       required="">
            </div>
        </div>
        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="description">Description</label>
            <div class="col-md-4">
                <input id="description" name="description"
                       type="text" class="form-control input-md"
                       required="">
            </div>
        </div>

        <!-- Number input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="stars">Stars</label>
            <div class="col-md-4">
                <input id="stars" name="stars"
                       max="5" min="1"
                       type="number" class="form-control input-md"
                       required="">
            </div>
        </div>

        <!-- Number input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="seats">Seats</label>
            <div class="col-md-4">
                <input id="seats" name="seats"
                       max="100000" min="1"
                       type="number" class="form-control input-md"
                       required="">
            </div>
        </div>

        <!-- Number input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="price">Price</label>
            <div class="col-md-4">
                <input id="price" name="price"
                       max="100000" min="1"
                       type="number" step="0.01" class="form-control input-md"
                       required="">
            </div>
        </div>

        <!-- Number input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="price_child">Price for children</label>
            <div class="col-md-4">
                <input id="price_child" name="price_child"
                       max="100000" min="1"
                       type="number" step="0.01" class="form-control input-md"
                       required="">
            </div>
        </div>

        <!-- Selection input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="location_id">Location</label>
            <div class="col-md-4">
                <select id="location_id" name="location_id" class="form-control" required>
                    <?php foreach ($locations as $location): ?>
                        <option value="<?php echo $location->getId(); ?>">
                            <?php echo $location->getAddress(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <!-- Selection input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="cuisines">Cuisines</label>
            <div class="col-md-4">
                <select id="cuisines" name="cuisines[]" class="form-control" multiple required>
                    <?php foreach ($cuisines as $cuisine): ?>
                        <option value="<?php echo $cuisine->getId(); ?>">
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
                       value="">
            </div>
        </div>

        <!-- Button -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="submit"></label>
            <div class="col-md-4">
                <button id="submit" name="submit" class="btn btn-primary">Create</button>
                <a href="/admin/restaurants" class="btn btn-danger">Go back</a>
            </div>
        </div>
    </fieldset>
</form>
