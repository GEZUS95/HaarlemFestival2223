<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Haarlem Festival 2023</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="/">Haarlem Festival 2023</a>
        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item">
                    <a class="nav-link" href="/admin">Admin Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/users">Users</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle"
                       id="navbarDropdownMenuLink"
                       data-bs-toggle="dropdown"
                       role="button"
                       aria-expanded="false">
                        Events
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="/admin/events">Events</a>
                        <a class="dropdown-item" href="/admin/locations">Locations</a>
                        <a class="dropdown-item" href="/admin/artists">Artists</a>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/admin/content">Content Pages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/restaurants">Restaurants</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/sessions">Sessions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/reservations">Reservations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/api">Api keys</a>
                </li>
            </ul>
            <?php if (!isset($_SESSION['user'])) {
                echo '
                <form class="form-inline" action="/login">
                    <button class="btn btn-outline-success" type="submit">Login</button>
                </form>
            ';
            } else {
                echo '
                 <form class="form-inline" action="/logout">
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

