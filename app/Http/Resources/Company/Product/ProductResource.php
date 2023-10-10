<?php

namespace App\Http\Resources\Company\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'success' => true,
            'data' => [
                'id' => $this->id,
                'category_id' => $this->category_id,
                'slug' => $this->slug,
                'cover_image' => $this->cover_image,
                'translations' => $this->translations,
                'links' => $this->links,
                'order' => $this->order,
                'is_active' => $this->is_active,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
        ];
    }
}
