<?php

namespace App\Services;

use App\Filters\Company\BranchProductFilter;
use App\Models\BranchProduct;
use App\Repositories\BranchProductRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class BranchProductService extends BaseService
{
    public function __construct(
        protected BranchProductRepository $branchProductRepository,
    ) { }

    public function getByFilter(BranchProductFilter $filter): LengthAwarePaginator | Collection | \Illuminate\Support\Collection | BranchProduct | null
    {
        return $this->branchProductRepository->getByFilter($filter);
    }

    public function destroyByModel(BranchProduct $branchProduct): ?bool
    {
        try {
            return $this->branchProductRepository->destroyByModel($branchProduct);
        } catch (\Throwable $e) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $e), [
                'branchProductId' => $branchProduct->id,
            ]);
        }

        return null;
    }

    public function create(array $validatedData): ?BranchProduct
    {
        try {
            $branchProduct = $this->branchProductRepository->create($validatedData);

            if (! $branchProduct instanceof BranchProduct) {
                throw new \Exception(sprintf('[%s][%s] Data could not created.', __CLASS__, __FUNCTION__));
            }

            return $branchProduct;
        } catch (\Throwable $e) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $e), [
                'data' => $validatedData,
            ]);
        }

        return null;
    }

    public function update(BranchProduct $branchProduct, array $requestData)
    {
        try {
            if (! $this->branchProductRepository->updateByModel($requestData, $branchProduct)) {
                throw new \Exception(sprintf('[%s][%s] BranchProduct could not updated.', __CLASS__, __FUNCTION__));
            }

            return true;
        } catch (\Throwable $e) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $e), [
                'requestData' => $requestData,
                'branchProductId' => $branchProduct->id,
            ]);
        }

        return false;
    }
}
