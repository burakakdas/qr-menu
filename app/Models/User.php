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
