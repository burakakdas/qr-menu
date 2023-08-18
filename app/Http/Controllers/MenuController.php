<?php

namespace App\Http\Controllers;

use App\Http\Requests\Menu\CategoryRequest;
use App\Http\Requests\Menu\ProductRequest;
use App\Http\Resources\Menu\MenuCategoryCollection;
use App\Http\Resources\Menu\MenuProductCollection;
use App\Services\BranchProductService;
use App\Services\CategoryService;
use App\Services\CompanyService;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;

class MenuController extends Controller
{
    public function __construct(
        protected BranchProductService $branchProductService,
        protected CompanyService $companyService,
        protected CategoryService $categoryService,
        protected ProductService $productService,
    ) { }

    public function categories(CategoryRequest $request, string $companySlug): JsonResponse | MenuCategoryCollection
    {
        $branchId = $request->validated('branch');

        $categories = $this->categoryService->categoryByCompanySlug($companySlug, $branchId);

        return new MenuCategoryCollection($categories);
    }

    public function categoryProducts(ProductRequest $request, string $companySlug, string $categorySlug): MenuProductCollection
    {
        $branchId = $request->validated('branch');

        $products = $this->productService->categoryProductsBySlugs($companySlug, $categorySlug, $branchId);

        return new MenuProductCollection($products);
    }
}
