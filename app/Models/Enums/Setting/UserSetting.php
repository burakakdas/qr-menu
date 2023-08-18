<?php

namespace App\Models\Enums\Setting;

use App\Models\Enums\Traits\BaseEnumTrait;

enum UserSetting: int
{
    use BaseEnumTrait;

    case Email = 1;
    case Sms = 2;
    case Phone = 3;
}
