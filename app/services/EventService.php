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

    public function insertOne(Event $event){
        $this->repository->insertOne($event);
    }

    public function updateOne(Event $event){
        $this->repository->updateOne($event);
    }

    public function deleteOne(Event $event){
        $this->repository->deleteOne($event);
    }

    public function postEvents(){
        $event = new Event();
        $event->setTitle($_POST["title"]);
        $event->setDescription($_POST["description"]);
        $event->setPrice($_POST["price"]);
        $event->setStartTime($_POST["start_time"]);
        $event->setEndTime($_POST["end_time"]);
        $event->setSessionId($_POST["session_id"]);
        return $event;
    }
}
