<?php

namespace App\Filters\Utils\Traits;

trait HasIsActiveFilter
{
    /**
     * @var bool|null
     */
    private $isActive;

    /**
     * @return bool|null
     */
    public function isActive(): ?bool
    {
        return $this->isActive;
    }

    /**
     * @param bool|null $isActive
     *
     * @return $this
     */
    public function setIsActive(?bool $isActive): self
    {
        $this->isActive = $isActive;
        return $this;
    }

    /**
     * @return array
     */
    public function isActiveToArray(): array
    {
        return [
            'isActive' => $this->isActive,
        ];
    }
}
