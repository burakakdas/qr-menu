<?php

namespace App\Models\Traits\Scopes;

use Illuminate\Database\Eloquent\Builder;

trait PhoneScope
{
    public function scopePhone(Builder $query, string $phone): Builder
    {
        return $query->where('phone', 'LIKE', "%{$phone}%");
    }
}

