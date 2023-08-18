<?php

namespace App\Models\Traits\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

trait FirstNameAndLastNameScope
{
    public function scopeFirstNameAndLastName(Builder $query, string $name): Builder
    {
        return $query->where(function (Builder $query) use ($name) {
            $query->where('first_name', 'LIKE', "%{$name}%")
                ->orwhere('last_name', 'LIKE', "%{$name}%")
                ->orWhere(DB::raw('CONCAT_WS(" ", first_name, last_name)'), 'LIKE', "%{$name}%");
        });
    }
}
