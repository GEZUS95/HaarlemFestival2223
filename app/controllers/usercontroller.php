<?php
require __DIR__ . '/../services/userservice.php';
class UserController
{
    private UserService $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function resetpassword(){
        require __DIR__ . '/../views/user/resetpassword.php';
    }
}