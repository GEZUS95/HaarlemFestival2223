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

    public function getProgramItemsByProgramId(int $id)
    {
        return $this->repository->getProgramItemsByProgramId($id);
    }

    public function getOneById(int $id)
    {
        return $this->repository->getOneById($id);
    }

    public function getOneByEventId(int $id)
    {
        return $this->repository->getOneByEventId($id);
    }

    public function getOneByContentId(int $id)
    {
        return $this->repository->getOneByContentId($id);
    }

    public function getOneByTitle(string $title)
    {
        return $this->repository->getOneByTitle($title);
    }

    public function getOneByTotalPriceProgram(float $totalPriceProgram)
    {
        return $this->repository->getOneByTotalPriceProgram($totalPriceProgram);
    }

    public function insertOneProgramWithProgramItems(Program $program)
    {
        $this->repository->insertOneProgramWithProgramItems($program);
    }

    public function insertOneProgram(Program $program, array $programItems)
    {
        $this->repository->insertOneProgram($program, $programItems);
    }

    public function insertOneProgramItem(ProgramItem $programItem)
    {
        $this->repository->insertOneProgramItem($programItem);
    }

    public function insertProgramItems(array $programItems, int $programId)
    {
        $this->repository->insertProgramItems($programItems, $programId);
    }

    public function updateOneProgram(Program $program)
    {
        $this->repository->updateOneProgram($program);
    }

    public function updateOneProgramItem(ProgramItem $programItem)
    {
        $this->repository->updateOneProgramItem($programItem);
    }

    public function deleteOneProgram(Program $program)
    {
        $this->repository->deleteOneProgram($program);
    }

    public function deleteOneProgramItem(ProgramItem $programItem)
    {
        $this->repository->deleteOneProgramItem($programItem);
    }

    public function deleteProgramItemsByProgramId(int $programId)
    {
        $this->repository->deleteProgramItemsByProgramId($programId);
    }
}
