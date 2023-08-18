<?php

namespace App\Repositories;

use App\Filters\Company\BranchProductFilter;
use App\Models\BranchProduct;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class BranchProductRepository extends BaseRepository
{
    public function __construct(protected BranchProduct $branchProduct)
    {
        parent::__construct($this->branchProduct);
    }

    public function getByFilter(BranchProductFilter $filter): LengthAwarePaginator | Collection | \Illuminate\Support\Collection | BranchProduct | null
    {
        $query = $this->applyCommonQueries($filter, $this->branchProduct);

        if (! empty($filter->getBranchIds())) {
            $query = $query->whereIn('branch_id', $filter->getBranchIds());
        }

        if (! empty($filter->getCompanyIds())) {
            $query = $query->whereHas('branch', function (Builder $builder) use ($filter) {
                $builder->whereIn('company_id', $filter->getCompanyIds());
            });
        }

        if (! is_null($filter->isActive())) {
            $query = $query->isActive($filter->isActive());
        }

        if (! is_null($filter->isOnlyCentralBranch())) {
            $query = $query->whereHas('branch', function (Builder $builder) use ($filter) {
                $builder->where('is_central', $filter->isOnlyCentralBranch());
            });
        }

        if (! empty($filter->getProductIds())) {
            $query = $query->productScope($filter->getProductIds());
        }

        return $this->fetchByFilter($filter, $query);
    }
}
