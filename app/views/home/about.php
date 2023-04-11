<?php
include_once __DIR__ . '/../header.php';
?>

    <div class="container">
        <div class="row">
            <h1><?= $about->getTitle() ?></h1>
            <p><?= $about->getBody() ?></p>
        </div>
    </div>


<?php
include_once __DIR__ . '/../footer.php';
