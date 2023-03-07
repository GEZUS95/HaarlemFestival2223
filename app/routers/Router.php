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

    //Cart Routes
    $router->get('/cart', function() {
        $controller = new controllers\CartController();
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
    $router->get('/admin/users', function() {
    $controller = new controllers\AdminController();
    $controller->users();
    });
    $router->get('/admin/restaurants', function() {
    $controller = new controllers\AdminController();
    $controller->restaurants();
    });
    $router->get('/admin/restaurants/update/(\d+)', function ($restaurantId) {
        $controller = new controllers\AdminController();
        $controller->updateRestaurant($restaurantId);
    });
    $router->post('/admin/restaurants/update/(\d+)', function ($restaurantId) {
        $controller = new controllers\AdminController();
        $controller->updateRestaurantPost($restaurantId);
    });
    $router->get('/admin/newrestaurant', function() {
    $controller = new controllers\AdminController();
    $controller->newrestaurant();
    });
    $router->get('/admin/newsession', function() {
    $controller = new controllers\AdminController();
    $controller->newsession();
    });
    $router->get('/admin/sessions', function() {
    $controller = new controllers\AdminController();
    $controller->sessions();
    });
