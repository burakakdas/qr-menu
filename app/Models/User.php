<?php

namespace App\Models;

use App\Models\Traits\Relations\BelongsToCompany;
use App\Models\Traits\Scopes\CompanyScope;
use App\Models\Traits\Scopes\EmailScope;
use App\Models\Traits\Scopes\FirstNameAndLastNameScope;
use App\Models\Traits\Scopes\IsActiveScope;
use App\Models\Traits\Scopes\PhoneScope;
use App\Models\Traits\TrackUsersWithoutCreatingEvent;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property int $company_id
 * @property string $email
 * @property string $phone
 * @property int|null $email_verified_at
 * @property bool $is_active
 * @property mixed $password
 * @property int|null $created_by_id
 * @property int|null $updated_by_id
 * @property int|null $deleted_by_id
 * @property string|null $remember_token
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Company $company
 * @property-read User|null $deletedBy
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @property-read User|null $updatedBy
 * @method static \Illuminate\Database\Eloquent\Builder|User company(array $companyIds)
 * @method static \Illuminate\Database\Eloquent\Builder|User email(string $email)
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User firstNameAndLastName(string $name)
 * @method static \Illuminate\Database\Eloquent\Builder|User isActive(bool $isActive)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User phone(string $phone)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutTrashed()
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, TrackUsersWithoutCreatingEvent, HasRoles, HasApiTokens;

    use IsActiveScope, FirstNameAndLastNameScope, EmailScope, CompanyScope, PhoneScope;

    use BelongsToCompany;

    public const GUARD_NAME_ADMIN = 'admin';
    public const GUARD_NAME_COMPANY = 'system';

    public const TOKEN_WEB = 'web_token';

    protected $table = 'users';

    protected function getGuardNames(): Collection
    {
        return collect([self::GUARD_NAME_COMPANY]);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'company_id',
        'branch_id',
        'email',
        'phone',
        'settings',
        'is_active',
        'password',
    ];

    protected $casts = [
        'settings' => 'array',
        'is_active' => 'bool',
        'email_verified_at' => 'timestamp',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'password' => 'hashed',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function settings(): Attribute
    {
        return Attribute::make(
            set: fn (array $value) => $this->asJson($value),
        );
    }
}
