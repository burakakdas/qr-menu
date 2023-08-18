<?php

namespace App\Models\Traits\Scopes;

use Illuminate\Database\Eloquent\Builder;

trait CompanyScope
{
    public function scopeCompany(Builder $query, array $companyIds): Builder
    {
        return $query->whereIn('company_id', $companyIds);
    }
}

