<?php

require __DIR__ . '/../repositories/rolerepository.php';
class RoleService
{
    private RoleRepository $REPOSITORY;
    public function __construct()
    {
        $this->REPOSITORY = new RoleRepository();
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

}