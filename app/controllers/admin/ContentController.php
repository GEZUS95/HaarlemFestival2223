<?php

namespace controllers\admin;

use helpers\RedirectHelper;
use services\ContentService;
use services\UserService;

class ContentController
{
    private ContentService $contentService;
    private RedirectHelper $redirectHelper;
    private UserService $userService;

    public function __construct()
    {
        $this->contentService = new ContentService();
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

    public function showPages()
    {
        $model = $this->contentService->getAll();
        require_once __DIR__ . '/../../views/admin/content/index.php';
    }

    public function createPage()
    {
        require_once __DIR__ . '/../../views/admin/content/create.php';
    }

    public function addPage()
    {
        $this->contentService->insertOne($_POST['title'], $_POST['body'], '');
        $this->redirectHelper->redirect('/admin/content?success=Page is created');
    }

    public function updatePage($id)
    {
        $page = $this->contentService->getOneFromId($id);
        require_once __DIR__ . '/../../views/admin/content/update.php';
    }

    public function updatePagePost($id)
    {
        $this->contentService->updateOne($id, $_POST['title'], $_POST['body'], '');
        $this->redirectHelper->redirect('/admin/content?success=Pages successfully updated');
    }

    public function deletePage($id)
    {
        $this->contentService->deleteOne($id);
        $this->redirectHelper->redirect('/admin/content?success=Page successfully deleted');
    }
}
