<?php
include __DIR__ . '/admin-header.php';
?>

<h1>Welcome to the users panel</h1>

<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>username</th>
        <th>email</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($model as $user) {
        ?>

        <tr>
            <td><?php $user->getId() ?></td>
            <td><?php $user->getName() ?></td>
            <td><?php $user->getEmail() ?></td>
            <td>
                <button>Change Password</button>
                <button>Update User</button>
                <button>Delete User</button>
            </td>
        </tr>

        <?php
    }
    ?>
    </tbody>
</table>