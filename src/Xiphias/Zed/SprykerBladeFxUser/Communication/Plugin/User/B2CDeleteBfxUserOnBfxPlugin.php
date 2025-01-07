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
 * @method \Xiphias\Zed\SprykerBladeFxUser\Business\SprykerBladeFxUserBusinessFactory getFactory()
 */
class B2CDeleteBfxUserOnBfxPlugin extends AbstractPlugin implements BfxUserHandlerPluginInterface
{
    /**
     * @param array $groupRoles
     * @param int $userId
     *
     * @return bool
     */
    public function isApplicable(array $groupRoles, int $userId): bool
    {
        return $this->getFacade()->checkIfB2CBackofficeUserApplicableForDeleteOnBfx($groupRoles, $userId);
    }

    /**
     * @param \Generated\Shared\Transfer\UserTransfer $userTransfer
     *
     * @return void
     */
    public function execute(UserTransfer $userTransfer): void
    {
        $this->getFacade()->deleteUserOnBladeFx($userTransfer);
    }
}
