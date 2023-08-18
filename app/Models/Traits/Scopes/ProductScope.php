<?php

namespace App\Models\Traits\Scopes;

use Illuminate\Database\Eloquent\Builder;

trait ProductScope
{
    public function scopeProductScope(Builder $query, array $productIds): Builder
    {
        return $query->whereIn('product_id', $productIds);
    }
}

