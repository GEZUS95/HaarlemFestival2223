<?php

namespace services;

use helpers\EmailHelper;
use helpers\UuidHelper;
use repositories\ApiKeyRepository;

class ApiService
{
    private ApiKeyRepository $repository;
    private UuidHelper $uuidService;
    private EmailHelper $emailService;

    public function __construct()
    {
        $this->repository = new ApiKeyRepository();
        $this->uuidService = new UuidHelper();
        $this->emailService = new EmailHelper();
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

    public function getOneFromUuid(string $uuid)
    {
        return $this->repository->getOneFromUuid($uuid);
    }

    public function emailKey(string $uuid, string $email)
    {
        $this->emailService->sendEmail(
            'no-reply@haarlemfestival.com',
            $email,
            'Your new API key',
            "
            You have requested an API key for the Haarlem Festival, in this email you will find your new API key.
            
            
            Your new API key is ' $uuid '
            "
        );
    }
}
