<?php

namespace App\Filters\Company;

use App\Filters\Filter;
use App\Filters\Utils\Traits\HasCategoryFilter;
use App\Filters\Utils\Traits\HasCompanyFilter;
use App\Filters\Utils\Traits\HasIsActiveFilter;
use App\Filters\Utils\Traits\HasProductFilter;

class BranchProductFilter extends Filter
{
    use HasIsActiveFilter, HasProductFilter, HasCompanyFilter, HasCategoryFilter;

    private array $branchIds = [];

    private null|bool $onlyCentralBranch = null;

    public function getBranchIds(): array
    {
        return $this->branchIds;
    }

    public function setBranchIds(array $branchIds): self
    {
        $this->branchIds = $branchIds;
        return $this;
    }

    public function addBranchId(int $branchId): self
    {
        if (! in_array($branchId, $this->branchIds)) {
            $this->branchIds[] = $branchId;
        }

        return $this;
    }

    public function isOnlyCentralBranch(): ?bool
    {
        return $this->onlyCentralBranch;
    }

    public function setOnlyCentralBranch(?bool $onlyCentralBranch): self
    {
        $this->onlyCentralBranch = $onlyCentralBranch;
        return $this;
    }

   public function toArray(): array
   {
       return array_merge(
           parent::toArray(),
           $this->isActiveToArray(),
           $this->productIdsToArray(),
           $this->categoryIdsToArray(),
           $this->companyIdsToArray(),
           [
               'branchIds' => $this->branchIds,
               'onlyCentralBranch' => $this->onlyCentralBranch,
           ]
       );
   }
}
