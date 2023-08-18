<?php

namespace App\Models\Traits\Scopes;

use Illuminate\Database\Eloquent\Builder;

trait NameScope
{
    public function scopeName(Builder $query, string $name): Builder
    {
        return $query->where('name', 'LIKE', "%{$name}%");
    }
}

