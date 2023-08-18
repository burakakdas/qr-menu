<?php

namespace App\Filters\Utils\Traits;

trait HasProvinceFilter
{
    /**
     * @var int|null
     */
    private $provinceId;

    /**
     * @return int|null
     */
    public function getProvinceId(): ?int
    {
        return $this->provinceId;
    }

    /**
     * @param int|null $provinceId
     *
     * @return $this
     */
    public function setProvinceId(?int $provinceId): self
    {
        $this->provinceId = $provinceId;
        return $this;
    }

    /**
     * @return array
     */
    public function provinceIdToArray(): array
    {
        return [
            'provinceId' => $this->provinceId,
        ];
    }
}
