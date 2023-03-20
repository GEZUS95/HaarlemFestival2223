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
        <th scope="col"><a href="/admin/orders/create" class="btn btn-success disabled" role="button">Create Order</a></th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($orders as $order) {
        ?>

        <tr>
            <th scope="row"><?php echo $order->getId() ?></th>
            <td><?php echo $order->getUserId() ?></td>
            <td><?php echo $order->getShareUuid() ?></td>
            <td><?php echo $order->getStatus() ?></td>
            <td>
                <a href="/admin/order/<?php echo $order->getId() ?>" class="btn btn-warning">Show order</a>
                <a href="/admin/order/<?php echo $order->getId() ?>/invoice" class="btn btn-success">Get Invoice</a>
                <a href="/admin/order/<?php echo $order->getId() ?>/updatestatus" class="btn btn-danger">Update Status</a>
            </td>
        </tr>

        <?php
    }
    ?>
    </tbody>
</table>
