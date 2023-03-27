<?php

namespace models;

class ProgramItem {
    private int $id;
    private int $program_id;
    private int $location_id;
    private int $artist_id;
    private int $special_guest_id;
    private string $title;
    private string $start_time;
    private string $end_time;
    private float $price;
    private int $seats_left;

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
    public function getProgramId(): int
    {
        return $this->program_id;
    }

    /**
     * @param int $program_id
     */
    public function setProgramId(int $program_id): void
    {
        $this->program_id = $program_id;
    }

    /**
     * @return int
     */
    public function getLocationId(): int
    {
        return $this->location_id;
    }

    /**
     * @param int $location_id
     */
    public function setLocationId(int $location_id): void
    {
        $this->location_id = $location_id;
    }

    /**
     * @return int
     */
    public function getArtistId(): int
    {
        return $this->artist_id;
    }

    /**
     * @param int $artist_id
     */
    public function setArtistId(int $artist_id): void
    {
        $this->artist_id = $artist_id;
    }

    /**
     * @return int
     */
    public function getSpecialGuestId(): int
    {
        return $this->special_guest_id;
    }

    /**
     * @param int $special_guest_id
     */
    public function setSpecialGuestId(int $special_guest_id): void
    {
        $this->special_guest_id = $special_guest_id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getStartTime(): string
    {
        return $this->start_time;
    }

    /**
     * @param string $start_time
     */
    public function setStartTime(string $start_time): void
    {
        $this->start_time = $start_time;
    }

    /**
     * @return string
     */
    public function getEndTime(): string
    {
        return $this->end_time;
    }

    /**
     * @param string $end_time
     */
    public function setEndTime(string $end_time): void
    {
        $this->end_time = $end_time;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
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
