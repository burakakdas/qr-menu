<?php

namespace App\Filters\Utils;

use App\Filters\Utils\WhereHas\Clause;

class WhereHas
{
    /**
     * @var string
     */
    protected $relation;

    /**
     * @var Clause[]
     */
    protected $clauses;

    public function __construct(
        string $relation,
        array $clauses,
    ) {
        $this->relation = $relation;
        $this->clauses = $clauses;
    }


    public function getRelation(): string
    {
        return $this->relation;
    }

    public function getClauses(): array
    {
        return $this->clauses;
    }
}
