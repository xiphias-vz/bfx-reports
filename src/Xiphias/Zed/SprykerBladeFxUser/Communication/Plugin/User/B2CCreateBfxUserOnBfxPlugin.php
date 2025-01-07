<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Zed\SprykerBladeFxUser\Communication\Plugin\User;

use Generated\Shared\Transfer\UserTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \Xiphias\Zed\SprykerBladeFxUser\Business\SprykerBladeFxUserFacadeInterface getFacade()
 */
class B2CCreateBfxUserOnBfxPlugin extends AbstractPlugin implements BfxUserHandlerPluginInterface
{
    /**
     * @param array $groupRoles
     * @param int $userId
     *
     * @return bool
     */
    public function isApplicable(array $groupRoles, int $userId): bool
    {
        return $this->getFacade()->checkIfB2CBackofficeUserApplicableForCreationOnBfx($groupRoles, $userId);
    }

    /**
     * @param \Generated\Shared\Transfer\UserTransfer $userTransfer
     *
     * @return void
     */
    public function execute(UserTransfer $userTransfer): void
    {
        $this->getFacade()->createOrUpdateUserOnBfx($userTransfer);
    }
}
