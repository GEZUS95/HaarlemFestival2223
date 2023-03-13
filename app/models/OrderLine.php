<?php

namespace models;

class OrderLine
{
    private string $uuid;
    private int $id;
    private int $eventId;
    private int $programId;
    private int $programItemId;
    private int $sessionId;

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     */
    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getEventId(): int
    {
        return $this->eventId;
    }

    /**
     * @param int $eventId
     */
    public function setEventId(int $eventId): void
    {
        $this->eventId = $eventId;
    }

    /**
     * @return int
     */
    public function getProgramId(): int
    {
        return $this->programId;
    }

    /**
     * @param int $programId
     */
    public function setProgramId(int $programId): void
    {
        $this->programId = $programId;
    }

    /**
     * @return int
     */
    public function getProgramItemId(): int
    {
        return $this->programItemId;
    }

    /**
     * @param int $programItemId
     */
    public function setProgramItemId(int $programItemId): void
    {
        $this->programItemId = $programItemId;
    }

    /**
     * @return int
     */
    public function getSessionId(): int
    {
        return $this->sessionId;
    }

    /**
     * @param int $sessionId
     */
    public function setSessionId(int $sessionId): void
    {
        $this->sessionId = $sessionId;
    }

}
