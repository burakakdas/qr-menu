<?php

namespace App\Filters\Utils\Traits;

trait HasCompanyFilter
{
    private array $companyIds = [];

    public function getCompanyIds(): array
    {
        return $this->companyIds;
    }

    public function setCompanyIds(array $companyIds): self
    {
        $this->companyIds = $companyIds;
        return $this;
    }

    public function addCompanyId(int $companyId): self
    {
        if (!in_array($companyId, $this->companyIds)) {
            $this->companyIds[] = $companyId;
        }

        return $this;
    }

    public function companyIdsToArray(): array
    {
        return [
            'companyIds' => $this->companyIds,
        ];
    }
}
