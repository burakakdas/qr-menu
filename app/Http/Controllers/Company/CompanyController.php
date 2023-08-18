<?php

namespace App\Http\Controllers\Company;

use App\Filters\Company\CompanyFilter;
use App\Filters\Utils\FetchType\Model;
use App\Http\Controllers\Controller;
use App\Http\Requests\Company\Company\CheckCompanySlugRequest;
use App\Http\Requests\Company\Company\UpdateCompanyRequest;
use App\Models\Company;
use App\Services\CompanyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class CompanyController extends Controller
{
    public function __construct(
        protected CompanyService $companyService,
    ) { }

    public function show(): JsonResponse
    {
        $filter = (new CompanyFilter())
            ->addId(Auth::user()->company_id)
            ->setFetchType(new Model());

        $company = $this->companyService->getByFilter($filter);

        return $this->successJsonResponse(data: [$company]);
    }

    public function update(UpdateCompanyRequest $request): JsonResponse
    {
        $requestData = $request->safe()->all();

        $filter = (new CompanyFilter())
            ->addId(Auth::user()->company_id)
            ->setFetchType(new Model());

        $company = $this->companyService->getByFilter($filter);

        $updated = $this->companyService->update($requestData, $company);

        if ($updated) {
            return $this->successJsonResponse(clientMessage: Lang::get('messages.info.has_been_updated'));
        }

        return $this->failedJsonResponse(clientMessage: Lang::get('messages.errors.unexpected_error'));
    }

    public function checkSlug(CheckCompanySlugRequest $request): JsonResponse
    {
        $filter = (new CompanyFilter())
            ->setSlug($request->slug)
            ->setExcludedIds([Auth::user()->company_id])
            ->setAttributes(['id'])
            ->setFetchType(new Model());

        $company = $this->companyService->getByFilter($filter);

        if (! $company instanceof Company) {
            return $this->successJsonResponse();
        }

        return $this->failedJsonResponse(clientMessage: Lang::get('messages.This company link has already been taken by other company'));
    }
}
