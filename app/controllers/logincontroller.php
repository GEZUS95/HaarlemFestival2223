<?php
require './../services/userservice.php';
class LoginController
{
    public function index()
    {
        if (isset($_POST['Email'])) {
            $userService = new UserService();
            $userService->login($_POST['Email'],$_POST['password']);
        }
        require __DIR__ . '/../views/login.php';
    }
}