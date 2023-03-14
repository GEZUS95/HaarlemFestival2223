<?php

namespace controllers;

use services\PasswordResetService;
use services\UserService;

class UserController
{
    private UserService $userService;
    private PasswordResetService $passwordResetService;

    public function __construct()
    {
        $this->userService = new UserService();
        $this->passwordResetService = new PasswordResetService();
    }

    public function requestResetPassword()
    {
        require_once __DIR__ . '/../views/user/requestresetpassword.php';
    }

    public function requestResetPasswordPost()
    {
        if (!isset($_POST['email'])) {
            $this->userService->redirect('/resetpassword?error=No email provided');
        }
        $this->userService->requestPasswordReset($_POST['email']);
    }

    public function resetPasswordPage(string $uuid)
    {
        if (!$this->passwordResetService->checkUuid($uuid)) {
            $this->userService->redirect('/passwordreset?error=This link is not valid, please try again');
        }

        require_once __DIR__ . '/../views/user/resetpassword.php';
    }

    public function resetPasswordPost(string $uuid)
    {
        $this->userService->resetPassword($uuid, $_POST['newpassword'], $_POST['newpasswordcheck']);
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

    public function showUserUpdate()
    {
        $this->userService->verifySession();
        $user = $this->userService->getUserFromSession();
        require_once __DIR__ . '/../views/user/update.php';
    }

    public function userUpdate(int $id)
    {
            $this->userService->update($_POST['name'], $_POST['email'], $_POST['emailcheck'], $id);
    }
}
