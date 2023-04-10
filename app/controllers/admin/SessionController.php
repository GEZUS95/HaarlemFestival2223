<?php

namespace controllers\admin;

use helpers\RedirectHelper;
use models\Session;
use services\ProgramService;
use services\SessionService;
use services\RestaurantService;
use services\UserService;

class SessionController {

    private RedirectHelper $redirectHelper;
    private SessionService $sessionService;
    private RestaurantService $restaurantService;
    private UserService $userService;
    private ProgramService $programService;

    public function __construct()
    {
        $this->redirectHelper = new RedirectHelper();
        $this->sessionService = new SessionService();
        $this->restaurantService = new RestaurantService();
        $this->userService = new UserService();
        $this->programService = new ProgramService();

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
        $programs = $this->programService->getAll();
        require_once __DIR__ . '/../../views/admin/session/sessions.php';
    }

    public function newSession(){
        $programs = $this->programService->getAll();
        $restaurants = $this->restaurantService->getAll();
        require_once __DIR__ . '/../../views/admin/session/newsession.php';
    }

    public function newSessionPost() {
        $startTime = new \DateTime($_POST['start_time']); // Convert string to DateTime object
        $endTime = new \DateTime($_POST['end_time']); // Convert string to DateTime object
        $this->sessionService->insertOne($_POST['restaurant_id'], $_POST['program_id'], $startTime, $endTime, $_POST['seats_left']);
        $this->redirectHelper->redirect("/admin/sessions");
    }


    public function updateSession(int $sessionId){
        $programs = $this->programService->getAll();
        $session = $this->sessionService->getOneById($sessionId);
        $restaurants = $this->restaurantService->getAll();
        require_once __DIR__ . '/../../views/admin/session/updatesession.php';
    }

    public function updateSessionPost(int $sessionId) {
        $this->sessionService->updateOne($sessionId, $_POST['restaurant_id'], $_POST['program_id'], new \DateTime($_POST['start_time']), new \DateTime($_POST['end_time']) , $_POST['seats_left']);
        $this->redirectHelper->redirect("/admin/sessions");
    }

    public function deleteSession(int $sessionId) {
        $this->sessionService->deleteOne($sessionId);
        $this->redirectHelper->redirect("/admin/sessions");
    }
}
