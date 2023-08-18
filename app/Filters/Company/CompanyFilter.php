<?php

namespace App\Filters\Company;

use App\Filters\Filter;
use App\Filters\Utils\Traits\HasIsActiveFilter;
use App\Filters\Utils\Traits\HasNameFilter;
use App\Filters\Utils\Traits\HasPhoneFilter;
use App\Filters\Utils\Traits\HasSlugFilter;

class CompanyFilter extends Filter
{
    use HasNameFilter, HasPhoneFilter, HasSlugFilter, HasIsActiveFilter;

    public function toArray(): array
    {
        return array_merge(
            parent::toArray(),
            $this->nameToArray(),
            $this->phoneToArray(),
            $this->slugToArray(),
            $this->isActiveToArray(),
        );
    }
}
