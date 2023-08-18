<?php

namespace App\Helpers;

use App\Models\Enums\Setting\CompanySetting;
use App\Models\Enums\Setting\UserSetting;
use App\Models\Enums\Setting\UserSettingGroup;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SettingOptionHelper
{
    public static function getFromAuthUserCompany(CompanySetting $setting): mixed
    {
        return Auth::user()->company->settings[$setting->value];
    }

    public static function getFromAuthUser(UserSettingGroup $group, UserSetting $setting): mixed
    {
        return Auth::user()->settings[$group->value][$setting->value];
    }

    public static function getFromUser(User $user, UserSettingGroup $group, UserSetting $setting): mixed
    {
        return $user->settings[$group->value][$setting->value];
    }
}
