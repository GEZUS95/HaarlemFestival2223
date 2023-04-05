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
        <!-- if no sessions make message no session -->
        <?php if (empty($sessions)): ?>
            <p>There are no sessions currently for this restaurant</p>
        <?php endif; ?>
        <?php foreach ($sessions as $session): ?>
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><?php echo date('l F jS'); ?></h5>
                </div>
                <div class="card-body">
                        <p class="card-text"><strong>Time:</strong> <?php echo date('H:i', strtotime($session->getStartTime())); ?>
                            - <?php echo date('H:i', strtotime($session->getEndTime())); ?></p>
                        <p class="card-text"><strong>Seats left:</strong> <?php echo $session->getSeatsLeft(); ?></p>
                        <!-- Button that looks if user is logged in and if so, it will redirect to the cart page and if seats 0 button grayed out-->
                        <?php if (isset($_SESSION['user'])): ?>
                            <?php if ($session->getSeatsLeft() > 0): ?>
                                <a href="/reservation/<?php echo $session->getId(); ?>" class="btn btn-primary">Put in cart</a>
                            <?php else: ?>
                                <button class="btn btn-primary" disabled>No seats left</button>
                            <?php endif; ?>
                        <?php else: ?>
                            <a href="/login" class="btn btn-primary">Login to put in cart</a>
                        <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="col-3"></div>
</div>
</body>

<?php
include_once __DIR__ . '/../footer.php';
?>
