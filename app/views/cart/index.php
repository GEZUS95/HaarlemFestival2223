<?php
include __DIR__ . '/../header.php';
?>

    <h1>Shopping cart</h1>

    <a href="/cart/pay/<?= $order->getId()?>" class="btn btn-success">Pay</a>

    <table class="table table-striped" aria-describedby="description">
    <thead>
    <tr>
        <th scope="col">Item</th>
        <th scope="col">Start</th>
        <th scope="col">End</th>
        <th scope="col">quantity</th>
        <th scope="col">child ticket</th>
        <th scope="col">price (excl. VAT)</th>
        <th scope="col">VAT</th>
        <th scope="col"></th>

    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($orderItems as $item) {
        ?>
        <tr>
            <th scope="row"><?= $item['name'] ?></th>
            <td><?= $item['start_time'] ?></td>
            <td><?= $item['end_time'] ?></td>
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
                                   max="<?= $item['seats_left'] ?>"
                            >
                        </div>
                        <div class="col">
                            <button id="submit" name="submit" class="btn btn-primary form-control">Update</button>
                        </div>
                    </div>
                </form>
            </td>
            <td><?= isset($item['child']) ? ($item['child'] ? 'yes' : 'no') : '' ?></td>
            <td>€<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
            <td>€<?= number_format(($item['price'] * $item['quantity']) * $_ENV['VAT'], 2) ?></td>
            <td><a href="/cart/delete/<?= $item['id'] ?>" class="btn btn-danger">Remove from cart</a></td>
        </tr>

        <?php
    }
    ?>

    </tbody>


<?php
include __DIR__ . '/../footer.php';
