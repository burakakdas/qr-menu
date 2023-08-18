<?php

namespace App\Filters\Utils\Traits;

trait HasTitleFilter
{
    private $title;

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function titleToArray(): array
    {
        return [
            'title' => $this->title,
        ];
    }
}
