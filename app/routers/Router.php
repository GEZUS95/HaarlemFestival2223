<?php

use Bramus\Router\Router;

$router = new Router();
    //Home Routes
    $router->get('/home', function() {
        $controller = new controllers\HomeController();
        $controller->index();
    });
    $router->get('/index', function() {
    $controller = new controllers\HomeController();
    $controller->index();
    });
    $router->get('/', function() {
        $controller = new controllers\HomeController();
        $controller->index();
    });

    //User routes
    $router->get('/login', function() {
    $controller = new controllers\LoginController();
    $controller->index();
    });

    //Admin routes
    $router->get('/admin', function() {
    $controller = new controllers\AdminController();
    $controller->index();
    });

    //Test routes
    $router->get('/email', function() {
    $controller = new controllers\EmailController();
    $controller->index();
    });