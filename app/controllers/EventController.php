<?php

namespace controllers;

use helpers\RedirectHelper;
use models\Event;
use models\Program;
use models\ProgramItem;
use services\EventService;
use services\LocationService;
use services\ProgramService;
use services\ProgramItemService;
use services\OrderService;
use services\SessionService;

class EventController
{
    private RedirectHelper $redirectHelper;
    private EventService $eventService;
    private ProgramService $programService;
    private ProgramItemService $programItemService;
    private OrderService $orderService;
    private SessionService $sessionService;
    private LocationService $locationService;

    public function __construct()
    {
        $this->redirectHelper = new RedirectHelper();
        $this->eventService = new EventService();
        $this->programService = new ProgramService();
        $this->programItemService = new ProgramItemService();
        $this->orderService = new OrderService();
        $this->sessionService = new SessionService();
        $this->locationService = new LocationService();
    }

    public function showEvent(int $eventId)
    {
        $page_event = $this->eventService->getOneById($eventId);
        $programs = $this->programService->getAllByEventId($eventId);
        $sessions = $this->sessionService->getAll();
        require_once __DIR__ . '/../views/event/eventpage.php';
    }

    public function showProgram(int $eventId, string $programTitle)
    {
        $program = $this->programService->getOneByTitle($programTitle);
        $items = $this->programItemService->getAllByProgramTitle($program->getId());
        require_once __DIR__ . '/../views/event/programpage.php';
    }

    public function showProgramItem($programItemId)
    {
        $programItem = $this->programItemService->getOneById($programItemId);
        $location = $this->locationService->getOneById($programItem->getLocationId());
        require_once __DIR__ . '/../views/event/programitempage.php';
    }

    public function addProgramItemToCart(int $programItemId)
    {
        $programItem = $this->programItemService->getOneById($programItemId);
        $program = $this->programService->getOneById($programItem->getProgramId());
        $event = $this->eventService->getOneById($program->getEventId());
        $order = $this->orderService->getOneOrderFromUserId($_SESSION['user']['id']);
        $this->orderService->addOrderLine($order->getId(), "programitem", $programItemId, $_POST['quantity'], false);
    }
}
