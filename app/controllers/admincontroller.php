<?php

namespace controllers;

require __DIR__ . '/../services/userservice.php';
class AdminController
{
    private $userService;

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