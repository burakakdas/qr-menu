<?php

namespace App\Services;

use App\Filters\Company\CategoryFilter;
use App\Models\Category;
use App\Models\Product;
use App\Repositories\CategoryRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class CategoryService extends BaseService
{
    public function __construct(
        protected CategoryRepository $categoryRepository,
    ) { }

    public function getByFilter(CategoryFilter $filter): LengthAwarePaginator | Collection | \Illuminate\Support\Collection | Category | null
    {
        return $this->categoryRepository->getByFilter($filter);
    }
    public function destroyByModel(Category $category): ?bool
    {
        try {
            return $this->categoryRepository->destroyByModel($category);
        } catch (\Throwable $e) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $e), [
                'categoryId' => $category->id,
            ]);
        }

        return null;
    }

    public function create(array $validatedData): ?Category
    {
        try {
            $category = $this->categoryRepository->create($validatedData);

            if (! $category instanceof Category) {
                throw new \Exception(sprintf('[%s][%s] Data could not created.', __CLASS__, __FUNCTION__));
            }

            return $category;
        } catch (\Throwable $e) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $e), [
                'data' => $validatedData,
            ]);
        }

        return null;
    }

    public function update(array $requestData, Category $category)
    {
        try {
            if (! $this->categoryRepository->updateByModel($requestData, $category)) {
                throw new \Exception(sprintf('[%s][%s] Category could not updated.', __CLASS__, __FUNCTION__));
            }

            return true;
        } catch (\Throwable $e) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $e), [
                'requestData' => $requestData,
                'categoryId' => $category->id,
            ]);
        }

        return false;
    }

    public function categoryByCompanySlug(string $companySlug, int|null $branchId): \Illuminate\Support\Collection
    {
        return $this->categoryRepository->categoryBySlugs($companySlug, $branchId);
    }
}
