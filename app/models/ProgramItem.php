<?php

namespace models;

class ProgramItem {
    private int $id;
    private int $location_id;
    private int $artist_id;
    private int $special_guest_id;
    private int $content_id;
    private \DateTime $start_time;
    private \DateTime $end_time;
    private float $price;

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
     * @return int
     */
    public function getContentId(): int
    {
        return $this->content_id;
    }

    /**
     * @param int $content_id
     */
    public function setContentId(int $content_id): void
    {
        $this->content_id = $content_id;
    }

    /**
     * @return \DateTime
     */
    public function getStartTime(): \DateTime
    {
        return $this->start_time;
    }

    /**
     * @param \DateTime $start_time
     */
    public function setStartTime(\DateTime $start_time): void
    {
        $this->start_time = $start_time;
    }

    /**
     * @return \DateTime
     */
    public function getEndTime(): \DateTime
    {
        return $this->end_time;
    }

    /**
     * @param \DateTime $end_time
     */
    public function setEndTime(\DateTime $end_time): void
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
}
