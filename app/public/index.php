<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../services/userservice.php';
use routers\PatternRouter;
$uri = trim($_SERVER['REQUEST_URI'], '/');

$router = new PatternRouter();
$router->route($uri);

use controllers\AdminController;

$controller = new AdminController();