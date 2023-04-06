<?php
namespace services;
use models\Reservation;
use repositories\ReservationRepository;

class ReservationService {

    private ReservationRepository $repository;

    public function __construct()
    {
        $this->repository = new ReservationRepository();
    }

    public function getAll() {
        return $this->repository->getAll();
    }

    public function getOneById(int $id){
        return $this->repository->getOneById($id);
    }

    public function getAllByRestaurantId(int $id){
        return $this->repository->getAllByRestaurantId($id);
    }

    public function getAllBySessionId(int $id){
        return $this->repository->getAllBySessionId($id);
    }

    public function insertOne(Reservation $reservation){
        $this->repository->insertOne($reservation);
    }

    public function updateOne(Reservation $reservation){
        $this->repository->updateOne($reservation);
    }

    public function postReservation(int $sessionId){
        $reservation = new Reservation();
        $reservation->setSessionId($sessionId);
        $reservation->setUserId($_SESSION['user']['id']);
        $reservation->setRemarks($_POST['remarks']);
        $reservation->setStatus('active');
        return $reservation;
    }

    public function getOptionLabel()
    {
        $restaurantName = $this->restaurantService->getOneById($this->restaurantId)->getName();
        $startTime = $this->startTime->format('Y-m-d H:i:s'); // format datetime as string
        $endTime = $this->endTime->format('Y-m-d H:i:s'); // format datetime as string
        return sprintf('%s - %s - %s', $restaurantName, $startTime, $endTime);
    }
}
