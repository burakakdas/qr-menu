<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->delete();

        $products = [
            [
                'id' => 1,
                'company_id' => 1,
                'category_id' => 1,
                'slug' => 'urun-1',
                'translations' => [
                    'tr' => [
                        'name' => 'Ürün 1', 'description' => 'Detaylı ürün açıklaması',
                        'seo' => ['title' => 'Ürün 1 başlık', 'description' => 'Ürün 1 Açıklaması', 'keywords' => 'ürün 1, anahtar kelimeler'],
                    ],
                    'en' => [
                        'name' => 'Product 1', 'description' => 'Detailed product description',
                        'seo' => ['title' => 'Product 1 title', 'description' => 'Product 1 description', 'keywords' => 'product 1, keywords'],
                    ],
                ],
                'links' => [
                    ['resource' => 1, 'url' => 'https://www.instagram.com'],
                    ['resource' => 2, 'url' => 'https://www.facebook.com'],
                ],
                'order' => null,
                'is_active' => true,
                'created_by_id' => 1,
            ],
            [
                'id' => 2,
                'company_id' => 1,
                'category_id' => 1,
                'slug' => 'urun-2',
                'translations' => [
                    'tr' => [
                        'name' => 'Ürün 2', 'description' => 'Detaylı ürün açıklaması',
                        'seo' => ['title' => 'Ürün 2 başlık', 'description' => 'Ürün 2 Açıklaması', 'keywords' => 'ürün 2, anahtar kelimeler'],
                    ],
                    'en' => [
                        'name' => 'Product 2', 'description' => 'Detailed category description',
                        'seo' => ['title' => 'Product 2 title', 'description' => 'Product 2 description', 'keywords' => 'product 2, keywords'],
                    ],
                ],
                'links' => [
                    ['resource' => 1, 'url' => 'https://www.instagram.com'],
                ],
                'order' => null,
                'is_active' => true,
                'created_by_id' => 1,
            ],
            [
                'id' => 3,
                'company_id' => 1,
                'category_id' => 1,
                'slug' => 'urun-3',
                'translations' => [
                    'tr' => [
                        'name' => 'Ürün 3', 'description' => 'Detaylı ürün açıklaması',
                        'seo' => ['title' => 'Ürün 3 başlık', 'description' => 'Ürün 3 Açıklaması', 'keywords' => 'ürün 3, anahtar kelimeler'],
                        ],
                    'en' => [
                        'name' => 'Product 3', 'description' => 'Detailed category description',
                        'seo' => ['title' => 'Product 3 title', 'description' => 'Product 3 description', 'keywords' => 'product 3, keywords'],
                    ],
                ],
                'links' => [
                    ['resource' => 1, 'url' => 'https://www.instagram.com'],
                    ['resource' => 2, 'url' => 'https://www.facebook.com'],
                    ['resource' => 3, 'url' => 'https://www.tiktok.com'],
                ],
                'order' => null,
                'is_active' => true,
                'created_by_id' => 1,
            ],
            [
                'id' => 4,
                'company_id' => 1,
                'category_id' => 2,
                'slug' => 'urun-4',
                'translations' => [
                    'tr' => [
                        'name' => 'Ürün 4', 'description' => 'Detaylı ürün açıklaması',
                        'seo' => ['title' => 'Ürün 4 başlık', 'description' => 'Ürün 4 Açıklaması', 'keywords' => 'ürün 4, anahtar kelimeler'],
                        ],
                    'en' => [
                        'name' => 'Product 4', 'description' => 'Detailed category description',
                        'seo' => ['title' => 'Product 4 title', 'description' => 'Product 4 description', 'keywords' => 'product 4, keywords'],
                        ],
                    ],
                'links' => [],
                    'order' => null,
                    'is_active' => true,
                    'created_by_id' => 1,
                ],
            [
                'id' => 5,
                'company_id' => 1,
                'category_id' => 2,
                'slug' => 'urun-5',
                'translations' => [
                    'tr' => [
                        'name' => 'Ürün 5', 'description' => 'Detaylı ürün açıklaması',
                        'seo' => ['title' => 'Ürün 5 başlık', 'description' => 'Ürün 5 Açıklaması', 'keywords' => 'Ürün 5, anahtar kelimeler'],
                    ],
                    'en' => [
                        'name' => 'Product 5', 'description' => 'Detailed category description',
                        'seo' => ['title' => 'Product 5 title', 'description' => 'Product 5 description', 'keywords' => 'product 5, keywords'],
                    ],
                ],
                'links' => [
                    ['resource' => 1, 'url' => 'https://www.instagram.com'],
                ],
                'order' => null,
                'is_active' => true,
                'created_by_id' => 1,
            ],
            [
                'id' => 6,
                'company_id' => 1,
                'category_id' => 2,
                'slug' => 'urun-6',
                'translations' => [
                    'tr' => [
                        'name' => 'Ürün 6', 'description' => 'Detaylı ürün açıklaması',
                        'seo' => ['title' => 'Ürün 6 başlık', 'description' => 'Ürün 6 Açıklaması', 'keywords' => 'ürün 6, anahtar kelimeler'],
                    ],
                    'en' => [
                        'name' => 'Product 6', 'description' => 'Detailed category description',
                        'seo' => ['title' => 'Product 6 title', 'description' => 'Product 6 description', 'keywords' => 'product 6, keywords'],
                    ],
                ],
                'links' => [
                    ['resource' => 1, 'url' => 'https://www.instagram.com'],
                    ['resource' => 2, 'url' => 'https://www.facebook.com'],
                    ['resource' => 3, 'url' => 'https://www.tiktok.com'],
                    ['resource' => 4, 'url' => 'https://www.youtube.com'],
                ],
                'order' => null,
                'is_active' => false,
                'created_by_id' => 1,
            ],
            [
                'id' => 7,
                'company_id' => 1,
                'category_id' => 3,
                'slug' => 'urun-7',
                'translations' => [
                    'tr' => [
                        'name' => 'Ürün 7', 'description' => 'Detaylı ürün açıklaması',
                        'seo' => ['title' => 'Ürün 7 başlık', 'description' => 'Ürün 7 Açıklaması', 'keywords' => 'ürün 7, anahtar kelimeler'],
                    ],
                    'en' => [
                        'name' => 'Product 7', 'description' => 'Detailed category description',
                        'seo' => ['title' => 'Product 7 title', 'description' => 'Product 7 description', 'keywords' => 'product 7, keywords'],
                    ],
                ],
                'links' => [
                    ['resource' => 1, 'url' => 'https://www.instagram.com'],
                    ['resource' => 2, 'url' => 'https://www.facebook.com'],
                ],
                'order' => null,
                'is_active' => true,
                'created_by_id' => 1,
            ],
            [
                'id' => 8,
                'company_id' => 1,
                'category_id' => 3,
                'slug' => 'urun-8',
                'translations' => [
                    'tr' => [
                        'name' => 'Ürün 8', 'description' => 'Detaylı ürün açıklaması',
                        'seo' => ['title' => 'Ürün 8 başlık', 'description' => 'Ürün 8 Açıklaması', 'keywords' => 'ürün 8, anahtar kelimeler'],
                    ],
                    'en' => [
                        'name' => 'Product 8', 'description' => 'Detailed category description',
                        'seo' => ['title' => 'Product 1 title', 'description' => 'Product 8 description', 'keywords' => 'product 8, keywords'],
                    ],
                ],
                'links' => [
                    ['resource' => 1, 'url' => 'https://www.instagram.com'],
                ],
                'order' => null,
                'is_active' => true,
                'created_by_id' => 1,
            ],
            [
                'id' => 9,
                'company_id' => 1,
                'category_id' => 3,
                'slug' => 'urun-9',
                'translations' => [
                    'tr' => [
                        'name' => 'Ürün 9', 'description' => 'Detaylı ürün açıklaması',
                        'seo' => ['title' => 'Ürün 9 başlık', 'description' => 'Ürün 9 Açıklaması', 'keywords' => 'Ürün 9, anahtar kelimeler'],
                    ],
                    'en' => [
                        'name' => 'Product 9', 'description' => 'Detailed category description',
                        'seo' => ['title' => 'Product 9 title', 'description' => 'Product 9 description', 'keywords' => 'product 9, keywords'],
                    ],
                ],
                'links' => [
                    ['resource' => 1, 'url' => 'https://www.instagram.com'],
                    ['resource' => 2, 'url' => 'https://www.facebook.com'],
                    ['resource' => 3, 'url' => 'https://www.tiktok.com'],
                ],
                'order' => null,
                'is_active' => true,
                'created_by_id' => 1,
            ],
            [
                'id' => 10,
                'company_id' => 1,
                'category_id' => 3,
                'slug' => 'urun-10',
                'translations' => [
                    'tr' => [
                        'name' => 'Ürün 10', 'description' => 'Detaylı ürün açıklaması',
                        'seo' => ['title' => 'Ürün 10 başlık', 'description' => 'Ürün 10 Açıklaması', 'keywords' => 'ürün 10, anahtar kelimeler'],
                    ],
                    'en' => [
                        'name' => 'Product 10', 'description' => 'Detailed category description',
                        'seo' => ['title' => 'Product 10 title', 'description' => 'Product 10 description', 'keywords' => 'product 10, keywords'],
                    ],
                ],
                'links' => [
                    ['resource' => 2, 'url' => 'https://www.facebook.com'],
                ],
                'order' => null,
                'is_active' => true,
                'created_by_id' => 1,
            ],
        ];

        foreach ($products as  $product) {
            Product::create($product);
        }
    }
}
