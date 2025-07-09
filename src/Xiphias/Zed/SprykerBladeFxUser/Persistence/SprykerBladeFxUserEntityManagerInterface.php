<?php

declare(strict_types=1);

namespace Xiphias\Zed\SprykerBladeFxUser\Persistence;

interface SprykerBladeFxUserEntityManagerInterface
{
    /**
     * @param int $userId
     * @param int $groupId
     *
     * @return void
     */
    public function deleteUserHasGroupsByUserIdAndGroupId(int $userId, int $groupId): void;
}
