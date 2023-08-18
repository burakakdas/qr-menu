<?php

namespace App\Models\Enums\Setting;

use App\Models\Enums\Traits\BaseEnumTrait;

enum UserSettingGroup: int
{
    use BaseEnumTrait;

    case Communication = 1;
}
