<?php

namespace controllers;
use services\UserService;

class AdminController
{
    private UserService $userService;

    function __construct()
    {
        $this->userService = new UserService();
    }
    public function index(){
        require __DIR__ . '/../views/admin/index.php';
    }
    public function users(){
        $model = $this->userService->getAll();
        require __DIR__ . '/../views/admin/users.php';
    }
}