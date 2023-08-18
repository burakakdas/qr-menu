<?php

namespace App\Http\Requests\Company\Branch;

use Illuminate\Foundation\Http\FormRequest;

class StoreBranchRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['bail', 'required', 'string', 'min:3', 'max:255'],
            'phone' => ['bail', 'nullable', 'numeric'],
            'email' => ['bail', 'nullable', 'email', 'string', 'max:255'],
            'address' => ['bail', 'nullable'],
            'slug' => ['bail', 'required', 'alpha_dash:ascii'], // TODO Kayıt esnasında tekrardan kontrol edilmeli
            'order' => ['bail', 'numeric'],
            'is_active' => ['bail', 'nullable', 'boolean'],
        ];
    }
}
