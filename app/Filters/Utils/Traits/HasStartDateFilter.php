<?php

namespace App\Filters\Utils\Traits;

trait HasStartDateFilter
{
    private \DateTimeInterface|null $startDate = null;

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;
        return $this;
    }

    public function startDateToArray(): array
    {
        return [
            'startDate' => $this->startDate,
        ];
    }
}
