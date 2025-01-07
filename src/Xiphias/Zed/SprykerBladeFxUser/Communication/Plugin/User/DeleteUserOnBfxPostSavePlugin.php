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
class DeleteUserOnBfxPostSavePlugin extends AbstractPlugin implements UserPostSavePluginInterface
{
    /**
     * @var string
     */
    protected const HTTP_METHOD_DELETE = 'DELETE';

    /**
     * @param \Generated\Shared\Transfer\UserTransfer $userTransfer
     *
     * @return \Generated\Shared\Transfer\UserTransfer
     */
    public function postSave(UserTransfer $userTransfer): UserTransfer
    {
        $request = $this->getFactory()->getRequestStackService()->getCurrentRequest();

        if ($request->isMethod(static::HTTP_METHOD_DELETE) && $this->getFacade()->checkIfUserHasBfxBOGroup($userTransfer->getIdUser())) {
            $this->getFacade()->deleteUserOnBladeFx($userTransfer);
        }

        return $userTransfer;
    }
}
