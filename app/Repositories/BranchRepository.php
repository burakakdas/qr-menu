<?php

namespace App\Repositories;

use App\Filters\Company\BranchFilter;
use App\Models\Branch;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class BranchRepository extends BaseRepository
{
    public function __construct(protected Branch $branch)
    {
        parent::__construct($this->branch);
    }

    public function getByFilter(BranchFilter $filter): LengthAwarePaginator | Collection | \Illuminate\Support\Collection | Branch | null
    {
        $query = $this->applyCommonQueries($filter, $this->branch);

        if (! is_null($filter->getName())) {
            $query = $query->name($filter->getName());
        }

        if (! is_null($filter->isActive())) {
            $query = $query->isActive($filter->isActive());
        }

        if (! is_null($filter->getPhone())) {
            $query = $query->phone($filter->getPhone());
        }

        if (! is_null($filter->getSlug())) {
            $query = $query->whereSlug($filter->getSlug());
        }

        if (! is_null($filter->getCompanyIds())) {
            $query = $query->company($filter->getCompanyIds());
        }

        return $this->fetchByFilter($filter, $query);
    }
}
