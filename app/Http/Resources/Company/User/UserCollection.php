<?php

namespace App\Http\Resources\Company\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Lang;

class UserCollection extends ResourceCollection
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
            'data' => $this->collection->map(function (User $user, $key) {
                return [
                    'id' => $user->id,
                    'fist_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'email' => $user->email,
                    'is_active' => $user->is_active,
                    'email_verified_at' => $user->email_verified_at,
                    'created_at' => $user->created_at,
                    'updated_at' => $user->updated_at,
                    'role' => $this->when($user->relationLoaded('roles'), function () use ($user) {
                        return [
                            'id' => $user->roles->first()->id,
                            'name' => Lang::get(sprintf('role.%s', $user->roles->first()->name)),
                        ];
                    }),
                ];
            }),
        ];
    }
}
