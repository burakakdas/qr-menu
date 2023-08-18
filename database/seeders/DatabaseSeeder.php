<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\BranchProduct;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
            DemoCompanyBranchAndUserSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            BranchProductSeeder::class,
        ]);
    }
}
