<?php

class Session {
    public int $id;
    public int $restaurant_id;
    public DateTime $start_time;
    public DateTime $end_time;

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
    public function setStartTime(DateTime $start_time): void
    {
        $this->start_time = $start_time;
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
    public function setEndTime(DateTime $end_time): void
    {
        $this->end_time = $end_time;
    }
}