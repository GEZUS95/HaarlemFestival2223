<?php

namespace controllers;

use services\UserService;

class UserController
{
    private UserService $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function resetpassword(): void
    {
        //todo: email link with guid
        if ((isset($_POST['Email'])) && (isset($_POST['password']))) {
            $this->userService->resetPassword($_POST['oldpassword'], $_POST['newpassword'], $_POST['newpasswordcheck']);
        }
        require_once __DIR__ . '/../views/user/resetpassword.php';
    }

    public function register(): void
    {
        require_once __DIR__ . '/../views/user/register.php';
    }

    public function registerPost(): void
    {
        $this->userService->register(
            $_POST['name'],
            $_POST['email'],
            $_POST['emailVerify'],
            $_POST['password'],
            $_POST['passwordVerify']
        );
    }
}
