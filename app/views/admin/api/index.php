<?php
include_once __DIR__ . '/../admin-header.php';
?>

<h1 id="description">Welcome to the API keys panel</h1>

<table class="table table-striped" aria-describedby="description">
    <thead>
    <tr>
        <th scope="col">Uuid</th>
        <th scope="col">description</th>
        <th scope="col">Created At</th>
        <th scope="col"><a href="/admin/api/create" class="btn btn-success" role="button">Create API Key</a></th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($model as $api) {
        ?>

        <tr>
            <th scope="row"><?php echo $api['uuid'] ?></th>
            <td><?php echo $api['description'] ?></td>
            <td><?php echo $api['created_at'] ?></td>
            <td>
                <a href="/admin/api/email/<?php echo $api['uuid'] ?>" class="btn btn-warning">Email Key</a>
                <a href="/admin/api/delete/<?php echo $api['uuid'] ?>" class="btn btn-danger">Delete Key</a>
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
            <a class="page-link" href="/admin/api?p=<?= isset($_GET['p']) ? ($_GET['p'] - 1) : 0 ?>">Previous</a>
        </li>
        <li class="page-item">
            <a class="page-link" href="/admin/api?p=<?= isset($_GET['p']) ? ($_GET['p'] + 1) : 1 ?>">Next</a>
        </li>
    </ul>
</nav>
