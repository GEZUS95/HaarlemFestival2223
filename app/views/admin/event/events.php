<?php
include_once __DIR__ . '/../admin-header.php';
?>

<h1 id="description">Welcome to the event panel</h1>

<table class="table table-striped" aria-describedby="description">
    <thead>
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Title</th>
        <th scope="col">Description</th>
        <th scope="col"><a href="/admin/newevent" class="btn btn-success" role="button">Create Event</a></th>
    </tr>
    </thead>
    <tbody>
    <?php
            foreach ($model as $event) {
        ?>

        <tr>
            <th scope="row"><?php echo $event->getId() ?></th>
            <td><a href="/admin/programs/<?php echo $event->getId() ?>"><?php echo $event->getTitle() ?></a></td>
            <td><?php echo $event->getDescription() ?></td>
            <td>
                <a href="/admin/events/update/<?php echo $event->getId() ?>" class="btn btn-warning">Update Event</a>
                <a href="/admin/events/delete/<?php echo $event->getId() ?>" class="btn btn-danger">Delete Event</a>
            </td>
        </tr>

        <?php
    }
    ?>
    </tbody>
</table>
<nav aria-label="Page navigation">
    <ul class="pagination">
        <li class="page-item <?= !isset($_GET['p']) || $_GET['p'] == 0 ? 'disabled' : '' ?>">
            <a class="page-link" href="/admin/events?p=<?= isset($_GET['p']) ? ($_GET['p'] - 1) : 0 ?>">Previous</a>
        </li>
        <li class="page-item">
            <a class="page-link" href="/admin/events?p=<?= isset($_GET['p']) ? ($_GET['p'] + 1) : 1 ?>">Next</a>
        </li>
    </ul>
</nav>
