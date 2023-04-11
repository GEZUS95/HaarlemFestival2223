<?php

namespace services;

use repositories\SessionRepository;
use models\Session;
use DateTime;

class SessionService
{
    private SessionRepository $sessionRepository;

    public function __construct()
    {
        $this->sessionRepository = new SessionRepository();
    }

    public function getAllFromRestaurant(int $restaurantId)
    {
        return $this->sessionRepository->getAllFromRestaurant($restaurantId);
    }

    public function getAll()
    {
        return $this->sessionRepository->getAll();
    }

    public function getOneById(int $id)
    {
        return $this->sessionRepository->getOneById($id);
    }

    public function getAllFutureSessionsForRestaurant(int $restaurantId)
    {
        return $this->sessionRepository->getAllFutureSessionsForRestaurant($restaurantId);
    }

    public function getAllFromProgram(int $programId)
    {
        return $this->sessionRepository->getAllFromProgram($programId);
    }

    public function insertOne(int $restaurantId, int $programId, \DateTime $startTime, \DateTime $endTime, int $seatsLeft)
    {
        $this->sessionRepository->insertOne($restaurantId, $programId, $startTime, $endTime, $seatsLeft);
    }

    public function updateOne(int $id, int $restaurantId, int $programId, \DateTime $startTime, \DateTime $endTime, int $seatsLeft)
    {
        $this->sessionRepository->updateOne($id, $restaurantId, $programId, $startTime, $endTime, $seatsLeft);
    }

    public function deleteOne(int $id)
    {
        $this->sessionRepository->deleteOne($id);
    }

    public function getAllWithRestaurant()
    {
        return $this->sessionRepository->getAllWithRestaurant();
    }
}
