<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Zed\SprykerBladeFxUser\Business\Handler;

use Generated\Shared\Transfer\UserTransfer;

interface BladeFxUserHandlerInterface
{
    /**
     * @param \Generated\Shared\Transfer\UserTransfer $userTransfer
     * @param bool $isActive
     * @param bool $isItFromBO
     *
     * @return void
     */
    public function createOrUpdateUserOnBfx(UserTransfer $userTransfer, bool $isActive = true, bool $isItFromBO = true): void;

    /**
     * @param \Generated\Shared\Transfer\UserTransfer $userTransfer
     *
     * @return void
     */
    public function deleteUserOnBladeFx(UserTransfer $userTransfer): void;

    /**
     * @param array $groupRoles
     * @param \Generated\Shared\Transfer\UserTransfer $userTransfer
     *
     * @return void
     */
    public function executeCreateOrUpdateUserOnBladeFx(array $groupRoles, UserTransfer $userTransfer): void;
}
