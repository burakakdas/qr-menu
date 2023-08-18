<?php

namespace App\Filters\Utils\Traits;

trait HasDistrictFilter
{
    /**
     * @var int|null
     */
    private $districtId;

    /**
     * @return int|null
     */
    public function getDistrictId(): ?int
    {
        return $this->districtId;
    }

    /**
     * @param int|null $districtId
     *
     * @return $this
     */
    public function setDistrictId(?int $districtId): self
    {
        $this->districtId = $districtId;
        return $this;
    }

    /**
     * @return array
     */
    public function districtIdToArray(): array
    {
        return [
            'districtId' => $this->districtId,
        ];
    }
}
