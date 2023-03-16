<?php
include_once __DIR__ . '/../admin-header.php';
?>
<h1 id="description">Order <?= $order->getId() ?></h1>

<table class="table table-striped" aria-describedby="description">
    <thead>
    <tr>
        <th scope="col">Item</th>
        <th scope="col">quantity</th>
        <th scope="col"><a href="/admin/orders/create" class="btn btn-success" role="button">Create Order</a></th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($orderItems as $order) {
        ?>

        <tr>
            <th scope="row"><?php echo $order->getId() ?></th>
            <td><?php echo $order->getUserId() ?></td>
            <td><?php echo $order->getShareUuid() ?></td>
            <td><?php echo $order->getStatus() ?></td>
            <td>
                <a href="/admin/order/<?php echo $order->getId() ?>" class="btn btn-warning">Show order</a>
                <!--                <a href="/admin/users/delete/-->
                <?php //echo $order->getId() ?><!--" class="btn btn-danger">Delete User</a>-->
            </td>
        </tr>

        <?php
    }
    ?>
    </tbody>
