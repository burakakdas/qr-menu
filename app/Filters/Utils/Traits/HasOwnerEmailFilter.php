<?php

namespace App\Filters\Utils\Traits;

trait HasOwnerEmailFilter
{
    private $ownerEmail;

    public function getOwnerEmail(): ?string
    {
        return $this->ownerEmail;
    }

    public function setOwnerEmail(?string $ownerEmail): self
    {
        $this->ownerEmail = $ownerEmail;
        return $this;
    }

    public function ownerEmailToArray(): array
    {
        return [
            'ownerEmail' => $this->ownerEmail,
        ];
    }
}
