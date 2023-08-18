<?php

namespace App\Models\Traits\Scopes;

use Illuminate\Database\Eloquent\Builder;

trait EmailScope
{
    public function scopeEmail(Builder $query, string $email): Builder
    {
        return $query->where('email', 'LIKE', "%{$email}%");
    }
}
