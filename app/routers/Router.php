<?php

use Bramus\Router\Router;

$router = new Router();


//Home Routes
$router->get('/home', function () {
    $controller = new controllers\HomeController();
    $controller->index();
});
$router->get('/index', function () {
    $controller = new controllers\HomeController();
    $controller->index();
});
$router->get('/', function () {
    $controller = new controllers\HomeController();
    $controller->index();
});


//User routes
$router->get('/login', function () {
    $controller = new controllers\LoginController();
    $controller->login();
});
$router->post('/login', function () {
    $controller = new controllers\LoginController();
    $controller->loginPost();
});
$router->get('/logout', function () {
    $controller = new controllers\LoginController();
    $controller->logout();
});


//Admin routes
$router->get('/admin', function () {
    $controller = new controllers\AdminController();
    $controller->index();
});
$router->get('/admin/users', function () {
    $controller = new controllers\AdminController();
    $controller->users();
});
$router->get('/admin/users/(\d+)', function ($userId) {
    $controller = new controllers\AdminController();
    $controller->deleteUser($userId);
});
