<?php

namespace App\Http\Controllers\Company;

use App\Filters\Company\BranchFilter;
use App\Filters\Utils\FetchType\Model;
use App\Filters\Utils\FetchType\Paginate;
use App\Filters\Utils\OrderBy\OrderBy;
use App\Http\Controllers\Controller;
use App\Http\Requests\Company\Branch\StoreBranchRequest;
use App\Http\Requests\Company\Branch\UpdateBranchRequest;
use App\Http\Resources\Company\Branch\BranchCollection;
use App\Http\Resources\Company\Branch\BranchResource;
use App\Models\Branch;
use App\Services\BranchService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class BranchController extends Controller
{
    public function __construct(
        protected BranchService $branchService,
    ) { }

    public function list(): BranchCollection
    {
        $filter = (new BranchFilter())
            ->addCompanyId(Auth::user()->company_id)
            ->setOrderBy(new OrderBy('id', 'DESC'))
            ->setFetchType(new Paginate(route('company.branch.list')));

        $branch = $this->branchService->getByFilter($filter);

        return new BranchCollection($branch);
    }

    public function store(StoreBranchRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        $validatedData['company_id'] = Auth::user()->company_id;

        $branch = $this->branchService->create($validatedData);

        if ($branch instanceof Branch) {
            return $this->successJsonResponse(__('messages.Saved'));
        }

        return $this->failedJsonResponse(__('messages.Could Not Save'));
    }

    public function show(int $branchId): BranchResource
    {
        $branchFilter = (new BranchFilter())
            ->addId($branchId)
            ->addCompanyId(Auth::user()->company_id)
            ->setFetchType(new Model());

        $branch = $this->branchService->getByFilter($branchFilter);

        return new BranchResource($branch);
    }

    public function update(UpdateBranchRequest $request, int $branchId): JsonResponse
    {
        $requestData = $request->safe()->all();

        $branchFilter = (new BranchFilter())
            ->addId($branchId)
            ->addCompanyId(Auth::user()->company_id)
            ->setFetchType(new Model());

        $branch = $this->branchService->getByFilter($branchFilter);

        if (! $branch instanceof Branch) {
            return $this->notFoundJsonResponse($branchId, Lang::get('messages.info.not_found'));
        }

        $updateBranch = $this->branchService->update($requestData, $branch);

        return $updateBranch === true
            ? $this->successJsonResponse(clientMessage: Lang::get('messages.info.has_been_updated'))
            : $this->failedJsonResponse(clientMessage: Lang::get('messages.errors.unexpected_error'));
    }

    public function destroy(int $branchId): JsonResponse
    {
        $branchFilter = (new BranchFilter())
            ->addId($branchId)
            ->addCompanyId(Auth::user()->company_id)
            ->setAttributes(['id'])
            ->setFetchType(new Model());

        $branch = $this->branchService->getByFilter($branchFilter);

        return $this->destroyResponse($branch, Branch::class, $this->branchService);
    }
}
