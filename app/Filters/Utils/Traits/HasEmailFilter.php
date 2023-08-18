<?php

namespace App\Filters\Utils\Traits;

trait HasEmailFilter
{
    /**
     * @var string|null
     */
    private $email;

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     *
     * @return $this
     */
    public function setEmail(?string $email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return array
     */
    public function emailToArray(): array
    {
        return [
            'email' => $this->email,
        ];
    }
}
