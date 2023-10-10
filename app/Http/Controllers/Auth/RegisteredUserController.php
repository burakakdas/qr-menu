<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Branch;
use App\Models\Company;
use App\Models\Enums\Setting\CompanySetting;
use App\Models\Enums\Setting\UserSetting;
use App\Models\Enums\Setting\UserSettingGroup;
use App\Models\User;
use App\Services\BranchService;
use App\Services\CompanyService;
use App\Services\UserService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    public function __construct(
        protected CompanyService $companyService,
        protected UserService $userService,
        protected BranchService $branchService,
    ) { }

    public function store(RegisterRequest $request): JsonResponse
    {
        $requestData = $request->validated();

        $user = DB::transaction(function () use ($requestData) {
            $requestData['name'] = $requestData['company_name'];
            $requestData['is_active'] = true;
            $requestData['settings'][CompanySetting::Fallback_Locale->value] = \App::currentLocale();

            $company = $this->companyService->create($requestData);
            abort_if((! $company instanceof Company), Response::HTTP_INTERNAL_SERVER_ERROR);

            $branch = $this->branchService->create([
                'name' => 'Merkez',
                'company_id' => $company->id,
                'slug' => Str::slug('merkez'),
                'is_central' => true,
                'is_active' => true,
            ]);
            abort_if((! $branch instanceof Branch), Response::HTTP_INTERNAL_SERVER_ERROR);

            $requestData['company_id'] = $company->id;

            if (isset($requestData['communication']) && $requestData['communication'] == '1') {
                $requestData['settings'] = null;
                $requestData['settings'][UserSettingGroup::Communication->value][UserSetting::Email->value] = true;
                $requestData['settings'][UserSettingGroup::Communication->value][UserSetting::Sms->value] = true;
                $requestData['settings'][UserSettingGroup::Communication->value][UserSetting::Phone->value] = true;
            } else {
                $requestData['settings'][UserSettingGroup::Communication->value][UserSetting::Email->value] = false;
                $requestData['settings'][UserSettingGroup::Communication->value][UserSetting::Sms->value] = false;
                $requestData['settings'][UserSettingGroup::Communication->value][UserSetting::Phone->value] = false;
            }

            $requestData['branch_id'] = $branch->id;

            return $this->userService->createCompanyManager($requestData);
        });

        if ($user instanceof User) {
            event(new Registered($user));

            $token = $user->createToken(User::TOKEN_WEB)->plainTextToken;

            return $this->successJsonResponse(data: [User::TOKEN_WEB => $token], headers: [User::TOKEN_WEB => $token]);
        }

        return $this->failedJsonResponse();
    }
}
