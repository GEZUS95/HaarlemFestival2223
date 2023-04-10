<?php
include_once __DIR__ . '/../header.php';
?>
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <h1>Program <?php echo $program->getTitle(); ?></h1>

            <h3>Items</h3>
            <div class="container">
                <?php foreach ($items as $item): ?>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title"><?= $item->getTitle() ?></h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <strong>Time:</strong> <?php echo date('H:i', strtotime($item->getStartTime())); ?>
                                -
                                <?php echo date('H:i', strtotime($item->getEndTime())); ?>
                            </p>
                            <p>Price: <?= $item->getPrice() ?></p>
                            <p>Seats left: <?= $item->getSeatsLeft() ?></p>
                            <form action="/item/<?php echo $item->getId(); ?>" method="post">
                                <input type="number" name="quantity" value="1" min="1" max="<?php echo $item->getSeatsLeft(); ?>" class="form-control-sm">
                                <input type="submit" value="Put in cart" class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                    <br>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php
include_once __DIR__ . '/../footer.php';
