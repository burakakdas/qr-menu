<?php

namespace App\Models;

use App\Models\Traits\Scopes\CompanyScope;
use App\Models\Traits\Scopes\IsActiveScope;
use App\Models\Traits\Scopes\NameScope;
use App\Models\Traits\TrackUsers;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $translations
 * @property int $company_id
 * @property string $cover_image
 * @property string $description
 * @property string $slug
 * @property int $order
 * @property bool $is_active
 * @property int $created_by_id
 * @property int|null $updated_by_id
 * @property int|null $deleted_by_id
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User $createdBy
 * @property-read \App\Models\User|null $deletedBy
 * @property-read \App\Models\User|null $updatedBy
// * @method static \Illuminate\Database\Eloquent\Builder|Category company(array $companyIds)
 * @method static \Illuminate\Database\Eloquent\Builder|Category isActive(bool $isActive)
 * @method static \Illuminate\Database\Eloquent\Builder|Category name(string $name)
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCoverImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereDeletedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Category withoutTrashed()
 * @mixin \Eloquent
 */
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
}
