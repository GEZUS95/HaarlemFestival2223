<?php
require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../routers/Router.php';

use services\EmailService;
$emailService = new EmailService();
$emailService->sendEmail("no-reply@haarlemfestival.com", "florisbeentjes@ziggo.nl", "Test", "Dit is een testberichtje, als ik deze ontvang werkt het gewoon!");

$router->run();