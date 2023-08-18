<?php

namespace App\Filters\Utils\FetchType;

abstract class FetchType
{
    public const ID_PAGINATE = 1;
    public const ID_MODEL = 2;
    public const ID_PLUCK = 3;
    public const ID_COLLECT = 4;

    public int $fetchType;

    public function getFetchTypeId(): int
    {
        return $this->fetchType;
    }
}
