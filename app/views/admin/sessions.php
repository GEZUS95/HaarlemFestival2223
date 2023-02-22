<?php
include_once __DIR__ . '/admin-header.php';
?>

<h1>Welcome to the sessions panel</h1>

<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Restaurant Id</th>
        <th>Start Time</th>
        <th>End Time</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($model as $session) {
        ?>
        <tr>
            <td><?php echo $session->id ?></td>
            <td><?php echo $session->restaurant_id ?></td>
            <td><?php echo $session->start_time->format('Y-m-d H:i:s') ?></td>
            <td><?php echo $session->end_time->format('Y-m-d H:i:s') ?></td>
            <td>
                <button>Update Session</button>
                <button>Delete Session</button>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>

