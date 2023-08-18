<?php

namespace App\Services;

use App\Filters\Company\ProductFilter;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductService extends BaseService
{
    public function __construct(
        protected ProductRepository $productRepository,
    ) { }

    public function getByFilter(ProductFilter $filter): LengthAwarePaginator|Collection|\Illuminate\Support\Collection|Product|null
    {
        return $this->productRepository->getByFilter($filter);
    }

    public function create(array $data): ?Product
    {
        try {
            $product = $this->productRepository->create($data);

            if (! $product instanceof Product) {
                throw new \Exception(sprintf('[%s][%s] Data could not created.', __CLASS__, __FUNCTION__));
            }

            return $product;
        } catch (\Throwable $e) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $e), [
                'data' => $data,
            ]);
        }

        return null;
    }

    public function updateByModel(Product $product): bool
    {
        try {
            return $this->productRepository->saveByModel($product);
        } catch (\Throwable $e) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $e), [
                'productId' => $product->id,
            ]);
        }

        return false;
    }

    public function destroyByModel(Product $product): ?bool
    {
        try {
            return $this->productRepository->destroyByModel($product);
        } catch (\Throwable $e) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $e), [
                'productId' => $product->id,
            ]);
        }

        return null;
    }

    public function update(Product $product, array $requestData)
    {
        try {
            if (! $this->productRepository->updateByModel($requestData, $product)) {
                throw new \Exception(sprintf('[%s][%s] Product could not updated.', __CLASS__, __FUNCTION__));
            }

            return true;
        } catch (\Throwable $e) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $e), [
                'requestData' => $requestData,
                'productId' => $product->id,
            ]);
        }

        return false;
    }

    public function categoryProductsBySlugs(string $companySlug, string $categorySlug, int|null $branchId): \Illuminate\Support\Collection
    {
        return $this->productRepository->categoryProductsBySlugs($companySlug, $categorySlug, $branchId);
    }
}
