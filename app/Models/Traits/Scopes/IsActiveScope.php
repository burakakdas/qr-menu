<?php

namespace App\Models\Traits\Scopes;

use Illuminate\Database\Eloquent\Builder;

trait IsActiveScope
{
    public function scopeIsActive(Builder $query, bool $isActive): Builder
    {
        return $query->where('is_active', $isActive);
    }
}

