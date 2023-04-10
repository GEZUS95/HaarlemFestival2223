<?php

namespace services;
use repositories\ProgramItemRepository;
use models\Program;
use models\ProgramItem;

class ProgramItemService
{
    private ProgramItemRepository $repository;

    public function __construct()
    {
        $this->repository = new ProgramItemRepository();
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function getAllByProgramId(int $program_id)
    {
        return $this->repository->getAllByProgramId($program_id);
    }

    public function getOneById(int $id)
    {
        return $this->repository->getOneById($id);
    }

    public function insertOne(int $program_id, int $location_id, int $artist_id, int $special_guest_id, string $title, \DateTime $start_time, \DateTime $end_time, float $price, int $seats_left)
    {
        $this->repository->insertOne($program_id, $location_id, $artist_id, $special_guest_id, $title, $start_time, $end_time, $price, $seats_left);
    }

    public function updateOne(int $id, int $program_id, int $location_id, int $artist_id, int $special_guest_id, string $title, \DateTime $start_time, \DateTime $end_time, float $price, int $seats_left)
    {
        $this->repository->updateOne($id, $program_id, $location_id, $artist_id, $special_guest_id, $title, $start_time, $end_time, $price, $seats_left);
    }

    public function deleteOne(int $id)
    {
        $this->repository->deleteOne($id);
    }

    public function getAllByProgramTitle(int $programId)
    {
        return $this->repository->getAllByProgramTitle($programId);
    }
}
