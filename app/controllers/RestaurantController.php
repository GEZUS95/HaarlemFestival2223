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
        $order = $this->orderService->getOneOrderFromUserId($_SESSION['user']['id']);
        $restaurant = $this->restaurantService->getOneById($this->sessionService->getOneById($sessionId)->getRestaurantId());
        $this->reservationService->insertOne($_SESSION['user']['id'], $sessionId, $_POST['remarks'] = 'none', "active");

        if ($_POST['amount'] > 0  && $_POST['amount_child'] > 0) {
            $this->orderService->addOrderLine($order->getId(), "reservation", $restaurant->getId(), $_POST['amount'], false, false);
            $this->orderService->addOrderLine($order->getId(), "reservation", $restaurant->getId(), $_POST['amount_child'], true);
        }
        elseif ($_POST['amount'] > 0) {
            $this->orderService->addOrderLine($order->getId(), "reservation", $restaurant->getId(), $_POST['amount'], false);
        }
        elseif ($_POST['amount_child'] > 0) {
            $this->orderService->addOrderLine($order->getId(), "reservation", $restaurant->getId(), $_POST['amount_child'], true);
        }
    }
}
