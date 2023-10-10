<?php

namespace App\Http\Requests\Company\Branch;

use App\Helpers\PhoneHelper;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBranchRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge([
            'phone' => PhoneHelper::reformatPhoneData($this->phone),
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => ['bail', 'required', 'string', 'min:3', 'max:255'],
            'phone' => ['bail', 'nullable', 'numeric'],
            'email' => ['bail', 'nullable', 'email', 'string', 'max:255'],
            'address' => ['bail', 'nullable'],
            'slug' => ['bail', 'required', 'alpha_dash:ascii'], // TODO Kayıt esnasında tekrardan kontrol edilmeli
            'order' => ['bail', 'numeric'],
            'is_central' => ['bail', 'nullable', 'boolean'], // TODO Yeni bir şube merkez şube olursa diğerinin merkezi bilgisi false yapılmalı
            'is_active' => ['bail', 'nullable', 'boolean'],
        ];
    }
}
