<?php

namespace App\Http\Requests\Company\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => ['bail', 'required', 'string', 'min:3', 'max:255'],
            'last_name' => ['bail', 'required', 'string', 'min:3', 'max:255'],
            'email' => ['bail', 'required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'is_active' => ['bail', 'nullable', 'boolean'],
        ];
    }

    public function attributes()
    {
        return [
            'first_name' => __('input_name.first_name'),
            'last_name' => __('input_name.last_name'),
            'email' => __('input_name.email'),
            'password' => __('input_name.password'),
            'is_active' => __('input_name.is_active'),
        ];
    }

    public function validated($key = null, $default = null): array
    {
        $validatedData = parent::validated();

        if (! empty($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        return data_get($validatedData, $key, $default);
    }
}
