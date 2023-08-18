<?php

namespace App\Models\Enums\Setting;

use App\Models\Enums\Traits\BaseEnumTrait;
use Illuminate\Support\Facades\Lang;

enum CompanySetting: int
{
    use BaseEnumTrait;

    case Fallback_Locale = 1;

    public function getLabel(): string
    {
        return match ($this) {
            self::Fallback_Locale => Lang::get('messages.Default Language'),
        };
    }
}
