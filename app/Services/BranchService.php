<?php

namespace App\Services;

use App\Filters\Company\BranchFilter;
use App\Models\Branch;
use App\Repositories\BranchRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class BranchService extends BaseService
{
    public function __construct(
        protected BranchRepository $branchRepository,
    ) { }

    public function getByFilter(BranchFilter $filter): LengthAwarePaginator | Collection | \Illuminate\Support\Collection | Branch | null
    {
        return $this->branchRepository->getByFilter($filter);
    }

    public function destroyByModel(Branch $branch): ?bool
    {
        try {
            return $this->branchRepository->destroyByModel($branch);
        } catch (\Throwable $e) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $e), [
                'branchId' => $branch->id,
            ]);
        }

        return null;
    }

    public function update(array $requestData, Branch $branch): bool
    {
        try {
            if (! $this->branchRepository->updateByModel($requestData, $branch)) {
                throw new \Exception(sprintf('[%s][%s] Branch could not updated.', __CLASS__, __FUNCTION__));
            }

            return true;
        } catch (\Throwable $e) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $e), [
                'requestData' => $requestData,
                'branchId' => $branch->id,
            ]);
        }

        return false;
    }

    public function create(array $validatedData)
    {
        try {
            $branch = $this->branchRepository->create($validatedData);

            if (! $branch instanceof Branch) {
                throw new \Exception(sprintf('[%s][%s] Data could not created.', __CLASS__, __FUNCTION__));
            }

            return $branch;
        } catch (\Throwable $e) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $e), [
                'data' => $validatedData,
            ]);
        }
    }
}
