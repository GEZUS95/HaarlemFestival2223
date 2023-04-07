<?php
include_once __DIR__ . '/../admin-header.php';
?>
<h1 id="description">Welcome to the program panel</h1>
<table class="table table-striped" aria-describedby="description">
    <thead>
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Title</th>
        <th scope="col">Price</th>
        <th scope="col">Start Time</th>
        <th scope="col">End Time</th>
        <th scope="col"><a href="/admin/newprogram/<?php echo $eventId ?>" class="btn btn-success" role="button">Create Program</a></th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($model as $program) {
        ?>
        <tr class="program-row" data-program-id="<?php echo $program->getId() ?>">
            <th scope="row"><?php echo $program->getId() ?></th>
            <td><?php echo $program->getTitle() ?></td>
            <td><?php echo $program->getPrice() ?></td>
            <td><?php echo $program->getStartTime() ?></td>
            <td><?php echo $program->getEndTime() ?></td>
            <td>
                <!-- button to view program items -->
                <button class="btn btn-primary program-items-button" data-program-id="<?php echo $program->getId() ?>">View Program Items</button>
                <a href="/admin/updateprogram/<?php echo $program->getId() ?>" class="btn btn-warning">Update Program</a>
                <a href="/admin/deleteprogram/<?php echo $program->getId() ?>" class="btn btn-danger">Delete Program</a>
            </td>
        </tr>
        <tr class="program-items-row" style="display: none;">
            <td colspan="6">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Location</th>
                        <th scope="col">Artist</th>
                        <th scope="col">Special Guest</th>
                        <th scope="col">Title</th>
                        <th scope="col">Start Time</th>
                        <th scope="col">End Time</th>
                        <th scope="col">Price</th>
                        <th scope="col">Seats Left</th>
                        <th scope="col"><a href="/admin/newprogramitem/<?php echo $program->getId() ?>" class="btn btn-success" role="button">Create Program Item</a></th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody class="program-items-body"></tbody>
                    <?php
                    foreach ($programItems as $programItem) {
                        if ($programItem->getProgramId() !== $program->getId()) {
                            continue;
                        }
                        ?>
                        <tr>
                            <td><?php echo $programItem->getId() ?></td>
                            <td><?php foreach ($locations as $location) {
                                    if ($location->getId() === $programItem->getLocationId())
                                    {
                                        echo $location->getName();
                                    }
                                } ?></td>
                            <td><?php foreach ($artists as $artist) {
                                    if ($artist->getId() === $programItem->getArtistId())
                                    {
                                        echo $artist->getName();
                                    }
                                }?></td>
                            <td><?php foreach ($artists as $artist) {
                                    if ($artist->getId() === $programItem->getSpecialGuestId())
                                    {
                                        echo $artist->getName();
                                    }
                                }?></td>
                            <td><?php echo $programItem->getTitle() ?></td>
                            <td><?php echo $programItem->getStartTime() ?></td>
                            <td><?php echo $programItem->getEndTime() ?></td>
                            <td><?php echo $programItem->getPrice() ?></td>
                            <td><?php echo $programItem->getSeatsLeft() ?></td>
                            <td><a href="/admin/updateprogramitem/<?php echo $programItem->getId() ?>" class="btn btn-warning">Update Program Item</a></td>
                            <td><a href="/admin/deleteprogramitem/<?php echo $programItem->getId() ?>" class="btn btn-danger">Delete Program Item</a></td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
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
            <a class="page-link" href="/admin/programs/{id}/?p=<?= isset($_GET['p']) ? ($_GET['p'] - 1) : 0 ?>">Previous</a>
        </li>
        <li class="page-item">
            <a class="page-link" href="/admin/programs/{id}/?p=<?= isset($_GET['p']) ? ($_GET['p'] + 1) : 1 ?>">Next</a>
        </li>
    </ul>
</nav>

<script>
    // Get all the program items buttons
    const programItemsButtons = document.querySelectorAll('.program-items-button');

    // Loop through each button
    programItemsButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Get the program items row that corresponds to this button
            const programItemsRow = button.parentNode.parentNode.nextElementSibling;

            // Toggle the display of the program items row
            programItemsRow.style.display = programItemsRow.style.display === 'none' ? '' : 'none';
        });
    });
</script>
