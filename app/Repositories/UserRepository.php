<?php

namespace App\Repositories;

use App\Filters\Company\UserFilter;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository extends BaseRepository
{
    public function __construct(protected User $user)
    {
        parent::__construct($this->user);
    }

    public function getByFilter(UserFilter $filter): LengthAwarePaginator | Collection | \Illuminate\Support\Collection | User | null
    {
        $query = $this->applyCommonQueries($filter, $this->user);

        if (! is_null($filter->getName())) {
            $query = $query->firstNameAndLastname($filter->getName());
        }

        if (! empty($filter->getCompanyIds())) {
            $query = $query->company($filter->getCompanyIds());
        }

        if (! is_null($filter->isActive())) {
            $query = $query->isActive($filter->isActive());
        }

        if (! is_null($filter->getEmail())) {
            $query = $query->email($filter->getEmail());
        }

        return $this->fetchByFilter($filter, $query);
    }
}
