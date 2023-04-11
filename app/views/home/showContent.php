<?php
include_once __DIR__ . '/../header.php';
?>
    <div class="container">
        <div class="row">
            <h1><?= $content->getTitle() ?></h1>
            <p><?= $content->getBody() ?></p>
        </div>
    </div>
