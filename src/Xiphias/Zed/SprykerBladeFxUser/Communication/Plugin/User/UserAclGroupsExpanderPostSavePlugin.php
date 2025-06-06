<?php

declare(strict_types=1);

namespace Xiphias\Zed\SprykerBladeFxUser\Communication\Plugin\User;


use Generated\Shared\Transfer\UserTransfer;
use Spryker\Zed\UserExtension\Dependency\Plugin\UserPostSavePluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \Xiphias\Zed\BfxReportsMerchantPortalGui\Business\BfxReportsMerchantPortalGuiFacade getFacade();
 * @method \Xiphias\Zed\BfxReportsMerchantPortalGui\Communication\BfxReportsMerchantPortalGuiCommunicationFactory getFactory();
 * @method \Xiphias\Zed\BfxReportsMerchantPortalGui\Persistence\BfxReportsMerchantPortalGuiRepositoryInterface getRepository()
 */
class UserAclGroupsExpanderPostSavePlugin extends AbstractPlugin implements UserPostSavePluginInterface
{
    public function postSave(UserTransfer $userTransfer): UserTransfer
    {
        $requestStackService = $this->getFactory()->getRequestStackService();
        $request = $requestStackService ? $requestStackService->getCurrentRequest() : null;

        if ($request) {
            $requestUserTransfer = (new UserTransfer())
                ->fromArray($request->request->all()['user'] ?? [], true);

            $userTransfer->setGroup($requestUserTransfer->getGroup());
        }

        return $userTransfer;
    }
}
