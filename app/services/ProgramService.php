<?php

namespace services;
use repositories\ProgramRepository;
use models\Program;
use models\ProgramItem;

class ProgramService
{
    private ProgramRepository $repository;

    public function __construct()
    {
        $this->repository = new ProgramRepository();
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function getAllByEventId(int $eventId)
    {
        return $this->repository->getAllByEventId($eventId);
    }

    public function getOneById(int $id)
    {
        return $this->repository->getOneById($id);
    }

    public function getOneByEventId(int $event_id)
    {
        return $this->repository->getOneByEventId($event_id);
    }

    public function getOneByContentId(int $content_id)
    {
        return $this->repository->getOneByContentId($content_id);
    }

    public function getOneByTitle(string $title)
    {
        return $this->repository->getOneByTitle($title);
    }

    public function insertOne(int $event_id, string $title, float $price, \DateTime $start_time, \DateTime $end_time)
    {
        $this->repository->insertOne($event_id, $title, $price, $start_time, $end_time);
    }

    public function updateOne(int $id, int $event_id, string $title, float $price, \DateTime $start_time, \DateTime $end_time)
    {
        $this->repository->updateOne($id, $event_id, $title, $price, $start_time, $end_time);
    }

    public function deleteOne(int $id)
    {
        $this->repository->deleteOne($id);
    }
}
