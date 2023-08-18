<?php

namespace App\Filters\Utils\Traits;

trait HasUserFilter
{
    private array $userIds = [];

    /**
     * @return array
     */
    public function getUserIds(): array
    {
        return $this->userIds;
    }

    /**
     * @param array $userIds
     *
     * @return $this
     */
    public function setUserIds(array $userIds): self
    {
        $this->userIds = $userIds;
        return $this;
    }

    /**
     * @param int $userId
     *
     * @return $this
     */
    public function addUserId(int $userId): self
    {
        if (! in_array($userId, $this->userIds)) {
            $this->userIds[] = $userId;
        }

        return $this;
    }

    /**
     * @return array
     */
    public function userIdsToArray(): array
    {
        return [
            'userIds' => $this->userIds,
        ];
    }
}
