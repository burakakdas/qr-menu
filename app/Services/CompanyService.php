<?php

namespace App\Services;

use App\Filters\Company\CompanyFilter;
use App\Models\Company;
use App\Repositories\CompanyRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class CompanyService extends BaseService
{
    public function __construct(
        protected CompanyRepository $companyRepository,
    ) { }

    public function getByFilter(CompanyFilter $filter): LengthAwarePaginator | Collection | \Illuminate\Support\Collection | Company | null
    {
        return $this->companyRepository->getByFilter($filter);
    }

    public function update(array $data, Company $company): bool
    {
        try {
            if (! $this->companyRepository->updateByModel($data, $company)) {
                throw new \Exception(sprintf('[%s][%s] Company could not updated.', __CLASS__, __FUNCTION__));
            }

            return true;
        } catch (\Throwable $e) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $e), [
                'data' => $data,
                'companyId' => $company->id,
            ]);
        }

        return false;
    }

    public function create(array $data): ?Company
    {
        try {
            $company = $this->companyRepository->create($data);

            if (! $company instanceof Company) {
                throw new \Exception(sprintf('[%s][%s] Company could not created.', __CLASS__, __FUNCTION__));
            }

            return $company;
        } catch (\Throwable $e) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $e), [
                'data' => $data,
            ]);
        }

        return null;
    }
}
