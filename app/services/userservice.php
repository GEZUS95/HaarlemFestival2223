<?php
require __DIR__ . '/../repositories/userrepository.php';

class UserService
{

    private $REPOSITORY;
    public function __construct()
    {
        $this->REPOSITORY = new UserRepository();
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

    public function getOneByEmail(string $email){
        $this->REPOSITORY->getOneByEmail($email);
    }
    public function getOneByName(string $name){
        $this->REPOSITORY->getOneByEmail($name);
    }
    public function getOneById(int $id){
        $this->REPOSITORY->getOneByEmail($id);
    }


}