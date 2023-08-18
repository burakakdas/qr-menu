<?php

namespace App\Http\Requests\Company\Product;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;

class CheckProductSlugRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'slug' => ['bail', 'required', 'alpha_dash:ascii', 'max: 200', 'min: 3'],
            'current_product_id' => ['sometimes', sprintf('exists:%s,id', Product::class)],
        ];
    }

    public function attributes()
    {
        return [
            'slug' => Lang::get('input_name.product_slug'),
            'current_product_id' => Lang::get('input_name.id')
        ];
    }
}
