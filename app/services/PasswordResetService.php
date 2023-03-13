<?php

namespace services;

use DateTime;
use helpers\EmailHelper;
use helpers\UuidHelper;
use repositories\PasswordResetRepository;

class PasswordResetService
{
    private PasswordResetRepository $repository;
    private UuidHelper $uuidService;
    private $emailService;

    public function __construct()
    {
        $this->repository = new PasswordResetRepository();
        $this->uuidService = new UuidHelper();
        $this->emailService = new EmailHelper();
    }

    public function getOneWithUuid(string $uuid)
    {
        return $this->repository->getOneFromUuid($uuid);
    }

    public function insertOne(string $uuid, int $userId, \DateTime $expires): void
    {
        $this->repository->insertOne($uuid, $userId, $expires->format('Y-m-d H:i:s'));
    }

    public function deleteOne(string $uuid): void
    {
        $this->repository->deleteOne($uuid);
    }

    public function newRequest(string $email, int $userId): void
    {
        $expires = new \DateTime();
        $expires->modify('+15 minutes');

        $uuid = $this->uuidService->generateUUID();

        $this->insertOne($uuid, $userId, $expires);

        $this->emailService->sendEmail(
            'no-reply@haarlemfestival.com',
            $email,
            'Forgotten Password',
            "
<!DOCTYPE html>
<html>
    <body>
                <a href='http://localhost/resetpassword/$uuid'>Klik hier om je wachtwoord te resetten</a> /r
                if the link does not work  http://localhost/resetpassword/$uuid
    </body>
</html>"
        );
    }

    public function checkUuid(string $uuid): bool
    {
        $dbItem = $this->getOneWithUuid($uuid);
        if (!$dbItem) { return false;}
        $now = new DateTime();
        $expires = new DateTime($dbItem['expires_at']);

        return ($now <= $expires);
    }

    public function getOneWithUserId(int $userId)
    {
        return $this->repository->getOneFromUserId($userId);
    }

    public function checkIfAlreadyExist(int $userId): bool
    {
        if ($request = $this->getOneWithUserId($userId)) {
            if (new DateTime($request['expires_at']) <= new DateTime()) {
                $this->deleteOne($request['uuid']);
            }
            return true;
        } else {
            return false;
        }
    }
}
