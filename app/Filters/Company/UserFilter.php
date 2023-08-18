<?php

namespace App\Filters\Company;

use App\Filters\Filter;
use App\Filters\Utils\Traits\HasCompanyFilter;
use App\Filters\Utils\Traits\HasEmailFilter;
use App\Filters\Utils\Traits\HasIsActiveFilter;
use App\Filters\Utils\Traits\HasNameFilter;

class UserFilter extends Filter
{
    use HasNameFilter, HasIsActiveFilter, HasEmailFilter, HasCompanyFilter;

    public function toArray(): array
    {
        return array_merge(
            parent::toArray(),
            $this->nameToArray(),
            $this->isActiveToArray(),
            $this->emailToArray(),
            $this->companyIdsToArray(),
        );
    }
}
