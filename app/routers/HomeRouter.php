<?php
use Bramus\Router\Router;
use controllers\HomeController;

//Home Routes
$router->get('/home', function () {
    $homeController = new HomeController();
    $homeController->index();
});
$router->get('/index', function () {
    $homeController = new HomeController();
    $homeController->index();
});
$router->get('/', function () {
    $homeController = new HomeController();
    $homeController->index();
});