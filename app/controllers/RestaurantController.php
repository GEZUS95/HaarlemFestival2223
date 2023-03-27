<?php

namespace controllers;

use helpers\RedirectHelper;
use models\Restaurant;
use services\LocationService;
use services\OrderService;
use services\RestaurantService;
use services\SessionService;

class RestaurantController {
    private RedirectHelper $redirectHelper;
    private RestaurantService $restaurantService;
    private LocationService $locationService;
    private SessionService $sessionService;
    private OrderService $orderService;

    public function __construct() {
        $this->redirectHelper = new RedirectHelper();
        $this->restaurantService = new RestaurantService();
        $this->locationService = new LocationService();
        $this->sessionService = new SessionService();
        $this->orderService = new OrderService();
    }

    public function showRestaurant(int $restaurantId){
        $restaurant = $this->restaurantService->getOneById($restaurantId);
        $location = $this->locationService->getOneById($restaurant->getLocationId());
        $sessions = $this->sessionService->getAllFutureSessionsForRestaurant($restaurantId);
        require_once __DIR__ . '/../views/restaurant/restauranttemplate.php';
    }

    public function makeReservation(int $sessionId) {
        $session = $this->sessionService->getOneById($sessionId);
        $restaurant = $this->restaurantService->getOneById($session->getRestaurantId());
        require_once __DIR__ . '/../views/restaurant/makereservation.php';
    }

    public function confirmReservation(int $sessionId) {
        $session = $this->sessionService->getOneById($sessionId);
        $restaurant = $this->restaurantService->getOneById($session->getRestaurantId());
        $this->orderService->createOrder($_POST['user_id'], $sessionId, $_POST['remarks'], $_POST['status']);
        $this->redirectHelper->redirect('/restaurant/' . $restaurant->getId());
    }
}
