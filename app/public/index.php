<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../routers/patternrouter.php';
$uri = trim($_SERVER['REQUEST_URI'], '/');

$router = new PatternRouter();
$router->route($uri);

use controllers\AdminController;

$controller = new AdminController();