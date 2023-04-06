<?php

namespace services;
use repositories\EventRepository;
use models\Event;

class EventService {

    private EventRepository $repository;

    public function __construct()
    {
        $this->repository = new EventRepository();
    }

    public function getAll() {
        return $this->repository->getAll();
    }

    public function getOneById(int $id){
        return $this->repository->getOneById($id);
    }

    public function getOneByTitle(string $title){
        return $this->repository->getOneByTitle($title);
    }

    public function insertOne(string $title, string $description){
        $this->repository->insertOne($title, $description);
    }

    public function updateOne(string $title, string $description, int $id){
        $this->repository->updateOne($title, $description, $id);
    }

    public function deleteOne(int $eventId){
        $this->repository->deleteOne($eventId);
    }
}
