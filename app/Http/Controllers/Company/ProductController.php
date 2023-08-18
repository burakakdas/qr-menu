<?php

namespace App\Http\Controllers\Company;

use App\Filters\Company\ProductFilter;
use App\Filters\Utils\FetchType\Model;
use App\Filters\Utils\FetchType\Paginate;
use App\Filters\Utils\OrderBy\OrderBy;
use App\Http\Controllers\Controller;
use App\Http\Requests\Company\Product\CheckProductSlugRequest;
use App\Http\Requests\Company\Product\StoreProductRequest;
use App\Http\Requests\Company\Product\UpdateProductRequest;
use App\Http\Resources\Company\Product\ProductCollection;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class ProductController extends Controller
{
    public function __construct(
        protected ProductService $productService,
    ) { }

    public function list(): ProductCollection
    {
        $filter = (new ProductFilter())
            ->addCompanyId(Auth::user()->company_id)
            ->setOrderBy(new OrderBy('id', 'DESC'))
            ->setFetchType(new Paginate(route('company.product.list')));

        $products = $this->productService->getByFilter($filter);

        return new ProductCollection($products);
    }

    public function store(StoreProductRequest $request): JsonResponse
    {
        $data = $request->getPreparedData();

        $product = $this->productService->create($data);

        if ($product instanceof Product) {
            return $this->successJsonResponse(clientMessage: __('messages.Saved'));
        }

        return $this->failedJsonResponse(clientMessage: __('messages.Could Not Save'));
    }

    public function show(int $productId): JsonResponse
    {
        $productFilter = (new ProductFilter())
            ->addId($productId)
            ->addCompanyId(Auth::user()->company_id)
            ->setFetchType(new Model());

        $product = $this->productService->getByFilter($productFilter);

        if (! $product instanceof Product) {
            return $this->notFoundJsonResponse($productId);
        }

        return $this->successJsonResponse($product);
    }

    public function update(UpdateProductRequest $request, int $productId): JsonResponse
    {
        $requestData = $request->safe()->all();

        $productFilter = (new ProductFilter())
            ->addId($productId)
            ->addCompanyId(Auth::user()->company_id)
            ->setFetchType(new Model());

        $product = $this->productService->getByFilter($productFilter);

        $updateProduct = $this->productService->update($product, $requestData);

        if ($updateProduct) {
            return $this->successJsonResponse(__('messages.info.has_been_updated'));
        }

        return $this->failedJsonResponse(__('messages.errors.unexpected_error'));
    }

    public function checkSlug(CheckProductSlugRequest $request): JsonResponse
    {
        $filter = (new ProductFilter())
            ->setSlug($request->slug)
            ->addCompanyId(Auth::user()->company_id)
            ->setAttributes(['id'])
            ->setFetchType(new Model());

        if (null !== $request->current_product_id) {
            $filter->setExcludedIds([$request->current_product_id]);
        }

        $product = $this->productService->getByFilter($filter);

        if (! $product instanceof Product) {
            return $this->successJsonResponse();
        }

        return $this->failedJsonResponse(clientMessage: Lang::get('messages.This slug is used by another product'));
    }

    public function destroy(int $productId): JsonResponse
    {
        $filter = (new ProductFilter())
            ->addId($productId)
            ->addCompanyId(Auth::user()->company_id)
            ->setFetchType(new Model());

        $product = $this->productService->getByFilter($filter);

        return $this->destroyResponse($product, Product::class, $this->productService);
    }
}
