<?php

namespace App\Filters\Utils\FetchType;

class Model extends FetchType
{
    public function __construct()
    {
        $this->fetchType = FetchType::ID_MODEL;
    }
}
