<?php

namespace controllers;

use services\RoleService;
use services\UserService;

class AdminController
{
    private UserService $userService;
    private RoleService $roleService;

    public function __construct()
    {
        $this->userService = new UserService();
        $this->roleService = new RoleService();
        if ((!$this->userService->checkPermissions("admin")) && (!$this->userService->checkPermissions("super-admin"))) {
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
        $roles = $this->roleService->getAll();
        require __DIR__ . '/../views/admin/users/index.php';
    }

    public function updateUser($userId)
    {
        $user = $this->userService->getOneById($userId);
        $roles = $this->roleService->getAll();
        require __DIR__ . '/../views/admin/users/update.php';
    }

    public function updateUserPost($userId)
    {
        $this->userService->updateUser($userId, $_POST['name'], $_POST['email'], $_POST['role']);
    }

    public function deleteUser($userId)
    {
        $this->userService->deleteOne($userId);
    }

    public function createUser()
    {
        $roles = $this->roleService->getAll();
        require __DIR__ . '/../views/admin/users/create.php';
    }

    public function createUserPost()
    {
        $this->userService->createUser($_POST['name'],$_POST['email'],$_POST['role'],$_POST['password']);
    }


}
