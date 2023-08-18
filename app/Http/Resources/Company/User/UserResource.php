<?php

namespace App\Http\Resources\Company\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Lang;

class UserResource extends JsonResource
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
                'name' => $this->name,
                'email' => $this->email,
                'is_active' => $this->is_active,
                'email_verified_at' => $this->email_verified_at,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                'role' => $this->when($this->relationLoaded('roles'), function () {
                    return [
                        'id' => $this->roles->first()->id,
                        'name' => Lang::get(sprintf('role.%s', $this->roles->first()->name)),
                    ];
                }),
            ],
        ];
    }
}
