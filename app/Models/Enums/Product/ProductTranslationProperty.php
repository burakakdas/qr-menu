<?php

namespace App\Models\Enums\Product;

use App\Models\Enums\Traits\BaseEnumTrait;

enum ProductTranslationProperty: int
{
    use BaseEnumTrait;

    case NAME = 1;
    case DESCRIPTION = 2;
}
