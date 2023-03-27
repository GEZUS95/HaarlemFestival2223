<?php
include __DIR__ . '/../header.php';
?>

    <h1>Shopping cart</h1>

    <a href="/cart/pay/<?= $order->getId()?>" class="btn btn-success">Pay</a>

    <table class="table table-striped" aria-describedby="description">
    <thead>
    <tr>
        <th scope="col">Item</th>
        <th scope="col">quantity</th>
        <th scope="col">child ticket</th>
        <th scope="col">price (excl. VAT)</th>
        <th scope="col"></th>

    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($orderItems as $item) {
        ?>

        <tr>
            <th scope="row"><?= $item['name'] ?></th>
            <td>
                <form method="post" action="/cart/update/<?= $item['id'] ?>" class="form-inline">
                    <div class="form-row">
                        <div class="col">
                            <input id="quantity"
                                   name="quantity"
                                   placeholder="quantity"
                                   type="number"
                                   class="form-control"
                                   required="required"
                                   value="<?= $item['quantity'] ?>"
                                   min="1"
                            >
                        </div>
                        <div class="col">
                            <button id="submit" name="submit" class="btn btn-primary form-control">Update</button>
                        </div>
                    </div>
                </form>
            </td>
            <td><?= $item['isChild'] ?></td>
            <td><?= $item['price'] * $item['quantity'] ?></td>
            <td><a href="/cart/delete/<?= $item['id'] ?>" class="btn btn-danger">Remove from cart</a></td>
        </tr>

        <?php
    }
    ?>

    </tbody>


<?php
include __DIR__ . '/../footer.php';
