<?php

namespace App\Http\Requests\Company\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class StoreCategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'cover_image' => ['bail', 'required'],
            'translations' => ['bail', 'required', 'array', 'min:1'],
            'translations.*.language' => ['bail', 'required' , Rule::in(LaravelLocalization::getSupportedLanguagesKeys())],
            'translations.*.name' => ['bail', 'required', 'string', 'min:1', 'max:200'],
            'translations.*.description' => ['bail', 'required', 'string', 'min:1', 'max:5000'],
            'translations.*.seo' => ['nullable', 'array'],
            'translations.*.seo.*.title' => ['bail' , 'required', 'string', 'min:1', 'max:65'],
            'translations.*.seo.*.description' => ['bail', 'required', 'string', 'min:1', 'max:200'],
            'translations.*.seo.*.keywords' => ['bail', 'required', 'max:20'],
            'slug' => ['bail', 'required', 'alpha_dash:ascii'], // TODO Kayıt esnasında tekrardan kontrole edilmeli
            'order' => ['bail', 'numeric'],
            'is_active' => ['bail', 'nullable', 'boolean'],
        ];
    }

    public function getPreparedData(): array
    {
        $requestData = $this->safe()->all();

        $translations = [];
        foreach ($requestData['translations'] as $translation) {
            $translations[$translation['language']] = [
                'name' => $translation['name'],
                'description' => $translation['description'],
                'seo' => $translation['seo'],
            ];
        }

        return [
            'company_id' => \Auth::user()->company_id,
            'cover_image' => $this->cover_image,
            'slug' => $this->slug,
            'order' => $this->order,
            'is_active' => $this->boolean('is_active'),
            'translations' => $translations,
        ];
    }
}
