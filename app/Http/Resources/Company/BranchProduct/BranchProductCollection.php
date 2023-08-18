<?php

namespace App\Http\Resources\Company\BranchProduct;

use App\Models\BranchProduct;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Lang;

class BranchProductCollection extends ResourceCollection
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
            'data' => $this->collection->map(function (BranchProduct $branchProduct, $key) {
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
