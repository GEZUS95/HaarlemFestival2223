<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Haarlem Festival 2023</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="/">Haarlem Festival 2023</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">s
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/home/about">About</a>
                </li>
                <?php
                if ((isset($_SESSION['user'])) && ($_SESSION['user']['role_id'] == 2) || ($_SESSION['user']['role_id'] == 3)) {
                    echo '<li class="nav-item">
                            <a class="nav-link" href="/admin">Admin Panel</a>
                        </li>';
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
                 <form class="form-inline" action="/logout" method="get">
                    <button class="btn btn-outline-danger" type="submit">Logout</button>
                </form>
            ';
            } ?>
        </div>
    </div>
</nav>

<div class="container">
