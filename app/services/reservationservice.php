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
}
