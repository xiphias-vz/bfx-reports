<?php


namespace Xiphias\Zed\XiphiasAcl\Business;

use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Xiphias\Zed\XiphiasAcl\Business\BfxAclRoleCreator\BfxAclRoleCreator;
use Xiphias\Zed\XiphiasAcl\Business\BfxAclRoleCreator\BfxAclRoleCreatorInterface;
use Xiphias\Zed\XiphiasAcl\Business\BfxAclRoleCreator\BfxMerchantPortalAclRoleCreator;
use Xiphias\Zed\XiphiasAcl\Business\BfxAclRoleCreator\BfxMerchantPortalAclRoleCreatorInterface;

/**
 * @method \Xiphias\Zed\XiphiasAcl\XiphiasAclConfig getConfig()
 */
class XiphiasAclBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \Xiphias\Zed\XiphiasAcl\Business\BfxAclRoleCreator\BfxAclRoleCreatorInterface
     */
    public function createBfxAclRoleCreator(): BfxAclRoleCreatorInterface
    {
        return new BfxAclRoleCreator($this->getConfig());
    }

    /**
     * @return \Xiphias\Zed\XiphiasAcl\Business\BfxAclRoleCreator\BfxMerchantPortalAclRoleCreatorInterface
     */
    public function createBfxMerchantPortalAclRoleCreator(): BfxMerchantPortalAclRoleCreatorInterface
    {
        return new BfxMerchantPortalAclRoleCreator($this->getConfig());
    }
}
