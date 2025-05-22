<?php


namespace Xiphias\Zed\SprykerBladeFxUser\Communication\Plugin\User;

use Generated\Shared\Transfer\UserTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\UserExtension\Dependency\Plugin\UserPostSavePluginInterface;
use Xiphias\Shared\Reports\ReportsConstants;

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
        if (!class_exists(ReportsConstants::MARKETPLACE_ONLY_CLASS)) {
            $this->getFacade()->executeCreateOrUpdateUserOnBladeFx($userTransfer);
        }

        return $userTransfer;
    }
}
