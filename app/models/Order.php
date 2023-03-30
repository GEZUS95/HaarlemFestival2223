<?php

namespace models;

class Order
{
    private int $id;
    private int $user_id;
    private string $share_uuid;
    private string $status;
    private string $payed_at;

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
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return string
     */
    public function getShareUuid(): string
    {
        return $this->share_uuid;
    }

    /**
     * @param string $share_uuid
     */
    public function setShareUuid(string $share_uuid): void
    {
        $this->share_uuid = $share_uuid;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getPayedAt(): string
    {
        return $this->payed_at;
    }

    /**
     * @param string $payed_at
     */
    public function setPayedAt(string $payed_at): void
    {
        $this->payed_at = $payed_at;
    }
}
