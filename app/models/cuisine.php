<?php
namespace models;

class Cuisine {
    private int $id;
    private string $cuisine_name;

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
     * @return string
     */
    public function getCuisineName(): string
    {
        return $this->cuisine_name;
    }

    /**
     * @param string $cuisine_name
     */
    public function setCuisineName(string $cuisine_name): void
    {
        $this->cuisine_name = $cuisine_name;
    }
}
