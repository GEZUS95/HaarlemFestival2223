<?php

namespace controllers;

class ProgramItemController {
    private RedirectHelper $redirectHelper;
    private ProgramItemService $programItemService;
    private ProgramService $programService;
    private RestaurantService $restaurantService;

    public function __construct() {
        $this->redirectHelper = new RedirectHelper();
        $this->programItemService = new ProgramItemService();
        $this->programService = new ProgramService();
        $this->restaurantService = new RestaurantService();
    }

    public function showProgramItem(int $programItemId) {
        $programItem = $this->programItemService->getOneById($programItemId);
        $program = $this->programService->getOneById($programItem->getProgramId());
        $restaurant = $this->restaurantService->getOneById($program->getRestaurantId());
        require_once __DIR__ . '/../views/programitem/programitemtemplate.php';
    }
}
