<?php

namespace App\Http\Controllers\Company;

use App\Filters\Company\CategoryFilter;
use App\Filters\Utils\FetchType\Model;
use App\Filters\Utils\FetchType\Paginate;
use App\Filters\Utils\OrderBy\OrderBy;
use App\Http\Controllers\Controller;
use App\Http\Requests\Company\Category\CheckCategorySlugRequest;
use App\Http\Requests\Company\Category\StoreCategoryRequest;
use App\Http\Requests\Company\Category\UpdateCategoryRequest;
use App\Http\Resources\Company\Category\CategoryCollection;
use App\Http\Resources\Company\Category\CategoryResource;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class CategoryController extends Controller
{
    public function __construct(
        protected CategoryService $categoryService,
    ) { }

    public function list(): CategoryCollection
    {
        $filter = (new CategoryFilter())
            ->addCompanyId(Auth::user()->company_id)
            ->setOrderBy(new OrderBy('id', 'DESC'))
            ->setFetchType(new Paginate(route('company.category.list')));

        $categories = $this->categoryService->getByFilter($filter);

        return new CategoryCollection($categories);
    }

    public function store(StoreCategoryRequest $request): JsonResponse
    {
        $validatedData = $request->getPreparedData();

        $category = $this->categoryService->create($validatedData);

        return $category instanceof Category
            ? $this->successJsonResponse(__('messages.Saved'))
            : $this->failedJsonResponse(__('messages.Could Not Save'));
    }

    public function show(int $categoryId): CategoryResource | JsonResponse
    {
        $categoryfilter = (new CategoryFilter())
            ->addId($categoryId)
            ->addCompanyId(Auth::user()->company_id)
            ->setFetchType(new Model());

        $category = $this->categoryService->getByFilter($categoryfilter);

        return $category instanceof Category
            ? new CategoryResource($category)
            : $this->notFoundJsonResponse($categoryId, Lang::get('messages.info.not_found'));
    }

    public function update(UpdateCategoryRequest $request, int $categoryId): JsonResponse
    {
        $requestData = $request->safe()->all();

        $categoryFilter = (new CategoryFilter())
            ->addId($categoryId)
            ->addCompanyId(Auth::user()->company_id)
            ->setFetchType(new Model());

        $category = $this->categoryService->getByFilter($categoryFilter);

        if (! $category instanceof Category) {
            $this->notFoundJsonResponse($categoryId, Lang::get('messages.info.not_found'));
        }

        $updateCategory = $this->categoryService->update($requestData, $category);

        return $updateCategory === true
            ? $this->successJsonResponse(__('messages.info.has_been_updated'))
            : $this->failedJsonResponse(__('messages.errors.unexpected_error'));
    }

    public function destroy(int $categoryId): JsonResponse
    {
        $categoryFilter = (new CategoryFilter())
            ->addId($categoryId)
            ->addCompanyId(Auth::user()->company_id)
            ->setAttributes(['id'])
            ->setFetchType(new Model());

        $category = $this->categoryService->getByFilter($categoryFilter);

        return $this->destroyResponse($category, Category::class, $this->categoryService);
    }

    public function checkSlug(CheckCategorySlugRequest $request): JsonResponse
    {
        $filter = (new CategoryFilter())
            ->setSlug($request->slug)
            ->setAttributes(['id'])
            ->setFetchType(new Model());

        if (null !== $request->current_category_id) {
            $filter->setExcludedIds([$request->current_category_id]);
        }

        $category = $this->categoryService->getByFilter($filter);

        return ! $category instanceof Category
            ? $this->successJsonResponse()
            : $this->failedJsonResponse(clientMessage: Lang::get('messages.This category link has already been taken by another category'));
    }
}
