<?php

namespace models;

use models\ProgramItem;

class Program {
    private int $id;
    private int $event_id;
    private int $content_id;
    private array $program_items;
    private string $title;
    private float $total_price_program;
    private \DateTime $start_time;
    private \DateTime $end_time;

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
    public function getTotalPriceProgram(): float
    {
        return $this->total_price_program;
    }

    public function setTotalPriceProgram(): void
    {
        // calc total price from all program items
        $total_price = 0;
        if (!empty($this->program_items)) {
            foreach ($this->program_items as $program_item) {
                $total_price += $program_item->getPrice();
            }
            $this->total_price_program = $total_price;
        }
        else {
            $this->total_price_program = 0;
        }
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

}
