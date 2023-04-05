<?php
namespace controllers;

use helpers\RedirectHelper;
use services\UserService;

class AdminController
{
    private UserService $userService;
    private RedirectHelper $redirectHelper;

    public function __construct()
    {
        $this->redirectHelper = new RedirectHelper();
        $this->userService = new UserService();
        if (
            (!$this->userService->checkPermissions("admin"))
            &&
            (!$this->userService->checkPermissions("super-admin"))
        ) {
            $this->redirectHelper->redirect('/?error=You do not have the permission to do this');
        }
    }

    public function index()
    {
        require_once __DIR__ . '/../views/admin/index.php';
    }
}
