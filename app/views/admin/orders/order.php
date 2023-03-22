<?php
include_once __DIR__ . '/../admin-header.php';
?>
<h1 id="description">Order <?= $order->getId() ?></h1>

<a href="/admin/orders" class="btn btn-danger">Go back</a>

<table class="table table-striped" aria-describedby="description">
    <thead>
    <tr>
        <th scope="col">Item</th>
        <th scope="col">quantity</th>
        <th scope="col">child ticket</th>
        <th scope="col">price</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($orderItems as $order) {
        ?>

        <tr>
            <th scope="row"><?php echo $order['name'] ?></th>
            <td><?php echo $order['quantity'] ?></td>
            <td><?php echo $order['isChild'] ?></td>
            <td>&euro;<?php echo $order['price'] * $order['quantity'] ?></td>
        </tr>

        <?php
    }
    ?>

    </tbody>

