<?php

namespace models;

use models\ProgramItem;

class Program {
    private int $id;
    private int $event_id;
    private int $content_id;
    private array $program_items;
    private string $title;
    private float $price;
    private string $start_time;
    private string $end_time;

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
        return $this->event_id;
    }

    /**
     * @param int $event_id
     */
    public function setEventId(int $event_id): void
    {
        $this->event_id = $event_id;
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
     * @return array
     */
    public function getProgramItems(): array
    {
        return $this->program_items;
    }

    /**
     * @param array $program_items
     */
    public function setProgramItems(array $program_items): void
    {
        $this->program_items = $program_items;
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
}
