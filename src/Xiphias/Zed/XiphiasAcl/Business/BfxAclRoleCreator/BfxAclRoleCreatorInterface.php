<?php


namespace Xiphias\Zed\XiphiasAcl\Business\BfxAclRoleCreator;

use Generated\Shared\Transfer\BfxAclRoleTransfer;

interface BfxAclRoleCreatorInterface
{
    /**
     * @return \Generated\Shared\Transfer\BfxAclRoleTransfer
     */
    public function createBfxAclRoleAndGroup(): BfxAclRoleTransfer;
}
