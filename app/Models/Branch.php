<?php

namespace App\Models;

use App\Models\Traits\Scopes\CompanyScope;
use App\Models\Traits\Scopes\IsActiveScope;
use App\Models\Traits\Scopes\NameScope;
use App\Models\Traits\Scopes\PhoneScope;
use App\Models\Traits\TrackUsers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends BaseModel
{
    use HasFactory, SoftDeletes, TrackUsers;

    use NameScope, PhoneScope, CompanyScope, IsActiveScope;

    protected $table = 'branches';

    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'company_id',
        'slug',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
    ];
}
