<?php

namespace services;

use models\Role;
use repositories\RoleRepository;

class RoleService
{
    private RoleRepository $repository;
    public function __construct()
    {
        $this->repository = new RoleRepository();
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }
    public function updateOne(Role $role)
    {
        $this->repository->updateOne($role->getName(), $role->getDescription(), $role->getId());
    }
    public function insertOne(Role $role)
    {
        $this->repository->insertOne($role->getName(), $role->getDescription());
    }
    public function getOneById(int $id)
    {
        return $this->repository->getOneById($id);
    }

}
