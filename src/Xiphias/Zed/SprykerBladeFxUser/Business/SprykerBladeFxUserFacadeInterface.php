<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Zed\SprykerBladeFxUser\Business;

use Generated\Shared\Transfer\UserTransfer;

interface SprykerBladeFxUserFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\UserTransfer $userTransfer
     *
     * @return void
     */
    public function createOrUpdateUserOnBfx(UserTransfer $userTransfer): void;

    /**
     * @param array $groupRoles
     * @param int $userId
     *
     * @return bool
     */
    public function checkIfB2CBackofficeUserApplicableForCreationOnBfx(array $groupRoles, int $userId): bool;

    /**
     * @param array $groupRoles
     * @param int $userId
     *
     * @return bool
     */
    public function checkIfB2CBackofficeUserApplicableForUpdateOnBfx(array $groupRoles, int $userId): bool;

    /**
     * @param array $groupRoles
     * @param int $userId
     *
     * @return bool
     */
    public function checkIfB2CBackofficeUserApplicableForDeleteOnBfx(array $groupRoles, int $userId): bool;

    /**
     * @param \Generated\Shared\Transfer\UserTransfer $userTransfer
     *
     * @return void
     */
    public function deleteUserOnBladeFx(UserTransfer $userTransfer): void;

    /**
     * @param int $userId
     *
     * @return bool
     */
    public function checkIfUserHasBfxBOGroup(int $userId): bool;

    /**
     * @param \Generated\Shared\Transfer\UserTransfer|null $userTransfer
     *
     * @return bool
     */
    public function checkIfUserIsAdmin(?UserTransfer $userTransfer = null): bool;

    /**
     * @param array $groupRoles
     * @param \Generated\Shared\Transfer\UserTransfer $userTransfer
     *
     * @return void
     */
    public function executeCreateOrUpdateUserOnBladeFx(array $groupRoles, UserTransfer $userTransfer): void;
}
