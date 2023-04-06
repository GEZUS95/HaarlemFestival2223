<?php
include_once __DIR__ . '/../header.php';
?>

    <h1>Venues of Haarlem Festival</h1>

    <div class="container">
        <?php foreach ($venues as $venue): ?>
            <div class="card col-md-5">
                <div class="card-header">
                    <h5 class="card-title"><?php echo $venue->getName(); ?></h5>
                </div>
                <div class="card-body">
                    <p class="card-text"><strong>Address:</strong> <?php echo $venue->getAddress(); ?></p>
                    <p class="card-text"><strong>City:</strong> <?php echo $venue->getCity(); ?></p>
                    <p class="card-text"><strong>Stage:</strong> <?php echo $venue->getStage(); ?></p>
                    <p class="card-text"><strong>Capacity:</strong> <?php echo $venue->getSeats(); ?></p>

                </div>
            </div>
        <br>
        <?php endforeach; ?>
    </div>



<?php
include_once __DIR__ . '/../footer.php';
