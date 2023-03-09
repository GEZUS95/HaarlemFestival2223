<?php

namespace services;

use Ramsey\Uuid\Uuid;

class UuidService
{
    public function generateUUID(): \Ramsey\Uuid\UuidInterface
    {
        //returns a Gen4 (Random) UUID
        return (Uuid::uuid4());
    }
}
