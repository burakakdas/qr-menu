<?php

namespace App\Filters\Utils\FetchType;

class Paginate extends FetchType
{
    public string $paginationPath;
    public ?int $perPage;

    public function __construct(string $paginationPath, ?int $perPage = 15)
    {
        $this->fetchType = FetchType::ID_PAGINATE;
        $this->paginationPath = $paginationPath;
        $this->perPage = $perPage;
    }

    public function getPerPage(): int
    {
        return $this->perPage;
    }

    public function getPaginationPath(): string
    {
        return $this->paginationPath;
    }
}
