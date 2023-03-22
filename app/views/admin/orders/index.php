<?php
include_once __DIR__ . '/../admin-header.php';
?>
<h1 id="description">Welcome to the orders panel</h1>

<table class="table table-striped" aria-describedby="description">
    <thead>
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Userid</th>
        <th scope="col">Share Id</th>
        <th scope="col">Status</th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($orders as $order) {
        ?>

        <tr>
            <th scope="row"><?= $order->getId() ?></th>
            <td><?= $order->getUserId() ?></td>
            <td><?= $order->getShareUuid() ?></td>
            <td><?= $order->getStatus() ?></td>
            <td>
                <a href="/admin/order/<?= $order->getId() ?>" class="btn btn-warning">Show order</a>
                <a href="/admin/order/<?= $order->getId() ?>/invoice" class="btn btn-success">Get Invoice</a>
                <a href="/admin/order/<?= $order->getId() ?>/updatestatus" class="btn btn-danger">Update Status</a>
            </td>
        </tr>

        <?php
    }
    ?>
    </tbody>
</table>
