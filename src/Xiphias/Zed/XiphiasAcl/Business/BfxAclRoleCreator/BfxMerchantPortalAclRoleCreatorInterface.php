<?php


namespace Xiphias\Zed\XiphiasAcl\Business\BfxAclRoleCreator;

use Generated\Shared\Transfer\BfxAclRoleTransfer;

interface BfxMerchantPortalAclRoleCreatorInterface
{
    /**
     * @return \Generated\Shared\Transfer\BfxAclRoleTransfer
     */
    public function createBfxMerchantPortalAclRoleAndGroup(): BfxAclRoleTransfer;
}
