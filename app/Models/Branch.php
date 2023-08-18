<?php

namespace App\Models;

use App\Models\Traits\Scopes\CompanyScope;
use App\Models\Traits\Scopes\IsActiveScope;
use App\Models\Traits\Scopes\NameScope;
use App\Models\Traits\Scopes\PhoneScope;
use App\Models\Traits\TrackUsers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Branch
 *
 * @property int $id
 * @property string $name
 * @property int $company_id
 * @property string $phone
 * @property string $email
 * @property string $address
 * @property string $slug
 * @property string $order
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
 * @method static \Illuminate\Database\Eloquent\Builder|Branch company(array $companyIds)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch isActive(bool $isActive)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch name(string $name)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Branch newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Branch onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Branch phone(string $phone)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch query()
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereCreatedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereDeletedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereUpdatedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Branch withoutTrashed()
 * @mixin \Eloquent
 */
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
