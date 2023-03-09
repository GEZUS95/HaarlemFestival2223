<?php
use Bramus\Router\Router;

$router = new Router();

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


//User routes
$router->get('/login', function () {
    $loginController = new LoginController();
    $loginController->login();
});
$router->post('/login', function () {
    $loginController = new LoginController();
    $loginController->loginPost();
});
$router->get('/logout', function () {
    $loginController = new LoginController();
    $loginController->logout();
});
$router->get('/register', function () {
    $userController = new UserController();
    $userController->register();
});
$router->post('/register', function () {
    $userController = new UserController();
    $userController->registerPost();
});
$router->get('/resetpassword', function () {
    $userController = new UserController();
    $userController->requestResetPassword();
});
$router->post('/resetpassword', function () {
    $userController = new UserController();
    $userController->requestResetPasswordPost();
});
$router->get('/resetpassword/{uuid}', function ($uuid) {
    $userController = new UserController();
    $userController->resetPasswordPage($uuid);
});
$router->post('/resetpassword/{uuid}', function ($uuid) {
    $userController = new UserController();
    $userController->resetPasswordPost($uuid);
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
$router->get('/admin', function () {                                // Show Admin Panel
    $adminController = new AdminController();
    $adminController->index();
});
$router->get('/admin/users', function () {                          // Show All Users
    $adminController = new AdminController();
    $adminController->users();
});
$router->get('/admin/users/update/(\d+)', function ($userId) {      // Update User Get
    $adminController = new AdminController();
    $adminController->updateUser($userId);
});
$router->post('/admin/users/update/(\d+)', function ($userId) {      // Update User Post
    $adminController = new AdminController();
    $adminController->updateUserPost($userId);
});
$router->get('/admin/users/create', function () {                   // Create User Get
    $adminController = new AdminController();
    $adminController->createUser();
});
$router->post('/admin/users/create', function () {                  // Create User Post
    $adminController = new AdminController();
    $adminController->createUserPost();
});
$router->get('/admin/users/delete/(\d+)', function ($userId) {      // Delete User
    $adminController = new AdminController();
    $adminController->deleteUser($userId);
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
