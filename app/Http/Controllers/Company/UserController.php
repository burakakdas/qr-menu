<?php

namespace App\Http\Controllers\Company;

use App\Filters\Company\UserFilter;
use App\Filters\Utils\FetchType\Model;
use App\Filters\Utils\FetchType\Paginate;
use App\Filters\Utils\OrderBy\OrderBy;
use App\Http\Controllers\Controller;
use App\Http\Requests\Company\User\StoreUserRequest;
use App\Http\Requests\Company\User\UpdateUserRequest;
use App\Http\Resources\Company\User\UserCollection;
use App\Http\Resources\Company\User\UserResource;
use App\Models\Role;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService,
    ) { }

    public function list(): UserCollection
    {
        $filter = (new UserFilter())
            ->addCompanyId(Auth::user()->company_id)
            ->setWith([
                'roles:id,name',
            ])
            ->setOrderBy(new OrderBy('id', 'DESC'))
            ->setFetchType(new Paginate(route('company.user.list')));

        $users = $this->userService->getByFilter($filter);

        return new UserCollection($users);
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        $validatedAttributes = $request->validated();
        $validatedAttributes['company_id'] = Auth::user()->company_id;

        $user = $this->userService->createStaff($validatedAttributes);
        if ($user instanceof User) {
            return $this->successJsonResponse(status: Response::HTTP_CREATED);
        }

        return $this->failedJsonResponse(__('messages.errors.unexpected_error'));
    }

    public function show(int $userId): UserResource|JsonResponse
    {
        // TODO İlişkileri ihtiyaç oldugunda gönder
        $userFilter = (new UserFilter())
            ->addId($userId)
            ->addCompanyId(Auth::user()->company_id)
            ->setWith([
                'roles:id,name',
            ])
            ->setFetchType(new Model());

        $user = $this->userService->getByFilter($userFilter);

        if (! $user instanceof User) {
            return $this->notFoundJsonResponse($userId);
        }

        return new UserResource($user);
    }

    public function update(UpdateUserRequest $request, int $userId): JsonResponse
    {
        $userFilter = (new UserFilter())
            ->addId($userId)
            ->addCompanyId(Auth::user()->company_id)
            ->setFetchType(new Model());

        $user = $this->userService->getByFilter($userFilter);

        if (! $user instanceof User) {
            return $this->notFoundJsonResponse($userId);
        }

        if ($user->id !== Auth::user()->id && $user->hasRole(Role::NAME_COMPANY_MANAGER)) {
            Log::error(sprintf('[%s][%s] The user wants to change the owner information. UserId: %s, AuthUserId: %s', __CLASS__, __FUNCTION__, $userId, Auth::id()));

            return $this->failedJsonResponse(__('messages.info.unauthorized'), status: Response::HTTP_UNAUTHORIZED);
        }

        $validatedAttributes = $request->validated();
        $validatedAttributes['updated_by_id'] = Auth::id();

        $isUpdated = $this->userService->update($validatedAttributes, $user);

        return $isUpdated
            ? $this->successJsonResponse(clientMessage: Lang::get('messages.info.has_been_updated'))
            : $this->failedJsonResponse(clientMessage: Lang::get('messages.errors.unexpected_error'));
    }

    public function destroy(int $userId): JsonResponse
    {
        $userFilter = (new UserFilter())
            ->addId($userId)
            ->addExcludedId(Auth::id())
            ->addCompanyId(Auth::user()->company_id)
            ->setAttributes(['id'])
            ->setFetchType(new Model());

        $user = $this->userService->getByFilter($userFilter);

        if (! $user instanceof User || $user->hasRole(Role::NAME_COMPANY_MANAGER)) {
            return $this->notFoundJsonResponse($userId);
        }

        $isDeleted = $this->userService->destroyByModel($user);

        if ($isDeleted) {
            return $this->successJsonResponse(Lang::get('messages.info.deleted'));
        }

        return $this->failedJsonResponse(Lang::get('messages.info.failed_to_delete'));
    }
}
