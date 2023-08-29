<?php

namespace App\Http\Requests\Company\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class UpdateCategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'cover_image' => ['bail', 'required'],
            'translations' => ['bail', 'required', 'array', 'min:1'],
            'translations.*.seo' => ['nullable', 'array'],
            'translations.*.seo.*.title' => ['bail' , 'required', 'string', 'min:1', 'max:65'],
            'translations.*.seo.*.description' => ['bail', 'required', 'string', 'min:1', 'max:200'],
            'translations.*.seo.*.keywords' => ['bail', 'required', 'max:20'],
            'translations.*.language' => ['bail', 'required' , Rule::in(LaravelLocalization::getSupportedLanguagesKeys())],
            'translations.*.name' => ['bail', 'required', 'string', 'min:1', 'max:200'],
            'translations.*.description' => ['bail', 'required', 'string', 'min:1', 'max:5000'],
            'slug' => ['bail', 'required', 'alpha_dash:ascii'], // TODO Kayıt esnasında tekrardan kontrole edilmeli
            'order' => ['bail', 'numeric'],
            'is_active' => ['bail', 'nullable', 'boolean'],
        ];
    }
}
