<?php

namespace controllers;

use helpers\RedirectHelper;
use models\Restaurant;
use services\LocationService;
use services\OrderService;
use services\ReservationService;
use services\RestaurantService;
use services\SessionService;

class RestaurantController {
    private RedirectHelper $redirectHelper;
    private RestaurantService $restaurantService;
    private LocationService $locationService;
    private SessionService $sessionService;
    private OrderService $orderService;
    private ReservationService $reservationService;

    public function __construct() {
        $this->redirectHelper = new RedirectHelper();
        $this->restaurantService = new RestaurantService();
        $this->locationService = new LocationService();
        $this->sessionService = new SessionService();
        $this->orderService = new OrderService();
        $this->reservationService = new ReservationService();
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
        var_dump($_SESSION['user']['id']);
        $order = $this->orderService->getOneOrderFromUserId($_SESSION['user']['id']);
        $this->reservationService->insertOne($this->reservationService->postReservation($sessionId));

        // if adult is above 0 then add adult to order
        if ($_POST['amount'] > 0) {
            $this->orderService->addOrderLine($order->getId(), "reservation", 1, $_POST['amount'], false);
        }

        // if child is above 0 then add child to order
        if ($_POST['amount_child'] > 0) {
            $this->orderService->addOrderLine($order->getId(), "reservation", 2, $_POST['amount_child'], true);
        }

        $this->redirectHelper->redirect('/cart');
    }
}
