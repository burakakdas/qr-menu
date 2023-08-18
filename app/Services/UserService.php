<?php

namespace App\Services;

use App\Filters\Company\UserFilter;
use App\Models\Role;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserService extends BaseService
{
    public function __construct(
        protected UserRepository $userRepository,
    ) { }

    public function getByFilter(UserFilter $filter): LengthAwarePaginator | Collection | \Illuminate\Support\Collection | User | null
    {
        return $this->userRepository->getByFilter($filter);
    }

    public function createStaff(array $data): ?User
    {
        try {
            return DB::transaction(function () use ($data) {
                $user = $this->userRepository->create($data);

                if (! $user instanceof User) {
                    throw new \Exception(sprintf('[%s][%s] Data could not created.', __CLASS__, __FUNCTION__));
                }

                $user->assignRole(Role::ID_SYSTEM_USER);

                return $user;
            });
        } catch (\Throwable $e) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $e), [
                'data' => $data,
            ]);
        }

        return null;
    }

    public function update(array $data, User $user):? bool
    {
        try {
            return DB::transaction(function () use ($data, $user) {
                if (! $this->userRepository->updateByModel($data, $user)) {
                    throw new \Exception(sprintf('[%s][%s] Data could not updated.', __CLASS__, __FUNCTION__));
                }

                // TODO Eğer data içinde password gelmişse yeni şifre belirlenmiş demektir.
                // TODO Yeni şifre belirlendiğinde tokenlar silinmeli ve oturumlar kapatılmalı.

                return true;
            });
        } catch (\Throwable $e) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $e), [
                'data' => $data,
                'userId' => $user->id,
            ]);
        }

        return null;
    }

    public function destroyByModel(User $user): ?bool
    {
        try {
            return $this->userRepository->destroyByModel($user);
        } catch (\Throwable $e) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $e), [
                'userId' => $user->id,
            ]);
        }

        return null;
    }

    public function createCompanyManager(array $data): User
    {
        $user = $this->userRepository->create($data);

        if (! $user instanceof User) {
            throw new \Exception(sprintf('[%s][%s] Data could not created.', __CLASS__, __FUNCTION__));
        }

        $user->assignRole(Role::NAME_COMPANY_MANAGER);

        return $user;
    }
}
