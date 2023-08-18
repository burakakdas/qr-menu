<?php

namespace App\Filters\Utils\Traits;

trait HasBirthdayFilter
{
    private string|null $birthday = null;

    public function getBirthday(): ?string
    {
        return $this->birthday;
    }

    public function setBirthday(?string $birthday): self
    {
        $this->birthday = $birthday;
        return $this;
    }

    public function birthdayToArray(): array
    {
        return  [
            'birthday' => $this->birthday,
        ];
    }
}
