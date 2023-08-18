<?php

namespace App\Filters\Utils\FetchType;

class Pluck extends FetchType
{
    public function __construct(
        public string $pluckColumn,
        public string|null $pluckKey = null)
    {
        $this->fetchType = FetchType::ID_PLUCK;
    }

    public function getPluckColumn(): string
    {
        return $this->pluckColumn;
    }

    public function getPluckKey(): ?string
    {
        return $this->pluckKey;
    }
}
