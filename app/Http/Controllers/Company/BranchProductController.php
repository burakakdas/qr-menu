<?php

namespace App\Http\Controllers\Company;

use App\Filters\Company\BranchProductFilter;
use App\Filters\Utils\FetchType\Model;
use App\Filters\Utils\FetchType\Paginate;
use App\Filters\Utils\OrderBy\OrderBy;
use App\Http\Controllers\Controller;
use App\Http\Requests\Company\BranchProduct\StoreBranchProductRequest;
use App\Http\Requests\Company\BranchProduct\UpdateBranchProductRequest;
use App\Http\Resources\Company\BranchProduct\BranchProductCollection;
use App\Http\Resources\Company\BranchProduct\BranchProductResource;
use App\Models\BranchProduct;
use App\Services\BranchProductService;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\JsonResponse;

class BranchProductController extends Controller
{
    public function __construct(
        protected BranchProductService $branchProductService,
    ) { }

    public function list(int $branchId): BranchProductCollection
    {
        $filter = (new BranchProductFilter())
            ->addBranchId($branchId)
            ->setOrderBy(new OrderBy('id', 'DESC'))
            ->setFetchType(new Paginate(route('company.branchProduct.list')));

        $branchProduct = $this->branchProductService->getByFilter($filter);

        return new BranchProductCollection($branchProduct);
    }

    public function store(StoreBranchProductRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        $branchProduct = $this->branchProductService->create($validatedData);

        if ($branchProduct instanceof BranchProduct) {
            return $this->successJsonResponse(clientMessage: __('messages.Saved'));
        }

        return $this->failedJsonResponse(clientMessage: __('messages.Could Not Save'));
    }

    public function show(int $branchId, int $branchProductId)
    {
        // TODO Company Id sorgulaması eklenmesi günvenlik için daha uygun
        $filter = (new BranchProductFilter())
            ->addId($branchProductId)
            ->addBranchId($branchId)
            ->setOnlyCentralBranch(true)
            ->setWith([
                'product' => function(BelongsTo $builder) {
                    $builder->isActive(true);
                }
            ])
            ->setFetchType(new Model());

        $branchProduct = $this->branchProductService->getByFilter($filter);

        if ($branchProduct instanceof BranchProduct) {
            return new BranchProductResource($branchProduct);
        }

        return $this->notFoundJsonResponse($branchProductId);
    }

    public function update(UpdateBranchProductRequest $request, int $branchId, int $branchProductId)
    {
        $requestData = $request->safe()->all();

        $branchFilter = (new BranchProductFilter())
            ->addId($branchProductId)
            ->addBranchId($branchId) // // TODO CompanyId ile doğru kaydın güncellendiğini kontrol etmek daha güvenli
            ->setFetchType(new Model());

        $branchProduct = $this->branchProductService->getByFilter($branchFilter);

        $updateBranchProduct = $this->branchProductService->update($branchProduct, $requestData);

        if ($updateBranchProduct) {
            return $this->successJsonResponse(__('messages.info.has_been_updated'));
        }

        return $this->failedJsonResponse(__('messages.errors.unexpected_error'));
    }

    public function destroy(int $branchProductId,int $branchId): JsonResponse
    {
        $branchProductFilter = (new BranchProductFilter())
            ->addId($branchProductId)
            ->addBranchId($branchId)
            ->setAttributes(['id'])
            ->setFetchType(new Model());

        $branchProduct = $this->branchProductService->getByFilter($branchProductFilter);

        return $this->destroyResponse($branchProduct, BranchProduct::class, $this->branchProductService);
    }
}
