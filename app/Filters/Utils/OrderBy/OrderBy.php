<?php

namespace App\Filters\Utils\OrderBy;

class OrderBy
{
    public function __construct(protected string $column, protected ?string $direction = null)
    {
        //
    }

    public function getColumn(): string
    {
        return $this->column;
    }

    public function getDirection(): ?string
    {
        return $this->direction;
    }
}
