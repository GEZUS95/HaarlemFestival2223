<?php
namespace models;

use DateTime;
use Exception;

class Session {
    private int $id;
    private int $restaurant_id;
    private \DateTime $start_time;
    private \DateTime $end_time;
    private int $seats_left;

    public function __construct(string $startTimeStr, string $endTimeStr) {
        $this->start_time = new \DateTime($startTimeStr);
        $this->end_time = new \DateTime($endTimeStr);
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
    public function getRestaurantId(): int
    {
        return $this->restaurant_id;
    }

    /**
     * @param int $restaurant_id
     */
    public function setRestaurantId(int $restaurant_id): void
    {
        $this->restaurant_id = $restaurant_id;
    }

    /**
     * @return DateTime
     */
    public function getStartTime(): DateTime
    {
        return $this->start_time;
    }

    /**
     * @param DateTime $start_time
     */
    public function setStartTime(string $start_time): void
    {
        $this->start_time = new DateTime($start_time);
    }

    /**
     * @return DateTime
     */
    public function getEndTime(): DateTime
    {
        return $this->end_time;
    }

    /**
     * @param DateTime $end_time
     */
    public function setEndTime(string $end_time): void
    {
        $this->end_time = new DateTime($end_time);
    }

    /**
     * @return int
     */
    public function getSeatsLeft(): int
    {
        return $this->seats_left;
    }

    /**
     * @param int $seats_left
     */
    public function setSeatsLeft(int $seats_left): void
    {
        $this->seats_left = $seats_left;
    }
}