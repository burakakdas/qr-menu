<?php

namespace Database\Seeders;

use App\Models\BranchProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Enums\Currency;

class BranchProductSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BranchProduct::insert([
            ['id' => 1, 'branch_id' => 1, 'product_id' => 1, 'price' => 10.00, 'currency' => Currency::TL, 'is_active' => true, 'created_by_id' => 1],
            ['id' => 2, 'branch_id' => 1, 'product_id' => 2, 'price' => 1.00, 'currency' => Currency::TL, 'is_active' => true, 'created_by_id' => 1],
            ['id' => 3, 'branch_id' => 1, 'product_id' => 3, 'price' => 30.00, 'currency' => Currency::TL, 'is_active' => true, 'created_by_id' => 1],
            ['id' => 4, 'branch_id' => 1, 'product_id' => 4, 'price' => 22.90, 'currency' => Currency::TL, 'is_active' => true, 'created_by_id' => 1],
            ['id' => 5, 'branch_id' => 1, 'product_id' => 5, 'price' => 496.00, 'currency' => Currency::TL, 'is_active' => true, 'created_by_id' => 1],
            ['id' => 6, 'branch_id' => 1, 'product_id' => 6, 'price' => 35.10, 'currency' => Currency::TL, 'is_active' => true, 'created_by_id' => 1],
            ['id' => 7, 'branch_id' => 1, 'product_id' => 7, 'price' => 435.00, 'currency' => Currency::TL, 'is_active' => true, 'created_by_id' => 1],
            ['id' => 8, 'branch_id' => 1, 'product_id' => 8, 'price' => 5.00, 'currency' => Currency::TL, 'is_active' => true, 'created_by_id' => 1],
            ['id' => 9, 'branch_id' => 1, 'product_id' => 9, 'price' => 4300.00, 'currency' => Currency::TL, 'is_active' => true, 'created_by_id' => 1],
            ['id' => 10, 'branch_id' => 1, 'product_id' => 10, 'price' => 3400.25, 'currency' => Currency::TL, 'is_active' => true, 'created_by_id' => 1],
            ['id' => 11, 'branch_id' => 2, 'product_id' => 1, 'price' => 11.00, 'currency' => Currency::TL, 'is_active' => true, 'created_by_id' => 1],
            ['id' => 12, 'branch_id' => 2, 'product_id' => 2, 'price' => 1.05, 'currency' => Currency::TL, 'is_active' => true, 'created_by_id' => 1],
            ['id' => 13, 'branch_id' => 2, 'product_id' => 3, 'price' => 30.5, 'currency' => Currency::TL, 'is_active' => true, 'created_by_id' => 1]
        ]);
    }
}
