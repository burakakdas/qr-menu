<?php

namespace App\Repositories;

use App\Filters\Filter;
use App\Filters\Utils\FetchType\Collect;
use App\Filters\Utils\FetchType\Paginate;
use App\Filters\Utils\FetchType\Pluck;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class BaseRepository
{
    public function __construct(protected Model $model)
    { }

    public function all(): Collection
    {
        return $this->model::all();
    }

    public function create(array $data): Model
    {
        return $this->model::create($data);
    }

    public function saveByModel(Model $model): bool
    {
        return $model->save();
    }

    public function saveQuietly(Model $model): bool
    {
        return $model->saveQuietly();
    }

    public function insert(array $data): bool
    {
        return $this->model::insert($data);
    }

    public function update(Model $model)
    {
        return $model->update();
    }

    public function updateById(array $data, $id): bool
    {
        return $this->model::findOrFail($id)->update($data);
    }

    public function updateByModel(array $data, Model $model): bool
    {
        return $model->update($data);
    }

    public function destroyById(int $id): bool
    {
        return $this->model::findOrFail($id)->delete();
    }

    public function destroyByModel(Model $model): bool
    {
        return $model->delete();
    }

    public function find($id): Model
    {
        return $this->model::findOrFail($id);
    }

    public function getModel(): Model
    {
        return $this->model;
    }

    protected function applyCommonQueries(Filter $filter, Builder|Model $builder): Builder|Model
    {
        if (! empty($filter->getIds())) {
            $builder = $builder->whereIn('id', $filter->getIds());
        }

        if (method_exists($filter, 'getExcludedIds') && ! empty($filter->getExcludedIds())) {
            $builder = $builder->whereNotIn('id', $filter->getExcludedIds());
        }

        return $builder;
    }

    protected function fetchByFilter(Filter $filter, Builder|Model $builder): LengthAwarePaginator | Collection | \Illuminate\Support\Collection | Model | null
    {
        if (null !== $filter->getWith()) {
            $builder = $builder->with($filter->getWith());
        }

        if (null !== $filter->getWithCount()) {
            $builder = $builder->withCount($filter->getWithCount());
        }

        if (null !== $filter->getOrderBy()) {
            $builder = $builder->orderBy(
                $filter->getOrderBy()->getColumn(),
                $filter->getOrderBy()->getDirection()
            );
        }

        $columns = ['*'];
        if (! empty($filter->getAttributes())) {
            $columns = $filter->getAttributes();
        }

        if ($filter->getFetchType() instanceof Paginate) {
            return $builder->paginate($filter->getFetchType()->getPerPage(), $columns)
                ->setPath($filter->getFetchType()->getPaginationPath());
        }

        if ($filter->getFetchType() instanceof Pluck) {
            return $builder->pluck(
                $filter->getFetchType()->getPluckColumn(),
                $filter->getFetchType()->getPluckKey()
            );
        }

        if ($filter->getFetchType() instanceof Collect) {
            return $builder->get($columns);
        }

        return $builder->first($columns);
    }
}
