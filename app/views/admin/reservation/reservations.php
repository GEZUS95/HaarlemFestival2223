<?php
include_once __DIR__ . '../../admin-header.php';
?>
<div class="col-12">
    <div class="row">
        <div class="p-3 py-5">
            <button class="btn btn-info" onclick="location.reload();">
                Refresh Page
            </button>
            <a href="/admin/newreservation" class="btn btn-success">New Reservation</a>
            <h4 class="text-dark">Reservations</h4>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead class="usr-tab-head">
                    <tr class="text-dark">
                        <th>Customer Name</th>
                        <th>Restaurant Name</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Remarks</th>
                        <th>Status</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody class="usr-tab-bod">
                    <?php foreach ($model as $reservation) { ?>
                        <tr>
                            <td></td>
                            <td><?php
                                foreach ($restaurants as $restaurant) {
                                    $session = $this->sessionService->getOneById($reservation->getSessionId());
                                    if ($restaurant->getId() == $session->getRestaurantId()) {
                                        echo $restaurant->getName();
                                    }
                                }
                                ?></td>
                            <td><?=
                                // create DateTime object from string
                                (new DateTime($session->getStartTime()))->format('Y-m-d H:i:s')
                                ?></td>
                            <td><?=
                                // create DateTime object from string
                                (new DateTime($session->getEndTime()))->format('Y-m-d H:i:s')
                                ?></td>
                            <td><?= $reservation->getRemarks() ?></td>
                            <td>
                                <?php if ($reservation->getStatus() == 'active') { ?>
                                    <button class="btn btn-success" disabled>Active</button>
                                <?php } else { ?>
                                    <button class="btn btn-secondary" disabled>Inactive</button>
                                <?php } ?>
                            </td>
                            <td><a href="/admin/reservations/update/<?= $reservation->getId() ?>" class="btn btn-warning">Update</a></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <button class="btn btn-success"><a href="newreservation" class="text-light">New Reservation</a></button>
            </div>
        </div>
    </div>
</div>
