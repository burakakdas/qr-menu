<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Company;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DemoCompanyBranchAndUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('companies')->delete();
        DB::table('branches')->delete();
        DB::table('users')->delete();

        $companies = [
            ['id' => 1, 'name' => 'Firma 1', 'address' => 'Adres 1', 'domain' => 'http://ornekdoamin.com', 'slogan' => 'Slogan', 'slug' => 'firma-1', 'settings' => [], 'phone' => '05555555555', 'is_active' => true],
            ['id' => 2, 'name' => 'Firma 2', 'address' => 'Adres 2', 'domain' => 'http://ornekdoamin2.com', 'slogan' => 'Slogan2', 'slug' => 'firma-2', 'settings' => [], 'phone' => '05555555555', 'is_active' => true],
        ];

        foreach ($companies as $company) {
            Company::create($company);
        }

        $branches = [
            ['id' => 1, 'name' => 'Merkez', 'company_id' => 1, 'phone' => '05555555555', 'email' => null, 'address' => 'Ana Şube Adress', 'slug' => 'ana-sube', 'order' => null, 'is_central' => true, 'is_active' => true],
            ['id' => 2, 'name' => 'Talas Şube', 'company_id' => 1, 'phone' => '05555555555', 'email' => null, 'address' => 'Talas Şube Adress', 'slug' => 'talas-sube', 'order' => null, 'is_central' =>false, 'is_active' => true],
        ];

        Branch::insert($branches);

        $managerUsers = [
            ['id' => 1, 'first_name' => 'Firma 1 Yönetici', 'last_name' => 'Yönetici', 'company_id' => 1, 'branch_id' => 1, 'email' => 'demo@demo.com', 'phone' => '05555555555', 'settings' => [], 'is_active' => true, 'password' => Hash::make('tlg1234.')],
            ['id' => 2, 'first_name' => 'Firma 2 Yönetici', 'last_name' => 'Yönetici', 'company_id' => 2, 'branch_id' => 2, 'email' => 'demo1@demo.com', 'phone' => '05555555555', 'settings' => [], 'is_active' => true, 'password' => Hash::make('tlg1234.')],
        ];

        foreach ($managerUsers as $user) {
            /** @var User $userModel */
            $userModel = User::create($user);

            $managerRole = Role::findByName(Role::NAME_COMPANY_MANAGER, User::GUARD_NAME_COMPANY);

            $userModel->assignRole($managerRole);
        }
    }
}
