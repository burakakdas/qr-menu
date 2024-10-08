<?php

namespace App\Http\Resources\Company\Branch;

use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BranchCollection extends ResourceCollection
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
            'data' => $this->collection->map(function (Branch $branch, $key) {
                return [
                    'id' => $branch->id,
                    'name' => $branch->name,
                    'phone' => $branch->phone,
                    'email' => $branch->email,
                    'address' => $branch->address,
                    'slug' => $branch->slug,
                    'order' => $branch->order,
                    'is_active' => $branch->is_active,
                    'created_at' => $branch->created_at,
                    'updated_at' => $branch->updated_at,
                ];
            }),
        ];
    }
}
