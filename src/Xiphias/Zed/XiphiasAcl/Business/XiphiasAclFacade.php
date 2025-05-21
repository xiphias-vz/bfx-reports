<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Zed\XiphiasAcl\Business;

use Generated\Shared\Transfer\BfxAclRoleTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \Xiphias\Zed\XiphiasAcl\Business\XiphiasAclBusinessFactory getFactory()
 */
class XiphiasAclFacade extends AbstractFacade implements XiphiasAclFacadeInterface
{
    /**
     * @return \Generated\Shared\Transfer\BfxAclRoleTransfer
     */
    public function createBfxAclRoleAndGroup(): BfxAclRoleTransfer
    {
        return $this->getFactory()
            ->createBfxAclRoleCreator()
            ->createBfxAclRoleAndGroup();
    }

    /**
     * @return \Generated\Shared\Transfer\BfxAclRoleTransfer
     */
    public function createBfxMerchantPortalAclRoleAndGroup(): BfxAclRoleTransfer
    {
        return $this->getFactory()
            ->createBfxMerchantPortalAclRoleCreator()
            ->createBfxMerchantPortalAclRoleAndGroup();
    }
}
