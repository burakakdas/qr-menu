<?php

namespace App\Filters\Utils\Traits;

trait HasResourceFilter
{
    private $resource;

    public function getResource(): ?string
    {
        return $this->resource;
    }

    public function setResource(?string $resource): self
    {
        $this->resource = $resource;
        return $this;
    }

    public function resourceToArray(): array
    {
        return [
            'resource' => $this->resource,
        ];
    }
}
