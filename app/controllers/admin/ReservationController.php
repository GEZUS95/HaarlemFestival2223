<?php

namespace controllers\admin;

use helpers\RedirectHelper;
use models\Reservation;
use services\ReservationService;
use services\RestaurantService;
use services\SessionService;
use services\UserService;

class ReservationController {
    private RedirectHelper $redirectHelper;
    private ReservationService $reservationService;
    private RestaurantService $restaurantService;
    private SessionService $sessionService;
    private UserService $userService;

    public function __construct() {
        $this->redirectHelper = new RedirectHelper();
        $this->reservationService = new ReservationService();
        $this->restaurantService = new RestaurantService();
        $this->sessionService = new SessionService();
        $this->userService = new UserService();

        if (
            (!$this->userService->checkPermissions("admin"))
            &&
            (!$this->userService->checkPermissions("super-admin"))
        ) {
            $this->redirectHelper->redirect('/?error=You do not have the permission to do this');
        }
    }

    public function showReservations(){
        $model = $this->reservationService->getAll();
        $restaurants = $this->restaurantService->getAll();
        $sessions = $this->sessionService->getAll();
        $users = $this->userService->getAll(10000000, 0);
        require_once __DIR__ . '/../../views/admin/reservation/reservations.php';
    }

    public function newReservation(){
        $restaurants = $this->restaurantService->getAll();
        $sessions = $this->sessionService->getAll();
        require_once __DIR__ . '/../../views/admin/reservation/newreservation.php';
    }

    public function newReservationPost() {
        $this->reservationService->insertOne($_SESSION['user']['id'], $_POST['session_id'], $_POST['remarks'], "active");
        $this->redirectHelper->redirect("/admin/reservations");
    }

    public function updateReservation(int $reservationId){
        $reservation = $this->reservationService->getOneById($reservationId);
        if ($reservation->getStatus() == "active") {
            $reservation->setStatus("inactive");
        } else {
            $reservation->setStatus("active");
        }
        $this->reservationService->updateOne($reservation->getId(), $reservation->getUserId(), $reservation->getSessionId(), $reservation->getRemarks(), $reservation->getStatus());
        $this->redirectHelper->redirect("/admin/reservations");
    }

    public function getOptionLabel() {
        $this->reservationService->getOptionLabel();
    }
}
