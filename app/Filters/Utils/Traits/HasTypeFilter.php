<?php

namespace App\Filters\Utils\Traits;

trait HasTypeFilter
{
    private array|null $typeIds = [];

    public function getTypeIds(): array|null
    {
        return $this->typeIds;
    }

    public function setTypeIds(array $typeIds): self
    {
        $this->typeIds = $typeIds;
        return $this;
    }

    public function addTypeId(int $rewardTypeId): self
    {
        if (! in_array($rewardTypeId, $this->typeIds)) {
            $this->typeIds[] = $rewardTypeId;
        }

        return $this;
    }

    public function typeIdsToArray(): array
    {
        return [
            'typeIds' => $this->typeIds,
        ];
    }
}
