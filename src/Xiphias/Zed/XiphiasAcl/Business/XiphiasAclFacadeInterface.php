<?php


namespace Xiphias\Zed\XiphiasAcl\Business;

use Generated\Shared\Transfer\BfxAclRoleTransfer;

interface XiphiasAclFacadeInterface
{
    /**
     * @return \Generated\Shared\Transfer\BfxAclRoleTransfer
     */
    public function createBfxAclRoleAndGroup(): BfxAclRoleTransfer;
}
