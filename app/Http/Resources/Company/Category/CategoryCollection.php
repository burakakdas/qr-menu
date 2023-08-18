<?php

namespace App\Http\Resources\Company\Category;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'success' => true,
            'data' => $this->collection->map(function (Category $category, $key) {
                return [
                    'id' => $category->id,
                    'translations' => $category->translations,
                    'cover_image' => $category->cover_image,
                    'slug' => $category->slug,
                    'order' => $category->order,
                    'is_active' => $category->is_active,
                    'created_at' => $category->created_at,
                    'updated_at' => $category->updated_at,
                ];
            }),
        ];
    }
}
