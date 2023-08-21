<?php

namespace App\Models\Enums;

use App\Models\Enums\Traits\BaseEnumTrait;

enum MediaType: int
{
    use BaseEnumTrait;

    case Photo = 1;

    public function getLabel(): string
    {
        return match ($this) {
            self::Photo => 'Fotoğraf',
        };
    }
}
