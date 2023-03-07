<?php
include_once __DIR__ . '/../admin-header.php';
?>

<h1 id="description">Welcome to the api keys panel</h1>

<table class="table table-striped" aria-describedby="description">
    <thead>
    <tr>
        <th scope="col">Uuid</th>
        <th scope="col">description</th>
        <th scope="col">Created At</th>
        <th scope="col"><a href="/admin/api/create" class="btn btn-success" role="button">Create Api Key</a></th>
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
                <a href="/admin/api/update/<?php echo $api->getId() ?>" class="btn btn-warning">Update Key</a>
                <a href="/admin/api/delete/<?php echo $api->getId() ?>" class="btn btn-danger">Delete Key</a>
            </td>
        </tr>

        <?php
    }
    ?>
    </tbody>
</table>
