<?php

namespace App\Models;

use App\Models\Enums\Currency;
use App\Models\Traits\Scopes\IsActiveScope;
use App\Models\Traits\Scopes\ProductScope;
use App\Models\Traits\TrackUsers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

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
