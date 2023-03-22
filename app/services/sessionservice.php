<?php
namespace services;
use repositories\SessionRepository;
use models\Session;
use DateTime;

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

    public function getAll()
    {
        return $this->sessionRepository->getAll();
    }

    public function getOneById(int $id)
    {
        return $this->sessionRepository->getOneById($id);
    }

    public function insertOne(int $restaurantId, \DateTime $startTime, \DateTime $endTime)
    {
        $this->sessionRepository->insertOne($restaurantId, $startTime, $endTime);
    }

    public function updateOne(Session $session)
    {
        $this->sessionRepository->updateOne($session->getId(), $session->getRestaurantId(), $session->getStartTime(), $session->getEndTime());
    }

    public function deleteOne(int $id)
    {
        $this->sessionRepository->deleteOne($id);
    }

    public function postSession()
    {
        $session = new Session();
        $session->setRestaurantId($_POST["restaurant_id"]);
        $session->setStartTime(new \DateTime($_POST["start_time"]));
        $session->setEndTime(new \DateTime($_POST["end_time"]));
        return $session;
    }
}
