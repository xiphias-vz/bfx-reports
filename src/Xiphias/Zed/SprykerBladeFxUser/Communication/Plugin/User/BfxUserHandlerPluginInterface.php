<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Zed\SprykerBladeFxUser\Communication\Plugin\User;

use Generated\Shared\Transfer\UserTransfer;

interface BfxUserHandlerPluginInterface
{
    /**
     * @param array $groupRoles
     * @param int $userId
     *
     * @return bool
     */
    public function isApplicable(array $groupRoles, int $userId): bool;

    /**
     * @param \Generated\Shared\Transfer\UserTransfer $userTransfer
     *
     * @return void
     */
    public function execute(UserTransfer $userTransfer): void;
}
