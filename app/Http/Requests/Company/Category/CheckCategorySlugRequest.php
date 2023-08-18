<?php

namespace App\Http\Requests\Company\Category;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;

class CheckCategorySlugRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'current_category_id' => ['bail', 'nullable', sprintf('exists:%s,id', Category::class)],
            'slug' => ['required', 'alpha_dash:ascii', 'max: 200', 'min: 3'],
        ];
    }

    public function attributes()
    {
        return [
            'current_category_id' => Lang::get('input_name.current_category_id'),
            'slug' => Lang::get('input_name.slug'),
        ];
    }
}
