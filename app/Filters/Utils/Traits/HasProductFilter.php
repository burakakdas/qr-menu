<?php

namespace App\Filters\Utils\Traits;

use App\Filters\Company\BranchProductFilter;

trait HasProductFilter
{
    private array $productIds = [];

    /**
     * @return array
     */
    public function getProductIds(): array
    {
        return $this->productIds;
    }

    /**
     * @param array $productIds
     *
     * @return $this
     */
    public function setProductIds(array $productIds): self
    {
        $this->productIds = $productIds;
        return $this;
    }

    /**
     * @param int $productId
     *
     * @return $this
     */
    public function addProductId(int $productId): self
    {
        if (!in_array($productId, $this->productIds)) {
            $this->productIds[] = $productId;
        }

        return $this;
    }

    /**
     * @return array
     */
    public function productIdsToArray(): array
    {
        return [
            'productIds' => $this->productIds,
        ];
    }
}
