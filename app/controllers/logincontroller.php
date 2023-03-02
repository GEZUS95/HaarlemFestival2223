<?php
namespace controllers;

use services\UserService;

class LoginController
{

    private UserService $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function login()
    {
        require_once __DIR__ . '/../views/user/login.php';
    }

    public function loginPost()
    {
        $this->userService->login($_POST['Email'], $_POST['password']);
    }

    public function logout()
    {
        $this->userService->logout();
    }
}
