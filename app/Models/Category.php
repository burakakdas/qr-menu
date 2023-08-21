<?php

namespace App\Models;

use App\Models\Enums\MediaType;
use App\Models\Traits\Scopes\CompanyScope;
use App\Models\Traits\Scopes\IsActiveScope;
use App\Models\Traits\Scopes\NameScope;
use App\Models\Traits\TrackUsers;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends BaseModel
{
    use HasFactory, SoftDeletes, TrackUsers;

    use NameScope, IsActiveScope, CompanyScope;

    protected $table = 'categories';

    protected $fillable = [
        'company_id',
        'name',
        'cover_image',
        'description',
        'is_active',
        'slug',
        'order',
        'created_by_id',
    ];

    protected $casts = [
        'translations' => 'array',
        'is_active' => 'boolean',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
    ];

    protected function translations(): Attribute
    {
        return Attribute::make(
            set: fn (array $value) => $this->asJson($value),
        );
    }

    public function company(): BelongsTo
    {
        return  $this->belongsTo(Company::class);
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Media::class, 'model')
            ->where('media_type', '=', MediaType::IMAGE)
            ->orderBy('order');
    }

    public function coverImage(): MorphOne
    {
        return $this->morphOne(MediaType::class, 'model')
            ->where('media_type', '=', MediaType::IMAGE)
            ->where('is_cover', '=', true);
    }
}
