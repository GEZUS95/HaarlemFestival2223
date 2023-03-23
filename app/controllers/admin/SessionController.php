<?php

namespace controllers\admin;

use helpers\RedirectHelper;
use models\Session;
use services\SessionService;
use services\RestaurantService;
use services\UserService;

class SessionController {

    private RedirectHelper $redirectHelper;
    private SessionService $sessionService;
    private RestaurantService $restaurantService;
    private UserService $userService;

    public function __construct()
    {
        $this->redirectHelper = new RedirectHelper();
        $this->sessionService = new SessionService();
        $this->restaurantService = new RestaurantService();
        $this->userService = new UserService();

        if (
            (!$this->userService->checkPermissions("admin"))
            &&
            (!$this->userService->checkPermissions("super-admin"))
        ) {
            $this->redirectHelper->redirect('/?error=You do not have the permission to do this');
        }
    }

    public function showSessions(){
        $model = $this->sessionService->getAll();
        $restaurants = $this->restaurantService->getAll();
        require_once __DIR__ . '/../../views/admin/session/sessions.php';
    }

    public function newSession(){
        $restaurants = $this->restaurantService->getAll();
        require_once __DIR__ . '/../../views/admin/session/newsession.php';
    }

    public function newSessionPost() {
        $session = $this->sessionService->postSession($_POST);
        $this->sessionService->insertOne($session->getRestaurantId(), $session->getStartTime(), $session->getEndTime(), $session->getSeatsLeft());
        $this->redirectHelper->redirect("/admin/sessions");
    }

    public function updateSession(int $sessionId){
        $session = $this->sessionService->getOneById($sessionId);
        $restaurants = $this->restaurantService->getAll();
        require_once __DIR__ . '/../../views/admin/session/updatesession.php';
    }

    public function updateSessionPost(int $sessionId) {
        $session = $this->sessionService->postSession($_POST);
        $session->setId($sessionId);
        $this->sessionService->updateOne($session);
        $this->redirectHelper->redirect("/admin/sessions");
    }

    public function deleteSession(int $sessionId) {
        $this->sessionService->deleteOne($sessionId);
        $this->redirectHelper->redirect("/admin/sessions");
    }
}
