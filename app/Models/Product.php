<?php

namespace App\Models;

use App\Models\Enums\MediaType;
use App\Models\Traits\Scopes\CategoryScope;
use App\Models\Traits\Scopes\CompanyScope;
use App\Models\Traits\Scopes\IsActiveScope;
use App\Models\Traits\Scopes\NameScope;
use App\Models\Traits\TrackUsers;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends BaseModel
{
    use SoftDeletes, TrackUsers;

    use IsActiveScope, CategoryScope, NameScope, CompanyScope;

    protected $table = 'products';

    protected $fillable = [
        'company_id',
        'category_id',
        'slug',
        'cover_image',
        'translations',
        'links',
        'order',
        'is_active',
        'created_by_id'
    ];

    protected $casts = [
        //'translations' => ProductTranslationJsonKeyToEnum::class,
        'translations' => 'array',
        'links' => 'array',
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

    protected function links(): Attribute
    {
        return Attribute::make(
            set: fn (array $value) => $this->asJson($value),
        );
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Media::class, 'model')
            ->where('media_type', '=', MediaType::IMAGE)
            ->orderBy('order');
    }

    public function coverImage(): MorphOne
    {
        return $this->morphOne(Media::class, 'model')
            ->where('media_type', '=', MediaType::IMAGE)
            ->where('is_cover', '=', true);
    }
}
