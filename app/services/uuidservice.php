<?php
namespace services;
use Ramsey\Uuid\Uuid;

Class UuidService
{
    public function generateUUID(): \Ramsey\Uuid\UuidInterface
    {
        return (Uuid::uuid4());
    }
}
