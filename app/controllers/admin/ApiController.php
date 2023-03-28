<?php

namespace controllers\admin;

use helpers\RedirectHelper;
use services\ApiService;
use services\UserService;

class ApiController
{
    private ApiService $apiService;
    private RedirectHelper $redirectHelper;
    private UserService $userService;

    public function __construct()
    {
        $this->apiService = new ApiService();
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

    public function showApiKeys()
    {
        $page = $_GET['p'] ?? 0;
        $model = $this->apiService->getAll($_GET['l'] ?? 15, $page * ($_GET['l'] ?? 15));
        require_once __DIR__ . '/../../views/admin/api/index.php';
    }

    public function createApiKey()
    {
        require_once __DIR__ . '/../../views/admin/api/createkey.php';
    }

    public function deleteApiKey(string $key)
    {
        $this->apiService->deleteOne($key);
        $this->redirectHelper->redirect('/admin/api?success=Api key deleted');
    }

    public function addApiKey()
    {
        $this->apiService->insertOne($_POST['description']);
        $this->redirectHelper->redirect('/admin/api?success=Api key created');
    }

    public function emailApiKey(string $uuid)
    {
        require_once __DIR__ . '/../../views/admin/api/email.php';
    }

    public function emailApiKeyPost(string $uuid)
    {
        $this->apiService->emailKey($uuid, $_POST['email']);
        $this->redirectHelper->redirect('/admin/api?success=Email send');
    }
}
