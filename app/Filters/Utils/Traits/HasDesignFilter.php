<?php

namespace App\Filters\Utils\Traits;

trait HasDesignFilter
{
    private array|null $designIds = [];

    public function getDesignIds(): array|null
    {
        return $this->designIds;
    }

    public function setDesignIds(array $designIds): self
    {
        $this->designIds = $designIds;
        return $this;
    }

    public function addDesignId(int $designId): self
    {
        if (! in_array($designId, $this->designIds)) {
            $this->designIds[] = $designId;
        }

        return $this;
    }

    public function designIdsToArray(): array
    {
        return [
            'designIds' => $this->designIds,
        ];
    }
}
