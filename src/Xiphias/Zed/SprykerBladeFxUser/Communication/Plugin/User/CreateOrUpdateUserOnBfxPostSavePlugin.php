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
 */
class CreateOrUpdateUserOnBfxPostSavePlugin extends AbstractPlugin implements UserPostSavePluginInterface
{
    /**
     * @var string
     */
    protected const USER_KEY = 'user';

    /**
     * @var string
     */
    protected const GROUP_KEY = 'group';

    /**
     * @param \Generated\Shared\Transfer\UserTransfer $userTransfer
     *
     * @return \Generated\Shared\Transfer\UserTransfer
     */
    public function postSave(UserTransfer $userTransfer): UserTransfer
    {
        $sessionClient = $this->getFactory()->getSessionClient();
        $bfxUserSession = $this->getFactory()->getReportsSharedConfig()->getBfxUserSessionKey($userTransfer->getUsername());
        $request = $this->getFactory()->getRequestStackService()->getCurrentRequest();

        if ($sessionClient->has($bfxUserSession)) {
            $userTransferFromSession = ($sessionClient->get($bfxUserSession))
                ->setIdUser($userTransfer->getIdUser());
            $this->getFacade()->executeCreateOrUpdateUserOnBladeFx($request->request->all()[static::USER_KEY][static::GROUP_KEY], $userTransferFromSession);
            $sessionClient->remove($bfxUserSession);
        }

        return $userTransfer;
    }
}
