<?php
$pages = (new services\ContentService)->getAllPagesNonDeletable();
$events = (new services\EventService)->getAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Haarlem Festival 2023</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.cdnfonts.com/css/comic-sans" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/papyrus" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>
<body style="font-family: 'Comic Sans', 'Papyrus', sans-serif;">

<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="/">Haarlem Festival 2023</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle"
                       id="navbarDropdownMenuLink"
                       data-bs-toggle="dropdown"
                       role="button"
                       aria-expanded="false">
                        Events
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <?php foreach ($events as $event) : ?>
                            <a class="dropdown-item" href="/event/<?= $event->getId() ?>"><?= $event->getTitle() ?></a>
                        <?php endforeach; ?>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/venues">Venues</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/artist">Artists</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle"
                       id="navbarDropdownMenuLink"
                       data-bs-toggle="dropdown"
                       role="button"
                       aria-expanded="false">
                        Information
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="/about-haarlem">About haarlem</a>
                        <?php foreach ($pages as $page) : ?>
                            <a class="dropdown-item"
                               href="/page/<?= $page->getTitle(); ?>"><?= $page->getTitle(); ?></a>
                        <?php endforeach; ?>
                    </div>
                </li>
                <?php
                if (isset($_SESSION['user'])) {
                    if (($_SESSION['user']['role_id'] == 2) || ($_SESSION['user']['role_id'] == 3)) {
                        echo '<li class="nav-item">
                            <a class="nav-link" href="/admin">Admin Panel</a>
                        </li>';
                    }
                }
                ?>
            </ul>
            <?php if (!isset($_SESSION['user'])) {
                echo '
                <form class="form-inline" action="/login" method="get">
                    <button class="btn btn-outline-success" type="submit">Login</button>
                </form>
            ';
            } else {
                echo '
                    <form class="form-inline" action="/cart" method="get">
                        <button class="btn btn-outline-light" type="submit"><i class="bi bi-cart"></i></button>
                    </form>
                    <form class="form-inline" action="/user/update" method="get">
                        <button class="btn btn-outline-warning" type="submit">Manage Account</button>
                    </form>
                    <form class="form-inline" action="/logout" method="get">
                        <button class="btn btn-outline-danger" type="submit">Logout</button>
                    </form>
            ';
            } ?>
        </div>
    </div>
</nav>

<div class="container">

    <?php
    if (isset($_GET['success'])) {
        echo "<div class='alert alert-success'>" . $_GET['success'] . " </div>";
    }
    if (isset($_GET['error'])) {
        echo "<div class='alert alert-danger'>" . $_GET['error'] . " </div>";
    }
    ?>
