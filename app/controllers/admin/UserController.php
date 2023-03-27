<?php

namespace controllers\admin;

use helpers\RedirectHelper;
use services\RoleService;
use services\UserService;

class UserController
{
    private UserService $userService;
    private RoleService $roleService;
    private RedirectHelper $redirectHelper;

    public function __construct()
    {
        $this->userService = new UserService();
        $this->roleService = new RoleService();
        $this->redirectHelper = new RedirectHelper();

        if (
            (!$this->userService->checkPermissions("admin"))
            &&
            (!$this->userService->checkPermissions("super-admin"))
        ) {
            $this->redirectHelper->redirect('/?error=You do not have the permission to do this');
        }
    }

    public function showUsers()
    {
        $page = $_GET['p'] ?? 0;
        $model = $this->userService->getAll(
            $_GET['l'] ?? 15,
            $page * ($_GET['l'] ?? 15),
            $_GET['search'] ?? null,
            $_GET['filter'] ?? null,
            $_GET['sort'] ?? null
        );
        $roles = $this->roleService->getAll();
        require_once __DIR__ . '/../../views/admin/users/index.php';
    }

    public function updateUser($userId)
    {
        $user = $this->userService->getOneById($userId);
        $roles = $this->roleService->getAll();
        require_once __DIR__ . '/../../views/admin/users/update.php';
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
        require_once __DIR__ . '/../../views/admin/users/create.php';
    }

    public function createUserPost()
    {
        $this->userService->createUser($_POST['name'], $_POST['email'], $_POST['role'], $_POST['password']);
    }
}
