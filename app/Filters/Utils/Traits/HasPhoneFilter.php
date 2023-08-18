<?php

namespace App\Filters\Utils\Traits;

trait HasPhoneFilter
{
    /**
     * @var string|null
     */
    private $phone;

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     *
     * @return $this
     */
    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return array
     */
    public function phoneToArray(): array
    {
        return [
            'phone' => $this->phone,
        ];
    }
}
