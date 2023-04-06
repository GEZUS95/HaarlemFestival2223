<?php
include_once __DIR__ . '/../header.php';
?>

    <h1>Artists on Haarlem Festival</h1>

    <div class="container">
        <?php foreach ($artists as $artist): ?>
            <div class="card col-md-5">
                <div class="card-header">
                    <h5 class="card-title"><?php echo $artist->getName(); ?></h5>
                </div>
                <div class="card-body">
                    <p class="card-text"><?php echo $artist->getDescription(); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>



<?php
include_once __DIR__ . '/../footer.php';
