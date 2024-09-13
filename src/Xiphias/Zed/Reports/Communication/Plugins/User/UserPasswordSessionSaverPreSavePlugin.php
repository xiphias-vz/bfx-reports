<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Zed\Reports\Communication\Plugins\User;

use Generated\Shared\Transfer\UserTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\UserExtension\Dependency\Plugin\UserPreSavePluginInterface;

/**
 * @method \Xiphias\Zed\Reports\ReportsConfig getConfig()
 * @method \Xiphias\Zed\Reports\Communication\ReportsCommunicationFactory getFactory()
 * @method \Xiphias\Zed\Reports\Business\ReportsFacadeInterface getFacade()
 * @method \Xiphias\Zed\Reports\Persistence\ReportsRepositoryInterface getRepository()
 */
class UserPasswordSessionSaverPreSavePlugin extends AbstractPlugin implements UserPreSavePluginInterface
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
    public function preSave(UserTransfer $userTransfer): UserTransfer
    {
        $sessionClient = $this->getFactory()->getSessionClient();
        $request = $this->getFactory()->getRequestStackService()->getCurrentRequest();

        if (isset($request->request->all()[static::USER_KEY]) && $this->getRepository()->findBladeFxBOGroupById($request->request->all()[static::USER_KEY][static::GROUP_KEY])) {
            $sessionClient->set($this->getConfig()->getBfxUserSessionKey($userTransfer->getUsername()), $userTransfer);
        }

        return $userTransfer;
    }
}
