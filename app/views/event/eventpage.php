<?php
include_once __DIR__ . '/../header.php';
?>
<div class="row">
    <div class="col-3"></div>
    <div class="col-6">
        <h1>Event <?php echo $page_event->getTitle(); ?></h1>
        <p><?php echo $page_event->getDescription(); ?></p>
        
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
    <div class="col-3"></div>
</div>

<?php
include_once __DIR__ . '/../footer.php';
?>
