<?php

namespace App\Filters\Utils\Traits;

trait HasSlugFilter
{
    private $slug;

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;
        return $this;
    }

    public function slugToArray(): array
    {
        return [
            'slug' => $this->slug,
        ];
    }
}
