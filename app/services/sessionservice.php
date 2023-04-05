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

    public function getAllFutureSessionsForRestaurant(int $restaurantId) {
        return $this->sessionRepository->getAllFutureSessionsForRestaurant($restaurantId);
    }

    public function insertOne(int $restaurantId, int $programId, \DateTime $startTime, \DateTime $endTime)
    {
        $this->sessionRepository->insertOne($restaurantId, $programId, $startTime, $endTime);
    }

    public function updateOne(Session $session)
    {
        $this->sessionRepository->updateOne($session->getId(), $session->getRestaurantId(), $session->getProgramId(), $session->getStartTime(), $session->getEndTime());
    }

    public function deleteOne(int $id)
    {
        $this->sessionRepository->deleteOne($id);
    }

    public function postSession()
    {
        $session = new Session();
        $session->setRestaurantId($_POST["restaurant_id"]);
        $session->setProgramId($_POST["program_id"]);
        $session->setStartTime(new \DateTime($_POST["start_time"]));
        $session->setEndTime(new \DateTime($_POST["end_time"]));
        $session->setSeatsLeft($_POST["seats_left"]);
        return $session;
    }
}
