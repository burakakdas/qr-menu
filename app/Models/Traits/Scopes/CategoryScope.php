<?php

namespace App\Models\Traits\Scopes;

use Illuminate\Database\Eloquent\Builder;

trait CategoryScope
{
    public function scopeCategory(Builder $query, array $categoryIds): Builder
    {
        return $query->whereIn('category_id', $categoryIds);
    }
}

