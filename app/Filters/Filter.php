<?php

namespace App\Filters;

use App\Filters\Utils\FetchType\FetchType;
use App\Filters\Utils\FetchType\Paginate;
use App\Filters\Utils\OrderBy\OrderBy;
use App\Filters\Utils\WhereHas;

abstract class Filter
{
    private array $ids = [];

    private array $attributes = [];

    private array $excludedIds = [];

    /**
     * @var array|null
     */
    private $with;

    /**
     * @var array|null
     */
    private $withCount;

    /**
     * @var WhereHas[]|null
     */
    private $whereHas;

    /**
     * @var FetchType|null
     */
    private $fetchType;

    /**
     * @var OrderBy|null
     */
    private $orderBy;

    public function getIds(): ?array
    {
        return $this->ids;
    }

    public function setIds(?array $ids): self
    {
        $this->ids = $ids;
        return $this;
    }

    public function addId(int $id): self
    {
        if (! in_array($id, $this->ids)) {
            $this->ids[] = $id;
        }

        return $this;
    }

    public function getAttributes(): ?array
    {
        return $this->attributes;
    }

    public function setAttributes(array $attributes): self
    {
        $this->attributes = $attributes;
        return $this;
    }

    public function addAttribute(string $attribute): self
    {
        if (! in_array($attribute, $this->attributes)) {
            $this->attributes[] = $attribute;
        }

        return $this;
    }

    public function getExcludedIds(): ?array
    {
        return $this->excludedIds;
    }

    public function setExcludedIds(array $excludedIds): self
    {
        $this->excludedIds = $excludedIds;
        return $this;
    }

    public function addExcludedId(int $excludedId): self
    {
        if (! in_array($excludedId, $this->excludedIds)) {
            $this->excludedIds[] = $excludedId;
        }

        return $this;
    }

    public function getWith(): ?array
    {
        return $this->with;
    }

    public function setWith(?array $with): self
    {
        $this->with = $with;
        return $this;
    }

    public function getWithCount(): ?array
    {
        return $this->withCount;
    }

    public function setWithCount(array $withCount): self
    {
        $this->withCount = $withCount;
        return $this;
    }

    public function getWhereHas(): ?array
    {
        return $this->whereHas;
    }

    public function setWhereHas(array $whereHas): self
    {
        $this->whereHas = $whereHas;
        return $this;
    }

    public function getFetchType(): ?FetchType
    {
        return $this->fetchType;
    }

    public function setFetchType(FetchType $fetchType): self
    {
        $this->fetchType = $fetchType;
        return $this;
    }

    /**
     * @return OrderBy|null
     */
    public function getOrderBy(): ?OrderBy
    {
        return $this->orderBy;
    }

    /**
     * @param OrderBy|null $orderBy
     *
     * @return $this
     */
    public function setOrderBy(?OrderBy $orderBy): self
    {
        $this->orderBy = $orderBy;
        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'ids' => $this->ids,
            'attributes' => $this->attributes,
            'excludedIds' => $this->excludedIds,
            'with' => $this->with,
            'withCount' => $this->withCount,
            #'whereHas' => $this->whereHas,
            'fetchType' => [
                'fetchTypeId' => $this->getFetchType()->fetchType,
                'paginationPath' => $this->getFetchType() instanceof Paginate ? $this->getFetchType()->getPaginationPath() : null,
                'perPage' => $this->getFetchType() instanceof Paginate ? $this->getFetchType()->getPerPage() : null,
            ],
            'orderBy' => [
                'column' => $this->orderBy instanceof OrderBy ? $this->orderBy->getColumn() : null,
                'direction' => $this->orderBy instanceof OrderBy ? $this->orderBy->getDirection() : null,
            ],
        ];
    }
}
