<?php

namespace App\Repositories;

use App\Filters\Company\ProductFilter;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class ProductRepository extends BaseRepository
{
    public function __construct(protected Product $product)
    {
        parent::__construct($this->product);
    }

    public function getByFilter(ProductFilter $filter): LengthAwarePaginator | Collection | \Illuminate\Support\Collection | Product | null
    {
        $query = $this->applyCommonQueries($filter, $this->product);

        if (! is_null($filter->getName())) {
            $query = $query->name($filter->getName());
        }

        if (! is_null($filter->isActive())) {
            $query = $query->isActive($filter->isActive());
        }

        if (! is_null($filter->getSlug())) {
            $query = $query->whereSlug($filter->getSlug());
        }

        if (! empty($filter->getCategoryIds())) {
            $query = $query->category($filter->getCategoryIds());
        }

        if (! empty($filter->getCompanyIds())) {
            $query = $query->company($filter->getCompanyIds());
        }

        return $this->fetchByFilter($filter, $query);
    }

    public function categoryProductsBySlugs(string $companySlug, string $categorySlug, int|null $branchId): \Illuminate\Support\Collection
    {
        $query = DB::table('products', 'p')
            ->select('p.id', 'p.cover_image', 'p.translations', 'p.links')
            ->join('companies as cm', 'p.company_id', '=', 'cm.id')
            ->join('categories as c', 'p.category_id', '=', 'c.id')
            ->join('branch_products as bp', 'p.id', '=', 'bp.product_id')
            ->join('branches as b', 'bp.branch_id', '=', 'b.id')
            ->where('cm.slug', $companySlug)
            ->where('cm.is_active', true)
            ->where('c.slug', $categorySlug)
            ->where('c.is_active', true)
            ->where('b.is_active', true)
            ->orderBy('p.order', 'ASC');

        if (null === $branchId) {
            $query = $query->where('b.is_central', true);
        } else {
            $query = $query->where('bp.branch_id', $branchId);
        }

        return $query->get();
    }
}
