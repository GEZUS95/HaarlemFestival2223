<?php
error_reporting(E_ALL); ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ticket</title>
    <style>
        body {
            background-image: url(<?php echo __DIR__ . '/../../public/images/ticket/ticketbackground.jpg' ?>);
            background-repeat: no-repeat;
            background-size: cover;
            font-family: Arial, sans-serif;
        }
        .ticket {
            width: 50%;
            height: 45%;
            margin: 15% auto;
            text-align: center;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            position: relative;
        }
        .ticket h1 {
            margin-top: 10px;
            font-size: 30px;
            font-weight: bold;
        }
        .ticket p {
            margin: 10px;
            font-size: 20px;
        }
        .ticket .qr-code {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
        }
    </style>
</head>
<body>

<?php
use services\QRService;
var_dump($uuid);
$qrcode = (new services\QRService)->generateQRCodeFromUUID(Uuid::fromString($uuid));
$qrCodeImageData = $qrcode->getBarcodePNG(5, 5, 0, 0);
?>

<div class="ticket">
    <h1><?php echo $eventName?></h1>
    <p>Customer Name: <?php echo $customerName?></p>
    <p>Event Date: <?php echo $eventDate?></p>
    <p>Amount of Tickets: <?php echo $ticketAmount?></p>
    <div class="qr-code">
        <?php
        echo $qrCodeImageData;
        ?>
    </div>
</div>
</body>
</html>