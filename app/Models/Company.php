<?php

namespace App\Models;

use App\Models\Enums\MediaType;
use App\Models\Traits\Scopes\IsActiveScope;
use App\Models\Traits\Scopes\NameScope;
use App\Models\Traits\Scopes\PhoneScope;
use App\Models\Traits\TrackUsersWithoutCreatingEvent;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends BaseModel
{
    use HasFactory, SoftDeletes, TrackUsersWithoutCreatingEvent;

    use NameScope, PhoneScope, IsActiveScope;

    protected $table = 'companies';

    protected $fillable = [
        'name',
        'address',
        'domain',
        'slogan',
        'slug',
        'settings',
        'phone',
        'is_active',
    ];

    protected $casts = [
        'settings' => 'array',
        'is_active' => 'boolean',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
    ];

    protected function settings(): Attribute
    {
        return Attribute::make(
            set: fn (array $value) => $this->asJson($value),
        );
    }

    public function logo(): MorphOne
    {
        return $this->morphOne(Media::class, 'model')
            ->where('media_type', '=', MediaType::IMAGE);
    }
}
