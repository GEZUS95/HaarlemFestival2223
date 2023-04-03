<br><br>
<h1>Invoice</h1>
<table>
    <tr>
        <td><strong>Customer Name:</strong></td>
        <td><?php echo $customerName; ?></td>
    </tr>
    <tr>
        <td><strong>Date:</strong></td>
        <td><?php echo $orderDate; ?></td>
    </tr>
    <tr>
        <td><strong>Order Number:</strong></td>
        <td><?php echo $orderNumber; ?></td>
    </tr>
</table>
<br><br>
<br><br>
<table style="padding: 10px;">
    <thead>
    <tr>
        <th>Item Name</th>
        <th>Quantity</th>
        <th>Price (excl. Taxes)</th>
        <th>Tax Rate</th>
        <th>Tax Amount</th>
        <th>Price (incl. Taxes)</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $totalExclTax = 0;
    $totalInclTax = 0;

    foreach ($items as $item) {
        $name = $item['name'];
        $quantity = $item['quantity'];
        $price = $item['price'];

        $priceExclTax = $price;
        $taxAmount = $price * $_ENV['VAT'];
        $priceInclTax = $priceExclTax + $taxAmount;

        $totalExclTax += $priceExclTax * $quantity;
        $totalInclTax += $priceInclTax * $quantity;
        ?>
        <tr>
            <td><?php echo $name; ?></td>
            <td><?php echo $quantity; ?></td>
            <td>&euro;<?php echo number_format($priceExclTax, 2); ?></td>
            <td><?php echo number_format($_ENV['VAT'] * 100) . '%'; ?></td>
            <td>&euro;<?php echo number_format($taxAmount, 2); ?></td>
            <td>&euro;<?php echo number_format($priceInclTax, 2); ?></td>
        </tr>
        <?php
    }
    ?>
    </tbody>
    <tfoot>
    <tr>
        <td colspan="5"><strong>Total (excl. Taxes):</strong></td>
        <td>&euro;<?php echo number_format($totalExclTax, 2); ?></td>
        <td></td>
    </tr>
    <tr>
        <td colspan="5"><strong>Total (incl. Taxes):</strong></td>
        <td>&euro;<?php echo number_format($totalInclTax, 2); ?></td>
        <td></td>
    </tr>
    </tfoot>
