<?php

namespace App\Http\Resources\Company\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'success' => true,
            'data' => $this->collection->map(function ($product, $key) {
                return [
                    'id' => $product->id,
                    'category_id' => $product->category_id,
                    'slug' => $product->slug,
                    'cover_image' => $product->cover_image,
                    'translations' => $product->translations,
                    'links' => $product->links,
                    'order' => $product->order,
                    'is_active' => $product->is_active,
                    'created_at' => $product->created_at,
                    'updated_at' => $product->updated_at,
                ];
            }),
        ];
    }
}
