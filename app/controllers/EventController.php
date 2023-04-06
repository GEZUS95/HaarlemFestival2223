<?php

namespace controllers;

use helpers\RedirectHelper;
use models\Event;
use models\Program;
use models\ProgramItem;
use services\EventService;
use services\ProgramService;
use services\ProgramItemService;
use services\OrderService;

class EventController {
    private RedirectHelper $redirectHelper;
    private EventService $eventService;
    private ProgramService $programService;
    private ProgramItemService $programItemService;
    private OrderService $orderService;

    public function __construct() {
        $this->redirectHelper = new RedirectHelper();
        $this->eventService = new EventService();
        $this->programService = new ProgramService();
        $this->programItemService = new ProgramItemService();
        $this->orderService = new OrderService();
    }

    public function showEvent(int $eventId){
        $event = $this->eventService->getOneById($eventId);
        $program = $this->programService->getOneByEventId($eventId);
        require_once __DIR__ . '/../views/event/eventpage.php';
    }

    public function addProgramItemToCart(int $programItemId) {
        $programItem = $this->programItemService->getOneById($programItemId);
        $program = $this->programService->getOneById($programItem->getProgramId());
        $event = $this->eventService->getOneById($program->getEventId());
        $order = $this->orderService->getOneOrderFromUserId($_SESSION['user']['id']);
        $this->orderService->addOrderLine($order->getId(), "programitem", $programItemId, 1, false);
        $this->redirectHelper->redirect('/cart');
    }
}
