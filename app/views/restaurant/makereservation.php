<?php
include_once __DIR__ . '/../header.php';
?>

<body>
<div class="row">
    <div class="col-3"></div>
    <div class="col-6">
        <h1>Reservation Form</h1>
        <form method="post" action="" class="form">
            <div class="form-group">
                <label for="remarks">Remarks:</label>
                <input type="text" id="remarks" name="remarks" class="form-control" >
            </div>
            <div class="form-group">
                <label for="amount">Amount:</label>
                <input type="text" id="amount" name="amount" class="form-control" min="0" max="<?php echo $session->getSeatsLeft(); ?>" required>
            </div>
            <div class="form-group">
                <label for="amount_child">Amount Child:</label>
                <input type="text" id="amount_child" name="amount_child" class="form-control" min="0" max="<?php echo $session->getSeatsLeft(); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <div class="col-3"></div>
</body>

<?php
include_once __DIR__ . '/../footer.php';
?>
