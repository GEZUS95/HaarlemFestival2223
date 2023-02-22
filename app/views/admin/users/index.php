<?php
include __DIR__ . '/../admin-header.php';
?>

<h1>Welcome to the users panel</h1>

<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Username</th>
        <th scope="col">Role</th>
        <th scope="col">Email</th>
        <th scope="col">Created At</th>
        <th scope="col"><a href="/admin/users/create" class="btn btn-success" role="button">Create User</a></th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($model as $user) {
        ?>

        <tr>
            <th scope="row"><?php echo $user->getId() ?></th>
            <td><?php echo $user->getName() ?></td>
            <td><?php echo $user->getRoleId() ?></td>
            <td><?php echo $user->getEmail() ?></td>
            <td><?php echo $user->getCreatedAt() ?></td>
            <td>
                <a href="/admin/users/update/<?php echo $user->getId() ?>" class="btn btn-warning">Update User</a>
                <a href="/admin/users/delete/<?php echo $user->getId() ?>" class="btn btn-danger">Delete User</a>
            </td>
        </tr>

        <?php
    }
    ?>
    </tbody>
</table>
