<?php

namespace App\Filters\Company;

use App\Filters\Filter;
use App\Filters\Utils\Traits\HasCompanyFilter;
use App\Filters\Utils\Traits\HasIsActiveFilter;
use App\Filters\Utils\Traits\HasNameFilter;
use App\Filters\Utils\Traits\HasPhoneFilter;
use App\Filters\Utils\Traits\HasSlugFilter;

class BranchFilter extends Filter
{
    use HasNameFilter, HasIsActiveFilter, HasPhoneFilter, HasSlugFilter, HasCompanyFilter;

    public function toArray(): array
    {
        return array_merge(
            parent::toArray(),
            $this->nameToArray(),
            $this->isActiveToArray(),
            $this->phoneToArray(),
            $this->slugToArray(),
            $this->companyIdsToArray(),
        );
    }
}
