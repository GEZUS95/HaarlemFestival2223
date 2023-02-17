<?php
namespace config;

use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;

$transport = Transport::fromDsn('smtp://no-reply@haarlemfestival.com:no-reply2022@mail.haarlemfestival.com:587');
$mailer = new Mailer($transport);
d