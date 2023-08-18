<?php

namespace App\Filters\Utils\Traits;

trait HasCategoryFilter
{
    private array $categoryIds = [];

    public function getCategoryIds(): array
    {
        return $this->categoryIds;
    }

    public function setCategoryIds(array $categoryIds): self
    {
        $this->categoryIds = $categoryIds;
        return $this;
    }

    public function addCategoryId(int $categoryId): self
    {
        if (!in_array($categoryId, $this->categoryIds)) {
            $this->categoryIds[] = $categoryId;
        }

        return $this;
    }

    public function categoryIdsToArray(): array
    {
        return [
            'categoryIds' => $this->categoryIds,
        ];
    }
}
