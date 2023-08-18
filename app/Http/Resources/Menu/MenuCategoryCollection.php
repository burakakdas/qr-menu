<?php

namespace App\Http\Resources\Menu;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\App;

class MenuCategoryCollection extends ResourceCollection
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
            'data' => $this->collection->map(function (\stdClass $category, $key) {
                $translations = json_decode($category->translations, true);

                return [
                    'id' => $category->id,
                    'name' => $translations[App::getLocale()]['name'],
                    'description' => $translations[App::getLocale()]['description'],
                    'cover_image' => $category->cover_image,
                ];
            })
        ];
    }
}
