<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Zed\Reports\Persistence;

use Generated\Shared\Transfer\UserTransfer;

interface ReportsRepositoryInterface
{
    /**
     * @param array $groupRoles
     *
     * @return bool
     */
    public function findBladeFxGroupById(array $groupRoles): bool;

    /**
     * @param array $groupRoles
     *
     * @return bool
     */
    public function findBladeFxBOGroupById(array $groupRoles): bool;

    /**
     * @param int $userId
     *
     * @return bool
     */
    public function checkIfUserHasMerchant(int $userId): bool;

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
     * @param \Generated\Shared\Transfer\UserTransfer $userTransfer
     *
     * @return bool
     */
    public function checkIfUserHasAdminGroup(UserTransfer $userTransfer): bool;

    /**
     * @param int $userId
     *
     * @return string
     */
    public function getUserMerchantId(int $userId): string;
}
