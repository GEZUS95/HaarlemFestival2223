<?php
include_once __DIR__ . '/../header.php';
?>
<div class="row">
    <div class="col-3"></div>
    <div class="col-6">
        <h1>Event <?php echo $page_event->getTitle(); ?></h1>
        <p><?php echo $page_event->getDescription(); ?></p>

        <?php if ($page_event->getTitle() !== 'Food') { ?>
        <h3>Programs</h3>
        <div class="container">
            <?php foreach ($programs as $program): ?>
                <a href="/event/<?php echo $page_event->getId() . '/' . $program->getTitle(); ?>">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title"><?= $program->getTitle() ?></h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <strong>Time:</strong> <?php echo date('H:i', strtotime($program->getStartTime())); ?>
                                -
                                <?php echo date('H:i', strtotime($program->getEndTime())); ?>
                            </p>
                        </div>
                    </div>
                </a>
                <br>
            <?php endforeach; ?>
        </div>
    </div>
    <?php } else { ?>
    <!-- Sessions in the program -->
    <div class="container">
        <h3>Sessions</h3>
        <?php foreach ($sessions as $session):
        if ($session['seats_left'] > 0): ?>
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    <?=$session['restaurant_name']
                    . ' ' .
                    date('d-M', strtotime($session['start_time'])); ?>
                </h5>
            </div>
            <div class="card-body">
                <p class="card-text">
                    <strong>Time:</strong> <?php echo date('H:i', strtotime($session['start_time'])); ?>
                    -<?php echo date('H:i', strtotime($session['end_time'])); ?></p>
                <p class="card-text"><strong>Seats Left:</strong>
                    <?php echo $session['seats_left']; ?></p>
                <a href="/session/<?php echo $session['id']; ?>" class="btn btn-primary">Put in cart</a>
            </div>
        </div>
    <br>
        <?php endif; ?>
            <?php endforeach; ?>
    </div>
    <?php } ?>
    <div class="col-3"></div>
</div>

<?php
include_once __DIR__ . '/../footer.php';
?>
