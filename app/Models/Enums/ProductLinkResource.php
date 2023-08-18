<?php

namespace App\Models\Enums;

use App\Models\Enums\Traits\BaseEnumTrait;

enum ProductLinkResource: int
{
    use BaseEnumTrait;

    case Instagram = 1;
    case Facebook = 2;
    case Tiktok = 3;
    case Youtube = 4;

    public function getLabel(): string
    {
        return match ($this) {
            self::Instagram => 'Instagram',
            self::Facebook => 'Facebook',
            self::Tiktok => 'Tiktok',
            self::Youtube => 'Youtube',
        };
    }
}
