<?php

namespace App\Filters\Company;

use App\Filters\Filter;
use App\Filters\Utils\Traits\HasCategoryFilter;
use App\Filters\Utils\Traits\HasCompanyFilter;
use App\Filters\Utils\Traits\HasIsActiveFilter;
use App\Filters\Utils\Traits\HasNameFilter;
use App\Filters\Utils\Traits\HasSlugFilter;

class ProductFilter extends Filter
{
    use HasNameFilter, HasIsActiveFilter, HasSlugFilter, HasCategoryFilter, HasCompanyFilter;

    public function toArray(): array
    {
        return array_merge(
            parent::toArray(),
            $this->nameToArray(),
            $this->isActiveToArray(),
            $this->slugToArray(),
            $this->categoryIdsToArray(),
            $this->companyIdsToArray(),
        );
    }
}
