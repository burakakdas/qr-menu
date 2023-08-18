<?php

namespace App\Filters\Utils\WhereHas;

class Clause
{
    public function __construct(
        protected string $clause,
        protected string $value,
    ) {
    }

    public function getClause(): string
    {
        return $this->clause;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
