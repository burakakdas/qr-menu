<?php

namespace App\Http\Resources\Menu;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\App;

class MenuProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'success' => true,
            'data' => $this->collection->map(function (\stdClass $product, $key) {
                $translations = json_decode($product->translations, true);

                return [
                    'id' => $product->id,
                    'name' => $translations[App::getLocale()]['name'],
                    'description' => $translations[App::getLocale()]['description'],
                    'cover_image' => $product->cover_image,
                ];
            })->unique(),
        ];
    }
}
