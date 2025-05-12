<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Zed\SprykerBladeFxUser\Communication\Plugin\User;

use Generated\Shared\Transfer\UserTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\UserExtension\Dependency\Plugin\UserPostSavePluginInterface;

/**
 * @method \Xiphias\Zed\SprykerBladeFxUser\Business\SprykerBladeFxUserFacadeInterface getFacade()
 * @method \Xiphias\Zed\SprykerBladeFxUser\Communication\SprykerBladeFxUserCommunicationFactory getFactory()
 * @method \Xiphias\Zed\SprykerBladeFxUser\Persistence\SprykerBladeFxUserRepositoryInterface getRepository()
 */
class CreateOrUpdateUserOnBfxPostSavePlugin extends AbstractPlugin implements UserPostSavePluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\UserTransfer $userTransfer
     *
     * @return \Generated\Shared\Transfer\UserTransfer
     */
    public function postSave(UserTransfer $userTransfer): UserTransfer
    {
        if ($this->hasUserBfxGroup($userTransfer->getGroup())) {
            $this->getFacade()->executeCreateOrUpdateUserOnBladeFx($userTransfer);
        }

        return $userTransfer;
    }

    /**
     * @param array $groups
     *
     * @return bool
     */
    protected function hasUserBfxGroup(array $groups): bool
    {
        $bofficeGroupId = $this->getRepository()->getBladeFxBOGroupId();
        $mpGroupId = $this->getRepository()->getBladeFxMPGroupId();

        return in_array($bofficeGroupId, $groups) || in_array($mpGroupId, $groups);
    }
}
