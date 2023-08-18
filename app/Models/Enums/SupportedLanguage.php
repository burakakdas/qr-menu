<?php

namespace App\Models\Enums;

use App\Models\Enums\Traits\BaseEnumTrait;

enum SupportedLanguage: int
{
    use BaseEnumTrait;

    case TR = 1;
    case EN = 2;
    case DE = 3;
}
