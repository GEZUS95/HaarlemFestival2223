<?php
include __DIR__ . '/admin-header.php';
?>

<h1>Welcome to the users panel</h1>

<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Username</th>
        <th>Email</th>
        <th>Created At</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($model as $user) {
        ?>

        <tr>
            <td><?php echo $user->getId() ?></td>
            <td><?php echo $user->getName() ?></td>
            <td><?php echo $user->getEmail() ?></td>
            <td><?php //echo $user->getCreatedAt() ?></td>
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
