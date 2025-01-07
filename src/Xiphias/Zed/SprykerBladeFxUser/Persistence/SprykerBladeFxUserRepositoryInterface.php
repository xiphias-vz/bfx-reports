<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Zed\SprykerBladeFxUser\Persistence;

interface SprykerBladeFxUserRepositoryInterface
{
    /**
     * @param int $userId
     *
     * @return string
     */
    public function getUserMerchantId(int $userId): string;

    /**
     * @return int
     */
    public function getBladeFxBOGroupId(): int;

    /**
     * @param string $groupName
     *
     * @return int
     */
    public function findWantedGroupId(string $groupName): int;

    /**
     * @param array $groupRoles
     *
     * @return bool
     */
    public function findBladeFxBOGroupById(array $groupRoles): bool;

    /**
     * @param array $groupRoles
     *
     * @return bool
     */
    public function findBladeFxMPGroupById(array $groupRoles): bool;

    /**
     * @param int $userId
     * @param int $groupId
     *
     * @return bool
     */
    public function checkIfUserHasWantedGroup(int $userId, int $groupId): bool;

    /**
     * @param int $userId
     *
     * @return bool
     */
    public function checkIfUserHasBfxMPGroup(int $userId): bool;

    /**
     * @param int $userId
     *
     * @return bool
     */
    public function checkIfUserHasBfxBOGroup(int $userId): bool;

    /**
     * @param int $userId
     *
     * @return bool
     */
    public function checkIfUserHasMerchant(int $userId): bool;
}
