<?php

namespace controllers\admin;

use helpers\RedirectHelper;
use services\EventService;
use services\UserService;

class EventController {

    private RedirectHelper $redirectHelper;
    private EventService $eventService;
    private UserService $userService;

    public function __construct() {
        $this->redirectHelper = new RedirectHelper();
        $this->eventService = new EventService();
        $this->userService = new UserService();

        if (
            (!$this->userService->checkPermissions("admin"))
            &&
            (!$this->userService->checkPermissions("super-admin"))
        ) {
            $this->redirectHelper->redirect('/?error=You do not have the permission to do this');
        }
    }

    public function showEvents(){
        $model = $this->eventService->getAll();
        require_once __DIR__ . '/../../views/admin/event/events.php';
    }

    public function newEvent(){
        require_once __DIR__ . '/../../views/admin/event/newevent.php';
    }

    public function newEventPost() {
        $event = $this->eventService->postEvent($_POST);
        $this->eventService->insertOne($event);
        $this->redirectHelper->redirect("/admin/events");
    }

    public function updateEvent(int $eventId){
        $event = $this->eventService->getOneById($eventId);
        require_once __DIR__ . '/../../views/admin/event/updateevent.php';
    }

    public function updateEventPost(int $eventId) {
        $event = $this->eventService->postEvent($_POST);
        $event->setId($eventId);
        $this->eventService->updateOne($event);
        $this->redirectHelper->redirect("/admin/events");
    }

    public function deleteEvent(int $eventId) {
        $this->eventService->deleteOne($eventId);
        $this->redirectHelper->redirect("/admin/events");
    }
}