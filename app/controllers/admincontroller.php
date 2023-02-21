<?php

namespace controllers;

use services\UserService;
use models\User;

class AdminController
{
    private UserService $userService;

    public function __construct()
    {
        $this->userService = new UserService();
        if ((!$this->userService->checkPermissions("admin")) && (!$this->userService->checkPermissions("super-admin"))){
            $this->userService->redirect('/?error=You do not have the permission to do this');
        }
    }
    public function index()
    {
        require __DIR__ . '/../views/admin/index.php';
    }
    public function users()
    {
        $model = $this->userService->getAll();
        require __DIR__ . '/../views/admin/users.php';
    }

    public function deleteUser($userId)
    {
        $this->userService->deleteOne($userId);
    }
}