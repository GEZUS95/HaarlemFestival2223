<?php

namespace routers;

use controllers\LoginController;
use controllers\UserController;

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
$router->get('/user/update', function () {
    $userController = new UserController();
    $userController->showUserUpdate();
});
$router->post('/user/update/{id}', function ($id) {
    $userController = new UserController();
    $userController->userUpdate($id);
});
