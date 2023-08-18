<?php

namespace App\Casts;

use App\Models\Enums\Product\ProductTranslationProperty;
use App\Models\Enums\SupportedLanguage;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Database\Eloquent\Model;

class ProductTranslationJsonKeyToEnum implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        $data = Json::decode($attributes[$key]);

        if (! is_array($data)) {
            return null;
        }

        foreach ($data as $languageKey => $datum) {
            foreach ($datum as $propertyKey => $propertyValue) {
                $propertyData[strtolower(ProductTranslationProperty::from($propertyKey)->name)] = $propertyValue;
            }

            $castedKeys[strtolower(SupportedLanguage::from($languageKey)->name)] = $propertyData;
        }

        return $castedKeys;
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        // Bu method çalışıyorsa Illuminate\Database\Eloquent\Casts\AsEnumCollection içindeki set methodunu incele
        dd(sprintf('[%s][%s] Unexpected.', __CLASS__, __FUNCTION__));
        return $value;
    }
}
