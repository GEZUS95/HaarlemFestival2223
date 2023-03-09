<?php

namespace controllers;

use services\ApiService;
use services\RoleService;
use services\UserService;

class AdminController
{
    private UserService $userService;
    private RoleService $roleService;

    private ApiService $apiService;

    public function __construct()
    {
        $this->userService = new UserService();
        $this->roleService = new RoleService();
        $this->apiService = new ApiService();
        if (
            (!$this->userService->checkPermissions("admin"))
            &&
            (!$this->userService->checkPermissions("super-admin"))
        ) {
            $this->userService->redirect('/?error=You do not have the permission to do this');
        }
    }

    public function index()
    {
        require_once __DIR__ . '/../views/admin/index.php';
    }

    public function showUsers()
    {
        $model = $this->userService->getAll();
        $roles = $this->roleService->getAll();
        require_once __DIR__ . '/../views/admin/users/index.php';
    }

    public function updateUser($userId)
    {
        $user = $this->userService->getOneById($userId);
        $roles = $this->roleService->getAll();
        require_once __DIR__ . '/../views/admin/users/update.php';
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
        require_once __DIR__ . '/../views/admin/users/create.php';
    }

    public function createUserPost()
    {
        $this->userService->createUser($_POST['name'], $_POST['email'], $_POST['role'], $_POST['password']);
    }

    public function showApiKeys()
    {
        $model = $this->apiService->getAll();
        require_once __DIR__ . '/../views/admin/api/index.php';
    }

    public function createApiKey()
    {
        require_once __DIR__ . '/../views/admin/api/createkey.php';
    }

    public function deleteApiKey(string $key)
    {
        $this->apiService->deleteOne($key);
        $this->userService->redirect('/admin/api?success=Api key deleted');
    }

    public function addApiKey()
    {
        $this->apiService->insertOne($_POST['description']);
        $this->userService->redirect('/admin/api?success=Api key created');
    }

    public function emailApiKey(string $uuid)
    {
        require_once __DIR__ . '/../views/admin/api/email.php';
    }
    public function emailApiKeyPost(string $uuid)
    {
        $this->apiService->emailKey($uuid, $_POST['email']);
        $this->userService->redirect('/admin/api?success=Email send');
    }
}
