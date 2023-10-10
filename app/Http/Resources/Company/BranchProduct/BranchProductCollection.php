<?php

namespace App\Http\Resources\Company\BranchProduct;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BranchProductCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'success' => true,
            'data' => $this->collection->map(function ($branchProduct) {
                return [
                    'id' => $branchProduct->id,
                    'price' => $branchProduct->price,
                    'currency' => $branchProduct->currency,
                    'is_active' => $branchProduct->is_active,
                    'created_at' => $branchProduct->created_at,
                    'updated_at' => $branchProduct->updated_at,
                ];
            }),
        ];
    }
}
