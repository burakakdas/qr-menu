<?php

namespace App\Http\Requests\Company\Company;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;

class CheckCompanySlugRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'slug' => ['bail', 'required', 'alpha_dash:ascii'],
        ];
    }

    public function attributes()
    {
        return [
            'slug' => Lang::get('input_name.slug'),
        ];
    }
}
