<?php

namespace controllers\admin;

use helpers\RedirectHelper;
use services\ArtistService;
use services\EventService;
use services\LocationService;
use services\ProgramItemService;
use services\ProgramService;
use services\UserService;

class EventController {

    private RedirectHelper $redirectHelper;
    private EventService $eventService;
    private UserService $userService;
    private ProgramService $programService;
    private ProgramItemService $programItemService;
    private ArtistService $artistService;
    private LocationService $locationService;

    public function __construct() {
        $this->redirectHelper = new RedirectHelper();
        $this->eventService = new EventService();
        $this->userService = new UserService();
        $this->programService = new ProgramService();
        $this->programItemService = new ProgramItemService();
        $this->artistService = new ArtistService();
        $this->locationService = new LocationService();

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
        $programs = $this->programService->getAll();
        require_once __DIR__ . '/../../views/admin/event/events.php';
    }

    public function newEvent(){
        require_once __DIR__ . '/../../views/admin/event/newevent.php';
    }

    public function newEventPost() {
        $this->eventService->insertOne($_POST['title'], $_POST['description']);
        $this->redirectHelper->redirect("/admin/events");
    }

    public function updateEvent(int $eventId){
        $event = $this->eventService->getOneById($eventId);
        require_once __DIR__ . '/../../views/admin/event/updateevent.php';
    }

    public function updateEventPost(int $eventId) {
        $this->eventService->updateOne($_POST['title'], $_POST['body'], $eventId);
        $this->redirectHelper->redirect("/admin/events");
    }

    public function deleteEvent(int $eventId) {
        $this->eventService->deleteOne($eventId);
        $this->redirectHelper->redirect("/admin/events");
    }

    public function showPrograms(int $eventId){
        $model = $this->programService->getAllByEventId($eventId);
        $programItems = $this->programItemService->getAll();
        $event = $this->eventService->getOneById($eventId);
        require_once __DIR__ . '/../../views/admin/event/programs.php';
    }

    public function newProgram(int $eventId){
        require_once __DIR__ . '/../../views/admin/event/newprogram.php';
    }

    public function newProgramPost(int $eventId) {
        $this->programService->insertOne($eventId, $_POST['title'], $_POST['price'], new \DateTime($_POST['start_time']), new \DateTime($_POST['end_time']));
        $this->redirectHelper->redirect("/admin/programs/$eventId");
    }

    public function updateProgram(int $programId){
        $program = $this->programService->getOneById($programId);
        require_once __DIR__ . '/../../views/admin/event/updateprogram.php';
    }

    public function updateProgramPost(int $programId) {
        $eventId = $this->programService->getOneById($programId)->getEventId();
        $this->programService->updateOne($programId, $eventId, $_POST['title'], $_POST['price'], new \DateTime($_POST['start_time']), new \DateTime($_POST['end_time']));
        $this->redirectHelper->redirect("/admin/programs/$eventId");
    }

    public function deleteProgram(int $programId) {
        $eventId = $this->programService->getOneById($programId)->getEventId();
        $this->programService->deleteOne($programId);
        $this->redirectHelper->redirect("/admin/programs/$eventId");
    }

    public function newProgramItem(int $programId){
        $artists = $this->artistService->getAll();
        $locations = $this->locationService->getAll();
        require_once __DIR__ . '/../../views/admin/event/newprogramitem.php';
    }

    public function newProgramItemPost(int $programId) {
        $eventId = $this->programService->getOneById($programId)->getEventId();
        $this->programItemService->insertOne($programId, $_POST['location_id'], $_POST['artist_id'], $_POST['special_guest_id'], $_POST['title'], new \DateTime($_POST['start_time']), new \DateTime($_POST['end_time']), $_POST['price'], $_POST['seats_left']);
        $this->redirectHelper->redirect("/admin/programs/$eventId");
    }

    public function updateProgramItem(int $programItemId){
        $programItem = $this->programItemService->getOneById($programItemId);
        $artists = $this->artistService->getAll();
        $locations = $this->locationService->getAll();
        require_once __DIR__ . '/../../views/admin/event/updateprogramitem.php';
    }

    public function updateProgramItemPost(int $programItemId){
        $program = $this->programService->getOneById($this->programItemService->getOneById($programItemId)->getProgramId());
        $eventId = $program->getEventId();
        $this->programItemService->updateOne($programItemId, $program->getId(), $_POST['location_id'], $_POST['artist_id'], $_POST['special_guest_id'], $_POST['title'], new \DateTime($_POST['start_time']), new \DateTime($_POST['end_time']), $_POST['price'], $_POST['seats_left']);
        $this->redirectHelper->redirect("/admin/programs/$eventId");
    }

    public function deleteProgramItem(int $programItemId){
        $eventId = $this->programService->getOneById($this->programItemService->getOneById($programItemId)->getProgramId())->getEventId();
        $this->programItemService->deleteOne($programItemId);
        $this->redirectHelper->redirect("/admin/programs/$eventId");
    }
}
