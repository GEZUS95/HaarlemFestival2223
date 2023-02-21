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
        require __DIR__ . '/../views/admin/users/index.php';
    }

    public function updateUser($userId)
    {
        $user = $this->userService->getOneById($userId);
        require __DIR__ . '/../views/admin/users/update.php';
    }

    public function updateUserPost($userId)
    {
        //todo: put submit data in object and put it through
    }

    public function deleteUser($userId)
    {
        $this->userService->deleteOne($userId);
    }


}
