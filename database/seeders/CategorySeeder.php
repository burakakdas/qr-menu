<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'id' => 1,
                'company_id' => 2,
                'slug' => 'kategori-1',
                'translations' => [
                    'tr' => [
                        'name' => 'Kategori 1', 'description' => 'Detaylı kategori açıklaması',
                        'seo' => ['title' => 'Kategor 1 başlık', 'description' => 'Kategori 1 Açıklaması', 'keywords' => 'kategori 1, anahtar kelimeler'],
                    ],
                    'en' => [
                        'name' => 'Category 1', 'description' => 'Detailed category description',
                        'seo' => ['title' => 'Category 1 Title', 'description' => 'Category 1 Description', 'keywords' => 'Category 1, Keywords'],
                    ],
                ],
                'order' => null, 'is_active' => true, 'created_by_id' => 1],
            [
                'id' => 2,
                'company_id' => 2,
                'slug' => 'kategori-2',
                'translations' => [
                    'tr' => [
                        'name' => 'Kategori 2', 'description' => 'Detaylı kategori açıklaması',
                        'seo' => ['title' => 'Kategor 2 başlık', 'description' => 'Kategori 2 Açıklaması', 'keywords' => 'kategori 2, anahtar kelimeler'],
                        ],
                    'en' => [
                        'name' => 'Category 2', 'description' => 'Detailed category description',
                        'seo' => ['title' => 'Category 2 Title', 'description' => 'Category 2 Description', 'keywords' => 'Category 2, Keywords'],
                    ],
                ],
                'order' => null, 'is_active' => true, 'created_by_id' => 1],
            [
                'id' => 3,
                'company_id' => 2,
                'slug' => 'kategori-3',
                'translations' => [
                    'tr' => [
                        'name' => 'Kategori 3', 'description' => 'Detaylı kategori açıklaması',
                        'seo' => ['title' => 'Kategor 3 başlık', 'description' => 'Kategori 3 Açıklaması', 'keywords' => 'kategori 3, anahtar kelimeler'],
                        ],
                    'en' => [
                        'name' => 'Category 3', 'description' => 'Detailed category description',
                        'seo' => ['title' => 'Category 3 Title', 'description' => 'Category 3 Description', 'keywords' => 'Category 3, Keywords'],
                    ],
                ],
                'order' => null, 'is_active' => false, 'created_by_id' => 1],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
