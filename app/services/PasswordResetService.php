<?php

namespace services;

use DateTime;
use repositories\PasswordResetRepository;

class PasswordResetService
{
    private PasswordResetRepository $repository;
    private UserService $userService;
    private UuidService $uuidService;
    private $emailService;

    public function __construct()
    {
        $this->repository = new PasswordResetRepository();
        $this->userService = new UserService();
        $this->uuidService = new UuidService();
        $this->emailService = new EmailService();
    }

    public function getOneWithUuid(string $uuid)
    {
        return $this->repository->getOneFromUuid($uuid);
    }

    public function insertOne(string $uuid, int $userId, \DateTime $expires)
    {
        $this->repository->insertOne($uuid, $userId, $expires);
    }

    public function deleteOne(string $uuid)
    {
        $this->repository->deleteOne($uuid);
    }

    public function newRequest($email)
    {
        $user = $this->userService->getOneByEmail($email);

        $expires = new \DateTime();
        $expires->modify('+15 minutes');
        $expires->format('Y-m-d H:i:s');

        $uuid = $this->uuidService->generateUUID();

        $this->insertOne($uuid, $user->getId(), $expires);

        $this->emailService->sendEmail(
            'no-reply@haarlemfestival.com',
            $email,
            'Forgotten Password',
            "<a href='http://localhost/passwordreset/$uuid'>Klik hier om je wachtwoord te resetten</a> /r
                if the link does not work `http://localhost/passwordreset/$uuid`
"
        );
    }

    public function checkUuid(string $uuid)
    {
        $dbItem = $this->getOneWithUuid($uuid);
        if (!$dbItem) { return false;}
        $now = new DateTime();
        $expires = new DateTime($dbItem['expires_at']);

        return ($now <= $expires);
    }



}