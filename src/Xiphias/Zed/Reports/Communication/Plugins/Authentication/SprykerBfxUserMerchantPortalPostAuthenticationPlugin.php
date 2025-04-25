<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Zed\Reports\Communication\Plugins\Authentication;

use Generated\Shared\Transfer\MerchantUserTransfer;
use Generated\Shared\Transfer\UserTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Xiphias\Zed\Reports\Communication\ReportsCommunicationFactory getFactory()
 * @method \Xiphias\Zed\Reports\Business\ReportsFacadeInterface getFacade()
 */
class SprykerBfxUserMerchantPortalPostAuthenticationPlugin extends AbstractPlugin implements PostUserAuthenticationPluginInterface
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \Generated\Shared\Transfer\UserTransfer $userTransfer
     *
     * @return void
     */
    public function execute(Request $request, UserTransfer $userTransfer): void
    {
        $this->getFacade()->authenticateBladeFxUserOnMerchantPortal($request, $userTransfer);
    }
}
