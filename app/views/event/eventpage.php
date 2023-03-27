<?php
include_once __DIR__ . '/../header.php';
?>

<body>
<div class="row">
    <div class="col-3"></div>
    <div class="col-6">
    <h1>Event <?php echo $event->getTitle(); ?></h1>
    <p><?php echo $event->getDescription(); ?></p>

    <h1>Program</h1>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title"><?php echo date('l F jS'); ?></h5>
            </div>
            <div class="card-body">
                <?php foreach ($program->getProgramItems() as $programItem): ?>
                    <p class="card-text"><strong>Time:</strong> <?php echo date('H:i', strtotime($programItem->getStartTime())); ?>-<?php echo date('H:i', strtotime($programItem->getEndTime())); ?></p>
                    <p class="card-text"><strong>Seats Left:</strong> <?php echo $programItem->getSeatsLeft(); ?></p>
                    <a href="/programitem/<?php echo $programItem->getId(); ?>" class="btn btn-primary">Put in cart</a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="col-3"></div>
</div>

</body>

<?php
include_once __DIR__ . '/../footer.php';
?>
