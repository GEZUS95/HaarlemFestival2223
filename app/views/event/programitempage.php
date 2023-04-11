<?php
include_once __DIR__ . '/../header.php';
?>

<body>
<div class="row">
    <div class="col-3"></div>
    <div class="col-6">
        <h1>Program Item: <?php echo $programItem->getTitle(); ?></h1>
        <p><strong>Start Time:</strong> <?php echo date('H:i', strtotime($programItem->getStartTime())); ?></p>
        <p><strong>End Time:</strong> <?php echo date('H:i', strtotime($programItem->getEndTime())); ?></p>
        <p><strong>Price:</strong> <?php echo $programItem->getPrice(); ?></p>
        <p><strong>Seats Left:</strong> <?php echo $programItem->getSeatsLeft(); ?></p>
        <p><strong>Highlight:</strong> <?php echo $programItem->isHighlight() ? 'Yes' : 'No'; ?></p>

        <h1>Location</h1>
        <p><?php echo $location->getName(); ?></p>
        <p>Address: <?php echo $location->getAddress(); ?>, <?php echo $location->getCity(); ?></p>
        <p>Stage: <?php echo $location->getStage(); ?></p>
        <?php if (isset($_SESSION['user'])) { ?>
        <form action="/item/<?php echo $programItem->getId(); ?>" method="post">
            <input type="number" name="quantity" value="1" min="1" max="<?php echo $programItem->getSeatsLeft(); ?>" class="form-control-sm">
            <input type="submit" value="Put in cart" class="btn btn-primary">
        </form>
        <?php } else { ?>
            <p>Please <a href="/login" class="btn btn-primary">login</a> to put items in your cart.</p>
        <?php } ?>
    </div>
    <div class="col-3"></div>
</div>
</body>

<?php
include_once __DIR__ . '/../footer.php';
?>

