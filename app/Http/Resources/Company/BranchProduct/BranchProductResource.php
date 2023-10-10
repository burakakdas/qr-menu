<?php

namespace App\Http\Resources\Company\BranchProduct;

use App\Http\Resources\Company\Product\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BranchProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'success' => true,
            'data' => [
                'id' => $this->id,
                'product' => $this->when($this->relationLoaded('product'), function () {
                    return [
                        'id' => $this->product->id,
                        'category' => [
                            'id' => $this->product->category_id,
                            'translations' => $this->product->category->translations,
                        ],
                        'slug' => $this->product->slug,
                        'cover_image' => $this->product->cover_image,
                        'translations' => $this->product->translations,
                        'links' => $this->product->links,
                        'order' => $this->product->order,
                        'is_active' => $this->product->is_active,
                    ];
                }),
                'price' => $this->price,
                'currency' => [
                    'id' => $this->currency->value,
                    'name' => $this->currency->getLabel(),
                    'symbol' => $this->currency->getSymbol(),
                ],
                'is_active' => $this->is_active,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
        ];
    }
}
