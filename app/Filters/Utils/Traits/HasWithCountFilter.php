<?php

namespace App\Filters\Utils\Traits;

trait HasWithCountFilter
{
    /**
     * @var array|null
     */
    private $withCount;

    /**
     * @return array|null
     */
    public function getWithCount(): ?array
    {
        return $this->withCount;
    }

    /**
     * @param array|null $withCount
     *
     * @return $this
     */
    public function setWithCount(?array $withCount): self
    {
        $this->withCount = $withCount;
        return $this;
    }

    /**
     * @return array
     */
    public function withCountToArray(): array
    {
        return [
            'withCount' => $this->withCount,
        ];
    }
}
