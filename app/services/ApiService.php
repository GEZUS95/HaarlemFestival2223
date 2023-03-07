<?php

namespace services;

use repositories\ApiKeyRepository;

class ApiService
{
    private ApiKeyRepository $repository;
    private UuidService $uuidService;

    public function __construct()
    {
        $this->repository = new ApiKeyRepository();
        $this->uuidService = new UuidService();
    }


    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function insertOne(string $description)
    {
        $uuid = $this->uuidService->generateUuid();
        $this->repository->insertOne($uuid, $description);
    }

    public function deleteOne(string $uuid)
    {
        $this->repository->deleteOne($uuid);
    }

    public function updateOne(string $uuid, string $description)
    {
        $this->repository->updateOne($description, $uuid);
    }

    public function getOneFromUuid(string $uuid)
    {
        return $this->repository->getOneFromUuid($uuid);
    }
}