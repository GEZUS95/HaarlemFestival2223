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


    public function getAll(int $limit = 0, int $offset = 0)
    {
        return $this->repository->getAll($limit, $offset);
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
        ob_start();
        include __DIR__. '/../views/templates/emailtemplates/apikey.php';
        $html = ob_get_clean();

        $this->emailService->sendHTMLEmail(
            'no-reply@haarlemfestival.com',
            $email,
            'Your new API key',
            $html
        );
    }

    public function verifyToken(string $token)
    {
        return $this->getOneFromUuid($token);
    }
}
