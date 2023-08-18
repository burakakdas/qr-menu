<?php

namespace App\Models;

use App\Models\Enums\Currency;
use App\Models\Traits\Scopes\IsActiveScope;
use App\Models\Traits\Scopes\ProductScope;
use App\Models\Traits\TrackUsers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\BranchProduct
 *
 * @property int $id
 * @property int $branch_id
 * @property int $product_id
 * @property string $price
 * @property Currency $currency
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
 * @method static \Illuminate\Database\Eloquent\Builder|BranchProduct isActive(bool $isActive)
 * @method static \Illuminate\Database\Eloquent\Builder|BranchProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BranchProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BranchProduct onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BranchProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|BranchProduct whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BranchProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BranchProduct whereCreatedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BranchProduct whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BranchProduct whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BranchProduct whereDeletedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BranchProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BranchProduct whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BranchProduct wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BranchProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BranchProduct whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BranchProduct whereUpdatedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BranchProduct withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BranchProduct withoutTrashed()
 * @mixin \Eloquent
 */
class BranchProduct extends BaseModel
{
    use HasFactory, SoftDeletes, TrackUsers;

    use IsActiveScope, ProductScope;

    protected $table = 'branch_products';

    protected $fillable = [
        'branch_id',
        'product_id',
        'currency',
        'is_active',
    ];

    protected $casts = [
        'currency' => Currency::class,
        'is_active' => 'boolean',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
    ];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
