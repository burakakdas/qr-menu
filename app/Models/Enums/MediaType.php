<?php

namespace App\Models\Enums;

use App\Models\Enums\Traits\BaseEnumTrait;

enum MediaType: int
{
    use BaseEnumTrait;

    case IMAGE = 1;

    public function getLabel(): string
    {
        return match ($this) {
            self::IMAGE => 'Fotoğraf',
        };
    }
}
