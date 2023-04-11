<?php
include_once __DIR__ . '/../header.php';
?>
<?= $page->getBody() ?>

    <div class="container">
        <div class="row">
            <h1> Dance Highlights </h1>
            <?php foreach ($danceHighlights as $highlight): ?>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h2><?= $highlight['title'] ?></h2>
                        </div>
                        <div class="card-body">
                            <h4><?= $highlight['name'] ?></h4>
                            <p><?= $highlight['description'] ?></p>
                            <h5>With: <?= $highlight['special_guest_name'] ?></h5>
                            <p><?= $highlight['special_guest_description'] ?></p>
                            <p>Starts at: <?= $highlight['start_time'] ?></p>
                            <a href="/item/<?= $highlight['id'] ?>" class="btn btn-primary">Go to</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="row">
            <h1> Jazz Highlights </h1>
            <?php foreach ($jazzHighlights as $highlight): ?>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h2><?= $highlight['title'] ?></h2>
                        </div>
                        <div class="card-body">
                            <h4><?= $highlight['name'] ?></h4>
                            <p><?= $highlight['description'] ?></p>
                            <h5>With: <?= $highlight['special_guest_name'] ?></h5>
                            <p><?= $highlight['special_guest_description'] ?></p>
                            <p>Starts at: <?= $highlight['start_time'] ?></p>
                            <a href="/item/<?= $highlight['id'] ?>" class="btn btn-primary">Go to</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="row">
            <h1>Food Highlights</h1>
            <?php foreach ($foodHighlights as $highlight): ?>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h2><?= $highlight->getName() ?></h2>
                        </div>
                        <div class="card-body">
                            <p><?= $highlight->getDescription() ?></p>
                            <p>Stars: <?= $highlight->getStars() ?></p>
                            <a href="/restaurant/<?= $highlight->getId() ?>" class="btn btn-primary">Go to</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

<?php
include_once __DIR__ . '/../footer.php';
