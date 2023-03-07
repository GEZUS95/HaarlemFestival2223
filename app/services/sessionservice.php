<?php
namespace services;
use repositories\SessionRepository;

class SessionService {
    private SessionRepository $sessionRepository;

    public function __construct()
    {
        $this->sessionRepository = new SessionRepository();
    }

    public function getAllFromRestaurant(int $restaurantId)
    {
        return $this->sessionRepository->getAllFromRestaurant($restaurantId);
    }

    public function getOneById(int $id)
    {
        return $this->sessionRepository->getOneById($id);
    }

    public function insertOne(Session $session)
    {
        $this->sessionRepository->insertOne($session);
    }

    public function updateOne(Session $session)
    {
        $this->sessionRepository->updateOne($session);
    }

    public function deleteOne(int $id)
    {
        $this->sessionRepository->deleteOne($id);
    }
}
