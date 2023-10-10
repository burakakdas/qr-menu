<?php

namespace App\Models;

use App\Models\Traits\Scopes\CompanyScope;
use App\Models\Traits\Scopes\IsActiveScope;
use App\Models\Traits\Scopes\NameScope;
use App\Models\Traits\Scopes\PhoneScope;
use App\Models\Traits\TrackUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends BaseModel
{
    use SoftDeletes, TrackUsers;

    use NameScope, PhoneScope, CompanyScope, IsActiveScope;

    protected $table = 'branches';

    protected $fillable = [
        'name',
        'company_id',
        'phone',
        'email',
        'address',
        'slug',
        'order',
        'is_central',
        'is_active',
    ];

    protected $casts = [
        'is_central' => 'boolean',
        'is_active' => 'boolean',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
    ];
}
