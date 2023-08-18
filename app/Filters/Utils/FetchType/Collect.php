<?php

namespace App\Filters\Utils\FetchType;

class Collect extends FetchType
{
    public function __construct()
    {
        $this->fetchType = FetchType::ID_COLLECT;
    }
}
