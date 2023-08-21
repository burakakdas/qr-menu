<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends \Spatie\Permission\Models\Role
{
    use HasFactory;

    public const ID_SUPER_ADMIN = 1;
    public const ID_COMPANY_MANAGER = 2;
    public const ID_SYSTEM_USER = 3;

    public const NAME_SUPER_ADMIN = 'super-admin';
    public const NAME_COMPANY_MANAGER = 'company-manager';
    public const NAME_SYSTEM_USER = 'system-user';
}
