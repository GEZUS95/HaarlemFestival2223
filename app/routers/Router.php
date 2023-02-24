<?php
use Bramus\Router\Router;
use controllers\AdminController;
use controllers\HomeController;
use controllers\LoginController;
use controllers\UserController;

$router = new Router();

// controllers
$loginController = new LoginController();
$homeController = new HomeController();
$adminController = new AdminController();
$userController = new UserController();


//Home Routes
$router->get('/home', function () {
    $this->homeController->index();
});
$router->get('/index', function () {
    $this->homeController->index();
});
$router->get('/', function () {
    $this->homeController->index();
});


//User routes
$router->get('/login', function () {
    $this->loginController->login();
});
$router->post('/login', function () {
    $this->loginController->loginPost();
});
$router->get('/logout', function () {
    $this->loginController->logout();
});
$router->get('/register', function () {
    $this->userController->register();
});
$router->post('/register', function () {
    $this->userController->registerPost();
});
$router->get('/resetpassword', function () {
    $this->userController->requestResetPassword();
});
$router->post('/resetpassword', function () {
    $this->userController->requestResetPasswordPost();
});
$router->get('/resetpassword/{uuid}', function ($uuid) {
    $this->userController->resetPasswordPage($uuid);
});
$router->post('/resetpassword/{uuid}', function ($uuid) {
    $this->userController->resetPasswordPost($uuid);
});


//Admin routes
$router->get('/admin', function () {                                // Show Admin Panel
    $this->adminController->index();
});
$router->get('/admin/users', function () {                          // Show All Users
    $this->adminController->users();
});
$router->get('/admin/users/update/(\d+)', function ($userId) {      // Update User Get
    $this->adminController->updateUser($userId);
});
$router->post('/admin/users/update/(\d+)', function ($userId) {      // Update User Post
    $this->adminController->updateUserPost($userId);
});
$router->get('/admin/users/create', function () {                   // Create User Get
    $this->adminController->createUser();
});
$router->post('/admin/users/create', function () {                  // Create User Post
    $this->adminController->createUserPost();
});
$router->get('/admin/users/delete/(\d+)', function ($userId)  {      // Delete User
    $this->adminController->deleteUser($userId);
});
