<?php
include_once __DIR__ . '/../admin-header.php';
?>
<h1 id="description">Order <?= $order->getId() ?></h1>

<a href="/admin/orders" class="btn btn-danger">Go back</a>
<!--<a href="/admin/order/--><?php //= $order->getId()?><!--/updatestatus" class="btn btn-warning">Update status</a>-->

<table class="table table-striped" aria-describedby="description">
    <thead>
    <tr>
        <th scope="col">Item</th>
        <th scope="col">Table</th>
        <th scope="col">item id</th>
        <th scope="col">quantity</th>
<!--        <th scope="col"><a href="/admin/orders/create" class="btn btn-success" role="button">Add To Order</a></th>-->
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($orderItems as $order) {
        ?>

        <tr>
            <th scope="row"><?php echo $order->getId() ?></th>
            <td><?php echo $order->getTable() ?></td>
            <td><?php echo $order->getItemId() ?></td>
            <td><?php echo $order->getQuantity() ?></td>
        </tr>

        <?php
    }
    ?>

    </tbody>

