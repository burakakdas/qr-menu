<?php

namespace App\Repositories;

use App\Filters\Company\CategoryFilter;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class CategoryRepository extends BaseRepository
{
    public function __construct(protected Category $category)
    {
        parent::__construct($this->category);
    }

    public function getByFilter(CategoryFilter $filter): LengthAwarePaginator | Collection | \Illuminate\Support\Collection | Category | null
    {
        $query = $this->applyCommonQueries($filter, $this->category);

        if (! is_null($filter->getName())) {
            $query = $query->name($filter->getName());
        }

        if (null !== $filter->getSlug()) {
            $query = $query->where('slug','=', $filter->getSlug());
        }

        if (! is_null($filter->isActive())) {
            $query = $query->isActive($filter->isActive());
        }

        if (! empty($filter->getCompanyIds())) {
            $query = $query->company($filter->getCompanyIds());
        }

        return $this->fetchByFilter($filter, $query);
    }

    public function categoryBySlugs(string $companySlug, int|null $branchId): \Illuminate\Support\Collection
    {
        $query = DB::table('categories','c')
            ->select('c.id', 'c.cover_image', 'c.translations')
            ->join('companies as cm', 'c.company_id', '=', 'cm.id')
            ->join('branch_products as bp', 'c.id', '=', 'bp.product_id')
            ->join('branches as b', 'bp.branch_id', '=', 'b.id')
            ->where('cm.slug', $companySlug)
            ->where('cm.is_active', true)
            ->where('b.is_active', true)
            ->orderBy('c.order', 'ASC');

        if (null === $branchId) {
            $query = $query->where('b.is_central', true);
        } else {
            $query = $query->where('bp.branch_id', $branchId);
        }

        return $query->get();
    }
}

