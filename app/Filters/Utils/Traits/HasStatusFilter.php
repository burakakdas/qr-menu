<?php

namespace App\Filters\Utils\Traits;

trait HasStatusFilter
{
    private array $statusIds = [];

    public function getStatusIds(): array
    {
        return $this->statusIds;
    }

    public function setStatusIds(array $statusIds): self
    {
        $this->statusIds = $statusIds;
        return $this;
    }

    public function addStatusId(int $statusId): self
    {
        if (! in_array($statusId, $this->statusIds)) {
            $this->statusIds[] = $statusId;
        }

        return $this;
    }

    public function statusIdsToArray(): array
    {
        return [
            'statusIds' => $this->statusIds,
        ];
    }
}
