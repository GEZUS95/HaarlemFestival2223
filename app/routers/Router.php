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
$router->get('/register', function () {
    $controller = new controllers\UserController();
    $controller->register();
});
$router->post('/register', function () {
    $controller = new controllers\UserController();
    $controller->registerPost();
});


//Admin routes
$router->get('/admin', function () {                                // Show Admin Panel
    $controller = new controllers\AdminController();
    $controller->index();
});
$router->get('/admin/users', function () {                          // Show All Users
    $controller = new controllers\AdminController();
    $controller->users();
});
$router->get('/admin/users/update/(\d+)', function ($userId) {      // Update User Get
    $controller = new controllers\AdminController();
    $controller->updateUser($userId);
});
$router->post('/admin/users/update/(\d+)', function ($userId) {      // Update User Post
    $controller = new controllers\AdminController();
    $controller->updateUserPost($userId);
});
$router->get('/admin/users/delete/(\d+)', function ($userId) {      // Delete User
    $controller = new controllers\AdminController();
    $controller->deleteUser($userId);
});
