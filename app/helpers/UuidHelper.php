<?php

namespace helpers;

use Ramsey\Uuid\Uuid;

class UuidHelper
{
    public function generateUUID(): \Ramsey\Uuid\UuidInterface
    {
        //returns a Gen4 (Random) UUID
        return (Uuid::uuid4());
    }
}
