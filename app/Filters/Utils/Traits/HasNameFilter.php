<?php

namespace App\Filters\Utils\Traits;

trait HasNameFilter
{
    /**
     * @var string|null
     */
    private $name;

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     *
     * @return $this
     */
    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return array
     */
    public function nameToArray(): array
    {
        return [
            'name' => $this->name,
        ];
    }
}
