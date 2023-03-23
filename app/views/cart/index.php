<?php
include __DIR__ . '/../header.php';
?>

    <h1>Shopping cart</h1>

    <table class="table table-striped" aria-describedby="description">
    <thead>
    <tr>
        <th scope="col">Item</th>
        <th scope="col">Table</th>
        <th scope="col">item id</th>
        <th scope="col">quantity</th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($orderItems as $item) {
        ?>

        <tr>
            <th scope="row"><?= $item->getId() ?></th>
            <td><?= $item->getTable() ?></td>
            <td><?= $item->getItemId() ?></td>
            <td>
                <form method="post" action="/cart/update/<?= $item->getId() ?>" class="form-inline">
                    <div class="form-row">
                        <div class="col">
                            <input id="quantity" name="quantity" placeholder="quantity" type="number" class="form-control"
                                   required="required" value="<?= $item->getQuantity() ?>" min="1">
                        </div>


                        <div class="col">
                            <button id="submit" name="submit" class="btn btn-primary form-control">Update</button>
                        </div>
                    </div>
                </form>
            </td>

            <td><a href="/cart/delete/<?= $item->getId() ?>" class="btn btn-warning">Remove from cart</a></td>
        </tr>

        <?php
    }
    ?>

    </tbody>


<?php
include __DIR__ . '/../footer.php';
