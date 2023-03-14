<?php
session_start();

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../routers/Router.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
}

$router->run();
