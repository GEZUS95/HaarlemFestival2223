<?php
include_once __DIR__ . '/../header.php';
?>

<body>
<div class="row">
    <div class="col-3"></div>
    <div class="col-6">
        <h1>Restaurant <?php echo $restaurant->getName(); ?></h1>
        <p><?php foreach ($restaurant->getRestaurantCuisines() as $cuisine): ?>
                <?php echo $cuisine->getCuisineName() . ' '; ?>
            <?php endforeach; ?></p>
        <p><?php echo $restaurant->getDescription(); ?></p>
        <p><?php echo $restaurant->getStars(); ?> Stars</p>
        <p>Total seats: <?php echo $restaurant->getSeats(); ?></p>
        <p>Price: <?php echo $restaurant->getPrice(); ?></p>
        <p>Price for Children: <?php echo $restaurant->getPriceChild(); ?></p>
        <p>Accessibility: <?php echo $restaurant->getAccessibility(); ?></p>


        <h1>Location</h1>
        <p><?php echo $location->getName(); ?></p>
        <p>Address: <?php echo $location->getAddress(); ?>, <?php echo $location->getCity(); ?></p>
        <p>Stage: <?php echo $location->getStage(); ?></p>
    </div>
    <div class="col-3"></div>
</div>

<div class="row">
    <div class="col-3"></div>
    <div class="col-6">
        <h1>Sessions</h1>
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><?php echo date('l F jS'); ?></h5>
                </div>
                <div class="card-body">
                    <?php foreach ($sessions as $session): ?>
                        <p class="card-text"><strong>Time:</strong> <?php echo date('H:i', strtotime($session['start_time'])); ?>-<?php echo date('H:i', strtotime($session['end_time'])); ?></p>
                        <p class="card-text"><strong>Seats Left:</strong> <?php echo $session['seats_left']; ?></p>
                        <a href="/reservation/<?php echo $session['id']; ?>" class="btn btn-primary">Put in cart</a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

    </div>
    <div class="col-3"></div>
</div>

</body>

<?php
include_once __DIR__ . '/../footer.php';
?>

