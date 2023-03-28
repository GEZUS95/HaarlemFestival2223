<?php
session_start();

require_once __DIR__ . '/../vendor/autoload.php';

$router = new \Bramus\Router\Router();
require_once __DIR__ . '/../routers/HomeRouter.php';
require_once __DIR__ . '/../routers/AdminRouter.php';
require_once __DIR__ . '/../routers/CartRouter.php';
require_once __DIR__ . '/../routers/TestRouter.php';
require_once __DIR__ . '/../routers/UserRouter.php';
require_once __DIR__ . '/../routers/RestaurantRouter.php';
require_once __DIR__ . '/../routers/EventRouter.php';
require_once __DIR__ . '/../routers/PaymentRouter.php';
require_once __DIR__ . '/../routers/UploadRouter.php';
require_once __DIR__ . '/../routers/ApiRouter.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
}
$router->run();