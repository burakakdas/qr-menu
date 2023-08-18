<?php

namespace App\Http\Resources\Company\BranchProduct;

use App\Http\Resources\Company\Product\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BranchProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'success' => true,
            'data' => [
                'id' => $this->id,
                'product' => $this->when($this->relationLoaded('product'), function () {
                    return new ProductResource($this->product);
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
