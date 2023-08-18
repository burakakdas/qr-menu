<?php

namespace App\Repositories;

use App\Filters\Company\CompanyFilter;
use App\Models\Company;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CompanyRepository extends BaseRepository
{
    public function __construct(protected Company $company)
    {
        parent::__construct($this->company);
    }
    public function getByFilter(CompanyFilter $filter): LengthAwarePaginator | Collection | \Illuminate\Support\Collection | Company | null
    {
        $query = $this->applyCommonQueries($filter, $this->company);

        if (null !== $filter->getName()) {
            $query = $query->name($filter->getName());
        }

        if (null !== $filter->getPhone()) {
            $query = $query->phone($filter->getPhone());
        }

        if (null !== $filter->getSlug()) {
            $query = $query->whereSlug($filter->getSlug());
        }

        if (! is_null($filter->isActive())) {
            $query = $query->isActive($filter->isActive());
        }

        return $this->fetchByFilter($filter, $query);
    }
}

