<?php

namespace App\Http\Requests\Company\Product;

use App\Models\Category;
use App\Models\Enums\ProductLinkResource;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class StoreProductRequest extends FormRequest
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

        $links = [];
        foreach ($requestData['links'] as $link) {
            $links[$link['resource']] = $link['urls'];
        }

        return [
            'company_id' => \Auth::user()->company_id,
            'category_id' => $this->category_id,
            'slug' => $this->slug,
            'cover_image' => $this->cover_image,
            'is_active' => $this->boolean('is_active'),
            'translations' => $translations,
            'links' => $links,
        ];
    }
}
