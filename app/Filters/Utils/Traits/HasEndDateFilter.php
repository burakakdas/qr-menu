<?php

namespace App\Filters\Utils\Traits;

trait HasEndDateFilter
{
    private \DateTimeInterface|null $endDate = null;

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;
        return $this;
    }

    public function endDateToArray(): array
    {
        return [
            'endDate' => $this->endDate,
        ];
    }
}
