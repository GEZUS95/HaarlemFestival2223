<?php
require __DIR__ . '/../repositories/userrepository.php';

class UserService
{
    public function getAll() {
        $repository = new UserRepository();
        return $repository->getAll();
    }
}