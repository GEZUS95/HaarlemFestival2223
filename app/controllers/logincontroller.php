<?php
require './../services/userservice.php';

namespace controllers;
class LoginController
{

    private UserService $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function index()
    {
        if ((isset($_POST['Email'])) && (isset($_POST['password']))) {
            $this->userService->login($_POST['Email'], $_POST['password']);
        }
        require __DIR__ . '/../views/login.php';
    }

    public function logout()
    {
        $this->userService->logout();
    }
}