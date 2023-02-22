<?php

class Restaurant {
    private int $id;
    private int $location_id;
    private array $restaurant_cuisines;
    private string $name;
    private string $description;
    private int $stars;
    private int $seats;
    private float $price;
    private float $price_child;
    private DateTime $session_time;
    private string $accessibility;

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
     * @return array
     */
    public function getRestaurantCuisines(): array
    {
        return $this->restaurant_cuisines;
    }

    /**
     * @param array $restaurant_cuisines
     */
    public function setRestaurantCuisines(array $restaurant_cuisines): void
    {
        $this->restaurant_cuisines = $restaurant_cuisines;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getStars(): int
    {
        return $this->stars;
    }

    /**
     * @param int $stars
     */
    public function setStars(int $stars): void
    {
        $this->stars = $stars;
    }

    /**
     * @return int
     */
    public function getSeats(): int
    {
        return $this->seats;
    }

    /**
     * @param int $seats
     */
    public function setSeats(int $seats): void
    {
        $this->seats = $seats;
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
     * @return float
     */
    public function getPriceChild(): float
    {
        return $this->price_child;
    }

    /**
     * @param float $price_child
     */
    public function setPriceChild(float $price_child): void
    {
        $this->price_child = $price_child;
    }

    /**
     * @return DateTime
     */
    public function getSessionTime(): DateTime
    {
        return $this->session_time;
    }

    /**
     * @param DateTime $session_time
     */
    public function setSessionTime(DateTime $session_time): void
    {
        $this->session_time = $session_time;
    }

    /**
     * @return string
     */
    public function getAccessibility(): string
    {
        return $this->accessibility;
    }

    /**
     * @param string $accessibility
     */
    public function setAccessibility(string $accessibility): void
    {
        $this->accessibility = $accessibility;
    }
}
