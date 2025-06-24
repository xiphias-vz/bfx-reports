<?php


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
}
