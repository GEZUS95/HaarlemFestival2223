<?php
include_once __DIR__ . '/admin-header.php';
?>

<h1>Welcome to the restaurants panel</h1>

<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Location Id</th>
        <th>Name</th>
        <th>Restaurant Cuisines</th>
        <th>Description</th>
        <th>Stars</th>
        <th>Seats</th>
        <th>Price</th>
        <th>Price Child</th>
        <th>Session Time</th>
        <th>Accessibility</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($model as $restaurant) {
        var_dump($restaurant);
        ?>
        <tr>
            <td><?php echo $restaurant->getId() ?></td>
            <td><?php echo $restaurant->getLocationId() ?></td>
            <td><?php echo $restaurant->getName() ?></td>
            <td><?php echo $restaurant->getRestaurantCuisines() ?></td>
            <td><?php echo $restaurant->getDescription() ?></td>
            <td><?php echo $restaurant->getStars() ?></td>
            <td><?php echo $restaurant->getSeats() ?></td>
            <td><?php echo $restaurant->getPrice() ?></td>
            <td><?php echo $restaurant->getPriceChild() ?></td>
            <td><?php echo $restaurant->getSessionTime() ?></td>
            <td><?php echo $restaurant->getAccessibility() ?></td>
            <td>
                <button>Update Restaurant</button>
                <button>Delete Restaurant</button>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
