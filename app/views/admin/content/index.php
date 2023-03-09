<?php
include_once __DIR__ . '/../admin-header.php';
?>

<h1 id="description">Welcome to the content panel</h1>

<table class="table table-striped" aria-describedby="description">
    <thead>
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Title</th>
        <th scope="col"><a href="/admin/content/create" class="btn btn-success" role="button">Create Page</a></th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($model as $page) {
        ?>

        <tr>
            <th scope="row"><?php echo $page->getId() ?></th>
            <td><?php echo $page->getTitle() ?></td>
            <td>
                <a href="/admin/content/update/<?php echo $page->getId() ?>" class="btn btn-warning">Update Page</a>
                <a href="/admin/content/delete/<?php echo $page->getId() ?>" class="btn btn-danger">Delete Page</a>
            </td>
        </tr>

        <?php
    }
    ?>
    </tbody>
</table>
