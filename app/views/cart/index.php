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


<?php
include __DIR__ . '/../footer.php';
