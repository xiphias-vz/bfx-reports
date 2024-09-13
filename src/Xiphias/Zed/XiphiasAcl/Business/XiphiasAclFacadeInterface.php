<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Zed\XiphiasAcl\Business;

use Generated\Shared\Transfer\BfxAclRoleTransfer;

interface XiphiasAclFacadeInterface
{
    /**
     * @return \Generated\Shared\Transfer\BfxAclRoleTransfer
     */
    public function createBfxAclRoleAndGroup(): BfxAclRoleTransfer;

    /**
     * @return \Generated\Shared\Transfer\BfxAclRoleTransfer
     */
    public function createBfxMerchantPortalAclRoleAndGroup(): BfxAclRoleTransfer;
}
