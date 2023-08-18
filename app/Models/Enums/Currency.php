<?php

namespace App\Models\Enums;

use App\Models\Enums\Traits\BaseEnumTrait;

enum Currency: int
{
    use BaseEnumTrait;

    case TL = 1;

    public function getLabel(): string
    {
        return match ($this) {
            self::TL => 'TL',
        };
    }

    public function getSymbol(): string
    {
        return match ($this) {
            self::TL => '₺',
        };
    }
}
