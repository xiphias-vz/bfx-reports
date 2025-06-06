<?php


namespace Xiphias\Zed\SprykerBladeFxUser\Communication\Plugin\User;

use Generated\Shared\Transfer\UserTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\UserExtension\Dependency\Plugin\UserPostSavePluginInterface;
use Xiphias\Shared\Reports\ReportsConstants;

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
        if (!class_exists(ReportsConstants::MARKETPLACE_ONLY_CLASS)
            && $userTransfer->getStatus() === 'deleted'
            && $this->getFacade()->hasUserBfxGroup($userTransfer->getIdUser())
        ) {
            $this->getFacade()->deleteUserOnBladeFx($userTransfer);
        }

        return $userTransfer;
    }
}
