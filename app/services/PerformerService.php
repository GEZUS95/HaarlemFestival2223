<?php
namespace services;
use repositories\PerformerRepository;
class PerformerService
{
    private PerformerRepository $REPOSITORY;
    public function __construct()
    {
        $this->REPOSITORY = new PerformerRepository();
    }

    public function getAll() {
        return $this->REPOSITORY->getAll();
    }
    public function updateOne(User $user){
        $this->REPOSITORY->updateOne($user);
    }
    public function insertOne(User $user){
        $this->REPOSITORY->insertOne($user);
    }
    public function getOneById(int $id){
        return $this->REPOSITORY->getOneById($id);
    }
    public function getOneByName(string $name){
        return $this->REPOSITORY->getOneByName($name);
    }
}