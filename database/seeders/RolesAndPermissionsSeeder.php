<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $allAdminPermissions = [];

        Role::create(['id' => Role::ID_SUPER_ADMIN, 'guard_name' => User::GUARD_NAME_ADMIN, 'name' => Role::NAME_SUPER_ADMIN])
            ->givePermissionTo([$allAdminPermissions]);

        $allCompanyPermissions = [];

        Role::create(['id' => Role::ID_COMPANY_MANAGER, 'guard_name' => User::GUARD_NAME_COMPANY, 'name' => Role::NAME_COMPANY_MANAGER])
            ->givePermissionTo([$allCompanyPermissions]);

        /** Guard:System User */
        Role::create(['id' => Role::ID_SYSTEM_USER, 'guard_name' => User::GUARD_NAME_COMPANY, 'name' => Role::NAME_SYSTEM_USER]);
    }
}
