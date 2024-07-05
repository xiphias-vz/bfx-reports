<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Zed\Acl\Business\BfxAclRoleCreator;

use Generated\Shared\Transfer\BfxAclRoleTransfer;

interface BfxMerchantPortalAclRoleCreatorInterface
{
    /**
     * @return \Generated\Shared\Transfer\BfxAclRoleTransfer
     */
    public function createBfxMerchantPortalAclRoleAndGroup(): BfxAclRoleTransfer;
}
