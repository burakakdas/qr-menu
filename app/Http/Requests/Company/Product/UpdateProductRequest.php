<?php

namespace App\Http\Requests\Company\Product;

use App\Models\Category;
use App\Models\Enums\ProductLinkResource;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class UpdateProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'category_id' => ['bail', 'required', sprintf('exists:%s,id', Category::class)],
            'slug' => ['bail', 'required', 'alpha_dash:ascii'],
            'cover_image' => ['bail', 'required'],
            'translations' => ['bail', 'required', 'array', 'min:1'],
            'translations.*.seo' => ['nullable', 'array'],
            'translations.*.seo.*.title' => ['bail' , 'required', 'string', 'min:1', 'max:65'],
            'translations.*.seo.*.description' => ['bail', 'required', 'string', 'min:1', 'max:200'],
            'translations.*.seo.*.keywords' => ['bail', 'required', 'max:20'],
            'translations.*.language' => ['bail', 'required', Rule::in(LaravelLocalization::getSupportedLanguagesKeys())],
            'translations.*.name' => ['bail', 'required', 'string', 'min:1', 'max:200'],
            'translations.*.description' => ['bail', 'required', 'string', 'min:1', 'max:5000'],
            'links' => ['bail', 'sometimes', 'array', 'min:1'],
            'links.*.resource' => ['bail', 'required', Rule::in(ProductLinkResource::getValues())],
            'links.*.urls' => ['bail', 'required', 'array', 'min:1'],
            'is_active' => ['bail', 'nullable', 'boolean'],
        ];
    }
}
